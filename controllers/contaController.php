<?php
class contaController extends controller {

    private $userName;
    private $arrayInfo;
    private $user;

    public function __construct() {
		parent::__construct();

        $userName = '';
		$u = new users();

        if(!$u->isLogged($userName)) {
            header("Location: ".BASE_URL);
        }

        $this->arrayInfo = array(
            'user' => $this->user
        );
		
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
 
			
		

        $this->loadTemplate('conta', $dados);
        }
    }

    public function meus_dados() {
        $users = new users();
        $store = new store();
        $dados = $store->getTemplateData();
        if(isset($_SESSION['name'])) {
            $this->loadTemplate('meus_dados', $dados);
        }
    }
	
	

}