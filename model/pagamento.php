<?php
class PedidoModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function buscarCepUsuario($id_usuario)
    {
        $stmt = $this->conn->prepare("SELECT cep FROM enderecos WHERE id_user = ?");
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function calcularFrete($cep)
    {
        $cep = preg_replace('/\D/', '', $cep);

        if (!$this->conn) {
            die("Erro de conexão: " . mysqli_connect_error());
        }

        $sql = "SELECT valor FROM frete WHERE cep = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $cep);
        $stmt->execute();
        $stmt->bind_result($valorFrete);

        if ($stmt->fetch()) {
            $stmt->close();
            return floatval($valorFrete);
        } else {
            $stmt->close();
            return 0;
        }
    }

    public function buscarProdutosCarrinho($id_usuario)
    {
        $stmt = $this->conn->prepare("SELECT preco, preco_com_desconto, quantidade FROM carrinho WHERE id_user = ?");
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function buscarCartoesUsuario($id_usuario)
    {
        $sql = "SELECT * FROM cartoes WHERE id_user = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
