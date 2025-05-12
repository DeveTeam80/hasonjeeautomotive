document.querySelector('.prev-btn').addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
    const translateX = -currentIndex * 100;
    slider.style.transform = `translateX(${translateX}%)`;
});

document.querySelector('.next-btn').addEventListener('click', nextSlide);