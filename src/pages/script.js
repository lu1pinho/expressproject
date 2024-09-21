const slider = document.querySelectorAll('.slider');
const btnPrev = document.getElementById('prev-button');
const btnNext = document.getElementById('next-button');

let currentSlide = 0;

function hideSlider() {
  slider.forEach(item => item.classList.remove('on'))
}

function showSlider() {
  slider[currentSlide].classList.add('on')
}

function nextSlider() {
  hideSlider()
  if (currentSlide === slider.length - 1) {
    currentSlide = 0
  } else {
    currentSlide++
  }
  showSlider()
}

document.addEventListener("DOMContentLoaded", function () {
  // Controle de Faixa de Preços
  const minPrice = document.getElementById('minPrice');
  const maxPrice = document.getElementById('maxPrice');
  const minPriceLabel = document.getElementById('minPriceLabel');
  const maxPriceLabel = document.getElementById('maxPriceLabel');

  minPrice.addEventListener('input', function () {
    minPriceLabel.textContent = this.value;
    if (+minPrice.value > +maxPrice.value) {
      maxPrice.value = this.value;
      maxPriceLabel.textContent = this.value;
    }
  });

  maxPrice.addEventListener('input', function () {
    maxPriceLabel.textContent = this.value;
    if (+maxPrice.value < +minPrice.value) {
      minPrice.value = this.value;
      minPriceLabel.textContent = this.value;
    }
  });

  function setFilterValue(field, value) {
    document.getElementById(field).value = value;
    document.getElementById('filterForm').submit();
  }

  const ofertasDiaBtn = document.querySelector('.opcao-ofertas-dia');
  const todosDescontosBtn = document.querySelector('.opcao-todos-descontos');
  const condicaoNovoBtn = document.querySelector('.opcao-novo');
  const condicaoUsadoBtn = document.querySelector('.opcao-usado');

  ofertasDiaBtn?.addEventListener('click', function () {
    setFilterValue('oferta', 'dia');
  });

  todosDescontosBtn?.addEventListener('click', function () {
    setFilterValue('oferta', 'descontos');
  });

  condicaoNovoBtn?.addEventListener('click', function () {
    setFilterValue('condicao', 'novo');
  });

  condicaoUsadoBtn?.addEventListener('click', function () {
    setFilterValue('condicao', 'usado');
  });

  const carousels = document.querySelectorAll('.carousel');

  carousels.forEach((carousel) => {
    const images = carousel.querySelectorAll('.carousel-img');
    let currentIndex = 0;

    function showNextImage() {
      images[currentIndex].classList.remove('active');
      currentIndex = (currentIndex + 1) % images.length;
      images[currentIndex].classList.add('active');
    }

    setInterval(showNextImage, 3000);
  });
});
