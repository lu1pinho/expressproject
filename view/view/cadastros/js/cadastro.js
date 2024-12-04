const fileInput = document.getElementById('file');
const imagePreview = document.getElementById('image');

fileInput.addEventListener('change', function () {
    const file = fileInput.files[0]; // Pega o arquivo selecionado

    if (file) {
        const reader = new FileReader(); // Cria um leitor de arquivos

        reader.onload = function (e) {
            imagePreview.src = e.target.result; // Define o src da imagem como o conteúdo do arquivo
        };

        reader.readAsDataURL(file); // Lê o arquivo como uma URL base64
    } else {
        imagePreview.src = ''; // Remove a imagem se nenhum arquivo for selecionado
    }
});



// Nome do Usuário
const inputFirstname = document.getElementById('firstname');
const inputLastname = document.getElementById('lastname');
const labelname = document.getElementById('labelname');

// Função para atualizar o nome completo
function updateFullname() {
    // Obter os valores dos inputs e remover espaços extras
    const firstname = inputFirstname.value.trim();
    const lastname = inputLastname.value.trim();

    // Função para capitalizar a primeira letra de cada palavra
    function capitalizeWords(str) {
        return str.split(' ').map(word =>
            word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()
        ).join(' ');
    }

    // Capitaliza todas as palavras no primeiro nome e sobrenome
    const formattedFirstname = capitalizeWords(firstname);
    const formattedLastname = capitalizeWords(lastname);

    // Junta o nome completo
    let fullname = `${formattedFirstname} ${formattedLastname}`.trim();

    // Verifica se o nome completo tem mais de 30 caracteres
    if (fullname.length > 37) {
        // Corta até o último espaço antes de 30 caracteres
        fullname = fullname.substring(0, 37);
        fullname = fullname.substring(0, fullname.lastIndexOf(' '));
    }

    // Atualiza o texto do label
    labelname.innerText = fullname;

    // Log para verificação
    console.log(fullname);
    console.log("Tamanho: " + fullname.length);
}

// Adiciona eventos de entrada nos campos de nome e sobrenome
inputFirstname.addEventListener('input', updateFullname);
inputLastname.addEventListener('input', updateFullname);