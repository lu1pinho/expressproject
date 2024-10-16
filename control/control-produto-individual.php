<?php
session_start();
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Corrigindo o caminho da model
include_once '../model/produto_individual.php';

// Função para formatar texto
require 'C:\xampp\htdocs\expressproject\vendor\erusev\parsedown\Parsedown.php';

function formatText($text) {
    $allowed_tags = '<h1><h2><h3><p><strong><em><div><br><ul><li>';
    $parsedown = new Parsedown();
    $html = $parsedown->text($text);
    return nl2br(strip_tags($html, $allowed_tags));
}

function dividirPor10($valor) {
    if (is_numeric($valor) && $valor > 0) {
        return number_format($valor / 10, 2, ',', '.');
    }
    return '0,00';
}

// Coletando dados do produto
$productData = getProductData($id);
if (!$productData) {
    // Redireciona para a página de erro 404
    header("Location: /expressproject/error404/error404.html");
    exit();
}

// Calculando o preço com desconto
$preco = $productData['preco'];
$precodesconto = $productData['preco_com_desconto'] ?: $preco - (($productData['percentual_desconto'] / 100) * $preco);
$porcentagem = ($precodesconto < $preco) ? round(100 - (($precodesconto / $preco) * 100)) : 0;

// Consultando produtos recomendados
$recommendedProducts = getRecommendedProducts($id);

// Carregando a view
include '../view/view-produto-individual.php';

function logout() {
    session_destroy();
}

if (isset($_POST['logout'])) {
    logout();
}
?>
