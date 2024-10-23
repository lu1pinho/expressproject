<?php
session_start();
include '../settings/connection.php';
include '../model/faturamento.php';

class FaturamentoController {
    private $model;

    public function __construct($conn) {
        $this->model = new FaturamentoModel($conn);
    }

    public function getFaturamento($userId) {
        // Retorna o valor somado do model
        return $this->model->getTotalVendido($userId);
    }

    public function getTotalProdutosVendidos($userId) {
        // Retorna o total de produtos vendidos do model
        return $this->model->getTotalProdutosVendidos($userId);
    }

    public function GetActualSession(){
        return $_SESSION['id'];
    }

    public function getTopProdutosVendidos($userId) {
        // Retorna os 5 produtos mais vendidos do modelo
        return $this->model->getTopProdutosVendidos($userId);
    }
}

// Verifica se o usuário está logado
if (isset($_SESSION['id'])) {
    // Pega o ID do vendedor logado a partir da sessão
    $vendedor_id = $_SESSION['id'];

    // Instancia a control e busca o faturamento e o total de produtos vendidos
    $faturamentoController = new FaturamentoController($conn);
    $totalVendido = $faturamentoController->getFaturamento($vendedor_id);
    $totalProdutosVendidos = $faturamentoController->getTotalProdutosVendidos($vendedor_id);
    $topProdutos = $faturamentoController->getTopProdutosVendidos($vendedor_id);

    // Inclui a view e passa o faturamento total e o total de produtos vendidos
    include '../view/faturamento.php';
} else {
    echo "Erro: Usuário não logado.";
}