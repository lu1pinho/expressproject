<?php
include_once '../settings/connection.php';

define('CAMINHO_IMAGENS', '/expressproject/view/produtos/');

// Função para buscar categorias
function getCategorias($conn)
{
    $sql_departamentos = "SELECT categoria FROM produtos GROUP BY categoria";
    return $conn->query($sql_departamentos);
}

// Função para formatar o nome da categoria
function formatarNomeCategoria($categoria)
{
    $categoria = str_replace('_', ' ', $categoria);
    $conectivos = ['de', 'do', 'da', 'dos', 'das', 'e'];
    $palavras = explode(' ', $categoria);

    foreach ($palavras as $key => $palavra) {
        $palavras[$key] = ($key == 0 || !in_array(strtolower($palavra), $conectivos)) ? ucfirst(strtolower($palavra)) : strtolower($palavra);
    }

    return implode(' ', $palavras);
}

// Função para construir a query SQL com filtros
function buildQuery($categoria, $preco_min, $preco_max, $ofertas, $descontos, $frete_gratis, $go_express)
{
    $sql_produtos = "SELECT * FROM produtos WHERE preco BETWEEN ? AND ?";
    $params = [$preco_min, $preco_max];
    $param_types = "dd";

    if ($categoria !== 'all') {
        $sql_produtos .= " AND categoria = ?";
        $param_types .= "s";
        $params[] = $categoria;
    }
    if ($ofertas) $sql_produtos .= " AND oferta_do_dia = 1";
    if ($descontos) $sql_produtos .= " AND preco_com_desconto > 0";
    if ($frete_gratis) $sql_produtos .= " AND frete_gratis = 1";
    if ($go_express) $sql_produtos .= " AND go_express = 1";

    return [$sql_produtos, $param_types, $params];
}
