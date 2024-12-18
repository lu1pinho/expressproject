<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../view/vendedor/modular/sidebar/sidebar.css">
  <title>Página do Vendedor</title>
  <style>
    @font-face {
      font-family: 'Inter';
      src: url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
      font-display: swap;
    }

    .container {
  margin-left: 280px;
  margin-top: 30px;
}

.container h2 {
  font-family: 'Inter';
  font-weight: normal;
}

.seusprodutos {
  margin-top: 30px;
  margin-left: 12px;
}

/* Definir o layout principal para exibir aside e produtos lado a lado */
.main-layout {
  display: flex;
  flex-direction: row;
  width: 100%;
  height: 100vh;
}

.produtos-container {
  display: flex;
  margin-left: 280px;
  margin-top: -23px;
  flex-wrap: wrap;
  justify-content: space-between;
  gap: 10px;
  /* Reduz o espaçamento entre os produtos */
  padding: 10px;
}

.produto {
  flex: 1 1 180px;
  /* Define um tamanho mínimo para os produtos, ajustando a largura */
  max-width: 200px;
  /* Ajusta a largura máxima para deixar os produtos mais próximos */
  background-color: #f9f9f9;
  border: 1px solid #ddd;
  border-radius: 8px;
  text-align: center;
  padding: 10px;
  cursor: pointer;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

/* Ajuste no hover para o produto */
.produto:hover {
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* Estilos para a imagem dentro de cada produto */
.produto img {
  width: 100%;
  height: auto;
  object-fit: contain;
  /* Garante que a imagem seja exibida corretamente sem cortar */
  border-radius: 8px;
}

/* Estilos para o nome e descrição do produto */
.produto h3 {
  font-size: 1rem;
  color: #18344F;
  margin-top: 0.5rem;
}

.produto p {
  font-size: 0.9rem;
  color: #635a5a;
}

.editar-produto-btn {
  background-color: rgb(10, 56, 113);
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 5px;
  text-decoration: none;
  cursor: pointer;
  margin-top: auto;
}

/*Footer*/

.footer-container {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  gap: 80px;
  padding: 20px;
  height: 250px;
  margin-top: 100px;
  background-color: white;
  color: black;
  border-top: 1px solid #d3d3d3;
}
.footer-container img {
  width: 20px;
  height: 20px;
  object-fit: contain; /* Mantém a proporção da imagem dentro das dimensões */
}

.footer-item2 img {
  width: 200px;
  height: auto;
}

.footer-item {
  display: flex;
  flex-direction: column;
  /* Para empilhar os links verticalmente */
  align-items: flex-start;
  /* Alinha os itens à esquerda */
  height: 150px;
  margin-left: -40px;
}

.footer-item:first-child {
  align-items: center;
  margin-right: 50px;
}

.footer-item h3 {
  font-size: 1rem;
  font-weight: bold;
  margin-bottom: 10px;
}

.footer-item .payments {
  width: 180px;
  margin-right: 10px;
}

.footer-item a {
  text-decoration: none;
  color: black;
  margin: 5px 0;
  transition: all 0.3s;
  font-size: 0.9rem;
  border-bottom: 1px solid transparent;
}

.footer-item a:hover {
  color: orange;
  border-bottom: 1px solid orange;
}

  </style>
</head>

<body>
  <?php include_once 'C:\xampp\htdocs\expressproject\view\vendedor\modular\sidebar\include_sidebar.php'; ?>
  <?php include 'C:\xampp\htdocs\expressproject\settings\connection.php'; ?>

  <div class="container">
    <h2>Que bom te ver, <?php echo $_SESSION['nome']; ?></h2>
    <a class="editar-produto-btn" style="margin-left: 1050px;" href="../control/control_adicionar_produto.php">Adicionar Produto</a>
    <h2 class="seusprodutos">Seus Produtos</h2>
  </div>

  <main>
    <h2>Produtos</h2>
    <div class="produtos-container">
      <?php
      if (count($produtos) > 0) {
        foreach ($produtos as $produto) {
          $imagem_produto = !empty($produto['url_img']) ? CAMINHO_IMAGENS . $produto['url_img'] : CAMINHO_IMAGENS . 'default.png';

          echo '<div class="produto" onclick="window.location.href=\'../control/control-produto-individual.php?id=' . $produto['id'] . '\'">';
          echo '<img src="' . $imagem_produto . '" alt="' . $produto['nome'] . '">';
          echo '<h3>' . $produto['nome'] . '</h3>';
          echo '<p>R$' . number_format($produto['preco'], 2, ',', '.') . '</p>';
          echo '<button class="editar-produto-btn" onclick="event.stopPropagation(); window.location.href=\'../control/control_atualizar-produto.php?id=' . $produto['id'] . '\'">Editar Produto</button>';
          echo '</div>';
        }
      } else {
        echo '<p>Nenhum produto encontrado.</p>';
      }
      ?>
    </div>
  </main>

  <footer>
    <div class="footer-container">
      <div class="footer-item2">
        <img src="../view/images/logo/logopreta.png" alt="Logo Express">
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
        <h3>Siga-nos</h3>
        <a href="#"><img class="svg" src="../view/images/svg/facebook.svg" alt="Facebook"></a>
        <a href="#"><img class="svg" src="../view/images/svg/instagram.svg" alt="Instagram"></a>
        <a href="#"><img class="svg" src="../view/images/svg/twitter.svg" alt="Twitter"></a>
      </div>

    </div>
  </footer>
</body>

</html>