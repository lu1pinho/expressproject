<?php
class UserModel {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function uploadImage($file) {
        if (isset($file['imagem']) && $file['imagem']['error'] == 0) {
            $image_tmp_name = $file['imagem']['tmp_name'];
            $image_name = basename($file['imagem']['name']);
            $target_dir = "../view/produtos/";
            $target_file = $image_name;
            return $target_file; // Retorna o caminho da imagem
        }
    }    

    public function createProduto($name, $descricao, $preco, $estoque, $category, $promocao, $frete, $dados, $file) {

        $this->conn->begin_transaction();
        try {
            $url_img = $file;
            if ($url_img === null) {
                throw new Exception("A URL da imagem não pode ser nula.");
            }

            $sql_insert = "INSERT INTO produtos (nome, descricao, preco, estoque, categoria, preco_com_desconto, frete, dados_produto, url_img) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql_insert);
            $stmt->bind_param('ssdisssss', $name, $descricao, $preco, $estoque, $category, $promocao, $frete, $dados, $url_img);

            if ($stmt->execute()) {
                $this->conn->commit();
                return true;
            } else {
                throw new Exception("Erro ao inserir produto: " . $stmt->error);
            }
        } catch (Exception $e) {
            $this->conn->rollback();
            throw $e;
        } finally {
            if (isset($stmt)) {
                $stmt->close(); 
            }
        }
    }
}
?>
