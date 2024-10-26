// productModel.js
const { DataTypes } = require('sequelize');
const sequelize = require('./connection'); // Ajuste o caminho conforme necessário

const Product = sequelize.define('Product', {
  nome: {
    type: DataTypes.STRING,
    allowNull: false, // Nome é obrigatório
  },
  descricao: {
    type: DataTypes.STRING,
    allowNull: false, // Descrição é obrigatória
  },
  preco: {
    type: DataTypes.FLOAT,
    allowNull: false, // Preço é obrigatório
  },
  categoria: {
    type: DataTypes.STRING,
    allowNull: false, // Categoria é obrigatória
  },
  dados_produto: {
    type: DataTypes.TEXT,
    allowNull: false, // Dados  é obrigatório
  },
  estoque: {
    type: DataTypes.INTEGER,
    allowNull: false, // Estoque é obrigatório
    defaultValue: 0, // Valor padrão para estoque
  },
  url_img: {
    type: DataTypes.STRING, // URL ou caminho da imagem
    allowNull: false, // n obrigatória
  },
}, {
  tableName: 'produtos', // Nome da tabela existente
  timestamps: false, // Adiciona campos de criação e atualização automáticos
});

// Sincroniza o modelo com o banco de dados (opcional, use com cuidado em produção)
(async () => {
 // await Product.sync();
})();

module.exports = Product;
