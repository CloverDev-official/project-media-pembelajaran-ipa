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
                labels: ['Bab 1', 'Bab 2', 'Bab 3', 'Bab 4', 'Bab 5', 'Bab 6', 'Bab 7'],
                datasets: [{
                    label: 'Nilai',
                    data: [75, 80, 85, 90, 88, 90, 100],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',   // merah
                        'rgba(54, 162, 235, 0.6)',   // biru
                        'rgba(255, 206, 86, 0.6)',   // kuning
                        'rgba(75, 192, 192, 0.6)',   // hijau toska
                        'rgba(153, 102, 255, 0.6)',  // ungu
                        'rgba(255, 159, 64, 0.6)',   // oranye
                        'rgba(46, 204, 113, 0.6)',   // hijau
                        'rgba(255, 20, 147, 0.6)',   // pink
                        'rgba(128, 128, 128, 0.6)',  // abu-abu
                        'rgba(139, 69, 19, 0.6)'     // coklat
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',   // merah
                        'rgb(54, 162, 235)',   // biru
                        'rgb(255, 206, 86)',   // kuning
                        'rgb(75, 192, 192)',   // hijau toska
                        'rgb(153, 102, 255)',  // ungu
                        'rgb(255, 159, 64)',   // oranye
                        'rgb(46, 204, 113)',   // hijau
                        'rgb(255, 20, 147)',   // pink
                        'rgb(128, 128, 128)',  // abu-abu
                        'rgb(139, 69, 19)'     // coklat
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