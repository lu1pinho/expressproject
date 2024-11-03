<?php

include '../settings/connection.php'; // Inclua a conexão com o banco de dados

// Função para buscar dados do produto via API
function getProductData($id) {
    $url = "http://localhost:3000/api/products/" . $id; // Ajuste a URL para o servidor remoto
    $response = file_get_contents($url); // Faz uma chamada para a API
    if ($response === FALSE) {
        die('Erro ao buscar dados do produto.');
    }
    
    $data = json_decode($response, true); // Retorna os dados do produto como um array
    return $data; 
}

// Função para buscar produtos recomendados diretamente do banco de dados
function getRecommendedProducts($id) {
    global $conn; // Use a conexão do banco de dados

    // Consulta para selecionar produtos diferentes do produto atual
    $recommended_sql = "SELECT id, nome, preco, preco_com_desconto, percentual_desconto, url_img FROM produtos WHERE id != ? LIMIT 3";
    $stmt = $conn->prepare($recommended_sql); // Prepara a consulta
    $stmt->bind_param("i", $id); // Liga o parâmetro do id do produto atual
    $stmt->execute(); // Executa a consulta
    $result = $stmt->get_result(); // Obtém o resultado da consulta

    $recommended_products = [];
    while ($product = $result->fetch_assoc()) { // Busca os produtos recomendados
        $recommended_products[] = $product; // Adiciona ao array de produtos recomendados
    }
    
    $stmt->close(); // Fecha a declaração
    return $recommended_products; // Retorna os produtos recomendados
}

?>
