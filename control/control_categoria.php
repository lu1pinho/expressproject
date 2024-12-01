<?php
session_start();
// Incluir a conexão com o banco de dados
include '../settings/connection.php'; // Certifique-se de que este arquivo tem a lógica de conexão com o banco de dados

// Inicializa os filtros de busca
$termo_busca = trim($_GET['query'] ?? ''); // Remove espaços em branco no início e fim
$categoria = $_POST['departamento'] ?? 'all';
$preco_min = (float)($_POST['preco_min'] ?? 0);
$preco_max = (float)($_POST['preco_max'] ?? 12000);
$ofertas = isset($_POST['ofertas']) && $_POST['ofertas'] == 'on';
$descontos = isset($_POST['descontos']) && $_POST['descontos'] == 'on';
$frete_gratis = isset($_POST['frete']) && $_POST['frete'] == 'on';
$go_express = isset($_POST['express']) && $_POST['express'] == 'on';

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Construa a consulta SQL usando prepared statements para evitar SQL Injection
$sql = "SELECT * FROM produtos WHERE 1=1";
$params = [];
$types = "";

// Valida o termo de busca antes de incluí-lo no SQL
if (!empty($termo_busca)) { // Certifique-se de que o termo de busca não está vazio
    $sql .= " AND (nome LIKE ? OR descricao LIKE ?)";
    $params[] = "%$termo_busca%";
    $params[] = "%$termo_busca%";
    $types .= "ss";
}

if ($categoria && $categoria !== 'all') {
    $sql .= " AND categoria = ?";
    $params[] = $categoria;
    $types .= "s";
}

if ($preco_min > 0) {
    $sql .= " AND preco >= ?";
    $params[] = $preco_min;
    $types .= "d";
}

if ($preco_max > 0) {
    $sql .= " AND preco <= ?";
    $params[] = $preco_max;
    $types .= "d";
}

if ($ofertas) {
    $sql .= " AND oferta = 1"; // Supondo que "oferta" seja uma coluna booleana na sua tabela
}

if ($descontos) {
    $sql .= " AND desconto > 0"; // Supondo que "desconto" seja uma coluna que indica a porcentagem de desconto
}

if ($frete_gratis) {
    $sql .= " AND frete_gratis = 1"; // Supondo que "frete_gratis" seja uma coluna booleana na sua tabela
}

if ($go_express) {
    $sql .= " AND express = 1"; // Supondo que "express" seja uma coluna booleana na sua tabela
}

// Prepara a declaração e liga os parâmetros
$stmt = $conn->prepare($sql);

if ($types) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

// Verifica se a consulta retornou resultados
$produtos = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $produtos[] = $row;
    }
} else {
    echo 'Nenhum produto encontrado.<br>';
}

// Obtém as categorias antes de fechar a conexão
function getCategorias($conn) {
    $categorias = [];
    $sql = "SELECT DISTINCT categoria FROM produtos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categorias[] = $row;
        }
    }
    return $categorias;
}

$result_departamentos = getCategorias($conn);

// Fechar a conexão com o banco de dados
$stmt->close();
$conn->close();

// Incluir a View para renderizar os dados
include '../view/categoria.php';
?>
