<?php
class productController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        header("Location: ".BASE_URL);
    }


    public function open($id) {
        $store = new store();
        $products = new products();
        $categories = new categories();

        $dados = $store->getTemplateData();

        $info = $products->getProductInfo($id);

        if(count($info) > 0) {

            $dados['product_info'] = $info;
            $dados['product_images'] = $products->getImagesByProductId($id);
            $dados['product_options'] = $products->getOptionsByProductId($id);
            $dados['product_rates'] = $products->getRates($id, 5);

            $dados['searchTerm'] = '';
            $dados['category'] = '';

            $this->loadTemplate('product', $dados);
        } else {
            header("Location: ".BASE_URL);
        }


    }
























}