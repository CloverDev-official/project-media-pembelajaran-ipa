const ctx = document.getElementById('nilaiChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Ujian 1', 'Ujian 2', 'Ujian 3', 'Ujian 4', 'Ujian 5'],
        datasets: [{
            label: 'Nilai',
            data: [70, 80, 85, 90, 88],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',   // merah
                'rgba(54, 162, 235, 0.6)',   // biru
                'rgba(255, 206, 86, 0.6)',   // kuning
                'rgba(75, 192, 192, 0.6)',   // hijau toska
                'rgba(153, 102, 255, 0.6)'   // ungu
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 206, 86)',
                'rgb(75, 192, 192)',
                'rgb(153, 102, 255)'
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