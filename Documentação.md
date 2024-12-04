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
   2. Crie um banco de dados novo ou selecione um banco de dados existente.
   3. Vá até a aba **Importar** e selecione o arquivo de importação.
   4. Clique em **Executar** para completar a importação.

Após a importação, o banco de dados estará pronto para ser usado pelo projeto.

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