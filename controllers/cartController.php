<?php
class cartController extends controller {

	private $userName;

    public function __construct() {
        parent::__construct();
        // $userName = '';
        // $u = new users();

        // if(!$u->isLogged($userName)) {
        //     header("Location: ".BASE_URL."");
        // }
    }

    public function index() {
        $store = new store();
        $products = new products();
        $cart = new cart();
        $cep = '';
        $shipping = array();
        
        if(!empty($_POST['cep'])) {
            $cep = intval($_POST['cep']);

            $shipping = $cart->shippingCalculate($cep);
            $_SESSION['shipping'] = $shipping;

        }
        
        if(!empty($_SESSION['shipping'])) {
            $shipping = $_SESSION['shipping'];
        }

        if(!isset($_SESSION['cart']) || (isset($_SESSION['cart']) && count($_SESSION['cart']) == 0)) {
            header("Location: ".BASE_URL);
            exit;
        }

        $dados = $store->getTemplateData();

       // $_SESSION['cart'][33] = 255;
        $dados['shipping'] = $shipping;
        $dados['list'] = $cart->getList();

        //  print_r($_SESSION['shipping']);
        //  exit;

        $this->loadTemplate('cart', $dados);
    }

    public function del($id) {
        if(!empty($id)) {
            unset($_SESSION['cart'][$id]);
            unset($_SESSION['shipping']);
        }

        header("Location: ".BASE_URL."cart");
        exit;
    }

    public function addqt($id) {
        if(!empty($id)) {
            $_SESSION['cart'][$id]++;
        }
        
        // echo $_SESSION['cart'][$id];
        // exit;
        header("Location: ".BASE_URL."cart");
        exit;
    }

    public function lessqt($id) {
        if(!empty($id)) {
            
            if($_SESSION['cart'][$id] <= 1){
                unset($_SESSION['cart'][$id]);
                unset($_SESSION['shipping']);
            }else {
                $_SESSION['cart'][$id]--;
            }
            
        }

        header("Location: ".BASE_URL."cart");
        exit;
    }

    public function add() {

        if(!empty($_POST['id_product'])) {
            $id = intval($_POST['id_product']);
            $qt = intval($_POST['qt_product']);

            if(!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }

            if(isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id] += $qt;
            } else {
                $_SESSION['cart'][$id] = $qt;
            }
           
        }

        header("Location: ".BASE_URL."cart");
        exit;

    }

    public function payment_redirect() {

        if(!empty($_POST['payment_type']) && !isset($_SESSION['name'])) {
            $payment_type = $_POST['payment_type'];

            switch($payment_type) {
                case 'checkout_transparente':
                    header("Location: ".BASE_URL."psckttransparente");
                    exit;
                    break;
                case 'mp':
                    header("Location: ".BASE_URL."mp");
                    exit;
                    break;
                case 'paypal':
                    header("Location: ".BASE_URL."paypal");
                    exit;
                    break;
                case 'boleto':
                    header("Location: ".BASE_URL."boleto");
                    exit;
                    break;
            }


        } elseif(!empty($_POST['payment_type']) && isset($_SESSION['name'])) {            
            $payment_type = $_POST['payment_type'];
            switch($payment_type) {
                case 'checkout_transparente':
                    header("Location: ".BASE_URL."psckttransparente");
                    exit;
                    break;
                case 'mp':
                    header("Location: ".BASE_URL."mp_user/client/".$item['id']);
                    exit;
                    break;
                case 'paypal':
                    header("Location: ".BASE_URL."paypal_user");
                    exit;
                    break;
                case 'boleto':
                    header("Location: ".BASE_URL."boleto_user");
                    exit;
                    break;
            }
        } else {
            header("Location: ".BASE_URL."cart");
            exit;
        }

        
    }




















}