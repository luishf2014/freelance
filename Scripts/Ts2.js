let currentSlide = 1;

document.addEventListener('DOMContentLoaded', () => {
    const carouselInner = document.querySelector('.carousel-inner');
    const slides = document.querySelectorAll('.carousel-item');

    // Initial position
    carouselInner.style.transform = `translateX(-${currentSlide * 100}%)`;

    function showSlide(index) {
        carouselInner.style.transition = 'transform 0.5s ease';
        currentSlide = index;
        carouselInner.style.transform = `translateX(-${currentSlide * 100}%)`;

        if (index >= slides.length - 1) {
            setTimeout(() => {
                carouselInner.style.transition = 'none';
                currentSlide = 1;
                carouselInner.style.transform = `translateX(-${currentSlide * 100}%)`;
            }, 500);
        }

        if (index <= 0) {
            setTimeout(() => {
                carouselInner.style.transition = 'none';
                currentSlide = slides.length - 2;
                carouselInner.style.transform = `translateX(-${currentSlide * 100}%)`;
            }, 500);
        }
    }

    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    function prevSlide() {
        showSlide(currentSlide - 1);
    }

    document.querySelector('.prev').addEventListener('click', prevSlide);
    document.querySelector('.next').addEventListener('click', nextSlide);

    setInterval(nextSlide, 3000);
});