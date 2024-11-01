<?php  
include 'C:/xampp/htdocs/expressproject/src/settings/connection.php';

// Verifica se a categoria foi passada na URL
if (isset($_GET['categoria'])) {
    $categoria = $_GET['categoria'];

    // Prepara a consulta para evitar SQL Injection
    $stmt = $conn->prepare("SELECT * FROM produtos WHERE categoria = ?");
    $stmt->bind_param("s", $categoria);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Redireciona se a categoria não for fornecida
    header("Location: pagina.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - <?php echo htmlspecialchars($categoria); ?></title>
    <link rel="stylesheet" href="paginaprincipal.css">
    <script src="script-produtos.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;400;700&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <nav>
        <div class="navbar">
            <div class="logo">
                <img class="logo1" src="images/logo.png" alt="carrinho">
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
                    <img src="images/shopping_cart_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24 (1).svg" alt="Carrinho">
                    <a href="#">Carrinho</a>
                </div>
            </div>
        </div>
    </nav>
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
        </nav>
    </header>
    <h1 style="font-family: Inter; font-size:20px; margin-left:5px; " >Produtos da Categoria: <?php echo htmlspecialchars($categoria); ?></h1>
<main>
    <div class="produtos-lista" style="display: flex; flex-wrap: wrap; justify-content: center;">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($produto = $result->fetch_assoc()): ?>
                <div class="produto-item" style="text-align: center; width: 150px; margin: 10px;"> <!-- Aumentei a largura do item -->
                    <a href="individual-product.php?id=<?php echo $produto['id']; ?>">

                        <!-- Adiciona um div com fundo branco ao redor da imagem -->
                        <div style="background-color: white; padding: 10px; display: inline-block; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                            <img src="<?php echo htmlspecialchars($produto['url_img']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>" class="product-image" style="width: 150px; height: 150px;">
                        </div>

                        <!-- Ajusta o estilo do parágrafo -->
                        <p style="margin: 5px 0; word-wrap: break-word; text-align: left; font-family: 'Inter', sans-serif; padding-left: 10px; width: 130px;"><?php echo htmlspecialchars($produto['nome']); ?></p>
                        <p style="text-align:left; font-size: 20px; font-family: 'Inter', sans-serif; margin-left:7px;"><strong>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></strong></p>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Nenhum produto encontrado nesta categoria.</p>
        <?php endif; ?>
    </div>
</main>

    <?php
    // Fecha a conexão com o banco de dados
    $stmt->close();
    $conn->close();
    ?>
</body>
</html>
