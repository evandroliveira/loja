<?php
class homeController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $store = new store();
        $products = new products();
        $categories = new categories();
        $f = new filters();

        $dados = $store->getTemplateData();

        $filters = array();
        if(!empty($_GET['filter']) && is_array($_GET['filter'])) {
            $filters = $_GET['filter'];
        }

        $currentPage = 1;
        $offset = 0;
        $limit = 6;

        if(!empty($_GET['p'])) {
            $currentPage = $_GET['p'];
        }

        $offset = ($currentPage * $limit) - $limit;

        $dados['list'] = $products->getList($offset, $limit, $filters);
        $dados['totalItems'] = $products->getTotal($filters);
        $dados['numberOfPages'] = ceil($dados['totalItems'] / $limit);
        $dados['currentPage'] = $currentPage;

        $dados['filters'] = $f->getFilters($filters);
        $dados['filters_selected'] = $filters;

        $dados['searchTerm'] = '';
        $dados['category'] = '';

        $dados['sidebar'] = true;

        $this->loadTemplate('home', $dados);
    }

}