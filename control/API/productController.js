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


// Função para atualizar um produto
const updateProduct = async (req, res) => {
  const { id } = req.params;
  const { nome, descricao, preco, preco_com_desconto, frete_gratis, categoria, oferta_do_dia, dados_produto, estoque, frete } = req.body;

  try {
    // Busca o produto pelo ID e garante que o vendedor_id e a url_img não serão alterados
    const product = await Product.findByPk(id);
    if (!product) {
      return res.status(404).json({ message: 'Produto não encontrado' });
    }

    // Atualiza o produto, excluindo vendedor_id e url_img do update
    await product.update({
      nome,
      descricao,
      preco,
      preco_com_desconto,
      frete_gratis,
      categoria,
      oferta_do_dia,
      dados_produto,
      estoque,
      frete,
    });

    res.status(200).json({ message: 'Produto atualizado com sucesso', product });
  } catch (error) {
    res.status(500).json({ message: 'Erro ao atualizar produto', error });
  }
};


module.exports = {
  getAllProducts,
  getProductById,
  createProduct,
  deleteProduct,
  updateProduct,  // Exportando a nova função
};

