<?php

include '../settings/connection.php'; // Incluindo a conexão com o banco de dados

// Função para buscar dados do produto via API
function getProductData($id) {
    $url = "http://localhost:3000/api/products/" . $id; // Endpoint da API
    $response = @file_get_contents($url); // Faz a chamada à API
    if ($response === FALSE) {
        return null; // Retorna null se a API não responder
    }
    return json_decode($response, true); // Retorna os dados do produto como array
}

// Função para buscar produtos recomendados
function getRecommendedProducts($id) {
    global $conn; // Usando a conexão com o banco de dados

    $query = "SELECT id, nome, preco, preco_com_desconto, percentual_desconto, url_img FROM produtos WHERE id != ? LIMIT 3";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $recommended_products = [];
    while ($row = $result->fetch_assoc()) {
        $recommended_products[] = $row;
    }
    $stmt->close();
    return $recommended_products;
}
?>
