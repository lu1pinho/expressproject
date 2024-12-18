// control/API/productRoutes.js
const express = require('express');
//const multer = require('multer');
const router = express.Router();
const productController = require('./productController');


// Configuração do multer para armazenar arquivos
/*const storage = multer.diskStorage({
    destination: (req, file, cb) => {
      cb(null, 'C:/xampp/htdocs/expressproject/control/API/uploads'); // Pasta onde as imagens serão armazenadas
    },
    filename: (req, file, cb) => {
      cb(null, Date.now() + '-' + file.originalname); // Nome único para o arquivo
    }
  });
  
const upload = multer({ storage: storage });*/
// Rota para criar um novo produto (com upload de imagem)
//router.post('/', upload.single('url_img'), productController.createProduct);
router.post('/', productController.createProduct);


// Rota para listar todos os produtos
router.get('/', productController.getAllProducts);


// Rota para obter um produto específico pelo ID
router.get('/:id', productController.getProductById);


// Rota para deletar um produto
router.delete('/:id', productController.deleteProduct);

// Rota para atualizar um produto pelo ID
router.put('/:id', productController.updateProduct);




module.exports = router;


