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

// === Fungsi ambil warna dari CSS variable ===
function ambilWarna(variable) {
  return getComputedStyle(document.body).getPropertyValue(variable).trim();
}

// === Chart Instance ===
const ctx = document.getElementById('nilaiChart');
const nilaiChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Kelas 9A', 'Kelas 9B'],
    datasets: [{
      label: 'Rata-rata',
      data: [89, 88],
      backgroundColor: [ambilWarna('--bg-main'), ambilWarna('--bg-main')],
      borderColor: [ambilWarna('--bg-main-dark'), ambilWarna('--bg-main-dark')],
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
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

// === Fungsi update warna chart ===
function updateChartColors() {
  const bgMain = ambilWarna('--bg-main');
  const bgMainDark = ambilWarna('--bg-main-dark');
  nilaiChart.data.datasets[0].backgroundColor = [bgMain, bgMain];
  nilaiChart.data.datasets[0].borderColor = [bgMainDark, bgMainDark];
  nilaiChart.update();
}

// === Observer: Update saat data-theme berubah ===
const observer = new MutationObserver(updateChartColors);
observer.observe(document.body, {
  attributes: true,
  attributeFilter: ['data-theme']
});

// === Event: Update saat color picker diubah ===
const picker = document.getElementById('picker');
picker.addEventListener('input', (e) => {
  const warna = e.target.value;

  // set variabel CSS untuk tema custom
  document.documentElement.style.setProperty('--primary-500', warna);
  document.documentElement.style.setProperty('--primary-700', warna);

  // sinkronkan ke variabel chart
  document.documentElement.style.setProperty('--bg-main', warna);
  document.documentElement.style.setProperty('--bg-main-dark', warna);

  // set tema ke custom
  document.body.setAttribute('data-theme', 'custom');

  // simpan ke localStorage
  localStorage.setItem('customColor', warna);
  localStorage.setItem('theme', 'custom');

  updateChartColors();
});

// === Restore saat refresh ===
window.addEventListener('DOMContentLoaded', () => {
  const savedTheme = localStorage.getItem('theme');
  const savedColor = localStorage.getItem('customColor');

  if (savedTheme === 'custom' && savedColor) {
    // apply warna kembali
    document.documentElement.style.setProperty('--primary-500', savedColor);
    document.documentElement.style.setProperty('--primary-700', savedColor);
    document.documentElement.style.setProperty('--bg-main', savedColor);
    document.documentElement.style.setProperty('--bg-main-dark', savedColor);

    // update picker value
    picker.value = savedColor;

    // set tema body
    document.body.setAttribute('data-theme', 'custom');

    updateChartColors();
  }
});


