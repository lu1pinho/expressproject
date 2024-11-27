<?php
namespace Model;
// Inclui a conexão com o banco de dados
include '../settings/connection.php'; // Não é necessário incluir o arquivo de conexão de teste

class ProdutoModel {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Busca os produtos com oferta do dia
    public function getOfertasDoDia($limite = 6) {
        $query = "SELECT * FROM produtos WHERE oferta_do_dia = 1 LIMIT ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $limite);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    // Busca os produtos mais vendidos
    public function getMaisVendidos($limite = 6) {
        $query = "SELECT * FROM produtos ORDER BY n_vendas DESC LIMIT ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $limite);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function someOtherMethod() {
        $result = null;
        return $result;
    }
}
// Função global para formatar o preço e calcular o desconto
function calcularDesconto($preco, $preco_com_desconto, $percentual_desconto) {
    if ($percentual_desconto === null || $percentual_desconto === "") {
        if ($preco_com_desconto !== null) {
            $percentual_desconto = round((($preco - $preco_com_desconto) / $preco) * 100);
        } else {
            return [
                'preco' => number_format($preco, 2, ',', '.'),
                'percentual_desconto' => 0,
                'frete_texto' => "FRETE EXPRESSO"
            ];
        }
    }

    if ($percentual_desconto > 0) {
        return [
            'preco' => number_format($preco_com_desconto, 2, ',', '.'),
            'percentual_desconto' => $percentual_desconto,
            'frete_texto' => ""
        ];
    } else {
        return [
            'preco' => number_format($preco, 2, ',', '.'),
            'percentual_desconto' => 0,
            'frete_texto' => "FRETE EXPRESSO"
        ];
    }
}
?>
