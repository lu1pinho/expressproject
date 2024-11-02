<?php

include '../settings/connection.php';

if (empty($conn) || $conn->connect_error) {
    die("Falha na conexão: " . (isset($conn->connect_error) ? $conn->connect_error : "Conexão não estabelecida."));
}

function getProductData($id) {
    global $conn;
    $sql = "SELECT id, nome, dados_produto, descricao, preco, preco_com_desconto, percentual_desconto, url_img FROM produtos WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $conn->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function getRecommendedProducts($id) {
    global $conn;
    $recommended_sql = "SELECT id, nome, preco, preco_com_desconto, percentual_desconto, url_img FROM produtos WHERE id != ? LIMIT 3";
    $recommended_stmt = $conn->prepare($recommended_sql);
    $recommended_stmt->bind_param("i", $id);
    $recommended_stmt->execute();
    $recommended_stmt->bind_result($rec_id, $rec_nome, $rec_preco, $rec_precodesconto, $rec_percentual_desconto, $rec_url_img);

    $recommended_products = [];
    while ($recommended_stmt->fetch()) {
        $recommended_products[] = [
            'id' => $rec_id,
            'nome' => $rec_nome,
            'preco' => $rec_preco,
            'precodesconto' => $rec_precodesconto,
            'percentual_desconto' => $rec_percentual_desconto,
            'url_img' => $rec_url_img,
        ];
    }
    $recommended_stmt->close();
    return $recommended_products;
}
?>
