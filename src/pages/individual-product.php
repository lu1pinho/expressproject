<?php

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

include_once 'C:/xampp/htdocs/expressproject/src/settings/connection.php';

if (empty($conn) || $conn->connect_error) {
    die("Falha na conexão: " . (isset($conn->connect_error) ? $conn->connect_error : "Conexão não estabelecida."));
}


$sql = "SELECT id, nome, dados, descricao, preco, precodesconto FROM produtos WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Erro na preparação da consulta: ' . $conn->error);
}


$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($id, $nome, $dados, $descricao, $preco, $precodesconto);
if (!$stmt->fetch()) {
    die("Produto não encontrado.");
}

$porcentagem = 100 - (($precodesconto / $preco) * 100);
$porcentagem = round($porcentagem); // Formatar para número inteiro
$stmt->close();


function formatText($text) {
    $text = nl2br(htmlspecialchars($text));
    return str_replace("  ", "<br><br>", $text);
}


$recommended_sql = "SELECT id, nome, preco, precodesconto FROM produtos WHERE id != ? LIMIT 3";
$recommended_stmt = $conn->prepare($recommended_sql);
$recommended_stmt->bind_param("i", $id);
$recommended_stmt->execute();
$recommended_stmt->bind_result($rec_id, $rec_nome, $rec_preco, $rec_precodesconto);

$recommended_products = [];
while ($recommended_stmt->fetch()) {
    $recommended_products[] = [
        'id' => $rec_id,
        'nome' => $rec_nome,
        'preco' => $rec_preco,
        'precodesconto' => $rec_precodesconto,
    ];
}
$recommended_stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="../stylesheets/individual-product.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($nome); ?></title>
    <script src="../script/script.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div class="navbar">
        <div class="logo">
            <img src="images/logo.png" alt="Logotipo Express Marketplace" width="150">
        </div>
        <div class="location">
            <img src="images/svg/location_on.svg">
            <a href="#">Atualizar CEP</a>
        </div>
        <div class="searchbar">
            <input type="text" placeholder="Pesquisa Express.com.br">
            <button type="submit">
                <img style="height: 32px;" src="images/svg/search.svg" alt="pesquisa">
            </button>
        </div>
        <div class="divs">
            <div class="contas">
                <p>Olá, faça seu login</p>
                <a href="#">Contas</a>
                <div class="tooltip">
                    <button>Faça seu login</button>
                    <div class="inline">
                        <p>Cliente novo?</p>
                        <a style="color: #001f54; font-size: 13px;" href="#">Comece aqui.</a>
                    </div>
                </div>
            </div>
            <div class="pedidos">
                <a href="#">Devoluções e</a>
                <a href="#">Pedidos</a>
            </div>
            <div class="carrinho">
                <img src="images/svg/shopping_cart.svg" alt="">
                <a href="#">Carrinho</a>
            </div>
        </div>
    </div>
</header>

<div class="subnav">
    <div class="todos">
        <img src="images/svg/menu.svg" alt="menu-sanduiche">
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

<main>
    <article>
        <div class="left"></div>
        <div class="right">
            <div class="product">
                <h2><?php echo htmlspecialchars($nome); ?></h2>
                <div class="pricing-container">
                    <div class="pricing">
                        <p class="old_price">R$ <?php echo number_format($preco, 2, ',', '.'); ?></p>
                        <p class="actual_price">R$ <?php echo number_format($precodesconto, 2, ',', '.'); ?></p>
                        <p class="installment">em até 4x sem juros.</p>
                    </div>
                    <div class="vertical-line"></div>
                    <div class="discount">
                        <p class="discount-price"><?php echo htmlspecialchars($porcentagem); ?>% de desconto</p>
                        <p>comprando agora!</p>
                    </div>
                </div>
                <div class="minimal-description">
                    <p>Dados do Produto</p>
                    <ul>
                        <li><?php echo formatText($dados); ?></li> <!-- Usando a função formatText -->
                    </ul>
                </div>
                <div class="action-buttons">
                    <button class="buynow btn-final">Compre Agora</button>
                    <button class="addtocart btn-cart">Adicionar ao Carrinho</button>
                </div>
            </div>
        </div>
    </article>
    <section>
        <div class="description">
            <p class="description-text">Descrição do Produto</p>
            <hr>
            <p><?php echo formatText($descricao); ?></p> <!-- Usando a função formatText -->
        </div>
    </section>

    <section>
        <p class="tx-25 pd-top-bottom">Produtos Recomendados</p>
        <div class="container">
            <?php foreach ($recommended_products as $product): ?>
                <div class="card">
                    <div class="imgbg">Imagem</div>
                    <p><?php echo htmlspecialchars($product['nome']); ?></p>
                    <p class="price">R$ <?php echo number_format($product['precodesconto'], 2, ',', '.'); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<footer>
    <div id="containerFooter">
        <div class="flogo">
            <img src="images/logo.png" alt="Logotipo Express Marketplace" width="150">
        </div>
        <div id="webFooter">
            <h3> Express </h3>
            <p> Quem somos? </p>
            <p> Nossos Contatos </p>
            <p> Acessibilidade </p>
            <p> Suporte </p>
        </div>
        <div id="webFooter">
            <h3> Pagamento </h3>
            <p> Meios de Pagamento </p>
            <p> Cartão de Crédito</p>
            <p> Compras com Pix</p>
        </div>
    </div>
</footer>

</body>
</html>
