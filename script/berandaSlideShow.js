const swiper = new Swiper(".swiper", {
    loop: true,
    autoplay: {
        delay: 3000,  // waktu
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    spaceBetween: 20,   // 🔹 kasih jarak antar slide (px)
});