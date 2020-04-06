<?php
class mp_userController extends controller {

    private $userName;
    private $arrayInfo;

    public function __construct() {
		parent::__construct();

        // $userName = '';
		// $u = new users();

        // if(!$u->isLogged($userName)) {
        //     header("Location: ".BASE_URL."cart");
        // }

        // $this->arrayInfo = array(
        //     'user' => $this->user
        // );
		
    }

    public function index() {
    	$store = new store();
    	$users = new users();
    	$cart = new cart();
    	$purchases = new purchases();
		$id = '';
		$dados = $store->getTemplateData();
		
        $dados['error'] = '';		

        if(isset($_SESSION['name'])) {
 
			//$dados = array();

		if(!empty($id)) {
			$u = new users();

			if(!empty($_SESSION['name'])) {
				$name = $_POST['name'];

				
			} else {
				$dados['info'] = $u->get($id);

				if(isset($dados['info']['id'])) {
					$this->loadTemplate('mp_user', $dados);
					exit;
				}
			}
		}			


	        if(!empty($uid)) {
				print_r('aqui');exit;
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
				//print_r($total);exit;

		        $id_purchase = $purchases->createPurchase($uid, $total, 'mp');

		        foreach($list as $item) {
		            $purchases->addItem($id_purchase, $item['id'], $item['qt'], $item['price']);
		        }

		        global $config;

		        $mp = new MP($config['mp_appid'], $config['mp_key']);
				
		        $data = array(
		        	'items' => array(),
		        	'shipments' => array(
		        		'mode' => 'custom',
		        		'cost' => $frete,
		        		'receiver_address' => array(
		        			'zip_code' => $cep
		        		)
		        	),
		        	'back_urls' => array(
		        		'success' => BASE_URL.'mp/obrigadoaprovado',
		        		'pending' => BASE_URL.'mp/obrigadoanalise',
		        		'failure' => BASE_URL.'mp/obrigadocancelado'
		        	),
		        	'notification_url' => BASE_URL.'mp/notificacao',
		        	'auto_return' => 'all', //ou usar 'aproved'
		        	'external_reference' => $id_purchase
				);
				

		        foreach($list as $item) {
		        	$data['items'][] = array(
		        		'title' => $item['name'],
		        		'quantity' => $item['qt'],
		        		'currency_id' => 'BRL',
		        		'unit_price' => floatval($item['price'])
		        	);
				}
				

		        $link = $mp->create_preference($data);
				

		        if($link['status'] == '201') {
		        	$link = $link['response']['init_point'];
		        	header("Location: ".$link);
		        	exit;
		        } else {
		        	$dados['error'] = 'Tente novamente mais tarde';
		        }

	        }

        }

        $this->loadTemplate('mp_user', $dados);
	}
	
	public function client($id) {

		// 1º passo: pegar as informações do contato pelo ID
		// 2º passo: carregar o formulário, preenchido.
		// 3º passo: receber os dados do form e editar.
		$dados = array();

		if(!empty($id)) {
			$u = new users();

			if(!empty($_SESSION['name'])) {
				$name = $_POST['name'];

				
			} else {
				$dados['info'] = $u->get($id);

				if(isset($dados['info']['id'])) {
					$this->loadTemplate('mp_user', $dados);
					exit;
				}
			}
		}

		header("Location: ".BASE_URL.'mp_user');
	
	}

    public function notificacao() {
    	$purchases = new purchases();

    	global $config;
		$mp = new MP($config['mp_appid'], $config['mp_key']);
		$mp->sandbox_mode(false);
		//Informações de pagamento
		$info = $mp->get_payment_info($_GET['id']);

		if($info['status'] == '200') {

			$array = $info['response'];
			$ref = $array['collection']['external_reference'];

			$status = $array['collection']['status']; 

			file_put_contents('mplog.txt', print_r($array, true));

			
			/*
			pending = Em análise
			approved = Aprovado
			in_procress = Em revisão
			in_mediation = Em processo de disputa
			----------------------
			rejected = Foi rejeitado
			cancelled = Foi cancelado
			refunded = Reembolsado
			charged_back = Chargeback
			*/

			
			if($status == 'approved') {
				$purchases->setPaid($ref);
			}
			elseif($status == 'cancelled') {
				$purchases->setCancelled($ref);
			}
			elseif($status == 'pending') {
				$purchases->setPaid($ref);
			}
			elseif($status == 'in_procress') {
				$purchases->setPaid($ref);
			}
			elseif($status == 'in_mediation') {
				$purchases->setPaid($ref);
			}			
			elseif($status == 'rejected') {
				$purchases->setCancelled($ref);
			}
			elseif($status == 'refunded') {
				$purchases->setCancelled($ref);
			}
			elseif($status == 'charged_back') {
				$purchases->setCancelled($ref);
			}
		}

    }

}