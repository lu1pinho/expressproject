<?php

namespace Model;

class PedidosRealizadosModel {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function getProductsInCart($userId) {
        $stmt = $this->conn->prepare("SELECT produto_nome, url_img, preco, data_compra, quantidade FROM produtos_comprados WHERE id_user = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }
}
