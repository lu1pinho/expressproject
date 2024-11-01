// PopUps
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

// Favoritos
let active = false;
const favorite = document.querySelector('.favorite');
const favoritos = document.querySelector('.love-icon');
replaceImg();
favoritos.onclick = function(){
    replaceImg();
}

function replaceImg(){
    if (active) {
        animateHeart();
        favoritos.src = '../produto-individual/img/svg/heart-icon.svg';
        console.log(active);
        active = false;
    } else {
        animateHeart();
        favoritos.src = '../produto-individual/img/svg/heart-thin-icon.svg';
        console.log(active);
        active = true;
    }
}

function animateHeart(){
    if (active) {
        favoritos.style.animation = "pulse 0.5s linear infinite";
    } else {
        favoritos.style.animation = "wobble 2s linear infinite";
    }
}

// PopUp popup-cart
const popup = document.querySelector('.popup-cart');
const cart_button = document.getElementById('addcart');

cart_button.onclick = function() {
    // Exibe o popup
    popup.style.opacity = "1";
    popup.style.visibility = "visible";
    popup.style.animationPlayState = "running";
    popup.style.transform = "translateY(20px)";
    popup.style.animationPlayState = "running";

    // Temporizador para esconder o popup após 2 segundos
    setTimeout(() => {
        popup.style.opacity = "1"; // Torna invisível
        popup.style.animationPlayState = "paused"; // Pausa a animação se necessário
        popup.style.visibility = "hidden"; // Remove da visualização
        popup.style.transform = "translateY(60px)";
    }, 2000); // 2000 milissegundos = 2 segundos
}

function GoToMainPage(){
    alert("Você será redirecionado para a página principal");
}
