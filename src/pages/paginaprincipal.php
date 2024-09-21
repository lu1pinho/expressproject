<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página Principal</title>
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
        <input type="text" placeholder="Pesquisa Express.com.br">
        <button type="submit">
          <img style="height: 32px;" src="images/search_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.svg" alt="pesquisa">
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
              <a style="color: #001f54; font-size: 13px; " href="#">Comece aqui.</a>
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



  <main>
    <aside>
      <form id="filterForm" method="GET" action="">
        <!-- Frete Grátis -->
        <div class="frete-gratis-container">
          <p class="frete-gratis-text">Elegível a Frete Grátis</p>
          <div class="frete-gratis-checkbox">
            <input type="checkbox" id="frete-gratis" name="frete-gratis" value="1">
            <label for="frete-gratis">Frete Grátis</label>
          </div>
        </div>
        <!-- Categoria -->
        <div class="categoria">
          <p class="departamento">Departamento</p>
          <select id="categoria" name="categoria">
            <option value="Eletrônicos">Eletrônicos</option>
            <option value="Casa e Cozinha">Casa e Cozinha</option>
            <option value="Esportes e Lazer">Esportes e Lazer</option>
            <option value="Livros e Papelaria">Livros e Papelaria</option>
            <option value="Brinquedos e Jogos">Brinquedos e Jogos</option>
          </select>
        </div>
        <!-- Preço -->
        <h3 class="preço">Preço</h3>
        <div class="price-range-container">
          <label for="minPrice">Preço Mínimo: R$ <span id="minPriceLabel">0</span></label>
          <input type="range" id="minPrice" name="minPrice" min="0" max="10000" value="0" step="1">
          <br>
          <label for="maxPrice">Preço Máximo: R$ <span id="maxPriceLabel">10,000</span></label>
          <input type="range" id="maxPrice" name="maxPrice" min="0" max="10000" value="10000" step="1">
        </div>
        <!-- Ofertas e Descontos -->
        <div class="opcao">
          <h3>Ofertas e Descontos</h3>
          <div class="checkbox-container">
            <input type="checkbox" name="oferta" id="oferta_dia" value="dia">
            <label for="oferta_dia">Ofertas do Dia</label>
          </div>
          <div class="checkbox-container">
            <input type="checkbox" name="oferta" id="oferta_descontos" value="descontos">
            <label for="oferta_descontos">Todos os Descontos</label>
          </div>
        </div>
        <!-- Condição -->
        <div class="opcao">
          <h3>Condição</h3>
          <div class="checkbox-container">
            <input type="checkbox" name="condicao" id="condicao_novo" value="novo">
            <label for="condicao_novo">Novo</label>
          </div>
          <div class="checkbox-container">
            <input type="checkbox" name="condicao" id="condicao_usado" value="usado">
            <label for="condicao_usado">Usado</label>
          </div>
        </div>
        <!-- Botão de buscar -->
        <button type="submit" class="buscar-btn">Buscar</button>
      </form>
    </aside>

    <article>
      <div class="container">
        <!-- Carrossel de imagens -->
        <div class="carousel-container">
          <div class="carousel carousel-1">
            <img src="images/imagem01.jpg" alt="Imagem 1" class="carousel-img active">
            <img src="images/imagem02.jpg" alt="Imagem 2" class="carousel-img">
            <img src="images/imagem03.jpg" alt="Imagem 3" class="carousel-img">
          </div>
          <div class="carousel carousel-2">
            <img src="images/imagem05.jpeg" alt="Imagem 1 do Carrossel 2" class="carousel-img active">
            <img src="images/imagem06.jpg" alt="Imagem 2 do Carrossel 2" class="carousel-img">
            <img src="images/imagem07.jpeg" alt="Imagem 3 do Carrossel 2" class="carousel-img">
          </div>
        </div>

        <!-- Resultados da busca -->
        <h2>Resultados da Busca</h2>
        <div class="resultados">
          <?php
          include 'connection.php';

          if (isset($_GET['minPrice']) || isset($_GET['categoria']) || isset($_GET['frete-gratis']) || isset($_GET['oferta']) || isset($_GET['condicao'])) {

            $frete_gratis = isset($_GET['frete-gratis']) ? $_GET['frete-gratis'] : null;
            $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : null;
            $minPrice = isset($_GET['minPrice']) ? (int)$_GET['minPrice'] : 0;
            $maxPrice = isset($_GET['maxPrice']) ? (int)$_GET['maxPrice'] : 10000;
            $oferta = isset($_GET['oferta']) ? $_GET['oferta'] : null;
            $condicao = isset($_GET['condicao']) ? $_GET['condicao'] : null;

            $query = "SELECT * FROM filtro WHERE preco BETWEEN ? AND ?";

            $types = "dd";
            $params = [$minPrice, $maxPrice];

            if ($frete_gratis) {
              $query .= " AND frete_gratis = 1";
            }

            if (!empty($categoria)) {
              $query .= " AND departamento = ?";
              $types .= "s";
              $params[] = $categoria;
            }

            if (!empty($oferta)) {
              if ($oferta == 'dia') {
                $query .= " AND ofertas_descontos = 'Ofertas do Dia'";
              } elseif ($oferta == 'descontos') {
                $query .= " AND ofertas_descontos != ''";
              }
            }

            if (!empty($condicao)) {
              $query .= " AND condicao = ?";
              $types .= "s";
              $params[] = $condicao;
            }

            $stmt = $conn->prepare($query);

            if ($stmt === false) {
              die("Erro na preparação da consulta: " . $conn->error);
            }

            $stmt->bind_param($types, ...$params);

            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
              echo '<ul>';
              while ($row = $result->fetch_assoc()) {
                echo "<li><p><strong>Departamento:</strong> " . $row['departamento'] . " - <strong>Preço:</strong> R$" . number_format($row['preco'], 2, ',', '.') . " - <strong>Condição:</strong> " . $row['condicao'] . "</p></li>";
              }
              echo '</ul>';
            } else {
              echo "<p>Nenhum produto encontrado.</p>";
            }

            $stmt->close();
            $conn->close();
          } else {
            echo "<p>Use o formulário ao lado para buscar produtos.</p>";
          }
          ?>
        </div>
      </div>
    </article>
  </main>
</body>

</html>