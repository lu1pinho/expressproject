# Documentação - Express Project

## Introdução

Bem-vindo ao **Express Project**! Essa documentação foi feita para guiar você em todos os passos necessários para configurar o projeto em seu ambiente local pela primeira vez. Se você já é um desenvolvedor familiarizado com essas ferramentas, isso deve ser bem direto. Se precisar de alguma ajuda ou tiver dúvidas durante o processo, consulte cada etapa cuidadosamente.

---

## Pré-requisitos

Antes de começar a configurar o projeto, verifique se você tem as seguintes ferramentas instaladas:

1. **XAMPP** – Usado para rodar o Apache, MySQL e PHP em sua máquina local.
2. **Node.js** – Plataforma JavaScript para rodar o servidor do backend.
3. **Git** – Para clonar o repositório do projeto.

---

## Passo 1: Instalar o XAMPP

O **XAMPP** é a primeira ferramenta que você precisa configurar. Ele é um pacote que inclui o Apache, MySQL e PHP. Aqui está o processo para instalar:

1. **Baixar o XAMPP**:
   - Acesse [o site oficial do XAMPP](https://www.apachefriends.org/index.html) e baixe a versão apropriada para o seu sistema operacional (Windows, macOS ou Linux).

2. **Instalar o XAMPP**:
   - Execute o instalador baixado como administrador.
   - Selecione os componentes que deseja instalar. Para este projeto, certifique-se de que **Apache**, **MySQL**, **PHP** e **phpMyAdmin** estejam selecionados.
   - Escolha o diretório de instalação. O padrão no Windows é `C:\xampp`.

3. **Configurar o XAMPP**:
   - Abra o painel de controle do XAMPP.
   - Inicie os serviços **Apache** e **MySQL**.
   - Abra o navegador e acesse [http://localhost](http://localhost). Se você vir a página de boas-vindas do XAMPP, isso significa que a instalação foi bem-sucedida.

---

## Passo 2: Criar o Banco de Dados MySQL

O próximo passo é importar o banco de dados necessário para o projeto. Ele contém todas as tabelas e dados essenciais para o funcionamento do sistema.

1. **Localizar o Arquivo de Importação**:
   - Dentro da pasta do seu projeto, você encontrará uma pasta chamada **"Modelo Banco de Dados"**. O arquivo dentro dessa pasta contém o script para criar a estrutura do banco de dados.

2. **Importar o Banco de Dados**:
   Você pode usar qualquer cliente de banco de dados, como **MySQL Workbench** ou **phpMyAdmin**. Aqui estão os passos para cada um:

   ### Usando o MySQL Workbench:
   1. Abra o **MySQL Workbench**.
   2. No menu superior, clique em **File** e selecione **Open SQL Script**.
   3. Navegue até a pasta do seu projeto, abra a pasta **"Modelo Banco de Dados"** e selecione o arquivo de importação.
   4. Clique em **Open** e depois em **Execute** para rodar o script e criar o banco de dados.

   ### Usando o phpMyAdmin:
   1. Abra o **phpMyAdmin** no seu navegador.
   2. Crie um banco de dados novo.
   3. Use os comandos abaixo para criar as tabelas:

```
CREATE TABLE carrinho (
    id_user INT UNSIGNED NOT NULL,
    produto_nome VARCHAR(255) NOT NULL,
    url_img VARCHAR(255),
    preco DECIMAL(10,2) NOT NULL,
    preco_com_desconto DECIMAL(10,2),
    quantidade INT NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    id INT NOT NULL
);
```

```
CREATE TABLE cartoes (
    apelido VARCHAR(255) NOT NULL,
    id_user INT UNSIGNED NOT NULL,
    categoria_cartao VARCHAR(255) NOT NULL,
    cvv INT NOT NULL,
    dt_expedicao VARCHAR(255) NOT NULL,
    numero_cartao VARCHAR(255) NOT NULL,
    nome_cartao VARCHAR(255) NOT NULL,
    id_cartao INT UNSIGNED NOT NULL
);
```
```
CREATE TABLE enderecos (
    endereco VARCHAR(255) NOT NULL,
    id_user INT UNSIGNED NOT NULL,
    estado VARCHAR(255) NOT NULL,
    cidade VARCHAR(255) NOT NULL,
    cep VARCHAR(10) NOT NULL,
    numero INT NOT NULL,
    complemento VARCHAR(255),
    bairro VARCHAR(255) NOT NULL,
    id_end INT UNSIGNED NOT NULL
);
```
```
CREATE TABLE frete (
    id INT NOT NULL,
    cep VARCHAR(255) NOT NULL,
    valor DECIMAL(10,2) NOT NULL
);
```
```
CREATE TABLE produtos (
    descricao TEXT,
    vendedor_id INT NOT NULL,
    url_img VARCHAR(255),
    preco_com_desconto DECIMAL(10,2),
    preco DECIMAL(10,2) NOT NULL,
    percentual_desconto DECIMAL(5,2),
    oferta_do_dia TINYINT(1),
    nome VARCHAR(255) NOT NULL,
    frete_gratis TINYINT(1),
    frete DECIMAL(10,2),
    estoque INT,
    dados_produto TEXT,
    categoria VARCHAR(255) NOT NULL,
    id INT NOT NULL,
    n_vendas INT
);
```
```
CREATE TABLE produtos_comprados (
    produto_nome VARCHAR(255),
    codigo VARCHAR(255),
    id_vendedor INT,
    id_produto INT NOT NULL,
    preco_com_desconto VARCHAR(255),
    data_compra DATETIME NOT NULL,
    url_img VARCHAR(255),
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT NOT NULL,
    id_user INT UNSIGNED NOT NULL,
    id INT NOT NULL
);
```
```

CREATE TABLE users (
    id INT UNSIGNED NOT NULL,
    nome VARCHAR(255),
    email VARCHAR(255),
    senha VARCHAR(255),
    telefone VARCHAR(255),
    categoria VARCHAR(255),
    genero VARCHAR(255),
    cpf VARCHAR(14),
    dt_nascimento VARCHAR(255)
);
```
   4. Clique em **Executar** para criar as tabelas. 

Lembre-se que você terá que ajustar os dados de conexão nos arquivos de conexão: connection.js e connection.php
Após isso, o banco de dados estará pronto para ser usado pelo projeto.

### No final da documentação você encontrará alguns comandos SQL para adicionar dados no banco.
---

## Passo 3: Clonar o Repositório

Agora que o banco de dados está configurado, o próximo passo é clonar o repositório do GitHub para obter todos os arquivos do projeto.

1. **Instalar o Git**:
   - Certifique-se de que o **Git** esteja instalado em sua máquina. Caso não tenha, baixe e instale o Git [aqui](https://git-scm.com/).

2. **Clonar o Repositório**:
   - Abra o terminal ou prompt de comando.
   - Navegue até a pasta **htdocs** dentro do diretório de instalação do XAMPP. Por exemplo:
     ```bash
     cd /caminho/para/o/diretorio/htdocs
     ```
   - Execute o seguinte comando para clonar o repositório:
     ```bash
     git clone https://github.com/lu1pinho/expressproject.git
     ```

Isso criará uma pasta chamada **expressproject** dentro de **htdocs**, com todos os arquivos do projeto.

---

## Passo 4: Configurar o Ambiente

Agora que o projeto foi clonado, você precisará configurar as variáveis de ambiente para conectar o Node.js ao banco de dados.

1. **Criar o arquivo `.env`**:
   - Na raiz do projeto, crie um arquivo chamado `.env`. Este arquivo será usado para armazenar informações sensíveis, como as credenciais do banco de dados.

2. **Configurações no `.env`**:
   Dentro do arquivo `.env`, adicione as seguintes variáveis de ambiente, ajustando os valores conforme necessário:

   ```env
   DB_HOST=localhost
   DB_NAME=nome_do_banco
   DB_USER=usuario
   DB_PASS=senha
   DB_PORT=3306

## Passo 5: Instalar Dependências

Agora, vamos instalar as dependências PHP e Node.js necessárias para o projeto.

1. **Instalar as dependências do PHP**:
   - Abra o terminal e navegue até a pasta do projeto clonada.
   - Execute o seguinte comando para instalar as dependências PHP usando o Composer:
     ```bash
     composer install
     ```

2. **Instalar as dependências do Node.js**:
   - No mesmo terminal, execute o comando a seguir para instalar as dependências JavaScript via npm:
     ```bash
     npm install
     ```

---

## Passo 6: Rodar o Servidor

Com todas as dependências instaladas, você pode rodar o servidor do Node.js para iniciar o projeto.

1. Execute o seguinte comando no terminal para iniciar o servidor:
   ```bash
   node index.js

## Passo 7: Acessar o Projeto no Navegador

Agora que o servidor está rodando, você pode acessar o projeto diretamente no navegador. Para isso, siga os seguintes passos:

1. **Abrir o Navegador**:
   - Abra o navegador de sua preferência (Google Chrome, Firefox, etc.).

2. **Acessar a URL do Projeto**:
   - Na barra de endereços do navegador, digite o seguinte endereço:

`http://localhost/expressproject/control/control_pagina-principal.php`

Este é o endereço da página principal do projeto.

3. **Verificar se o Projeto Carregou Corretamente**:
- Ao acessar a URL, a página principal do seu projeto Express deverá ser exibida.
- Caso a página não carregue corretamente, verifique se o servidor Node.js está rodando (você deve ter executado o comando `node index.js` anteriormente). Além disso, certifique-se de que o XAMPP (ou outro servidor de banco de dados) esteja ativo, com os serviços Apache e MySQL iniciados.

Agora você está pronto para começar a trabalhar com o projeto, realizar alterações e desenvolver novas funcionalidades!


### Produtos:

``` 
insert into `produtos` (`categoria`, `dados_produto`, `descricao`, `estoque`, `frete`, `frete_gratis`, `id`, `n_vendas`, `nome`, `oferta_do_dia`, `percentual_desconto`, `preco`, `preco_com_desconto`, `url_img`, `vendedor_id`) values ('Tablet', '### Marca: Apple\n**Modelo**: iPad Air, 64GB, Cinza Espacial\n**Características**: Chip A14 Bionic, Tela Liquid Retina de 10.9 polegadas, Suporte ao Apple Pencil e Magic Keyboard', 'O iPad Air da Apple com 64GB é um tablet versátil que combina desempenho e portabilidade. Equipado com o chip A14 Bionic, ele proporciona desempenho rápido e eficiente para multitarefas, jogos e aplicativos criativos. A tela Liquid Retina de 10.9 polegadas oferece cores vivas e detalhes nítidos, ideal para trabalho e entretenimento. Com suporte ao Apple Pencil e ao Magic Keyboard, o iPad Air se transforma em uma ferramenta poderosa para profissionais e estudantes.', 35, NULL, 1, 5, 220, 'Apple iPad Air', 0, '12.00', '6999.00', '6159.12', 'ipadair.jpg', 5), ('Eletrodomesticos', '### Marca: Arno\n**Modelo**: Ventilador Turbo Silence, 40cm, Preto\n**Características**: Diâmetro de 40cm, 3 velocidades, Tecnologia Turbo Silence', 'O ventilador Arno Turbo Silence de 40cm é perfeito para manter a casa fresca e confortável. Com três velocidades ajustáveis, ele oferece ventilação potente e silenciosa. A tecnologia Turbo Silence garante um desempenho eficiente sem incomodar com ruídos. Seu design moderno e compacto facilita o transporte e a instalação em qualquer ambiente. Ideal para salas, quartos e escritórios, este ventilador combina funcionalidade e elegância.', 30, NULL, 0, 9, 120, 'Arno Ventilador Turbo Silence', 1, '15.00', '299.00', '254.15', 'arnovent.jpg', 9), ('Eletrodomesticos', '### Marca: Brastemp\n**Modelo**: Micro-ondas 32L, Inox\n**Características**: Capacidade de 32 litros, Painel digital, 10 níveis de potência', 'O micro-ondas Brastemp de 32 litros oferece praticidade e eficiência na cozinha. Com um painel digital intuitivo e 10 níveis de potência, ele facilita o preparo de diferentes tipos de alimentos. A função de descongelamento rápido permite preparar refeições em menos tempo. O design moderno em inox adiciona um toque de elegância à sua cozinha. Ideal para famílias que buscam um eletrodoméstico funcional e estético.', 25, NULL, 0, 12, 180, 'Brastemp Micro-ondas 32L', 0, '12.00', '899.00', '791.12', 'microondasbrastemp.webp', 12), ('Audio', '### Marca: JBL\n**Modelo**: Flip 5, Verde\n**Características**: Som estéreo, Resistente à água (IPX7), Bateria de 12 horas', 'A JBL Flip 5 é uma caixa de som Bluetooth portátil que oferece som estéreo de alta qualidade. Resistente à água com classificação IPX7, ela é perfeita para uso ao ar livre, como na piscina ou na praia. Com uma bateria que proporciona até 12 horas de reprodução, você pode curtir suas músicas favoritas o dia todo. A conectividade Bluetooth facilita o emparelhamento com seus dispositivos móveis. Com um design compacto e robusto, a Flip 5 é a companheira ideal para qualquer aventura.', 30, NULL, 1, 13, 160, 'JBL Flip 5', 0, '10.00', '599.00', '539.10', 'flip5.webp', 29), ('Notebook', '### Marca: Apple\n**Modelo**: MacBook Pro 13\", M1, 8GB RAM\n**Características**: Chip M1, 8GB de RAM, 256GB SSD', 'O MacBook Pro 13\" da Apple com chip M1 redefine o desempenho e a eficiência dos laptops. Equipado com o poderoso chip M1, ele oferece velocidade e eficiência excepcionais para tarefas diárias e profissionais. Com 8GB de RAM e 256GB de armazenamento SSD, o MacBook Pro é rápido e responsivo. A tela Retina de 13.3 polegadas proporciona cores vibrantes e detalhes nítidos. A longa duração da bateria garante até 20 horas de uso contínuo, perfeito para quem está sempre em movimento. Além disso, seu design fino e leve torna-o fácil de transportar para qualquer lugar.', 25, NULL, 0, 15, 200, 'Apple MacBook Pro 13\"', 0, '5.00', '12499.00', '11874.05', 'macbookpro13.png', 29), ('Smartphone', '### Marca: Samsung\n**Modelo**: Galaxy S21, 128GB, Phantom Gray\n**Características**: Tela AMOLED de 6.2\", Processador Exynos 2100, Câmera tripla de 64MP', 'O Samsung Galaxy S21 é um smartphone de alto desempenho que oferece uma experiência completa. Com uma tela AMOLED de 6.2 polegadas, ele proporciona cores vibrantes e nitidez excepcional. Equipado com um processador Exynos 2100 e 128GB de armazenamento, ele garante velocidade e espaço para todas as suas necessidades. A câmera tripla de 64MP captura fotos incríveis, mesmo em condições de pouca luz. Além disso, a bateria de longa duração e o design elegante fazem do Galaxy S21 uma escolha excelente para quem busca inovação e estilo.', 40, NULL, 1, 16, 220, 'Samsung Galaxy S21', 0, '10.00', '5999.00', '5399.10', 's21.webp', 29)
```

### Usuários:

```
insert into `users` (`categoria`, `cpf`, `dt_nascimento`, `email`, `genero`, `id`, `nome`, `senha`, `telefone`) values ('fornecedor', '99999999999', '02/02/2000', 'zedafeira@gmail.com', 'Masculino', 29, 'Zezinho da Feira', '12345678', '63999999999')
```

```
insert into `users` (`categoria`, `cpf`, `dt_nascimento`, `email`, `genero`, `id`, `nome`, `senha`, `telefone`) values ('cliente', '99999999991', '01/01/2001', 'ritinhadavila@gmail.com', 'Masculino', 30, 'Ritinha da Vila', '12345678', '63999999991')
```


