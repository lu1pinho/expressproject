<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="../stylesheets/individual-product.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <script src="../script/script.js" defer></script>
    <!-- Imports -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div class="navbar">
        <div class="logo">
            <img src="images/logo.png" alt="Logotipo Express Marketplace" width="150">
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

<main>
    <article>
        <div class="left"></div>

        <div class="right">
            <div class="product">
                <h2>WAP Parafusadeira E Furadeira A Bateria Li-Ion 12V Bpf 12K3</h2>
                <div class="pricing-container">
                    <div class="pricing">
                        <p class="old_price">R$ 349,90</p>
                        <p class="actual_price">R$ 218,91</p>
                        <p class="installment">em até 4x sem juros.</p>
                    </div>
                    <div class="vertical-line"></div>
                    <div class="discount">
                        <p class="discount-price">37% de desconto</p>
                        <p>comprando agora!</p>
                    </div>
                </div>
                <div class="minimal-description">
                    <p>Dados do Produto</p>
                    <ul>
                        <li>Marca: WAP</li>
                        <li>Fonte de Alimentação: Não Aplicável</li>
                        <li>Velocidade Máxima de Rotação: 740 RPM</li>
                        <li>Tensão: 110 Volts, 220 Volts</li>
                    </ul>
                </div>
                <div class="action-buttons">
                    <button class="buynow btn-final">Compre Agora</button>
                    <button class="addtocart btn-cart">Adicionar ao Carrinho</button>
                </div>
            </div>
        </div>
    </article>
    <section>
        <div class="description">
            <p class="description-text">Descrição do Produto</p>
            <hr>
            <p>
                A Parafusadeira e Furadeira 12V BPF 12K3 é a solução ideal para quem busca praticidade e eficiência em tarefas manuais.
                Compacta e robusta, é perfeita para pequenas reformas e manutenções domésticas. Seu design exclusivo da WAP e bateria de
                tecnologia lítio (Li-Íon) garantem mobilidade e maior vida útil. O produto é bivolt, conta com bateria recarregável e possui
                um LED indicativo do nível de carga, facilitando o uso em qualquer momento.
            </p>
            <p>
                Para apertar ou soltar parafusos, a ferramenta conta com um seletor de reverso, ajustando o sentido de rotação conforme a necessidade.
                Com 18 níveis de torque e 1 nível exclusivo para perfuração, oferece controle total para os mais variados trabalhos. A velocidade
                ajustável pelo gatilho garante mais precisão, produtividade e economia de tempo.
            </p>
            <p>
                A Parafusadeira e Furadeira 12V BPF 12K3 vem acompanhada de uma maleta com acessórios, oferecendo praticidade no transporte e
                armazenamento. Seu design ergonômico e o LED embutido garantem conforto e maior visibilidade em áreas de difícil acesso.
            </p>
        </div>
    </section>

    <section>
        <p class="tx-25 pd-top-bottom">Produtos Recomendados</p>
        <div class="container">
            <div class="card">
                <div class="imgbg">Imagem</div>
                <p>Produto 1</p>
                <p class="price">R$ 0,00</p>
            </div>
            <div class="card">
                <div class="imgbg">Imagem</div>
                <p>Produto 2</p>
                <p class="price">R$ 0,00</p>
            </div>
            <div class="card">
                <div class="imgbg">Imagem</div>
                <p>Produto 3</p>
                <p class="price">R$ 0,00</p>
            </div><div class="card">
                <div class="imgbg">Imagem</div>
                <p>Produto 3</p>
                <p class="price">R$ 0,00</p>
            </div>
        </div>
    </section>
</main>

<footer>
    <div id="containerFooter">
        <div class="flogo">
            <img src="images/logo.png" alt="Logotipo Express Marketplace" width="150">
        </div>
        <div id="webFooter">
            <h3> Express </h3>
            <p> Quem somos? </p>
            <p> Nossos Contatos </p>
            <p> Acessibilidade </p>
            <p> Suporte </p>
        </div>
        <div id="webFooter">
            <h3> Pagamento </h3>
            <p> Meios de Pagamento </p>
            <p> Cartão de Crédito</p>
            <p> Compras com Pix</p>
        </div>
    </div>
</footer>

</body>
</html>
