const swiper = new Swiper(".swiper", {
    loop: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    spaceBetween: 20,   // 🔹 kasih jarak antar slide (px)
});


const ctx = document.getElementById('nilaiChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Kelas 9A', 'Kelas 9B'],
        datasets: [{
            label: 'Rata-rata',
            data: [75, 88],
            backgroundColor: [
                'rgba(75, 192, 192, 0.6)',   // hijau toska
                'rgba(46, 204, 113, 0.6)',   // hijau

            ],
            borderColor: [
                'rgb(75, 192, 192)',   // hijau toska
                'rgb(46, 204, 113)',   // hijau

            ],
            borderWidth: 1
        }]
    },

    options: {
        responsive: true,   // ❌ nonaktifkan resize otomatis
        maintainAspectRatio: false, // biar height/width ikuti canvas
        plugins: {
            legend: { display: true }
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 100
            }
        }
    }
});