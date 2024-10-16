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
            $target_file = $target_dir . $image_name;

            if (move_uploaded_file($image_tmp_name, $target_file)) {
                $sql_img = "INSERT INTO img (path) VALUES (?)";
                if ($stmt_img = $this->conn->prepare($sql_img)) {
                    $stmt_img->bind_param('s', $target_file);
                    $stmt_img->execute();
                    $image_id = $stmt_img->insert_id; // Obtenha o ID da imagem inserida
                    $stmt_img->close();
                    return $image_id;
                } else {
                    throw new Exception("Erro ao salvar o caminho da imagem: " . $this->conn->error);
                }
            } else {
                throw new Exception("Erro ao fazer o upload da imagem.");
            }
        }
        return null;
    }

    public function createProduto($name, $descricao, $preco, $estoque, $category, $promocao, $frete, $dados, $imagem_id) {
        $sql_insert = "INSERT INTO produtos (nome, descricao, preco, estoque, categoria, preco_com_desconto, frete, dados_produto, url_img) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql_insert);
        $stmt->bind_param('ssdiisssi', $name, $descricao, $preco, $estoque, $category, $promocao, $frete, $dados, $imagem_id);

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Erro ao inserir produto: " . $stmt->conn->error);
        }
    }
}
?>
