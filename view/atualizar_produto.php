<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Produto</title>
    <link rel="stylesheet" href="../view/stylesheets/atualizar_produto.css">
    <link rel="stylesheet" href="../view/vendedor/modular/sidebar/sidebar.css">
</head>
<body>
    <aside>
        <?php include_once '../view/vendedor/modular/sidebar/sidebar.php';?>
    </aside>
    <main>
        <section class="produto-form">
            <header>
                <h1>Atualize seu produto e venda muito mais</h1>
                <p>Que tal criar um novo cupom de desconto?</p>
            </header>

            <form action="#">
                <div class="form-group">
                    <label for="nome-produto">Nome do Produto</label>
                    <input type="text" id="nome-produto" name="nome-produto">
                </div>

                <div class="form-group">
                    <label for="descricao-produto">Descrição do Produto</label>
                    <textarea id="descricao-produto" name="descricao-produto" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label for="preco-unitario">Preço Unitário</label>
                    <input type="text" id="preco-unitario" name="preco-unitario">
                </div>

                <div class="form-group">
                    <label for="preco-promocao">Preço em Promoção</label>
                    <input type="text" id="preco-promocao" name="preco-promocao">
                </div>

                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <input type="text" id="categoria" name="categoria">
                </div>

                <div class="form-group">
                    <label for="estoque">Em estoque (Smart Stock)</label>
                    <input type="text" id="estoque" name="estoque">
                </div>

                <div class="form-group">
                    <label for="porcentagem-frete">Porcentagem do Frete</label>
                    <input type="text" id="porcentagem-frete" name="porcentagem-frete">
                </div>

                <fieldset class="outros-ajustes">
                    <legend>Outros ajustes do produto</legend>
                    <div class="checkbox-group">
                        <input type="checkbox" id="frete-gratis" name="frete-gratis" checked>
                        <label for="frete-gratis">Frete Grátis</label>
                    </div>
                </fieldset>

                <div class="form-buttons">
                    <button type="submit" class="atualizar">Atualizar Produto</button>
                    <button type="button" class="excluir">Excluir Produto</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
