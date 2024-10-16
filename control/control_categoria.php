<?php

require_once __DIR__ . '/../model/categoria_dados_produtos.php';
require_once __DIR__ . '/../src/settings/connection.php';

class control_categoria {
    private $model;

    public function __construct() {
        global $conn; // Assuming $conn is initialized in your connection file
        $this->model = new categoria_dados_produtos($conn);
    }

    public function showCategoryPage() {
        $filters = [
            'departamento' => isset($_GET['departamento']) ? $_GET['departamento'] : 'all',
            'preco_min' => isset($_GET['preco_min']) ? $_GET['preco_min'] : 0,
            'preco_max' => isset($_GET['preco_max']) ? $_GET['preco_max'] : 12000,
            'ofertas' => isset($_GET['ofertas']) ? 1 : 0,
            'descontos' => isset($_GET['descontos']) ? 1 : 0,
            'frete' => isset($_GET['frete']) ? 1 : 0,
            'express' => isset($_GET['express']) ? 1 : 0
        ];

        $categorias = $this->model->getCategorias();
        $produtos = $this->model->getProdutos($filters);

        include __DIR__ . '../view/categoria.php';
    }
}
