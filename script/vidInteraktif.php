<script src="https://www.youtube.com/iframe_api"></script>
<script>
let player;
let soalIndex = 0;
let skor = 0;
let totalSoal = 0;

// Daftar soal
const daftarSoal = [
  {
    waktu: 5,
    pertanyaan: "Apa yang dimaksud dengan pertumbuhan pada makhluk hidup?",
    opsi: [
      { teks: "Bertambahnya ukuran dan volume sel", benar: true },
      { teks: "Perubahan bentuk menuju kedewasaan", benar: false },
      { teks: "Perubahan perilaku sosial", benar: false }
    ]
  },
  {
    waktu: 10,
    pertanyaan: "Organisme yang mengalami metamorfosis sempurna adalah?",
    opsi: [
      { teks: "Kucing", benar: false },
      { teks: "Kupu-kupu", benar: true },
      { teks: "Ikan", benar: false }
    ]
  }
];

totalSoal = daftarSoal.length;

// API YT siap
function onYouTubeIframeAPIReady() {
  player = new YT.Player('player', {
    height: '360',
    width: '640',
    videoId: '888HyVkGw4U',
    playerVars: { modestbranding: 1, rel: 0 },
    events: { 'onStateChange': onPlayerStateChange }
  });
}

// Cek waktu soal
function onPlayerStateChange(event) {
  if (event.data === YT.PlayerState.PLAYING) {
    setInterval(() => {
      const waktu = Math.floor(player.getCurrentTime());
      if (soalIndex < daftarSoal.length && waktu >= daftarSoal[soalIndex].waktu) {
        tampilkanSoal(daftarSoal[soalIndex]);
        soalIndex++;
      }
    }, 1000);
  }
}

// Tampilkan soal
function tampilkanSoal(soal) {
  player.pauseVideo();

  document.getElementById('pertanyaan').textContent = soal.pertanyaan;
  const opsiDiv = document.getElementById('opsi');
  opsiDiv.innerHTML = "";

  soal.opsi.forEach((opsi) => {
    const btn = document.createElement("button");
    btn.textContent = opsi.teks;
    btn.className = "bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg";
    btn.onclick = () => jawab(opsi.benar);
    opsiDiv.appendChild(btn);
  });

  document.getElementById('soal').classList.remove('hidden');
}

// Jawab soal
function jawab(benar) {
  if (benar) {
    skor++;
    alert("✅ Benar!");
    document.getElementById('soal').classList.add('hidden');

    if (soalIndex >= totalSoal) {
      tampilkanHasil();
    } else {
      player.playVideo();
    }
  } else {
    alert("❌ Salah, coba lagi.");
  }
}

// Hasil akhir
function tampilkanHasil() {
  alert(`🎉 Skor kamu: ${skor} dari ${totalSoal}`);
}
</script>
