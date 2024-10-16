<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Express.com</title>
    <link rel="stylesheet" href="../view/adicionar_produto.css">
</head>

<body>
    <div class="apresentacao">
    <form class="caixa_fundo" method="POST" action="../control/control_adicionar_produto.php" enctype="multipart/form-data">
        <h1 class="titulo">Adicionar um produto</h1>
            <p class="psub">Adicione um novo produto e venda mais.</p>
        
            <div class="sub">
                <label for="name" class="campos">Nome do produto:</label>
                <input type="text" id="name" name="name" class="bordas1" required>

                <label for="descricao" class="campos">Descrição:</label>
                <input type="text" id="descricao" name="descricao" class="bordas2" required>
            </div>
        <div class="dados">    
            <div class="sub">
                <label for="preco" class="campos">Preço:</label>
                <input type="text" id="preco" name="preco" class="bordas" required>

                <label for="estoque" class="campos">Em estoque:</label>
                <input type="text" id="estoque" name="estoque" class="bordas" required>

                <label for="category" class="campos">Categoria:</label>
                <select id="category" name="category" class="bordas" required>
                    <option value="">Escolha</option>
                    <option value="eletronico">Eletrônico</option>
                    <option value="informatica">Informática</option>
                    <option value="smartphone">Smartphone</option>
                    <option value="audio">Áudio</option>
                    <option value="televisor">Televisor</option>
                    <option value="tablet">Tablet</option>
                    <option value="game">Game</option>
                </select>
            </div>

            <div class="sub">
                <label for="promocao" class="campos">Preço em promoção:</label>
                <input type="text" id="promocao" name="promocao" class="bordas" required>

                <label for="frete" class="campos">Porcentagem do frete:</label>
                <input type="text" id="frete" name="frete" class="bordas" required>

                <label for="dados_produto" class="campos">Dados do produto:</label>
                <input type="text" id="dados_produto" name="dados_produto" class="bordas" required>
            </div>
        </div>    
            <label for="imagem" class="campos">Imagem:</label>
                <div class="imagem" id="imagem">
                    <p>Carregue uma imagem</p>
                </div>
            <input type="file" name="imagem" name="imagem" accept="image/*" onchange="previewImage(this)">

            <div class="centro">
                <button type="submit" class="botoes">Cadastrar produto</button>
            </div>
        </form>
    

        </div>
            
    <hr class="hr">

</body>
</html>