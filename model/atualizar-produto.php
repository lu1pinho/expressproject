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
        $url = "http://localhost:3000/api/products/" . $delete_id;
    
        // Inicializa a sessão cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
    
        // Executa a requisição
        $response = curl_exec($ch);
    
        // Verifica se houve erro na requisição
        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            die('Erro ao deletar produto pela API: ' . $error);
        }
    
        // Verifica o código de resposta HTTP
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        if ($http_code === 200 || $http_code === 204) {
            // Exclusão bem-sucedida; redireciona ou recarrega a página
            header("Location: " . $_SERVER['REQUEST_URI']); // recarrega a página atual
            exit;
        } else {
            // Caso o código HTTP seja diferente de 200 ou 204, exibe uma mensagem de erro
            die("Não foi possível excluir o produto. Código HTTP: " . $http_code);
        }
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