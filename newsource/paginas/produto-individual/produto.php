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
    // Redireciona para a página de erro 404
//    header("Location: /expressproject/error404/error404.html");
//    exit(); // Interrompe a execução do script
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
require 'C:\xampp\htdocs\expressproject\vendor\erusev\parsedown\Parsedown.php';
function formatText($text) {
    // Permitir apenas algumas tags HTML
    $allowed_tags = '<h1><h2><h3><p><strong><em><div><br><ul><li>'; // Adicione outras tags que você deseja permitir
    $parsedown = new Parsedown();
    // Converte Markdown para HTML
    $html = $parsedown->text($text);
    // Retorna HTML sanitizado com nl2br para que quebras de linha sejam mantidas
    return nl2br(strip_tags($html, $allowed_tags));
}

function dividirPor10($valor) {
    // Verifica se o valor é numérico e maior que 0
    if (is_numeric($valor) && $valor > 0) {
        return number_format($valor / 10, 2, ',', '.'); // Formata o valor para duas casas decimais
    }
    return '0,00'; // Retorna '0,00' caso o valor não seja válido
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
session_start();
function logout() {
    session_destroy();
}
if (isset($_POST['logout'])) {
    logout();
}
?>


<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../produto-individual/stylesheets/produto.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <title><?php echo htmlspecialchars($nome); ?></title>
</head>
<body>
    <header>
        <nav class="nav-container">
            <div class="express-logo">
                <img src="../principal/images/logo/logo.png" alt="Logo Express">
            </div>

            <div class="nav-item rem-9">
                <img src="../principal/images/svg/map-local.svg" alt="Atualizar CEP">
                <p>Atualizar CEP</p>
            </div>

            <div class="search-container">
                <input type="text" placeholder="Buscar na Express"=>
                <div class="search-icon">
                    <img src="../principal/images/svg/search.svg" alt="">
                </div>
            </div>

            <div class="nav-item rem-9" id="login">
                <p class="wrap" onmouseenter="showLoginPopup()" onmouseleave="hideLoginPopup()">faça seu login.</p>
            </div>

            <div class="nav-item rem-9">
                <p class="">Pedidos<br>e Devoluções</p>
            </div>

            <div class="nav-item rem-9">
                <img src="../principal/images/svg/shopping_cart.svg" alt="Atualizar CEP">
                <p>Carrinho</p>
            </div
        </nav>
    </header>

    <!--    NAV INFERIOR-->
    <div class="botton-nav">
        <div class="menu">
            <div class="option todos-menu">
                <img src="../principal/images/svg/menu.svg" alt="">
                <p>Todos</p>
            </div>
            <div class="option">
                <p>Venda na Express</p>
            </div>
            <div class="option">
                <p>Ofertas do Dia</p>
            </div>
            <div class="option">
                <p>Mais Vendidos</p>
            </div>
            <div class="option">
                <p>Comprar Novamente</p>
            </div>
        </div>
    </div>

    <!--    POPUP - LOGIN-->
    <div id="login-popup" class="form" style="display: flex;" onmouseenter="keepLoginPopup()" onmouseleave="hideLoginPopupWithDelay()">
        <button class="button-submit" type="submit">Fazer Login</button>
        <p class="p">Não tem uma conta Express? <span class="span">Cadastre-se</span></p>
    </div>

    <div class="popup-todos">
        <div class="categoria">
            <ul>
                <li><a href="#">Eletrônicos</a></li>
                <li><a href="#">Informática</a></li>
                <li><a href="#">Smartphones</a></li>
                <li><a href="#">TV e Vídeo</a></li>
                <li><a href="#">Áudio</a></li>
                <li><a href="#">Games</a></li>
                <li><a href="#">Tablets</a></li>
            </ul>
        </div>
    </div>

    <main>
        <div class="product-container">
            <div class="product-image">
                <img id="product-img" src="../../produtos/<?php echo htmlspecialchars($url_img); ?>" alt="iPhone 16">
            </div>

            <div class="product-info">
                <h1><?php echo htmlspecialchars($nome); ?></h1>
                <div class="values">
                    <div class="price">
                        <span>R$ <?php echo number_format($preco, 2, ',', '.'); ?></span>
                        <p>R$ <?php echo number_format($precodesconto, 2, ',', '.'); ?></p>
                        <span>em até 10x de <?php echo htmlspecialchars(dividirPor10($precodesconto)); ?> sem juros no Cartão Express.</span>
                    </div>
                    <div class="discount">
                        <p><?php echo htmlspecialchars($porcentagem); ?>% de desconto comprando agora no PIX!</p>
                    </div>
                </div>
                <div class="short-description">
                    <ul>
                        <li><?php echo formatText($dados); ?></li>
                    </ul>
                </div>
                <div class="popup-cart">
                    <p>Adicionado Ao Carrinho!</p>
                </div>
                <div class="buy">
                    <button>Comprar</button>
                    <button id="addcart">Adicionar Ao Carrinho</button>
                </div>
                <div class="favorite">
                    <img class="love-icon" src="../produto-individual/img/svg/heart-thin-icon.svg" alt="Favoritar" width="30px">
                </div>
            </div>
        </div>

        <div class="product-full-description">
            <h2 id="text-desc">Descrição do Produto</h2>
            <div class="description">
                <?php echo formatText($descricao); ?>
            </div>

        </div>
    </main>


    <footer>
        <div class="footer-container">

            <div class="footer-item">
                <img src="../principal/images/logo/logopreta.png" alt="Logo Express">
            </div>

            <div class="footer-item">
                <h3>Atendimento ao Cliente</h3>
                <a href="#">Central de Atendimento</a>
                <a href="#">Como Comprar</a>
                <a href="#">Formas de Pagamento</a>
                <a href="#">Política de Privacidade</a>
                <a href="#">Política de Troca e Devolução</a>
            </div>

            <div class="footer-item">
                <h3>Express Marketplace</h3>
                <a href="#">Quem Somos</a>
                <a href="#">Trabalhe Conosco</a>
                <a href="#">Seja um Parceiro</a>
            </div>

            <div class="footer-item">
                <h3>Minha Conta</h3>
                <a href="#">Meus Pedidos</a>
                <a href="#">Meus Dados</a>
                <a href="#">Meus Endereços</a>
            </div>
            <div class="footer-item">
                <h3>Formas de Pagamento</h3>
                <a href="#">Cartões Visa e MasterCard</a>
                <a href="#">Pagamento por Pix</a>
                <a href="#">Apple Pay e PayPal</a>
                <img class="payments" src="../principal/images/svg/paymentmethods.png" alt="Formas de Pagamento">
            </div>
        </div>
    </footer>

    <script src="scripts/produto.js"></script>
</body>
</html>
