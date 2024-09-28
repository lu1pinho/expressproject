<?php
  include 'C:/xampp/htdocs/expressproject/src/settings/connection.php';
  session_start();
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
  <title>Página Principal</title>
  <link rel="stylesheet" href="paginaprincipal.css">
  <script src="script-pag-principal/filtro.js" defer></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
    rel="stylesheet">
</head>

<body>
  <header>
    <div class="navbar">
        <div class="logo" onclick="homePage()">
            <img src="images/logo.png" alt="Logotipo Express Marketplace" width="150">
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
        <h3 class="preco">Preço</h3>
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
        <!-- Resultados da busca -->
        <div class="resultados">
    <?php
    include 'C:/xampp/htdocs/expressproject/src/settings/connection.php';

    // Verifica se a consulta foi passada
    if (isset($_GET['query'])) {
        $query = $_GET['query'];

        // Prepara a consulta para evitar SQL Injection
        $stmt = $conn->prepare("SELECT * FROM produtos WHERE nome LIKE ?");
        $searchTerm = "%" . $query . "%";
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<div class='product-item' style='text-align: center; width: 150px;'>";
              echo "<a href='individual-product.php?id=" . $row['id'] . "'>";
              
              // Adiciona um div com fundo branco ao redor da imagem
              echo "<div style='background-color: white; padding: 10px; display: inline-block; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);'>";
              echo "<img src='" . htmlspecialchars($row['url_img']) . "' alt='" . htmlspecialchars($row['nome']) . "' class='product-image' style='width: 150px; height: 150px;'>";
              echo "</div>";
              
              // Ajusta o estilo do parágrafo
              echo "<p style='margin: 5px 0; word-wrap: break-word; text-align: left; font-family: Inter; padding-left: 10px; width: 130px;'>" . htmlspecialchars($row['nome']) . "</p>";
      
              // Verifica se há um desconto percentual
              if (!empty($row['percentual_desconto'])) {
                  // Calcula o valor do desconto
                  $desconto = $row['preco'] * ($row['percentual_desconto'] / 100);
                  $preco_com_desconto = $row['preco'] - $desconto;
      
                  // Exibe o preço original riscado
                  echo "<p style='text-align:left; font-size: 16px; font-family:Inter; margin-left:7px; color: #777; text-decoration: line-through;'>R$ " . number_format($row['preco'], 2, ',', '.') . "</p>";
      
                  // Exibe o percentual de desconto e o preço com desconto
                  echo "<p style='text-align:left; font-size: 14px; font-family:Inter; margin-left:7px; color: green;'>(" . htmlspecialchars($row['percentual_desconto']) . "% de desconto)</p>";
                  
                  // Exibe o preço final com desconto
                  echo "<p style='text-align:left; font-size: 20px; font-family:Inter; margin-left:7px; color: #0A3871;'><strong>R$ " . number_format($preco_com_desconto, 2, ',', '.') . "</strong></p>";
              } else {
                  // Exibe apenas o preço normal se não houver desconto
                  echo "<p style='text-align:left; font-size: 20px; font-family:Inter; margin-left:7px'><strong>R$ " . number_format($row['preco'], 2, ',', '.') . "</strong></p>";
              }
      
              echo "</a>";
              echo "</div>";
          }
      } else {
          echo "<p>Nenhum resultado encontrado para: " . htmlspecialchars($query) . "</p>";
      }      


        $stmt->close();
    } else {
        // echo "<p>Por favor, insira uma pesquisa.</p>";
    }
    $conn->close();
    ?>
</div>

</div>
      
      <div class="carousel-container">
        <div class="carousel carousel-1">
          <?php
          // Conexão com o banco de dados novamente para exibir produtos filtrados
          include 'C:/xampp/htdocs/expressproject/src/settings/connection.php';

          // Verificação dos filtros aplicados
          if (isset($_GET['minPrice']) || isset($_GET['categoria']) || isset($_GET['frete-gratis']) || isset($_GET['oferta']) || isset($_GET['condicao'])) {
            $frete_gratis = $_GET['frete-gratis'] ?? null;
            $categoria = $_GET['categoria'] ?? null;
            $minPrice = (int)($_GET['minPrice'] ?? 0);
            $maxPrice = (int)($_GET['maxPrice'] ?? 10000);
            $oferta = $_GET['oferta'] ?? null;
            $condicao = $_GET['condicao'] ?? null;

            // Construção da query
            $query = "SELECT f.*, f.url_img FROM produtos f WHERE f.preco BETWEEN ? AND ?";
            $params = [$minPrice, $maxPrice];

            // Adiciona condições baseadas nos filtros
            if ($frete_gratis) {
              $query .= " AND f.frete_gratis = 1";
            }
            if ($categoria) {
              $query .= " AND f.categoria = ?";
              $params[] = $categoria;
            }
            if ($oferta) {
              $query .= " AND f.oferta_do_dia = ?";
              $params[] = $oferta;
            }

            // Prepara a consulta
            $stmt = $conn->prepare($query);
            $stmt->bind_param(str_repeat('i', count($params)), ...$params);
            $stmt->execute();
            $result = $stmt->get_result();
            
            // Exibe os produtos filtrados
            if ($result->num_rows > 0) {
              // Exibe cada resultado como uma imagem com o nome abaixo
              while ($row = $result->fetch_assoc()) {
                  echo "<div class='product-item' style='text-align: center; width: 150px;'>"; // Aumentei a largura do item
                  echo "<a href='individual-product.php?id=" . $row['id'] . "'>";
    
                  // Adiciona um div com fundo branco ao redor da imagem
                  echo "<div style='background-color: white; padding: 10px; display: inline-block; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);'>";
                  echo "<img src='" . htmlspecialchars($row['url_img']) . "' alt='" . htmlspecialchars($row['nome']) . "' class='product-image' style='width: 150px; height: 150px;'>";
                  echo "</div>";
    
                  // Ajusta o estilo do parágrafo
                  echo "<p style='margin: 5px 0; word-wrap: break-word; text-align: left; font-family: Inter; padding-left: 10px; width: 130px;'>" . htmlspecialchars($row['nome']) . "</p>";
                  echo "<p style='text-align:left; font-size: 20px; font-family:Inter; margin-left:7px'><strong>R$ " . number_format($row['preco'], 2, ',', '.') . "</strong></p>";
                  echo "</a>";
                  echo "</div>";
              }
            } else {
              echo "<p>Nenhum resultado encontrado para: " . htmlspecialchars($query) . "</p>";
            }     
    
            $stmt->close();
        } else {
            // echo "<p>Por favor, insira uma pesquisa.</p>";
        }
        $conn->close();
          ?>
        </div>
      </div>
    </article>
  </main>



</body>
</html>
