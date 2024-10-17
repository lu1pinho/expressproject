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


let popupTimeout;

function showLoginPopup() {
    clearTimeout(popupTimeout); // Cancela qualquer ocultamento programado
    document.getElementById("login-popup").style.opacity= "1";
}

function hideLoginPopup() {
    popupTimeout = setTimeout(() => {
        document.getElementById("login-popup").style.opacity= "0";
    }, 2000); // Esconde após 2 segundos
}

function keepLoginPopup() {
    clearTimeout(popupTimeout); // Se o cursor está sobre o formulário, cancela o temporizador
}

function hideLoginPopupWithDelay() {
    popupTimeout = setTimeout(() => {
        document.getElementById("login-popup").style.opacity= "0";
    }, 2000); // Inicia o temporizador para esconder o popup
}