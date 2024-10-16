<?php

class endereco_finalizar_pedido   {
    
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function getEnderecoByUserId($id_user) {
        $stmt = $this->conn->prepare("SELECT endereco, bairro, complemento, numero, cep, cidade, estado FROM enderecos WHERE id_user = ?");
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function calcularFrete($cep) {
        // Limpa o CEP
        $cep = preg_replace('/\D/', '', $cep);

        $stmt = $this->conn->prepare("SELECT valor FROM frete WHERE cep = ?");
        if (!$stmt) {
            die("Erro ao preparar a consulta: " . $this->conn->error);
        }

        $stmt->bind_param("s", $cep);
        $stmt->execute();
        $stmt->bind_result($valorFrete);

        if ($stmt->fetch()) {
            return floatval($valorFrete);
        } else {
            return 0; // Retorna 0 se o frete não for encontrado
        }
    }
}
