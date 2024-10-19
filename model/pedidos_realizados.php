<?php
function getPedidosByUserId($conn, $user_id) {
    if ($conn == null || $user_id == null) {
        return [];
    }

    // Consulta para pegar os pedidos do usuário
    $stmt = $conn->prepare("SELECT * FROM pedidos WHERE user_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $pedidos = $result->fetch_all(MYSQLI_ASSOC);

    // Para cada pedido, buscar os produtos relacionados
    foreach ($pedidos as &$pedido) {
        $stmt_prod = $conn->prepare("SELECT * FROM produtos WHERE pedido_id = ?");
        $stmt_prod->bind_param('i', $pedido['id']);
        $stmt_prod->execute();
        $result_prod = $stmt_prod->get_result();
        $pedido['produtos'] = $result_prod->fetch_all(MYSQLI_ASSOC);
    }

    return $pedidos;
}
?>