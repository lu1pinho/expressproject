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
  <script src="script-pag-principal/script-slider.js" defer ></script>
  <script src="script-pag-principal/script2.js" defer></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <div class="navbar" >
      <div class="logo" >
        <img class="logo1" src="images/logo.png" alt="carrinho">
      </div>
      <div class="location" >
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
  
<!--carrossel de imagens-->
  <div class="container-slider" >
    <button id="prev-button"><img src="images/arrow_back_ios_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg" alt="prev-button"></button>
    <div class="container-images" onclick="iphonePage()">
      <img src="poster/SOON.png" alt="banner" class="slider on">
      <img src="poster/SOON (2).png" alt="banner" class="slider" >
    </div>
    <button id="next-button"><img src="images/arrow_forward_ios_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg" alt="next-button"></button>
  </div>
<!--Ofertas do dia-->
<div class="sem-margem" >
  <div class="lista-ofertas" >
    <p><b>Ofertas do Dia</b></p>
    <a href="ofertas-do-dia.php">Ver Mais Ofertas</a>
  </div>
  <button id="prev-button2"><img src="images/arrow_back_ios_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg" alt="prev-button2"></button>
  <div class="images-lista-ofertas" id="images-lista-ofertas">
  <img class="offer-image on" src="imgs-ofertas/mouse.jpeg" alt="mouse 1">
  <img class="offer-image" src="images/Batedeira .jpg" alt="mouse 3">
  <img class="offer-image" src="images/Bicicleta Ergométrica.jpg" alt="mouse 4">
  <img class="offer-image" src="images/Caiu Perdeu.jpg" alt="mouse 5">
  <img class="offer-image" src="images/caneta.jpg" alt="mouse 6">
  <img class="offer-image" src="images/celular-samsung .jpg" alt="mouse 8">
  <img class="offer-image" src="images/Churrasqueira a Carvão.jpg" alt="mouse 9">
  <img class="offer-image" src="images/Colchão Ortopédico.jpg" alt="mouse 10">
  <img class="offer-image" src="images/Conjunto de Panelas.jpg" alt="mouse 11">
  </div>
  <button id="next-button2"><img src="images/arrow_forward_ios_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg" alt="next-button2"></button>
</div>

<!--categorias-->
<div class="categorias">
  <div>
    <p><b>Navegue pelas Categorias</b></p>
  </div>
  <div class="img-categoria" id="img-categoria">
    <a href="produtos.php?categoria=perifericos">
      <img class="category-image on" src="imgs-categoria/perifericos-com-fundo (1).png" alt="periféricos">
    </a>
    <a href="produtos.php?categoria=acessorios">
      <img class="category-image" src="imgs-categoria/mouse com fundo.png" alt="acessórios">
    </a>
    <a href="produtos.php?categoria=celular">
      <img class="category-image" src="imgs-categoria/celular-com-fundo (1).png" alt="celular">
    </a>
    <a href="produtos.php?categoria=drones">
      <img class="category-image" src="imgs-categoria/drone-com-fundo (2).png" alt="drones">
    </a>
    <a href="produtos.php?categoria=placa_de_video">
      <img class="category-image" src="imgs-categoria/placa-de-video-com-fundo.png" alt="placa de vídeo">
    </a>
    <a href="produtos.php?categoria=rede">
      <img class="category-image" src="imgs-categoria/roteador-com-fundo.png" alt="rede">
    </a>
    <a href="produtos.php?categoria=ssd">
      <img class="category-image" src="imgs-categoria/ssd-com-fundo.png" alt="ssd">
    </a>
    <a href="produtos.php?categoria=monitor">
      <img class="category-image" src="imgs-categoria/tv-com-fundo (2).png" alt="monitor">
    </a>
  </div>
</div>

<!-- Recomendações -->
<div class="identacao-recomendacao">
  <div class="lista-recomendacoes">
    <p><b>Recomendações</b></p>
    <a href="#">Ver Mais Recomendações</a>
  </div>
  <button id="prev-button3"><img src="images/arrow_back_ios_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg" alt="prev-button3"></button>
  <div class="images-lista-recomendacoes" id="images-lista-recomendacoes">
  <img class="offer-image on" src="imgs-ofertas/mouse.jpeg" alt="mouse 1">
  <img class="offer-image" src="images/Batedeira .jpg" alt="mouse 3">
  <img class="offer-image" src="images/Bicicleta Ergométrica.jpg" alt="mouse 4">
  <img class="offer-image" src="images/Caiu Perdeu.jpg" alt="mouse 5">
  <img class="offer-image" src="images/caneta.jpg" alt="mouse 6">
  <img class="offer-image" src="images/celular-samsung .jpg" alt="mouse 8">
  <img class="offer-image" src="images/Churrasqueira a Carvão.jpg" alt="mouse 9">
  <img class="offer-image" src="images/Colchão Ortopédico.jpg" alt="mouse 10">
  <img class="offer-image" src="images/Conjunto de Panelas.jpg" alt="mouse 11">
  </div>
  <button id="next-button3"><img src="images/arrow_forward_ios_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg" alt="next-button3"></button>
</div>
<!--Mais Vendidos-->
<div class="identacao-vendidos" >
  <div>
    <p><b>Mais Vendidos</b></p>
  </div>
  <button id="prev-button4"><img src="images/arrow_back_ios_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg" alt="prev-button4"></button>
  <div class="images-lista-vendidos" id="images-lista-vendidos">
  <img class="offer-image on" src="imgs-ofertas/mouse.jpeg" alt="mouse 1">
  <img class="offer-image" src="images/Batedeira .jpg" alt="mouse 3">
  <img class="offer-image" src="images/Bicicleta Ergométrica.jpg" alt="mouse 4">
  <img class="offer-image" src="images/Caiu Perdeu.jpg" alt="mouse 5">
  <img class="offer-image" src="images/caneta.jpg" alt="mouse 6">
  <img class="offer-image" src="images/celular-samsung .jpg" alt="mouse 8">
  <img class="offer-image" src="images/Churrasqueira a Carvão.jpg" alt="mouse 9">
  <img class="offer-image" src="images/Colchão Ortopédico.jpg" alt="mouse 10">
  <img class="offer-image" src="images/Conjunto de Panelas.jpg" alt="mouse 11">
  </div>
  <button id="next-button4"><img src="images/arrow_forward_ios_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg" alt="next-button4"></button>
</div>
<!--Produtos que talvez vc goste-->
<div class="identacao-talvez" >
  <div>
    <p><b>Produtos que talvez você goste</b></p>
  </div>
  <button id="prev-button5"><img src="images/arrow_back_ios_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg" alt="prev-button5"></button>
  <div class="images-talvez-goste" id="images-talvez-goste" >
  <img class="offer-image on" src="imgs-ofertas/mouse.jpeg" alt="mouse 1">
  <img class="offer-image" src="images/Batedeira .jpg" alt="mouse 3">
  <img class="offer-image" src="images/Bicicleta Ergométrica.jpg" alt="mouse 4">
  <img class="offer-image" src="images/Caiu Perdeu.jpg" alt="mouse 5">
  <img class="offer-image" src="images/caneta.jpg" alt="mouse 6">
  <img class="offer-image" src="images/celular-samsung .jpg" alt="mouse 8">
  <img class="offer-image" src="images/Churrasqueira a Carvão.jpg" alt="mouse 9">
  <img class="offer-image" src="images/Colchão Ortopédico.jpg" alt="mouse 10">
  <img class="offer-image" src="images/Conjunto de Panelas.jpg" alt="mouse 11">    
  </div>
  <button id="next-button5"><img src="images/arrow_forward_ios_24dp_000000_FILL0_wght400_GRAD0_opsz24.svg" alt="next-button5"></button>
</div>

<div class="lado-a-lado2" >
  <div class="quadrado" >
    <p>Menos de R$100</p>
  <div class="lado-a-lado" >
    <div>
      <img src="imgs-ofertas/mouse.jpeg" alt="teste">
    </div>
    <div>
      <img src="imgs-ofertas/mouse.jpeg" alt="teste">
    </div>
  </div>
    <div class="lado-a-lado" >
      <div>
        <img src="imgs-ofertas/mouse.jpeg" alt="teste">
      </div>
      <div>
        <img src="imgs-ofertas/mouse.jpeg" alt="teste">
      </div>
    </div>
  </div>

  <div class="quadrado" >
    <p>Menos de R$100</p>
  <div class="lado-a-lado" >
    <div>
      <img src="imgs-ofertas/mouse.jpeg" alt="teste">
    </div>
    <div>
      <img src="imgs-ofertas/mouse.jpeg" alt="teste">
    </div>
  </div>
    <div class="lado-a-lado" >
      <div>
        <img src="imgs-ofertas/mouse.jpeg" alt="teste">
      </div>
      <div>
        <img src="imgs-ofertas/mouse.jpeg" alt="teste">
      </div>
    </div>
  </div>

  <div class="quadrado" >
    <p>Menos de R$100</p>
  <div class="lado-a-lado" >
    <div>
      <img src="imgs-ofertas/mouse.jpeg" alt="teste">
    </div>
    <div>
      <img src="imgs-ofertas/mouse.jpeg" alt="teste">
    </div>
  </div>
    <div class="lado-a-lado" >
      <div>
        <img src="imgs-ofertas/mouse.jpeg" alt="teste">
      </div>
      <div>
        <img src="imgs-ofertas/mouse.jpeg" alt="teste">
      </div>
    </div>
  </div>

  <div class="quadrado" >
    <p>Menos de R$100</p>
  <div class="lado-a-lado" >
    <div>
      <img src="imgs-ofertas/mouse.jpeg" alt="teste">
    </div>
    <div>
      <img src="imgs-ofertas/mouse.jpeg" alt="teste">
    </div>
  </div>
    <div class="lado-a-lado" >
      <div>
        <img src="imgs-ofertas/mouse.jpeg" alt="teste">
      </div>
      <div>
        <img src="imgs-ofertas/mouse.jpeg" alt="teste">
      </div>
    </div>
  </div>
</div>

<div class="identacao-historico" >
  <div class="infor-historico" >
    <p><b>Seu histórico de navegação</b></p>
    <a href="#">Editar ou exibir histórico</a>
  </div>
  <div class="img-historico" >
    <img class="recommendation-image" src="imgs-ofertas/mouse.jpeg" alt="mouse 18">
    <img class="recommendation-image" src="imgs-ofertas/mouse.jpeg" alt="mouse 19">
    <img class="recommendation-image" src="imgs-ofertas/mouse.jpeg" alt="mouse 20">
  </div>
</div>
<!--rodapé-->
<div class="rodape" >
  <div class="redes-sociais" >
    <img src="images/Captura de tela 2024-09-24 111459.png" alt="redes sociais">
  </div>
  <div class="navegacao" >
    <p><b>Navegação</b></p>
    <a href="#">Página Principal</a>
    <a href="#">Faturamento</a>
    <a href="#">Meus Produtos</a>
    <a href="#">Configurações</a>
  </div>
  <div class="navegacao" >
    <p><b>Sobre a Express</b></p>
    <a href="#">Quem somos?</a>
    <a href="#">Como vender na Express?</a>
  </div>
  <div class="navegacao" >
    <p><b>Tópicos Frequentes</b></p>
    <a href="#">Taxas</a>
    <a href="#">Condições e Formas de Pagamento</a>
    <a href="#">Envio de Produtos</a>
    <a href="#">Suporte Online</a>
    <a href="#">Trabalhe na Express</a>
  </div>
</div>
</body>
</html>   