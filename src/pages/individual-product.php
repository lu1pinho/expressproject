<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Incluindo conexão
include_once 'C:/xampp/htdocs/expressproject/src/settings/connection.php';

// Verificando a conexão
if (empty($conn) || $conn->connect_error) {
    die("Falha na conexão: " . (isset($conn->connect_error) ? $conn->connect_error : "Conexão não estabelecida."));
}

// Preparando a consulta
$sql = "SELECT id, nome, dados_produto, descricao, preco, preco_com_desconto, percentual_desconto, url_img FROM produtos WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Erro na preparação da consulta: ' . $conn->error);
}

// Vinculando e executando a consulta
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($id, $nome, $dados, $descricao, $preco, $precodesconto, $percentual_desconto, $url_img);
if (!$stmt->fetch()) {
    die("Produto não encontrado.");
}

// Calculando o preço com desconto
if (empty($precodesconto)) {
    $precodesconto = !empty($percentual_desconto)
        ? $preco - (($percentual_desconto / 100) * $preco)
        : $preco;
}

// Calculando a porcentagem de desconto
$porcentagem = ($precodesconto < $preco) ? round(100 - (($precodesconto / $preco) * 100)) : 0;

$stmt->close();

// Função para formatar texto
function formatText($text) {
    return nl2br(htmlspecialchars($text));
}

// Consultando produtos recomendados
$recommended_sql = "SELECT id, nome, preco, preco_com_desconto, percentual_desconto, url_img FROM produtos WHERE id != ? LIMIT 3";
$recommended_stmt = $conn->prepare($recommended_sql);
$recommended_stmt->bind_param("i", $id);
$recommended_stmt->execute();
$recommended_stmt->bind_result($rec_id, $rec_nome, $rec_preco, $rec_precodesconto, $rec_percentual_desconto, $rec_url_img);

$recommended_products = [];
while ($recommended_stmt->fetch()) {
    $recommended_products[] = [
        'id' => $rec_id,
        'nome' => $rec_nome,
        'preco' => $rec_preco,
        'precodesconto' => $rec_precodesconto,
        'percentual_desconto' => $rec_percentual_desconto,
        'url_img' => $rec_url_img,
    ];
}
$recommended_stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheets/individual-product.css">
    <title><?php echo htmlspecialchars($nome); ?></title>
    <script src="script-pag-principal/script-slider.js" defer></script>
    <script src="script-pag-principal/script2.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div class="navbar">
        <div class="logo" onclick="homePage()">
            <img src="images/logo.png" alt="Logotipo Express Marketplace" width="150">
        </div>
        <div class="location">
            <img src="images/location_on_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.svg" alt="Localização">
            <a href="#">Atualizar CEP</a>
        </div>
        <div class="searchbar">
            <input type="text" placeholder="Pesquisa Express.com.br">
            <button type="submit">
                <img style="height: 32px;" src="images/search_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.svg" alt="pesquisa">
            </button>
        </div>
        <div class="divs" >
        <div class="contas" >
          <p>Olá, faça seu login</p>
          <a href="#">Contas</a>
          <div class="tooltip" >
            <button>Faça seu login</button>
            <div class="inline" >
            <p style="font-family: Inter;" >Cliente novo?</p>
            <a style="color: #001f54; font-size: 13px; " href="#">Comece aqui.</a>
            </div>
          </div>
        </div>
        <div class="pedidos" >
          <a href="#">Devoluções e</a>
          <a href="#">Pedidos</a>
        </div>
        <div class="carrinho" >
          <img src="images/shopping_cart_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24 (1).svg" alt="">
          <a href="#">Carrinho</a>
        </div>
      </div>
    </div>
    </div>
</header>

<div class="subnav" >
    <div class="todos" >
      <img src="images/menu_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24 (1).svg" alt="menu-sanduiche">
      <p>Todos</p>
    </div>
    <div class="venda-na-express" >
      Venda Na Express
    </div>
    <div class="comprar-novamente" >
      Comprar novamente
    </div>
    <div class="oferta-do-dia" >
      Oferta do dia
    </div>
  </div>

<main>
    <article>
        <div class="left">
            <img src="<?php echo htmlspecialchars($url_img); ?>" alt="" width="500px">
        </div>
        <div class="right">
            <div class="product">
                <h2><?php echo htmlspecialchars($nome); ?></h2>
                <div class="pricing-container">
                    <div class="pricing">
                        <p class="old_price">R$ <?php echo number_format($preco, 2, ',', '.'); ?></p>
                        <p class="actual_price">R$ <?php echo number_format($precodesconto, 2, ',', '.'); ?></p>
                        <p class="installment">em até 10x sem juros com o Cartão Express.</p>
                    </div>
                    <div class="vertical-line"></div>
                    <div class="discount">
                        <p class="discount-price"><?php echo htmlspecialchars($porcentagem); ?>% de desconto</p>
                        <p>comprando agora no PIX!</p>
                    </div>
                </div>
                <div class="minimal-description">
                    <p>Dados do Produto</p>
                    <ul>
                        <li><?php echo formatText($dados); ?></li>
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
            <p><?php echo formatText($descricao); ?></p>

            <br>
            <hr>
        </div>
    </section>

    <section>
        <p class="tx-25 pd-top-bottom">Produtos Recomendados</p>
        <div class="container">
            <?php foreach ($recommended_products as $product): ?>
                <div class="card" onclick="openPage(<?php echo htmlspecialchars($product['id']); ?>)">
                    <div class="imgbg">
                        <img src="<?php echo htmlspecialchars($product['url_img']); ?>" alt="<?php echo htmlspecialchars($product['nome']); ?>" class="recommended-product-image" width="290px">
                    </div>
                    <p class="rname"><?php echo htmlspecialchars($product['nome']); ?></p>
                    <p class="price">R$ <?php echo number_format($product['preco'], 2, ',', '.'); ?></p>
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
            <h3>Express</h3>
            <p>Quem somos?</p>
            <p>Nossos Contatos</p>
            <p>Acessibilidade</p>
            <p>Suporte</p>
        </div>
        <div id="webFooter">
            <h3>Pagamento</h3>
            <p>Meios de Pagamento</p>
            <p>Cartão de Crédito</p>
            <p>Compras com Pix</p>
        </div>
    </div>
</footer>

<script>
    function openPage(id) {
        window.location.href = "individual-product.php?id=" + id;
    }

    function homePage() {
        window.location.href = "paginaprincipal.php";
    }
</script>

</body>
</html>
