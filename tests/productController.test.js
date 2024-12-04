const Product = require('../control/API/productModel');
const { createProduct } = require('../control/API/productController');
const sinon = require('sinon');

describe('Testes do controlador de produto - createProduct', () => {
  let req, res;

  beforeEach(() => {
    req = {
      body: {
        nome: 'Produto Teste',
        descricao: 'Descrição do produto teste',
        preco: 99.99,
        categoria: 'Categoria Teste',
        dados_produto: 'Dados adicionais do produto',
        estoque: 10,
      },
      file: {
        path: 'uploads/produto.jpg', // Caminho da imagem
      },
    };

    res = {
      status: sinon.stub().returnsThis(),
      json: sinon.stub(),
    };
  });

  afterEach(() => {
    sinon.restore(); // Restaura os mocks/stubs após cada teste
  });

  it('Deve criar um novo produto com sucesso', async () => {
    const fakeProduct = {
      id: 1,
      nome: 'Produto Teste',
      descricao: 'Descrição do produto teste',
      preco: 99.99,
      categoria: 'Categoria Teste',
      dados_produto: 'Dados adicionais do produto',
      estoque: 10,
      url_img: 'uploads/produto.jpg',
    };

    // Mock da função create do Sequelize
    sinon.stub(Product, 'create').resolves(fakeProduct);

    await createProduct(req, res);

    // Verificações
    expect(res.status.calledWith(201)).toBe(true);
    expect(res.json.calledWith(fakeProduct)).toBe(true);
  });

  it('Deve retornar erro 500 se ocorrer uma exceção durante a criação do produto', async () => {
    const errorMessage = 'Erro ao criar produto';
    
    // Mock para lançar uma exceção
    sinon.stub(Product, 'create').rejects(new Error(errorMessage));

    await createProduct(req, res);

    // Verificações
    expect(res.status.calledWith(500)).toBe(true);
    expect(res.json.calledWithMatch({ message: 'Erro ao criar produto' })).toBe(true);
  });

  it('Deve definir url_img como null se nenhuma imagem for enviada', async () => {
    req.file = null; // Simula a ausência de uma imagem

    const fakeProduct = {
      id: 2,
      nome: 'Produto Teste Sem Imagem',
      descricao: 'Descrição do produto sem imagem',
      preco: 50.00,
      categoria: 'Categoria Teste',
      dados_produto: 'Dados adicionais do produto',
      estoque: 5,
      url_img: null,
    };

    sinon.stub(Product, 'create').resolves(fakeProduct);

    await createProduct(req, res);

    // Verificações
    expect(res.status.calledWith(201)).toBe(true);
    expect(res.json.calledWith(fakeProduct)).toBe(true);
  });

  afterAll(() => {
    jest.clearAllMocks();
    jest.restoreAllMocks();
    jest.resetModules();
  });
  
});
