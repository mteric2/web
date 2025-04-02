document.addEventListener("DOMContentLoaded", function () {
    const images = document.querySelectorAll(".background-carousel img");
    let currentIndex = 0;

    function changeImage() {
        const currentImage = images[currentIndex];
        let nextIndex = (currentIndex + 1) % images.length;
        const nextImage = images[nextIndex];

        // Mueve la imagen actual fuera de la pantalla a la izquierda
        currentImage.classList.remove("active");
        currentImage.classList.add("next");

        // Mueve la siguiente imagen al centro
        nextImage.classList.remove("next");
        nextImage.classList.add("active");

        currentIndex = nextIndex;
    }

    // Inicia el carrusel cada 3 segundos
    setInterval(changeImage, 5000);
});
