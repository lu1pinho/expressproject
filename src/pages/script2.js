let currentOfferIndex = 0; // Índice da imagem atual
const offerImagesContainer = document.getElementById('images-lista-ofertas');
const offerImages = document.querySelectorAll('.offer-image');
const totalOfferImages = offerImages.length;

document.getElementById('next-button2').addEventListener('click', () => {
  if (currentOfferIndex < totalOfferImages - 1) {
    currentOfferIndex++;
  } else {
    currentOfferIndex = 0; // Volta ao início
  }
  updateOfferImagePosition();
});

document.getElementById('prev-button2').addEventListener('click', () => {
  if (currentOfferIndex > 0) {
    currentOfferIndex--;
  } else {
    currentOfferIndex = totalOfferImages - 1; // Vai para a última imagem
  }
  updateOfferImagePosition();
});

function updateOfferImagePosition() {
  const offset = -currentOfferIndex * (150 + 8); // Largura da imagem + margem
  offerImagesContainer.style.transition = 'transform 0.5s ease';
  offerImagesContainer.style.transform = `translateX(${offset}px)`;

  // Verifica se é a última imagem e faz o loop para a primeira
  if (currentOfferIndex === totalOfferImages - 1) {
    setTimeout(() => {
      offerImagesContainer.style.transition = 'none';
      offerImagesContainer.style.transform = 'translateX(0px)';
      currentOfferIndex = 0;
    }, 500); // Tempo da transição
  }
}
