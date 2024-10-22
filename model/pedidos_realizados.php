<?php
class CartModel {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    // Função para obter os pedidos realizados pelo usuário
    public function getPedidosByUserId($userId) {
        if ($this->conn == null || $userId == null) {
            return [];
        }

        // Consulta para pegar os pedidos do usuário
        $stmt = $this->conn->prepare("SELECT * FROM pedidos WHERE user_id = ?");
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $pedidos = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        // Para cada pedido, buscar os produtos relacionados
        foreach ($pedidos as &$pedido) {
            $pedido['produtos'] = $this->getProdutosByPedidoId($pedido['id']);
        }

        return $pedidos;
    }

    // Função para obter os produtos relacionados a um pedido específico
    private function getProdutosByPedidoId($pedidoId) {
        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE pedido_id = ?");
        $stmt->bind_param('i', $pedidoId);
        $stmt->execute();
        $result = $stmt->get_result();
        $produtos = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $produtos;
    }

    // Função para criar um novo pedido
    public function criarPedido($userId) {
        $stmt = $this->conn->prepare("INSERT INTO pedidos (user_id, data_pedido) VALUES (?, NOW())");
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $pedidoId = $this->conn->insert_id; // Retorna o ID do pedido recém-criado
        $stmt->close();

        return $pedidoId;
    }

    // Função para adicionar um produto ao pedido
    public function adicionarProdutoAoPedido($pedidoId, $produtoId, $quantidade) {
        $stmt = $this->conn->prepare("INSERT INTO produtos (pedido_id, produto_id, quantidade) VALUES (?, ?, ?)");
        $stmt->bind_param('iii', $pedidoId, $produtoId, $quantidade);
        $stmt->execute();
        $stmt->close();
    }
}
?>