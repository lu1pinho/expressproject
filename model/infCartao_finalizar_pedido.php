<?php
class infCartao_finalizar_pedido
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getCartoesByUserId($id_usuario)
    {
        $stmt = $this->conn->prepare("SELECT * FROM cartoes WHERE id_user = ?");
        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>
