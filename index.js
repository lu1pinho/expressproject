// Importa as dependências necessárias
const express = require('express');
const sequelize = require('./control/API/connection'); // Importa a conexão com o MySQL
const productRoutes = require('./control/API/productRoutes'); // Ajuste o caminho conforme necessário

const app = express();

// Middleware para parsing de JSON
app.use(express.json());

// Usar as rotas de produtos
app.use('/api/products', productRoutes);

// Testar a conexão com o banco de dados
sequelize.authenticate()
    .then(() => console.log('Conexão com o MySQL foi bem-sucedida!'))
    .catch(err => console.error('Não foi possível conectar ao MySQL:', err));

// Inicia o servidor
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Servidor rodando na porta ${PORT}`);
});
