<?php

include_once '../model/endereco_finalizar_pedido.php';
include_once '../model/carrinho_finalizar_pedido.php';

class PedidoController {
    private $conn;
    private $enderecoModel;
    private $carrinhoModel;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
        $this->enderecoModel = new endereco_finalizar_pedido($dbConnection);
        $this->carrinhoModel = new carringo_finalizar_pedido($dbConnection);
    }

    public function finalizarPedido() {
        session_start();

        // Verifica se o usuário está logado
        if (!isset($_SESSION['id'])) {
            header('Location: login.php');
            exit();
        }

        $id_user = $_SESSION['id'];
        $erro = "";
        $frete = 0;

        // Busca o endereço do usuário
        $endereco = $this->enderecoModel->getEnderecoByUserId($id_user);

        if ($endereco) {
            $enderecoCompleto = htmlspecialchars($endereco['endereco']) . " " . htmlspecialchars($endereco['numero']) . ", " . htmlspecialchars($endereco['bairro']) . " - " . htmlspecialchars($endereco['cidade']) . ", " . htmlspecialchars($endereco['estado']);
            $frete = $this->enderecoModel->calcularFrete($endereco['cep']);
        } else {
            $erro = "Endereço não encontrado para este usuário.";
        }

        // Busca os produtos no carrinho
        $carrinho = $this->carrinhoModel->getCarrinhoByUserId($id_user);

        return [
            'enderecoCompleto' => $enderecoCompleto ?? '',
            'frete' => $frete,
            'erro' => $erro,
            'carrinho' => $carrinho
        ];
    }
}
