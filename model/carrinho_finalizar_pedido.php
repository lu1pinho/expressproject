<?php

class carringo_finalizar_pedido {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function getCarrinhoByUserId($id_user) {
        $stmt = $this->conn->prepare("SELECT produto_nome, url_img, preco, preco_com_desconto, quantidade FROM carrinho WHERE id_user = ?");
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        return $stmt->get_result();
    }
}
