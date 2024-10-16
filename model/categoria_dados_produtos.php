<?php

class categoria_dados_produtos {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getCategorias() {
        $sql = "SELECT categoria FROM produtos GROUP BY categoria";
        return $this->conn->query($sql);
    }

    public function getProdutos($filters = []) {
        $preco_min = isset($filters['preco_min']) ? $filters['preco_min'] : 0;
        $preco_max = isset($filters['preco_max']) ? $filters['preco_max'] : 12000;
        $departamento = isset($filters['departamento']) ? $filters['departamento'] : 'all';
        $ofertas = isset($filters['ofertas']) ? 1 : 0;
        $descontos = isset($filters['descontos']) ? 1 : 0;
        $frete_gratis = isset($filters['frete']) ? 1 : 0;
        $goexpress = isset($filters['express']) ? 1 : 0;

        $sql = "SELECT * FROM produtos WHERE preco BETWEEN $preco_min AND $preco_max";

        if ($departamento != 'all') {
            $sql .= " AND categoria = '$departamento'";
        }

        if ($ofertas) {
            $sql .= " AND oferta_do_dia = 1";
        }

        if ($descontos) {
            $sql .= " AND preco_com_desconto > 0";
        }

        if ($frete_gratis) {
            $sql .= " AND frete_gratis = 1";
        }

        if ($goexpress) {
            $sql .= " AND go_express = 1";
        }

        return $this->conn->query($sql);
    }

    public function calcularDesconto($preco, $preco_com_desconto) {
        if ($preco_com_desconto > 0) {
            $percentual_desconto = round((($preco - $preco_com_desconto) / $preco) * 100);
            $preco_final = number_format($preco_com_desconto, 2, ',', '.');
        } else {
            $percentual_desconto = 0;
            $preco_final = number_format($preco, 2, ',', '.');
        }
        return [
            'percentual_desconto' => $percentual_desconto,
            'preco' => $preco_final
        ];
    }
}
