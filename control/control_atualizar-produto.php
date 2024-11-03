<?php
//session_start();
include '../settings/connection.php'; // Altere conforme o caminho do seu arquivo de conexão
include '../model/atualizar-produto.php'; // Alterado para o nome correto do arquivo
define('CAMINHO_IMAGENS', '/expressproject/view/produtos');

session_start();

if ($conn->connect_error) {
    die("Erro: A conexão com o banco de dados não foi estabelecida.");
}

if (!isset($_SESSION['id'])) {
    header("Location: ../control/control_login.php");
    exit();
}

$vendedor_id = $_SESSION['id'];
$productModel = new ProductModel($conn);
//$response = $productModel->deleteProduct($delete_id, $vendedor_id);
// Listar produtos
$produtos = $productModel->getProductsBySeller($vendedor_id);

// Verifica se o formulário de edição ou exclusão foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_id'])) {
        $delete_id = $_POST['delete_id'];
        $productModel->deleteProduct($delete_id, $vendedor_id);
        // Redirecionar para a mesma página após a exclusão
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $dados_produto = $_POST['dados_produto'];
        $preco = $_POST['preco'];
        $preco_com_desconto = $_POST['preco_com_desconto'];
        $frete_gratis = isset($_POST['frete_gratis']) ? 1 : 0;
        $categoria = $_POST['categoria'];
        $oferta_do_dia = isset($_POST['oferta_do_dia']) ? 1 : 0;
        $estoque = $_POST['estoque'];
        $frete = $_POST['frete'];

        $productModel->updateProduct($id, $vendedor_id, $nome, $descricao, $dados_produto, $preco, $preco_com_desconto, $frete_gratis, $categoria, $oferta_do_dia, $estoque, $frete);
        // Redirecionar para a mesma página após a atualização
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Inclui a visão
include '../view/atualizar_produto.php';
?>
