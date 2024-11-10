const { Sequelize } = require('sequelize');
require('dotenv').config(); // Certifique-se de que a biblioteca dotenv está instalada

// Carregar variáveis de ambiente
const servidor = process.env.DB_HOST;
const banco = process.env.DB_NAME;
const usuario = process.env.DB_USER;
const porta = process.env.DB_PORT;
const senha = process.env.DB_PASS;

// Criar a instância do Sequelize
const sequelize = new Sequelize(banco, usuario, senha, {
  host: servidor,
  dialect: 'mysql', // Ou 'postgres', 'sqlite', etc. dependendo do banco de dados que você está usando
  port: porta, // Adicione a porta se necessário
  dialectOptions: {
    charset: 'utf8mb4', // Defina a codificação como utf8mb4
  }
});

// Testar a conexão
sequelize.authenticate()
  .then(() => {
    console.log('Conexão estabelecida com sucesso.');
  })
  .catch(err => {
    console.error('Não foi possível conectar ao banco de dados:', err);
  });

// Exportar a instância de sequelize para uso em outros módulos
module.exports = sequelize;
