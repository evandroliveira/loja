<?php
class boletoController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
    	$store = new store();
    	$users = new users();
    	$cart = new cart();
    	$purchases = new purchases();

        $dados = $store->getTemplateData();
        $dados['error'] = '';

		//Receber todas as informações enviadas
        if(!empty($_POST['name'])) {

			$name = addslashes($_POST['name']);
			if(!empty($_POST['cpf'])) {}
	        $cpf = addslashes($_POST['cpf1']);
	        $telefone = addslashes($_POST['telefone']);
	        $email = addslashes($_POST['email']);
	        $pass = addslashes($_POST['pass']);
	        $cep = addslashes($_POST['cep']);
	        $rua = addslashes($_POST['rua']);
	        $numero = addslashes($_POST['numero']);
	        $complemento = addslashes($_POST['complemento']);
	        $bairro = addslashes($_POST['bairro']);
	        $cidade = addslashes($_POST['cidade']);
	        $estado = addslashes($_POST['estado']);

	        if($users->emailExists($email)) {
	            $uid = $users->validate($email, $pass);

	            if(empty($uid)) {
	            	$dados['error'] = 'E-mail e/ou senha não conferem.';
	            }
	        } else {
	            $uid = $users->createUser($email, $pass); //Criando um usuário
	        }

	        if(!empty($uid)) {

	        	$list = $cart->getList();
	        	$frete = 0;
	        	$total = 0;

	        	foreach($list as $item) {
		            $total += (floatval($item['price']) * intval($item['qt']));
		        }

	        	if(!empty($_SESSION['shipping'])) {
		            $shipping = $_SESSION['shipping'];

		            if(isset($shipping['price'])) {
		                $frete = floatval(str_replace(',', '.', $shipping['price']));
		            } else {
		                $frete = 0;
		            }

		            $total += $frete;
		        }
				//Criando a transação no sistema
		        $id_purchase = $purchases->createPurchase($uid, $total, 'paypal');

				//Add os itens
		        foreach($list as $item) {
		            $purchases->addItem($id_purchase, $item['id'], $item['qt'], $item['price']);
		        }

				global $config;				

				// Começar a integração com boleto
				$options = array(
					'client_id' => $config['gerencianet_clientid'],
					'client_secret' => $config['gerencianet_secret'],
					'sandbox' => $config['gerencianet_sandbox']
				);

				//criando um array com os itens do carrinho de compra
				$items = array();
				foreach($list as $item) {
					$items[] = array(
						'name' => $item['name'],
						'amount' => $item['qt'],
						'value' => ($item['price'] * 100) //transformando em centavos
					);
				}

				$metadata = array(
					'custom_id' => $id_purchase,
					'notification_url' => BASE_URL.'boleto/notificacao'
				);
				
				//variavel com o valor do frete
				$shipping = array(
					array(
						'name' => 'FRETE',
						'value' => ($frete * 100)
					)
				);

				//Corpo da requisição
				$body = array(
					'metadata' => $metadata,
					'items' => $items,
					'shippings' => $shipping
				);

				//Passo 1 registrar a transação
				try {
					//Iniciando o gerencianet
					$api = new \Gerencianet\Gerencianet($options);
					$charge = $api->createCharge(array(), $body);

					if($charge['code'] == 200 ) {
						$charge_id = $charge['data']['charge_id'];

						$params = array(
							'id' => $charge_id
						);

						//Add o comprador no boleto
						$customer = array(
							'name' => $name,
							'cpf' => $cpf,
							'phone_number' => $telefone
						);

						//Criar informações do boleto
						$bankingBillet = array(
							'expire_at' => date('Y-m-d', strtotime('+4 days')),
							'customer' => $customer,
							'message' => "Pague o boleto até o vencimento!"
						);

						//Criar a variaval do pagamento
						$payment = array(
							'banking_billet' => $bankingBillet
						);

						$body = array(
							'payment' => $payment
						);

						//Gerar o boleto
						try {
							//usar a API
							$charge = $api->payCharge($params, $body);

							if($charge['code'] == '200') {
								$link = $charge['data']['link'];
								
								$_SESSION['link'] = $link;
								
								$purchases->updateBilletUrl($id_purchase, $_SESSION['link']);


								unset($_SESSION['cart']);

								$this->loadTemplate('boleto_obrigado', $dados);
								exit;
							}
						} catch (Exception $e ) {
							echo "ERRO: ";
							print_r($e->getMessage());
							exit;
						}
					}

				} catch (Exception $e ) {
					echo "ERRO: ";
					print_r($e->getMessage());
					exit;
				}

	        }


        }

        $this->loadTemplate('cart_boleto', $dados);
	}
	
	public function notificacao() {

		global $config;

		// Começar a integração com boleto
		$options = array(
			'client_id' => $config['gerencianet_clientid'],
			'client_secret' => $config['gerencianet_secret'],
			'sandbox' => $config['gerencianet_sandbox']
		);

		$token = $_POST['notification'];

		$params = array(
			'token' => $token
		);

		try {
			$api = new \Gerencianet\Gerencianet($options);
			//Pegando a notificação
			$c = $api->getNotification($params, array());

			//historico 
			$ultimo = end($c['data']);  //função end do php que pega a ultima chave
			$custom_id = $ultimo['custom_id']; //Referente a transação do sistema
			$status = $ultimo['status']['current']; //status da transação

			//Verificando se a compra foi paga
			if($status == 'paid') {

				$purchases = new purchases();
				$purchases->setPaid($custom_id);

			}


		} catch (Exception $e ) {
			echo "ERRO";
			print_r($e->getMessage());
		}

	}



    

    












}