<?php
include '../src/settings/connection.php';
include '../model/infPedido_finalizar_pedido.php';
include '../model/infUsuario_finalizar_pedido.php';
include '../model/infCarrinho_finalizar_pedido.php';
include '../model/infCartao_finalizar_pedido.php';

class PedidoController
{
    private $conn;
    private $usuarioModel;
    private $pedidoModel;
    private $carrinhoModel;
    private $cartaoModel;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->usuarioModel = new infUsuario_finalizar_pedido($conn);
        $this->pedidoModel = new infPedido_finalizar_pedido($conn);
        $this->carrinhoModel = new infCarrinho_finalizar_pedido($conn);
        $this->cartaoModel = new infCartao_finalizar_pedido($conn);
    }

    public function resumoPedido($id_usuario)
    {
        // 1. Buscar o CEP do endereço do usuário
        $endereco = $this->usuarioModel->getEnderecoById($id_usuario);
        $frete = $this->pedidoModel->calcularFrete($endereco['cep']);

        // 2. Buscar os produtos no carrinho
        $produtosCarrinho = $this->carrinhoModel->getProdutosCarrinho($id_usuario);
        $total_produtos = 0;

        while ($row = $produtosCarrinho->fetch_assoc()) {
            $preco = $row['preco'];
            $preco_com_desconto = $row['preco_com_desconto'];
            $quantidade = $row['quantidade'];
            $preco_final = $preco_com_desconto ?: $preco;
            $total_produtos += $preco_final * $quantidade;
        }

        // 3. Buscar os cartões do usuário
        $cartoes = $this->cartaoModel->getCartoesByUserId($id_usuario);

        return [
            'frete' => $frete,
            'total_produtos' => $total_produtos,
            'cartoes' => $cartoes
        ];
    }
}
?>
