// productController.js
const Product = require('./productModel');

// Função para criar um novo produto
const createProduct = async (req, res) => {
  const { nome, descricao, preco, categoria, dados_produto, estoque } = req.body;
  const image = req.file ? req.file.path : null; // Obtém o caminho da imagem, se existir

  try {
    const newProduct = await Product.create({
      nome,
      descricao,
      preco,
      categoria,
      dados_produto,
      estoque,
      url_img: image, // Adiciona a URL da imagem ao produto
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

// Exporta as funções do controlador
module.exports = {
  createProduct,
  deleteProduct, // Exporta a função de deletar produto
  // ... outras funções, se houver
};
/*
// Exporta as funções do controlador
module.exports = {
  createProduct, // Certifique-se de que esta função está exportada
  // ... outras funções, se houver
};*/
