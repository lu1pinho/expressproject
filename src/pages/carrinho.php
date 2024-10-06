<?php
session_start();

// Verifique se o carrinho já está criado
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Inicializa o total
$total = 0;

// Adiciona o produto ao carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Adicionar produto ao carrinho
    if (isset($_POST['produto_nome'])) {
        $produto = [
            'nome' => $_POST['produto_nome'],
            'url_img' => $_POST['produto_imagem'],
            'preco' => (float) $_POST['produto_preco'], // Preço original
            // Preço com desconto
            'preco_com_desconto' => (isset($_POST['produto_preco_desconto']) && $_POST['produto_preco_desconto'] != '') 
                                     ? (float) $_POST['produto_preco_desconto'] 
                                     : null,
            'quantidade' => (int) $_POST['quantidade']
        ];
        
        $_SESSION['carrinho'][] = $produto; // Adiciona o produto ao carrinho
    }

    // Remover item do carrinho
    if (isset($_POST['remover_item'])) {
        $index = $_POST['index']; // Índice do item a ser removido
        unset($_SESSION['carrinho'][$index]); // Remove o item
        $_SESSION['carrinho'] = array_values($_SESSION['carrinho']); // Reindexa o array
    }

    // Alterar a quantidade do item no carrinho
    if (isset($_POST['alterar_quantidade'])) {
        $index = $_POST['index']; // Índice do item
        $operacao = $_POST['alterar_quantidade']; // '+' ou '-'

        if ($operacao === 'plus') {
            $_SESSION['carrinho'][$index]['quantidade']++; // Aumenta a quantidade
        } elseif ($operacao === 'minus' && $_SESSION['carrinho'][$index]['quantidade'] > 1) {
            $_SESSION['carrinho'][$index]['quantidade']--; // Diminui a quantidade, sem permitir que fique menor que 1
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
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - Express.com</title>
    <link rel="stylesheet" href="../stylesheets/carrinho.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <img class="logo1" src="images/logo.png" alt="carrinho">
            </div>
            <div class="location">
                <img src="images/location_on_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.svg">
                <a href="#">Atualizar CEP</a>
            </div>
            <div class="searchbar">
                <form action="teste-listagem.php" method="GET">
                    <input type="text" name="query" placeholder="Pesquisa Express.com.br" required>
                    <button type="submit">
                        <img src="images/search_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.svg" alt="pesquisa">
                    </button>
                </form>
            </div>

            <div class="divs">
                <div class="contas">
                    <?php if (isset($_SESSION['nome'])): ?>
                    <p>Olá, <?php echo $_SESSION['nome']; ?>!</p>
                    <a href="#">Seus Dados</a>
                    <?php else: ?>
                    <p>Olá, faça seu login</p>
                    <a href="#">Abra sua conta</a>
                    <div class="tooltip">
                        <a href="login.php">
                            <button>Faça seu login</button>
                        </a>
                        <div class="inline">
                            <p>Cliente novo?</p>
                            <a style="color: #001f54; font-size: 13px;" href="cadastro.php">Comece aqui.</a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="pedidos">
                    <a href="#">Devoluções e</a>
                    <a href="#">Pedidos</a>
                </div>
                <div class="carrinho">
                    <img src="images/shopping_cart_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24 (1).svg" alt="">
                    <a href="#">Carrinho</a>
                </div>
            </div>
        </div>
    </header>

    <div class="subnav">
        <div class="todos">
            <img src="images/menu_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24 (1).svg" alt="menu-sanduiche">
            <p>Todos</p>
        </div>
        <div class="venda-na-express">
            Venda Na Express
        </div>
        <div class="comprar-novamente">
            Comprar novamente
        </div>
        <div class="oferta-do-dia">
            Oferta do dia
        </div>
    </div>

    <div class="juntando">
    <div class="container">
        <div class="cart">
            <div class="back-button">
                <a href="javascript:void(0);" class="arrow-link" onclick="goBack()">
                    <span class="arrow">&#8592;</span>
                </a> 
                <span>Carrinho</span>
            </div>

            <!-- Verificar se o carrinho está vazio -->
            <?php if (empty($_SESSION['carrinho'])): ?>
                <p>Seu carrinho está vazio.</p>
            <?php else: ?>
                <form action="carrinho.php" method="POST" id="carrinhoForm">
                <?php foreach ($_SESSION['carrinho'] as $index => $item): ?>
                    <div class="cart-item">
                        <input class="check" type="checkbox" name="produtos_selecionados[]" value="<?= $index; ?>" 
                        <?= (isset($_POST['produtos_selecionados']) && in_array($index, $_POST['produtos_selecionados'])) ? 'checked' : ''; ?>
                        onchange="document.getElementById('carrinhoForm').submit();">

                        <img src="<?= htmlspecialchars($item['url_img']); ?>" alt="<?= htmlspecialchars($item['nome']); ?>" class="product-image">
                        <div class="product-details">
                            <a href="#"><?= htmlspecialchars($item['nome']); ?></a>
                            <p>R$ <?= number_format($item['preco'], 2, ',', '.'); ?></p>
                        </div>
                        <div class="quantity-control">
                            <input type="hidden" name="index" value="<?= $index; ?>">
                            <button type="submit" name="alterar_quantidade" value="plus" class="btn-quantity">+</button>
                            <label class="quantity-label" for="item<?= $index; ?>-quantity"><?= $item['quantidade']; ?></label>
                            <button type="submit" name="alterar_quantidade" value="minus" class="btn-quantity">-</button>
                        </div>
                        <button type="submit" name="remover_item" class="remove-item">&#128465;</button>
                    </div>
                <?php endforeach; ?>
            </form>
            <?php endif; ?>
        </div>
    </div>

    <div class="container2">
        <h3> Subtotal:  R$ <?= number_format($total, 2, ',', '.'); ?></h3>
        <button class="checkout-button">Fechar Pedido</button>
    </div>
</div>


    <script>
    function goBack() {
        console.log('Voltar clicado'); // Adiciona log para depuração
        window.history.back(); // Redireciona para a página anterior
    }
    </script>
</body>
</html>
