<?php
class infUsuario_finalizar_pedido
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getEnderecoById($id_usuario)
    {
        $stmt = $this->conn->prepare("SELECT cep FROM enderecos WHERE id_user = ?");
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>
