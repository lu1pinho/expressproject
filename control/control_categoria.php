<?php
session_start();
// Incluir o Model que contém a lógica de banco de dados
include_once '../model/categoria.php';

// Obtém o termo de busca do formulário (se existir)
$termo_busca = $_GET['query'] ?? '';

// Filtros
$categoria = $_POST['departamento'] ?? 'all';
$preco_min = (float)($_POST['preco_min'] ?? 0);
$preco_max = (float)($_POST['preco_max'] ?? 12000);
$ofertas = isset($_POST['ofertas']) && $_POST['ofertas'] == 'on';
$descontos = isset($_POST['descontos']) && $_POST['descontos'] == 'on';
$frete_gratis = isset($_POST['frete']) && $_POST['frete'] == 'on';
$go_express = isset($_POST['express']) && $_POST['express'] == 'on';

// Adicionar termo de busca à query
list($sql_produtos, $param_types, $params) = buildQuery($categoria, $preco_min, $preco_max, $ofertas, $descontos, $frete_gratis, $go_express, $termo_busca);

// Preparar e executar a query
$stmt = $conn->prepare($sql_produtos);
if (!$stmt) {
    die("Erro ao preparar a query: " . $conn->error . "\nSQL: " . $sql_produtos);
}
$stmt->bind_param($param_types, ...$params);
$stmt->execute();
$result_produtos = $stmt->get_result();

$result_departamentos = getCategorias($conn);

// Incluir a View para renderizar os dados
include '../view/categoria.php';
?>
