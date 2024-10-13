document.getElementById('aplicar').addEventListener('click', function() {
    // Coletando valores dos filtros
    let departamento = document.getElementById('departamento').value;
    let precoMin = document.getElementById('fromInput').value;
    let precoMax = document.getElementById('toInput').value;
    let ofertas = document.getElementById('ofertas').checked ? 1 : 0;
    let descontos = document.getElementById('descontos').checked ? 1 : 0;
    let freteGratis = document.getElementById('frete').checked ? 1 : 0;
    let express = document.getElementById('express').checked ? 1 : 0;

    // Enviando os filtros para o backend
    let xhr = new XMLHttpRequest();
    xhr.open('GET', `categoria.php?departamento=${departamento}&precoMin=${precoMin}&precoMax=${precoMax}&ofertas=${ofertas}&descontos=${descontos}&freteGratis=${freteGratis}&express=${express}`, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.querySelector('.produtos').innerHTML = xhr.responseText; // Atualiza a lista de produtos
        }
    };
    xhr.send();
});


const fromSlider = document.querySelector('#fromSlider');
const toSlider = document.querySelector('#toSlider');
const fromInput = document.querySelector('#fromInput');
const toInput = document.querySelector('#toInput');
fillSlider(fromSlider, toSlider, '#004382', '#004382', toSlider);
setToggleAccessible(toSlider);

fromSlider.oninput = () => controlFromSlider(fromSlider, toSlider, fromInput);
toSlider.oninput = () => controlToSlider(fromSlider, toSlider, toInput);
fromInput.oninput = () => controlFromInput(fromSlider, fromInput, toInput, toSlider);
toInput.oninput = () => controlToInput(toSlider, fromInput, toInput, toSlider);

function controlFromInput(fromSlider, fromInput, toInput, controlSlider) {
    const [from, to] = getParsed(fromInput, toInput);
    fillSlider(fromInput, toInput, '#001C36', '#001C36', controlSlider);
    if (from > to) {
        fromSlider.value = to;
        fromInput.value = to;
    } else {
        fromSlider.value = from;
    }
}

function controlToInput(toSlider, fromInput, toInput, controlSlider) {
    const [from, to] = getParsed(fromInput, toInput);
    fillSlider(fromInput, toInput, '#001C36', '#001C36', controlSlider);
    setToggleAccessible(toInput);
    if (from <= to) {
        toSlider.value = to;
        toInput.value = to;
    } else {
        toInput.value = from;
    }
}

function controlFromSlider(fromSlider, toSlider, fromInput) {
    const [from, to] = getParsed(fromSlider, toSlider);
    fillSlider(fromSlider, toSlider, '#001C36', '#001C36', toSlider);
    if (from > to) {
        fromSlider.value = to;
        fromInput.value = to;
    } else {
        fromInput.value = from;
    }
}

function controlToSlider(fromSlider, toSlider, toInput) {
    const [from, to] = getParsed(fromSlider, toSlider);
    fillSlider(fromSlider, toSlider, '#001C36', '##001C36', toSlider);
    setToggleAccessible(toSlider);
    if (from <= to) {
        toSlider.value = to;
        toInput.value = to;
    } else {
        toInput.value = from;
        toSlider.value = from;
    }
}

function getParsed(currentFrom, currentTo) {
    const from = parseInt(currentFrom.value, 10);
    const to = parseInt(currentTo.value, 10);
    return [from, to];
}

function fillSlider(from, to, sliderColor, rangeColor, controlSlider) {
    const rangeDistance = to.max-to.min;
    const fromPosition = from.value - to.min;
    const toPosition = to.value - to.min;
    controlSlider.style.background = `linear-gradient(
      to right,
      ${sliderColor} 0%,
      ${sliderColor} ${(fromPosition)/(rangeDistance)*100}%,
      ${rangeColor} ${((fromPosition)/(rangeDistance))*100}%,
      ${rangeColor} ${(toPosition)/(rangeDistance)*100}%, 
      ${sliderColor} ${(toPosition)/(rangeDistance)*100}%, 
      ${sliderColor} 100%)`;
}

function setToggleAccessible(currentTarget) {
    const toSlider = document.querySelector('#toSlider');
    if (Number(currentTarget.value) <= 0 ) {
        toSlider.style.zIndex = 2;
    } else {
        toSlider.style.zIndex = 0;
    }
}

countProducts();
function countProducts() {
    const productsCountElements = document.querySelectorAll('.produtos .produto');
    const productsCount = productsCountElements.length;
    const aside = document.querySelector('aside');

    // Seleciona a primeira <section> encontrada
    const sidebar = document.getElementsByTagName("section")[0];

    if (sidebar) {
        // Ajusta a altura da sidebar multiplicando 20vw pelo número de produtos
        aside.style.height = ((productsCount/2) *250) + 'px';
    } else {
        console.log("Nenhuma <section> encontrada.");

    }
}

