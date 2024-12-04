<?php
session_start();

// Obtendo o ID do produto via GET
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Incluindo as dependências necessárias
include_once '../model/produto_individual.php';
include '../settings/config.php';
require 'C:\xampp\htdocs\expressproject\vendor\erusev\parsedown\Parsedown.php';

// Função para formatar texto
function formatText($text) {
    $allowed_tags = '<h1><h2><h3><p><strong><em><div><br><ul><li>';
    $parsedown = new Parsedown();
    $html = $parsedown->text($text);
    return nl2br(strip_tags($html, $allowed_tags));
}

// Função para dividir valor por 10
function dividirPor10($valor) {
    if (is_numeric($valor) && $valor > 0) {
        return number_format($valor / 10, 2, ',', '.');
    }
    return '0,00';
}

// Coletando os dados do produto
$productData = getProductData($id);
if (!$productData) {
    // Redireciona para a página de erro 404 caso o produto não exista
    header("Location: /expressproject/error404/error404.html");
    exit();
}

// Calculando o preço com desconto
$preco = $productData['preco'] ?? 0; // Preço normal
$percentual_desconto = $productData['percentual_desconto'] ?? 0; // Percentual de desconto
$preco_com_desconto = $productData['preco_com_desconto'] ?? null; // Preço com desconto

if ($preco_com_desconto !== null) {
    $precodesconto = $preco_com_desconto; // Usa o preço com desconto caso esteja definido
} else {
    $precodesconto = $preco - (($percentual_desconto / 100) * $preco); // Calcula o desconto
}

$porcentagem = ($precodesconto < $preco) ? round(100 - (($precodesconto / $preco) * 100)) : 0;

// Obtendo produtos recomendados
$recommendedProducts = getRecommendedProducts($id);

// Incluindo a view
include '../view/view-produto-individual.php';
?>
