<?php

class CarrinhoModel {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function adicionarProduto($id_user, $produto) {
        $stmt = $this->conn->prepare("INSERT INTO carrinho (id_user, produto_nome, url_img, preco, preco_com_desconto, quantidade) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issddi", $id_user, $produto['nome'], $produto['url_img'], $produto['preco'], $produto['preco_com_desconto'], $produto['quantidade']);
        $stmt->execute();
        $stmt->close();
    }

    public function removerProduto($id_user, $produto_nome) {
        $stmt = $this->conn->prepare("DELETE FROM carrinho WHERE id_user = ? AND produto_nome = ?");
        $stmt->bind_param("is", $id_user, $produto_nome);
        $stmt->execute();
        $stmt->close();
    }

    public function atualizarQuantidade($id_user, $produto_nome, $nova_quantidade) {
        $stmt = $this->conn->prepare("UPDATE carrinho SET quantidade = ? WHERE id_user = ? AND produto_nome = ?");
        $stmt->bind_param("iis", $nova_quantidade, $id_user, $produto_nome);
        $stmt->execute();
        $stmt->close();
    }
}

?>