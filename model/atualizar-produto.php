<?php
class ProductModel {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function getProductsBySeller($vendedor_id) {
        $sql = "SELECT id, nome, descricao, dados_produto, preco, preco_com_desconto, frete_gratis, categoria, oferta_do_dia, estoque, frete, url_img FROM produtos WHERE vendedor_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $vendedor_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteProduct($delete_id, $vendedor_id) {
        $url = "http://localhost:3000/api/products/" . $delete_id; // URL da API
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
        ]);
    
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        if ($httpCode != 200) {
            die('Erro ao deletar produto pela API: ' . $httpCode);
        }
    
        return json_decode($response, true);
    }
    
    
    

    /*public function deleteProduct($delete_id, $vendedor_id) {
        $sql_delete = "DELETE FROM produtos WHERE id = ? AND vendedor_id = ?";
        $stmt_delete = $this->conn->prepare($sql_delete);
        $stmt_delete->bind_param("ii", $delete_id, $vendedor_id);
        $stmt_delete->execute();
    }*/

    public function updateProduct($id, $vendedor_id, $nome, $descricao, $dados_produto, $preco, $preco_com_desconto, $frete_gratis, $categoria, $oferta_do_dia, $estoque, $frete) {
        $sql_update = "UPDATE produtos SET nome = ?, descricao = ?, dados_produto = ?, preco = ?, preco_com_desconto = ?, frete_gratis = ?, categoria = ?, oferta_do_dia = ?, estoque = ?, frete = ? WHERE id = ? AND vendedor_id = ?";
        $stmt_update = $this->conn->prepare($sql_update);
        $stmt_update->bind_param("sssdiiisidii", $nome, $descricao, $dados_produto, $preco, $preco_com_desconto, $frete_gratis, $categoria, $oferta_do_dia, $estoque, $frete, $id, $vendedor_id);
        $stmt_update->execute();
    }
}
?>
