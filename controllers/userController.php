<?php

class usersController extends controller {

    private $user;
    private $arrayInfo;

	public function __construct() {
		$this->user = new users();

		if(!$this->user->isLogged()) {
			header("Location: ".BASE_URL);
			exit;
        }

	}

	public function index() {
        $users = new users();
        $permissions = new permissions();

       

        $this->loadTemplate('home', $this->arrayInfo);

    }
/*
    public function items()
    {
        $brands = new Permissions();
        $this->arrayInfo['list'] = $brands->getAllItems();

        $this->loadTemplate('permissions_items', $this->arrayInfo);
    }
    
    public function del($id) {
        if(!empty($id)) {

            $brands = new Brands();
            $brands->deleteBrand($id); 

        } 

        header("Location: ".BASE_URL.'brands');
        exit;
    }

    /*public function del_items($id_item) {       
        $brands = new Permissions();

        $brands->deleteItems($id_item);        

        header("Location: ".BASE_URL.'permissions/items');
        exit;
    }*/

   /* public function add() {

        $this->arrayInfo['errorItems'] = array();

        $brands = new Brands();

        $this->arrayInfo['brands'] = $brands->getAllBrands();

        if(isset($_SESSION['formError'])) {
            $this->arrayInfo['errorItems'] = $_SESSION['formError'];
            $_SESSION['formError'] = '';
        }

        $this->loadTemplate('brands_add', $this->arrayInfo);
    }

    public function add_action() {
        $brands = new Brands();
        if(!empty($_POST['name'])) {
            $name = $_POST['name'];
            $brands->addBrand($name);

            header("Location: ".BASE_URL.'brands');
            exit;
            
        } else {
            $_SESSION['formError'] = 'Preencha o campo acima!';

            header("Location: ".BASE_URL.'brands/add');
            exit;
            }
    }

    public function edit($id) {
        if(!empty($id)) {
            
            $this->arrayInfo['errorItems'] = array();
    
            $brands = new Brands();
    
            $this->arrayInfo['brands'] = $brands->getAllBrands();
            $this->arrayInfo['brands_id'] = $id;
            $this->arrayInfo['brand_name'] = $brands->get($id);
           
            if(isset($_SESSION['formError'])) {
                $this->arrayInfo['errorItems'] = $_SESSION['formError'];
                $_SESSION['formError'] = '';
            }
    
            $this->loadTemplate('brands_edit', $this->arrayInfo);
        } else {
            header("Location: ".BASE_URL.'brands');
            exit;
        }
        
    }

    public function edit_action($id) {
        if(!empty($id)) {
            $brands = new Brands();

            if(!empty($_POST['name'])) {
                $name = $_POST['name'];
                
                $brands->editName($name, $id); //passo 1.
                
                header("Location: ".BASE_URL.'brands');
                exit;

        } else {
            $_SESSION['formError'] = 'Preencha o campo acima!';

            header("Location: ".BASE_URL.'brands/edit/'.$id);
            exit;
            }

        } else {
            header("Location: ".BASE_URL.'brands');
            exit;
        }
    }
*/
}