document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.mySwiper', {
        slidesPerView: 1,
        spaceBetween: 16,
        loop: true, // opsional tapi disarankan untuk autoplay
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
});

console.log('SLIDESHOQ');
