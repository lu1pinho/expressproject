<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página Principal</title>
  <style>
  .product-grid {
    display: flex;
    flex-wrap: wrap; /* Permite que os itens quebrem linha se necessário */
    gap: 20px; /* Espaçamento entre os itens */
    justify-content: flex-start; /* Alinha os produtos à esquerda */
    padding: 20px;
  }

  .product-item {
    text-align: center;
    width: 150px;
  }

  .product-image {
    width: 150px;
    height: 150px;
  }
  a {
    text-decoration: none;
    color: black;
  }
</style>

  <link rel="stylesheet" href="paginaprincipal.css">
  <script src="script.js" defer></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
    rel="stylesheet">
</head>

<body>
  <header>
    <div class="navbar">
      <div class="logo">
        <img src="images/shopping_cart_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24 (1).svg" alt="carrinho">
        <a href="#">Express.com</a>
      </div>
      <div class="location">
        <img src="images/location_on_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.svg">
        <a href="#">Atualizar CEP</a>
      </div>
      <div class="searchbar">
        <form action="teste-listagem.php" method="GET">
          <input type="text" name="query" placeholder="Pesquisa Express.com.br">
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
  <?php
include_once 'C:/xampp/htdocs/expressproject/src/settings/connection.php';

// Consulta para buscar produtos com 'oferta_do_dia' = 1
$sql = "SELECT * FROM produtos WHERE oferta_do_dia = 1";
$result = $conn->query($sql);

// Verifica se encontrou resultados
if ($result->num_rows > 0) {
    echo "<h2>Ofertas do Dia</h2>";
    // Adiciona a div que organiza os produtos em formato grid
    echo "<div class='product-grid'>";
    
    // Exibe cada produto que está em oferta
    while ($row = $result->fetch_assoc()) {
        echo "<div class='product-item'>";
        echo "<a href='individual-product.php?id=" . $row['id'] . "'>";

        // Exibe a imagem do produto
        echo "<div style='background-color: white; padding: 10px; display: inline-block; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);'>";
        echo "<img src='" . htmlspecialchars($row['url_img']) . "' alt='" . htmlspecialchars($row['nome']) . "' class='product-image'>";
        echo "</div>";

        // Exibe o nome e o preço do produto
        echo "<p style='margin: 5px 0; word-wrap: break-word; text-align: left; font-family: Inter; padding-left: 10px; width: 130px;'>" . htmlspecialchars($row['nome']) . "</p>";
        echo "<p style='text-align:left; font-size: 20px; font-family:Inter; margin-left:7px'><strong>R$ " . number_format($row['preco'], 2, ',', '.') . "</strong></p>";

        echo "</a>";
        echo "</div>";
    }

    echo "</div>"; // Fecha a div product-grid
} else {
    echo "<p>Nenhuma oferta disponível no momento.</p>";
}

// Fecha a conexão
$conn->close();
?>
