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

// Exporta as funções do controlador
module.exports = {
  createProduct, // Certifique-se de que esta função está exportada
  // ... outras funções, se houver
};
