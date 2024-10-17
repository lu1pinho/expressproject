<?php 
    session_start();
    include 'C:\xampp\htdocs\expressproject\settings\connection.php';
    include '../model/carrinho.php';
    include '../view/carrinho.php';

    // Verifique se o usuário está logado
    if (!isset($_SESSION['id'])) {
        die("Usuário não está logado. Por favor, faça o login para continuar.");
    } else {
        //$id_user = $_SESSION['id']; // Definir o ID do usuário logado
    }
    
    // Adiciona produto ao carrinho
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['produto_nome'])) {
            $produto = [
                'nome' => $_POST['produto_nome'],
                'url_img' => $_POST['produto_imagem'],
                'preco' => (float)$_POST['produto_preco'],
                'preco_com_desconto' => isset($_POST['produto_preco_desconto']) && $_POST['produto_preco_desconto'] != ''
                    ? (float)$_POST['produto_preco_desconto']
                    : null,
                'quantidade' => (int)$_POST['quantidade']
            ];
    
            // Adicionar o produto ao banco de dados
            $carrinhoModel->adicionarProduto($id_user, $produto);
        }
    }
    
?>