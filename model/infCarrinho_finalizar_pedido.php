<?php
class infCarrinho_finalizar_pedido
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getProdutosCarrinho($id_usuario)
    {
        $stmt = $this->conn->prepare("SELECT preco, preco_com_desconto, quantidade FROM carrinho WHERE id_user = ?");
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>
