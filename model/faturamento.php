<?php

class FaturamentoModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Função para calcular o total vendido por um vendedor
    public function getTotalVendido($userId) {
        $sql = "SELECT SUM(n_vendas * preco_com_desconto) AS total_vendido FROM produtos WHERE vendedor_id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception('Erro ao preparar a consulta');
        }
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total_vendido'] ?? 0;
    }

    // Função para somar todos os produtos vendidos
    public function getTotalProdutosVendidos($userId) {
        $sql = "SELECT COALESCE(SUM(n_vendas), 0) AS total_produtos_vendidos FROM produtos WHERE vendedor_id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception('Erro ao preparar a consulta');
        }
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total_produtos_vendidos'];
    }

    // Função para obter os 5 produtos mais vendidos
    public function getTopProdutosVendidos($userId) {
        $sql = "SELECT nome, SUM(n_vendas) AS total_vendas FROM produtos WHERE vendedor_id = ? GROUP BY nome ORDER BY total_vendas DESC LIMIT 5";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception('Erro ao preparar a consulta');
        }
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $produtos = [];
        while ($row = $result->fetch_assoc()) {
            $produtos[] = $row;
        }
        return $produtos;
    }
}
