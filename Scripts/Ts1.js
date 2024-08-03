/* Carousel */
/* Carousel */
document.addEventListener('DOMContentLoaded', function () {
    const carousel = document.querySelector('.carousel-inner');
    const items = document.querySelectorAll('.carousel-item');
    const indicators = document.querySelectorAll('.indicator');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
    let currentIndex = 0;
    const totalItems = items.length;
    const intervalTime = 5000; // tempo em milissegundos para passar para a próxima imagem

    // Adiciona evento de click nas setas
    prevButton.addEventListener('click', () => {
        moveToIndex(currentIndex - 1);
    });

    nextButton.addEventListener('click', () => {
        moveToIndex(currentIndex + 1);
    });

    // Adiciona evento de click nos indicadores
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            moveToIndex(index);
        });
    });

    // Função para mover para o índice especificado
    // Função para mover para o índice especificado
    function moveToIndex(index) {
        if (index < 0) {
            index = totalItems - 1;
        } else if (index >= totalItems) {
            index = 0;
        }
        carousel.style.transform = `translateX(-${index * 100}%)`;
        items.forEach((item) => item.classList.remove('active'));
        items[index].classList.add('active');
        indicators.forEach((indicator) => indicator.classList.remove('active'));
        indicators[index].classList.add('active');
        currentIndex = index;
    }

    // Função para passar para a próxima imagem automaticamente
    function autoPlay() {
        setInterval(() => {
            moveToIndex(currentIndex + 1);
        }, intervalTime);
    }

    // Inicia o autoplay
    autoPlay();
});
