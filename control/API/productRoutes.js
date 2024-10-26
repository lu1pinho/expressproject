// Importa o Router do Express
const express = require('express');
const multer = require('multer');
const router = express.Router();

// Importa o controller de produtos
const productController = require('./productController');

// Define as rotas para os produtos

// Rota para listar todos os produtos
/*router.get('/', productController.getAllProducts);

// Rota para obter um produto específico pelo ID
router.get('/:id', productController.getProductById);*/

// Configuração do multer para armazenar arquivos
const storage = multer.diskStorage({
    destination: (req, file, cb) => {
      cb(null, 'C:/xampp/htdocs/expressproject/control/API/uploads'); // Pasta onde as imagens serão armazenadas
    },
    filename: (req, file, cb) => {
      cb(null, Date.now() + '-' + file.originalname); // Nome único para o arquivo
    }
  });
  
const upload = multer({ storage: storage });

// Rota para criar um novo produto (com upload de imagem)
router.post('/', upload.single('url_img'), productController.createProduct);

// Rota para atualizar um produto existente
/*router.put('/:id', productController.updateProduct);

// Rota para deletar um produto
router.delete('/:id', productController.deleteProduct);*/

// Exporta o router para uso em outros arquivos
module.exports = router;
