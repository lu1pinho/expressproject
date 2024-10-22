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
        $stmt = $this->conn->prepare("SELECT produto_nome, url_img, quantidade, preco, preco_com_desconto 
        FROM carrinho 
        WHERE id_user = ?");

        if (!$stmt) {
            die("Erro ao preparar a consulta: " . $this->conn->error);
        }

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

    public function inserirProdutosComprados($id_usuario, $produto_nome, $quantidade, $preco, $url_img)
    {
        $sql_insert = "INSERT INTO produtos_comprados (id_user, produto_nome, quantidade, preco, url_img, data_compra) 
                   VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt_insert = $this->conn->prepare($sql_insert);

        if (!$stmt_insert) {
            die("Erro ao preparar a consulta de inserção: " . $this->conn->error);
        }

        $stmt_insert->bind_param("isids", $id_usuario, $produto_nome, $quantidade, $preco, $url_img);

        if (!$stmt_insert->execute()) {
            die("Erro ao inserir produto na tabela produtos_comprados: " . $stmt_insert->error);
        }

        $stmt_insert->close();
    }


    public function excluirProdutosCarrinho($id_usuario)
    {
        $sql_delete = "DELETE FROM carrinho WHERE id_user = ?";
        $stmt_delete = $this->conn->prepare($sql_delete);

        if (!$stmt_delete) {
            die("Erro ao preparar a consulta de exclusão: " . $this->conn->error);
        }

        $stmt_delete->bind_param("i", $id_usuario);

        if (!$stmt_delete->execute()) {
            die("Erro ao excluir produtos do carrinho: " . $stmt_delete->error);
        }

        $stmt_delete->close();
    }
}
