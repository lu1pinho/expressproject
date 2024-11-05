// control/API/productController.js
const Product = require('./productModel');


// Função para listar todos os produtos
const getAllProducts = async (req, res) => {
  try {
    const products = await Product.findAll();
    res.status(200).json(products);
  } catch (error) {
    res.status(500).json({ message: 'Erro ao buscar produtos', error });
  }
};


// Função para obter um produto específico pelo ID
const getProductById = async (req, res) => {
  const { id } = req.params;


  try {
    const product = await Product.findByPk(id);
    if (!product) {
      return res.status(404).json({ message: 'Produto não encontrado' });
    }


    res.status(200).json(product);
  } catch (error) {
    res.status(500).json({ message: 'Erro ao buscar produto', error });
  }
};


// Função para criar um novo produto
const createProduct = async (req, res) => {
  const { nome, descricao, preco, categoria, dados_produto, estoque, url_img, vendedor_id } = req.body;
  
  try {
    const newProduct = await Product.create({
      nome,
      descricao,
      preco,
      categoria,
      dados_produto,
      estoque,
      url_img,
      vendedor_id,
    });
    res.status(201).json(newProduct);
  } catch (error) {
    res.status(500).json({ message: 'Erro ao criar produto', error });
  }
};


// Função para deletar um produto
const deleteProduct = async (req, res) => {
  const { id } = req.params;


  try {
    const product = await Product.findByPk(id);
    if (!product) {
      return res.status(404).json({ message: 'Produto não encontrado' });
    }


    await product.destroy();
    res.status(204).json({ message: 'Produto deletado com sucesso' });
  } catch (error) {
    res.status(500).json({ message: 'Erro ao deletar produto', error });
  }
};


module.exports = {
  getAllProducts,
  getProductById,
  createProduct,
  deleteProduct,
};

