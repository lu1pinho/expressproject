// Executar o test com JEST
// npx jest tests/productExibir.test.js

const { expect } = require('chai');
const sinon = require('sinon');
const Product = require('../control/API/productModel');
const { getProductById, getAllProducts } = require('../control/API/productController');

describe('Testes para Produto', () => {
    let req, res;

    beforeEach(() => {
        sinon.stub(console, 'error'); // Suprime console.error para testes
        req = { params: { id: 1 } };
        res = {
            status: sinon.stub().returnsThis(),
            json: sinon.stub()
        };
        sinon.stub(Product, 'findByPk');
        sinon.stub(Product, 'findAll'); // Adiciona stub para findAll
    });

    afterEach(() => {
        console.error.restore();
        sinon.restore();
    });

    it('Deve retornar um produto quando o ID é encontrado', async () => {
        const fakeProduct = { id: 1, name: 'Produto Teste' };
        Product.findByPk.resolves(fakeProduct);

        await getProductById(req, res);

        expect(res.status.calledOnceWith(200)).to.be.true;
        expect(res.json.calledOnceWith(fakeProduct)).to.be.true;
    });

    it('Deve retornar 404 quando o produto não é encontrado', async () => {
        Product.findByPk.resolves(null);

        await getProductById(req, res);

        expect(res.status.calledOnceWith(404)).to.be.true;
        expect(res.json.calledOnceWith({ message: 'Produto não encontrado' })).to.be.true;
    });

    it('Deve retornar 500 em caso de erro', async () => {
        Product.findByPk.rejects(new Error('Erro de banco'));

        await getProductById(req, res);

        expect(res.status.calledOnceWith(500)).to.be.true;
        expect(res.json.calledOnceWith(sinon.match({ message: 'Erro ao buscar produto' }))).to.be.true;
    });

    it('Deve listar todos os produtos', async () => {
        const fakeProducts = [{ id: 1, name: 'Produto Teste' }, { id: 2, name: 'Produto 2' }];
        Product.findAll.resolves(fakeProducts);

        await getAllProducts(req, res);

        expect(res.status.calledOnceWith(200)).to.be.true;
        expect(res.json.calledOnceWith(fakeProducts)).to.be.true;
    });

    it('Deve retornar 500 em caso de erro ao listar todos os produtos', async () => {
        Product.findAll.rejects(new Error('Erro de banco'));

        await getAllProducts(req, res);

        expect(res.status.calledOnceWith(500)).to.be.true;
        expect(res.json.calledOnceWith(sinon.match({ message: 'Erro ao buscar produtos' }))).to.be.true;
    });
});
