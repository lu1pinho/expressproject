<?php
class ProductModel
{
    private $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    public function getProductByIdAndSeller($id, $vendedor_id)
    {
        $sql = "SELECT id, nome, descricao, dados_produto, preco, preco_com_desconto, frete_gratis, categoria, oferta_do_dia, estoque, frete, url_img FROM produtos WHERE id = ? AND vendedor_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $id, $vendedor_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateProduct($id, $vendedor_id, $nome, $descricao, $dados_produto, $preco, $preco_com_desconto, $frete_gratis, $oferta_do_dia, $estoque, $frete)
    {
        $sql_update = "UPDATE produtos 
                   SET nome = ?, descricao = ?, dados_produto = ?, preco = ?, preco_com_desconto = ?, frete_gratis = ?, oferta_do_dia = ?, estoque = ?, frete = ? 
                   WHERE id = ? AND vendedor_id = ?";

        $stmt_update = $this->conn->prepare($sql_update);
        $stmt_update->bind_param(
            "ssssdiisdii",    // Tipos de dados esperados
            $nome,
            $descricao,
            $dados_produto,
            $preco,
            $preco_com_desconto,
            $frete_gratis,
            $oferta_do_dia,
            $estoque,
            $frete,
            $id,
            $vendedor_id
        );

        $stmt_update->execute();

        if ($stmt_update->error) {
            echo "Erro ao atualizar: " . $stmt_update->error;
            exit();
        }
    }

    public function deleteProduct($delete_id, $vendedor_id) {
        $sql_delete = "DELETE FROM produtos WHERE id = ? AND vendedor_id = ?";
        $stmt_delete = $this->conn->prepare($sql_delete);
        $stmt_delete->bind_param("ii", $delete_id, $vendedor_id);
    
        if ($stmt_delete->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
