<?php

class FaturamentoModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Função para calcular o total vendido por um vendedor
    public function getTotalVendido($userId) {
        // SQL para calcular o total vendido
        $sql = "
            SELECT SUM(n_vendas * preco_com_desconto) AS total_vendido
            FROM produtos
            WHERE vendedor_id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die('Erro ao preparar a consulta: ' . $this->conn->error);
        }

        // Vincula o parâmetro (id do vendedor) à consulta
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        // Obtém o resultado da consulta
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Retorna o valor total vendido ou 0 se não houver valores
        return $row['total_vendido'] ?? 0;
    }

    // Função para somar todos os produtos vendidos (n_vendas) do vendedor
    public function getTotalProdutosVendidos($userId) {
        // SQL para calcular a soma de n_vendas do vendedor
        $sql = "
            SELECT COALESCE(SUM(n_vendas), 0) AS total_produtos_vendidos
            FROM produtos
            WHERE vendedor_id = ?
        ";

        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die('Erro ao preparar a consulta: ' . $this->conn->error);
        }

        // Vincula o parâmetro (id do vendedor) à consulta
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        // Obtém o resultado da consulta
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Retorna o total de produtos vendidos ou 0 se não houver valores
        return $row['total_produtos_vendidos'];
    }

    public function GetActualSession() {
        return $_SESSION['id'];
    }

    public function getTopProdutosVendidos($userId) {
        // SQL para obter os 5 produtos mais vendidos do vendedor
        $sql = "
        SELECT nome, SUM(n_vendas) AS total_vendas
        FROM produtos
        WHERE vendedor_id = ?
        GROUP BY nome
        ORDER BY total_vendas DESC
        LIMIT 5
    ";

        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die('Erro ao preparar a consulta: ' . $this->conn->error);
        }

        // Vincula o parâmetro (id do vendedor) à consulta
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        // Obtém o resultado da consulta
        $result = $stmt->get_result();
        $produtos = [];

        // Prepara os dados para a view
        while ($row = $result->fetch_assoc()) {
            $produtos[] = $row;
        }

        return $produtos;
    }

}
