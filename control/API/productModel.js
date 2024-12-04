// control/API/productModel.js
const { DataTypes } = require('sequelize');
const sequelize = require('./connection');

const Product = sequelize.define('Product', {
  id: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true,
  },
  categoria: {
    type: DataTypes.STRING(100),
    allowNull: false,
  },
  dados_produto: {
    type: DataTypes.TEXT,
    allowNull: true, // Ajustado para refletir o esquema da tabela.
  },
  descricao: {
    type: DataTypes.TEXT,
    allowNull: true, // Ajustado para refletir o esquema da tabela.
  },
  estoque: {
    type: DataTypes.INTEGER,
    allowNull: true,
    defaultValue: null,
  },
  frete: {
    type: DataTypes.DECIMAL(10, 2),
    allowNull: true,
    defaultValue: null,
  },
  frete_gratis: {
    type: DataTypes.BOOLEAN,
    allowNull: true,
    defaultValue: false,
  },
  n_vendas: {
    type: DataTypes.INTEGER,
    allowNull: true,
    defaultValue: 0,
  },
  nome: {
    type: DataTypes.STRING(255),
    allowNull: false,
  },
  oferta_do_dia: {
    type: DataTypes.BOOLEAN,
    allowNull: true,
    defaultValue: false,
  },
  percentual_desconto: {
    type: DataTypes.DECIMAL(5, 2),
    allowNull: true,
    defaultValue: null,
  },
  preco: {
    type: DataTypes.DECIMAL(10, 2),
    allowNull: false,
  },
  preco_com_desconto: {
    type: DataTypes.DECIMAL(10, 2),
    allowNull: true,
    defaultValue: null,
  },
  url_img: {
    type: DataTypes.STRING(255),
    allowNull: true,
    defaultValue: null,
  },
  vendedor_id: {
    type: DataTypes.INTEGER,
    allowNull: false,
  },
}, {
  tableName: 'produtos',
  timestamps: false,
});

module.exports = Product;
