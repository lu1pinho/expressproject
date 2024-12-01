<?php
include 'C:/xampp/htdocs/expressproject/settings/connection.php';
include '../model/pagamento.php';

session_start();
$id_usuario = $_SESSION['id'];

$pedidoModel = new PedidoModel($conn);

// Busca o endereço e calcula o frete
$endereco = $pedidoModel->buscarCepUsuario($id_usuario);
$frete = 0;
if ($endereco) {
    $frete = $pedidoModel->calcularFrete($endereco['cep']);
}

// Busca os produtos no carrinho e calcula o total
$produtos = $pedidoModel->buscarProdutosCarrinho($id_usuario);
$total_produtos = 0;
foreach ($produtos as $produto) {
    $preco_final = $produto['preco_com_desconto'] ?: $produto['preco'];
    $total_produtos += $preco_final * $produto['quantidade'];
}

// Busca os cartões do usuário
$cartoes = $pedidoModel->buscarCartoesUsuario($id_usuario);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comprar'])) {
    // Obtém os IDs dos vendedores com base nos produtos no carrinho
    $vendedores = $pedidoModel->buscarVendedoresPorUsuario($id_usuario);

    // Exibe as informações dos vendedores
    foreach ($vendedores as $vendedor_id) {
        $dados_vendedor = $pedidoModel->buscarDadosVendedor($vendedor_id);

        if ($dados_vendedor) {
            //echo "Vendedor: " . $dados_vendedor['nome'] . "<br>";
            //echo "E-mail: " . $dados_vendedor['email'] . "<br>";
            //echo "Telefone: " . $dados_vendedor['telefone'] . "<br><br>";
        } else {
            echo "Nenhum dado encontrado para o vendedor com ID: $vendedor_id<br><br>";
        }
    }

    // Processa a compra
    foreach ($produtos as $produto) {
        $produto_nome = $produto['produto_nome'];
        $preco = $produto['preco'];
        $preco_com_desconto = $produto['preco_com_desconto'];
        $quantidade = $produto['quantidade'];
        $url_img = $produto['url_img'];

        // Buscar o id_produto na tabela produtos
        $id_produto = $pedidoModel->buscarIdProdutoPorNome($produto_nome);

        if ($id_produto !== null) {
            $preco_final = $preco_com_desconto ?: $preco;

            // Inserir o produto comprado
            $pedidoModel->inserirProdutosComprados($id_usuario, $id_produto, $produto_nome, $quantidade, $preco_final, $url_img);
        } else {
            die("Produto não encontrado na tabela de produtos: $produto_nome");
        }
    }

    // Limpa o carrinho após a compra
    $pedidoModel->excluirProdutosCarrinho($id_usuario);

    // Redireciona para a página principal após a compra
    //header("Location: /expressproject/control/control_pagina-principal.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comprar'])) {
        // Espera 10 segundos
        sleep(3);
        // Redireciona para a página principal
        header("Location: ../view/pagina-final.php");
        exit();
    }

    exit();
}

$conn->close();

include '../view/pagamento.php';
