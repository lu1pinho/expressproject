function setupCarousel(nextButtonId, prevButtonId, imagesContainerId, imageClass) {
  let currentIndex = 0; // Índice da imagem atual
  const imagesContainer = document.getElementById(imagesContainerId);
  const images = document.querySelectorAll(`.${imageClass}`);
  const totalImages = images.length;

  document.getElementById(nextButtonId).addEventListener('click', () => {
    if (currentIndex < totalImages - 1) {
      currentIndex++;
    } else {
      currentIndex = 0; // Volta ao início
    }
    updateImagePosition();
  });

  document.getElementById(prevButtonId).addEventListener('click', () => {
    if (currentIndex > 0) {
      currentIndex--;
    } else {
      currentIndex = totalImages - 1; // Vai para a última imagem
    }
    updateImagePosition();
  });

  function updateImagePosition() {
    const offset = -currentIndex * (150 + 8); // Largura da imagem + margem
    imagesContainer.style.transition = 'transform 0.5s ease';
    imagesContainer.style.transform = `translateX(${offset}px)`;

    // Verifica se é a última imagem e faz o loop para a primeira
    if (currentIndex === totalImages - 1) {
      setTimeout(() => {
        imagesContainer.style.transition = 'none';
        imagesContainer.style.transform = 'translateX(0px)';
        currentIndex = 0;
      }, 500); // Tempo da transição
    }
  }
}

// Configurando os carrosséis
setupCarousel('next-button2', 'prev-button2', 'images-lista-ofertas', 'offer-image');
setupCarousel('next-button3', 'prev-button3', 'images-lista-recomendacoes', 'recommendation-image');
setupCarousel('next-button4', 'prev-button4', 'images-lista-vendidos', 'mais-vendidos');
setupCarousel('next-button5', 'prev-button=5', 'images-talvez-goste', 'talvez-goste');