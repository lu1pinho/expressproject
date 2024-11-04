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
            $target_file = $target_dir . $image_name; // Corrigido para criar o caminho completo
   
            // Move o arquivo para o diretório de destino
            move_uploaded_file($image_tmp_name, $target_file);
            return $image_name; // Retorna apenas o nome do arquivo
        }
    }
   


    public function createProduto($name, $descricao, $preco, $category, $dados, $estoque, $file, $vendedor_id) {
        $url_img = $file; // Captura o nome do arquivo da imagem
        var_dump($url_img);
        // Verifica se a URL da imagem não é nula
        if (empty($url_img)) {
            throw new Exception("A URL da imagem não pode ser nula.");
        }
   
        $produtoData = [
            "nome" => $name,
            "descricao" => $descricao,
            "preco" => $preco,
            "categoria" => $category,
            "dados_produto" => $dados,
            "estoque" => $estoque,
            "url_img" => $url_img, // Nome do arquivo da imagem
            "vendedor_id" => $vendedor_id
        ];
   
        $json_data = json_encode($produtoData); // Codifica os dados em JSON
   
        // Configurações da requisição cURL
        $ch = curl_init("http://localhost:3000/api/products");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
   
        // Executa a requisição
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
   
        // Verifica a resposta da API
        if ($http_code === 201) {
            return true; // Produto criado com sucesso
        } else {
            throw new Exception("Erro ao adicionar produto via API: " . $response);
        }
    }
         
}
?>
