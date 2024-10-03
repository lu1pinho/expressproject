<?php
session_start(); // Mover o session_start para o início

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
$stmt->bind_result($id, $nome, $dados, $descricao, $produto_preco, $produto_preco_desconto, $percentual_desconto, $url_img);
if (!$stmt->fetch()) {
    die("Produto não encontrado.");
}

// Calculando o preço com desconto
if (empty($produto_preco_desconto)) {
    $produto_preco_desconto = !empty($percentual_desconto)
        ? $produto_preco - (($percentual_desconto / 100) * $produto_preco)
        : $produto_preco;
}

// Calculando a porcentagem de desconto
$porcentagem = ($produto_preco_desconto < $produto_preco) ? round(100 - (($produto_preco_desconto / $produto_preco) * 100)) : 0;

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

function logout() {
    session_destroy();
}
if (isset($_POST['logout'])) {
    logout(); 
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\stylesheets\individual-product.css">
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
    <form action="teste-listagem.php" method="GET">
        <input type="text" name="query" placeholder="Pesquisa Express.com.br" required>
        <button type="submit">
            <img src="images/search_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.svg" alt="pesquisa">
        </button>
    </form>
</div>
      <div class="divs" >
      <div class="contas">
        <?php if (isset($_SESSION['nome'])): ?>
        <p>Olá, <?php echo $_SESSION['nome']; ?>!</p>
        <a href="#">Seus Dados</a>
        <?php else: ?>
        <p>Olá, faça seu login</p>
        <a href="#">Seus Dados</a>
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
                        <p class="old_price">R$ <?php echo number_format($produto_preco, 2, ',', '.'); ?></p>
                        <p class="actual_price">R$ <?php echo number_format($produto_preco_desconto, 2, ',', '.'); ?></p>
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
            <form action="carrinho.php" method="POST">
            <input type="hidden" name="produto_nome" value="<?php echo htmlspecialchars($nome); ?>">
            <input type="hidden" name="produto_imagem" value="<?php echo htmlspecialchars($url_img); ?>">
            <input type="hidden" name="produto_preco" value="<?php echo $produto_preco; ?>"> <!-- Mantendo o valor original -->
            <input type="hidden" name="produto_preco_desconto" value="<?php echo $produto_preco_desconto; ?>"> <!-- Preço com desconto -->
                <select class="seletor" name="quantidade" id="quantidade" value="1" min="1" required>
                <option value="1" selected>Quantidade: 1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                </select>
                <button class="addtocart btn-cart" type="submit">Adicionar ao Carrinho</button>
            </form>
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
                        <img src="<?php echo htmlspecialchars($url_img); ?>" alt="<?php echo htmlspecialchars($product['nome']); ?>" class="recommended-product-image" width="290px">
                    </div>
                    <p class="rname"><?php echo htmlspecialchars($product['nome']); ?></p>
                    <p class="price">R$ <?php echo number_format($product['produto_preco'], 2, ',', '.'); ?></p>
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
