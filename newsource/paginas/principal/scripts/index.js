let timeoutId;

function showPopup() {
    const elemento = document.getElementsByClassName('form')[0];
    elemento.style.opacity = '1'; // Define a opacidade como 1
    elemento.style.visibility = 'visible'; // Torna visível

    // Limpa o timeout se o popup for mostrado
    clearTimeout(timeoutId);
}

function hidePopup() {
    const elemento = document.getElementsByClassName('form')[0];
    elemento.style.opacity = '0'; // Define a opacidade como 0

    // Aguarda a animação antes de esconder o card
    setTimeout(() => {
        elemento.style.visibility = 'hidden'; // Torna invisível após a animação
    }, 300); // Tempo da animação em milissegundos
}

function startTimeout() {
    // Inicia um timeout de 3 segundos para esconder o popup
    timeoutId = setTimeout(hidePopup, 1000);
}

// Adiciona eventos de mouseleave ao popup
document.getElementById('login-popup').addEventListener('mouseenter', () => {
    clearTimeout(timeoutId); // Limpa o timeout se o mouse entrar no popup
});

document.getElementById('login-popup').addEventListener('mouseleave', startTimeout); // Reinicia o timeout se o mouse sair do popup


// Mudar cor do indicador
let indicator = document.querySelector('.slider-controls');

function changeColor(){
    if(sectionIndex === 0){
        indicator.style.color = 'white';
    } else {
        indicator.style.color = 'black';
    }
}
// Carrosel de Imagens
const slider = document.querySelector(".slider");

const leftArrow = document.querySelector(".left");
const rightArrow = document.querySelector(".right");
const indicatorParents = document.querySelector('.slider-controls ul');
let sectionIndex = 0;
let numberOfSlide = 10;
changeColor();

document.querySelectorAll('.slider-controls li').forEach(function (indicator, ind) {
    indicator.addEventListener('click', function () {
        sectionIndex = ind;
        document.querySelector('.slider-controls .selected').classList.remove('selected');
        indicator.classList.add('selected');
        slider.style.transform = 'translate(' + (sectionIndex) * -100/numberOfSlide +'%)';
        changeColor();
    });
});

rightArrow.addEventListener('click', function () {
    sectionIndex = (sectionIndex < numberOfSlide-1) ? sectionIndex + 1 : numberOfSlide-1;
    document.querySelector('.slider-controls .selected').classList.remove('selected');
    indicatorParents.children[sectionIndex].classList.add('selected');
    slider.style.transform = 'translate(' + (sectionIndex) * -100/numberOfSlide +'%)';
    changeColor();
});

leftArrow.addEventListener('click', function () {
    sectionIndex = (sectionIndex > 0) ? sectionIndex - 1 : 0;
    document.querySelector('.slider-controls .selected').classList.remove('selected');
    indicatorParents.children[sectionIndex].classList.add('selected');
    slider.style.transform = 'translate(' + (sectionIndex) * -100/numberOfSlide +'%)';
    changeColor();
});



// Categorias
const menu_burger = document.querySelector('.todos-menu');
const popup_todos = document.querySelector('.popup-todos');
let mouseInElement = false;
let timer;

// Função para mostrar o popup
function showPopup() {
    clearTimeout(timer); // Cancela o timer se ele estiver ativo
    popup_todos.style.top = '100px'; // Mostra o popup
}

// Função para esconder o popup com atraso
function hidePopupWithDelay() {
    timer = setTimeout(() => {
        if (!mouseInElement) {
            popup_todos.style.top = '50px'; // Esconde o popup após 2s
        }
    }, 2000); // 2 segundos de atraso
}

// Quando o mouse entra em qualquer um dos elementos
menu_burger.onmouseenter = popup_todos.onmouseenter = function () {
    mouseInElement = true;
    showPopup(); // Mostra o popup
};

// Quando o mouse sai de qualquer um dos elementos
menu_burger.onmouseleave = popup_todos.onmouseleave = function () {
    mouseInElement = false;
    hidePopupWithDelay(); // Inicia o timer para esconder o popup
};


