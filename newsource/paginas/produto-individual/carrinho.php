<?php
session_start();
include 'C:/xampp/htdocs/expressproject/src/settings/connection.php'; // Conexão ao banco de dados

// Define o caminho para as imagens
define('CAMINHO_IMAGENS', 'newsource/produtos/');

// Verifique se o carrinho já está criado
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Inicializa o total
$total = 0;

// Verificar se o usuário está logado
if (isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
} else {
    die("Usuário não está logado. Por favor, faça o login para continuar.");
}

// Adiciona o produto ao carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Adicionar produto ao carrinho
    if (isset($_POST['produto_nome'])) {
        $produto = [
            'nome' => $_POST['produto_nome'],
            'url_img' => $_POST['produto_imagem'],
            'preco' => (float) $_POST['produto_preco'],
            'preco_com_desconto' => (isset($_POST['produto_preco_desconto']) && $_POST['produto_preco_desconto'] != '')
                ? (float) $_POST['produto_preco_desconto']
                : null,
            'quantidade' => (int) $_POST['quantidade']
        ];

        $_SESSION['carrinho'][] = $produto;

        // Salvar no banco de dados
        $stmt = $conn->prepare("INSERT INTO carrinho (id_user, produto_nome, url_img, preco, preco_com_desconto, quantidade) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issddi", $id_user, $produto['nome'], $produto['url_img'], $produto['preco'], $produto['preco_com_desconto'], $produto['quantidade']);
        $stmt->execute();
        $stmt->close();
    }

    // Remover item do carrinho
    if (isset($_POST['remover_item'])) {
        $index = (int)$_POST['remover_item']; // Índice do item a ser removido

        if (isset($_SESSION['carrinho'][$index])) {
            $produto_nome = $_SESSION['carrinho'][$index]['nome']; // Nome do produto a ser removido

            // Remove o item do carrinho na sessão
            unset($_SESSION['carrinho'][$index]);
            $_SESSION['carrinho'] = array_values($_SESSION['carrinho']); // Reindexa o array

            // Remove o item do banco de dados
            $stmt = $conn->prepare("DELETE FROM carrinho WHERE id_user = ? AND produto_nome = ?");
            $stmt->bind_param("is", $id_user, $produto_nome);
            $stmt->execute();
            $stmt->close();
        } else {
            die("Produto não encontrado no carrinho.");
        }
    }

    // Alterar a quantidade do item no carrinho
    if (isset($_POST['alterar_quantidade'])) {
        foreach ($_POST['alterar_quantidade'] as $index => $operacao) {
            if (isset($_SESSION['carrinho'][$index])) {
                $produto_nome = $_SESSION['carrinho'][$index]['nome'];

                if ($operacao === 'plus') {
                    $_SESSION['carrinho'][$index]['quantidade']++;
                } elseif ($operacao === 'minus' && $_SESSION['carrinho'][$index]['quantidade'] > 1) {
                    $_SESSION['carrinho'][$index]['quantidade']--;
                }

                // Atualiza a quantidade no banco de dados
                $nova_quantidade = $_SESSION['carrinho'][$index]['quantidade'];
                $stmt = $conn->prepare("UPDATE carrinho SET quantidade = ? WHERE id_user = ? AND produto_nome = ?");
                $stmt->bind_param("iis", $nova_quantidade, $id_user, $produto_nome);
                $stmt->execute();
                $stmt->close();
            } else {
                die("Produto não encontrado no carrinho.");
            }
        }
    }
}

// Verifica se produtos foram selecionados e calcula o total
if (isset($_POST['produtos_selecionados'])) {
    foreach ($_POST['produtos_selecionados'] as $index) {
        if (isset($_SESSION['carrinho'][$index])) {
            $item = $_SESSION['carrinho'][$index];
            $preco_final = $item['preco_com_desconto'] ?? $item['preco']; // Usa o preço com desconto se existir
            $total += $preco_final * $item['quantidade'];
        }
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - Express.com</title>
    <link rel="stylesheet" href="carrinho.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <?php include 'nav.php'; ?>
    <div class="juntando">
        <div class="container">
            <div class="cart">
                <div class="back-button">
                    <a href="../principal/pagina.php">
                        <span class="arrow">&#8592;</span>
                    </a>
                    <span>Carrinho</span>
                </div>

                <!-- Verificar se o carrinho está vazio -->
                <?php if (empty($_SESSION['carrinho'])): ?>
                    <p style="margin-left: 20px;">Seu carrinho está vazio.</p>
                <?php else: ?>
                    <form action="carrinho.php" method="POST" id="carrinhoForm">
                        <?php foreach ($_SESSION['carrinho'] as $index => $item): ?>
                            <div class="cart-item">
                                <input class="check" type="checkbox" name="produtos_selecionados[]" value="<?= $index; ?>"
                                    <?= (isset($_POST['produtos_selecionados']) && in_array($index, $_POST['produtos_selecionados'])) ? 'checked' : ''; ?>
                                    onchange="document.getElementById('carrinhoForm').submit();">

                                <img class="product-image" src="<?= CAMINHO_IMAGENS . htmlspecialchars($item['url_img']); ?>" alt="<?= htmlspecialchars($item['nome']); ?>" />
                                <div class="product-details">
                                    <a href="#"><?= htmlspecialchars($item['nome']); ?></a>
                                    <p>
                                        <?php if ($item['preco_com_desconto'] !== null): ?>
                                            <span class="preco-original" style="text-decoration: line-through;">R$ <?= number_format($item['preco'], 2, ',', '.'); ?></span>
                                            <span class="preco-com-desconto">R$ <?= number_format($item['preco_com_desconto'], 2, ',', '.'); ?></span>
                                        <?php else: ?>
                                            R$ <?= number_format($item['preco'], 2, ',', '.'); ?>
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <div class="quantity-control">
                                    <button type="submit" name="alterar_quantidade[<?= $index; ?>]" value="plus" class="btn-quantity">+</button>
                                    <label class="quantity-label"><?= $item['quantidade']; ?></label>
                                    <button type="submit" name="alterar_quantidade[<?= $index; ?>]" value="minus" class="btn-quantity">-</button>
                                </div>
                                <!-- Botão de remoção com valor do índice -->
                                <button type="submit" name="remover_item" value="<?= $index; ?>" class="remove-item">&#128465;</button>
                            </div>
                        <?php endforeach; ?>
                    </form>
                <?php endif; ?>
            </div>
        </div>

        <div class="container2">
            <h3>Subtotal: R$ <?= number_format($total, 2, ',', '.'); ?></h3>
           <a href="../finalisar-compra/finalizar-pedido.php">
               <button class="checkout-button">Fechar Pedido</button>

           </a>
        </div>
    </div>

    <script>
        function goBack() {
            console.log('Voltar clicado'); // Adiciona log para depuração
            window.history.back();
        }
    </script>
</body>

</html>