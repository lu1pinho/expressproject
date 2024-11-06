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

// Construa a URL de requisição para a API
$api_url = 'http://localhost:3000/api/products';  // URL base da sua API
$query_params = [];

if ($termo_busca) {
    $query_params['query'] = $termo_busca;
}
if ($categoria && $categoria !== 'all') {
    $query_params['categoria'] = $categoria;
}
if ($preco_min) {
    $query_params['preco_min'] = $preco_min;
}
if ($preco_max) {
    $query_params['preco_max'] = $preco_max;
}
if ($ofertas) {
    $query_params['ofertas'] = 'on';
}
if ($descontos) {
    $query_params['descontos'] = 'on';
}
if ($frete_gratis) {
    $query_params['frete_gratis'] = 'on';
}
if ($go_express) {
    $query_params['express'] = 'on';
}

// Montar a URL com os parâmetros de consulta (query parameters)
if (!empty($query_params)) {
    $api_url .= '?' . http_build_query($query_params);
}

// Realizar a requisição cURL para a API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'
));

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Erro na requisição cURL: ' . curl_error($ch);
    exit;
}

curl_close($ch);

// Decodificar a resposta JSON da API
$produtos = json_decode($response, true);

// Verificar se a resposta contém dados
if (empty($produtos)) {
    $produtos = [];
}

// Obtém as categorias para renderizar na página
$result_departamentos = getCategorias($conn);

// Incluir a View para renderizar os dados
include '../view/categoria.php';
?>
