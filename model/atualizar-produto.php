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
        $options = [
            'http' => [
                'header'  => "Content-Type: application/json\r\n",
                'method'  => 'DELETE',
            ],
        ];
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
    
        if ($response === FALSE) {
            // Lida com o erro de forma adequada
            die('Erro ao deletar produto pela API.');
        }
        
        // Opcional: Verifique a resposta da API se necessário
        $responseData = json_decode($response, true); // Se a API retornar dados
        return $responseData; 
    }
    

    /*public function deleteProduct($delete_id, $vendedor_id) {
        $sql_delete = "DELETE FROM produtos WHERE id = ? AND vendedor_id = ?";
        $stmt_delete = $this->conn->prepare($sql_delete);
        $stmt_delete->bind_param("ii", $delete_id, $vendedor_id);
        $stmt_delete->execute();
    }*/

    /*colocando isso pra conseguir mexer na abencoada da branch q esqueci de criar e agr to tendo q criar e fingir q fiz tudo nela*/

    public function updateProduct($id, $vendedor_id, $nome, $descricao, $dados_produto, $preco, $preco_com_desconto, $frete_gratis, $categoria, $oferta_do_dia, $estoque, $frete) {
        $sql_update = "UPDATE produtos SET nome = ?, descricao = ?, dados_produto = ?, preco = ?, preco_com_desconto = ?, frete_gratis = ?, categoria = ?, oferta_do_dia = ?, estoque = ?, frete = ? WHERE id = ? AND vendedor_id = ?";
        $stmt_update = $this->conn->prepare($sql_update);
        $stmt_update->bind_param("sssdiiisidii", $nome, $descricao, $dados_produto, $preco, $preco_com_desconto, $frete_gratis, $categoria, $oferta_do_dia, $estoque, $frete, $id, $vendedor_id);
        $stmt_update->execute();
    }
}
?>
