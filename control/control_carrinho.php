<?php
session_start();
include 'C:/xampp/htdocs/expressproject/src/settings/connection.php'; // Conexão ao banco de dados
include '../model/carrinho.php'; 

$carrinhoModel = new CarrinhoModel($conn);

// Define o caminho para as imagens
define('CAMINHO_IMAGENS', 'newsource/produtos/');

// Verifica se o carrinho já está criado
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Inicializa o total
$total = 0;

// Verificar se o usuário está logado
/*if (isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
} else {
    die("Usuário não está logado. Por favor, faça o login para continuar.");
}*/

// Adiciona o produto ao carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Adicionar produto ao carrinho
    if (isset($_POST['produto_nome'])) {
        $produto = [
            'nome' => $_POST['produto_nome'],
            'url_img' => $_POST['produto_imagem'],
            'preco' => (float) $_POST['produto_preco'],
            'preco_com_desconto' => (isset($_POST['produto_preco_desconto']) && $_POST['produto_preco_desconto'] != '')
                ? (float) $_POST['produto_preco_desconto']
                : null,
            'quantidade' => (int) $_POST['quantidade']
        ];

        $_SESSION['carrinho'][] = $produto;

        // Adicionar produto ao banco de dados
        $carrinhoModel->adicionarProduto($id_user, $produto);
    }

    // Remover item do carrinho
    if (isset($_POST['remover_item'])) {
        $index = (int)$_POST['remover_item'];

        if (isset($_SESSION['carrinho'][$index])) {
            $produto_nome = $_SESSION['carrinho'][$index]['nome'];

            // Remove o item do carrinho na sessão
            unset($_SESSION['carrinho'][$index]);
            $_SESSION['carrinho'] = array_values($_SESSION['carrinho']); // Reindexa o array

            // Remove do banco de dados
            $carrinhoModel->removerProduto($id_user, $produto_nome);
        } else {
            die("Produto não encontrado no carrinho.");
        }
    }

    // Alterar a quantidade de um item
    if (isset($_POST['alterar_quantidade'])) {
        foreach ($_POST['alterar_quantidade'] as $index => $operacao) {
            if (isset($_SESSION['carrinho'][$index])) {
                $produto_nome = $_SESSION['carrinho'][$index]['nome'];

                if ($operacao === 'plus') {
                    $_SESSION['carrinho'][$index]['quantidade']++;
                } elseif ($operacao === 'minus' && $_SESSION['carrinho'][$index]['quantidade'] > 1) {
                    $_SESSION['carrinho'][$index]['quantidade']--;
                }

                // Atualiza no banco de dados
                $nova_quantidade = $_SESSION['carrinho'][$index]['quantidade'];
                $carrinhoModel->atualizarQuantidade($id_user, $produto_nome, $nova_quantidade);
            } else {
                die("Produto não encontrado no carrinho.");
            }
        }
    }
}

// Verifica se produtos foram selecionados e calcula o total
if (isset($_POST['produtos_selecionados'])) {
    foreach ($_POST['produtos_selecionados'] as $index) {
        if (isset($_SESSION['carrinho'][$index])) {
            $item = $_SESSION['carrinho'][$index];
            $preco_final = $item['preco_com_desconto'] ?? $item['preco']; // Usa o preço com desconto se existir
            $total += $preco_final * $item['quantidade'];
        }
    }
}

$conn->close();

// Inclui a View do carrinho
include '../view/carrinho.php';