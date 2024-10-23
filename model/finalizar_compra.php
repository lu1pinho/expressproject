<?php
class EnderecoModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function buscarEnderecoPorUsuario($id_user)
    {
        $stmt = $this->conn->prepare("SELECT endereco, bairro, complemento, numero, cep, cidade, estado FROM enderecos WHERE id_user = ?");
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        $endereco = $result->fetch_assoc();
        $stmt->close();
        return $endereco;
    }

    public function calcularFrete($cep)
    {
        $cep = preg_replace('/\D/', '', $cep);

        $sql = "SELECT valor FROM frete WHERE cep = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Erro ao preparar a consulta: " . $this->conn->error);
        }

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

    public function buscarProdutosCarrinho($id_user)
    {
        $stmt = $this->conn->prepare("SELECT produto_nome, url_img, preco, preco_com_desconto, quantidade FROM carrinho WHERE id_user = ?");
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $produtos = $stmt->get_result();
        $stmt->close();
        return $produtos;
    }

    public function excluirProdutosCarrinho($id_user) {
        $sql = "DELETE FROM carrinho WHERE id_user = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_user); // Usa o id_user
        return $stmt->execute();
    }
    
}
