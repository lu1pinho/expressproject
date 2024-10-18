<?php

function getPedidosByUserId($pdo, $userId) {
    // Buscar os pedidos realizados pelo usuário
    $stmt = $pdo->prepare("
        SELECT p.id, p.data, p.valor_total
        FROM pedidos p
        WHERE p.usuario_id = :userId
    ");
    $stmt->execute(['userId' => $userId]);
    $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Para cada pedido, buscar os produtos relacionados
    foreach ($pedidos as &$pedido) {
        $stmtProdutos = $pdo->prepare("
            SELECT pr.nome, pr.preco, pp.quantidade, pr.url_img
            FROM produtos pr
            JOIN pedido_produto pp ON pr.id = pp.produto_id
            WHERE pp.pedido_id = :pedidoId
        ");
        $stmtProdutos->execute(['pedidoId' => $pedido['id']]);
        $pedido['produtos'] = $stmtProdutos->fetchAll(PDO::FETCH_ASSOC);
    }

    return $pedidos;
}
?>