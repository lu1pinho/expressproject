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

        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            die('Erro ao deletar produto pela API: ' . $error);
        }

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code === 200 || $http_code === 204) {
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        } else {
            die("Não foi possível excluir o produto. Código HTTP: " . $http_code);
        }
    }

    public function updateProduct($id, $vendedor_id, $nome, $descricao, $dados_produto, $preco, $preco_com_desconto, $frete_gratis, $categoria, $oferta_do_dia, $estoque, $frete) {
        $sql_update = "UPDATE produtos SET nome = ?, descricao = ?, dados_produto = ?, preco = ?, preco_com_desconto = ?, frete_gratis = ?, categoria = ?, oferta_do_dia = ?, estoque = ?, frete = ? WHERE id = ? AND vendedor_id = ?";
        $stmt_update = $this->conn->prepare($sql_update);
        $stmt_update->bind_param("sssdiiisidii", $nome, $descricao, $dados_produto, $preco, $preco_com_desconto, $frete_gratis, $categoria, $oferta_do_dia, $estoque, $frete, $id, $vendedor_id);
        $stmt_update->execute();
    }

    // Método para atualizar produto via API
    public function updateProductViaAPI($id, $data) {
        $url = "http://localhost:3000/api/products/" . $id;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        // Prepara os dados como JSON
        $jsonData = json_encode($data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

        $response = curl_exec($ch);

        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            die('Erro ao atualizar produto pela API: ' . $error);
        }

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code === 200) {
            return json_decode($response, true); // Retorna o JSON decodificado se a atualização for bem-sucedida
        } else {
            die("Não foi possível atualizar o produto. Código HTTP: " . $http_code);
        }
    }
}
