const TOLERANCE = 1.5;
let player, soalIndex = 0, skor = 0;
let maxWatched = 0, dragging = false, wasPlayingBeforeDrag = false;

const daftarSoal = [
  {
    waktu: 5,
    pertanyaan: "Apa yang dimaksud dengan pertumbuhan pada makhluk hidup?",
    opsi: [
      { teks:"Bertambahnya ukuran dan volume sel", benar:true },
      { teks:"Perubahan bentuk menuju kedewasaan", benar:false },
      { teks:"Perubahan perilaku sosial", benar:false }
    ]
  },
  {
    waktu: 10,
    pertanyaan: "Organisme yang mengalami metamorfosis sempurna adalah?",
    opsi: [
      { teks:"Kucing", benar:false },
      { teks:"Kupu-kupu", benar:true },
      { teks:"Ikan", benar:false }
    ]
  }
];

/* Ambil elemen */
const container = document.getElementById('progress-container');
const bar = document.getElementById('progress-bar');
const watchedBar = document.getElementById('watched-bar');
const tooltip = document.getElementById('progress-tooltip');
const btnPlay = document.getElementById('btnPlay');
const btnPause = document.getElementById('btnPause');
const btnRestart = document.getElementById('btnRestart');

/* Format mm:ss */
function formatTime(sec){
  sec = Math.max(0, Math.floor(sec||0));
  const m = Math.floor(sec/60);
  const s = (sec % 60).toString().padStart(2,'0');
  return `${m}:${s}`;
}

/* Hitung waktu dari posisi mouse */
function getTimeFromEvent(e){
  const rect = container.getBoundingClientRect();
  const offsetX = e.clientX - rect.left;
  const pct = Math.max(0, Math.min(1, offsetX / rect.width));
  const dur = (player?.getDuration?.()) || 0;
  return pct * dur;
}

/* Tampilkan soal */
function tampilkanSoal(soal){
  if (player?.pauseVideo) player.pauseVideo();
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
  document.getElementById('soal').style.display = "flex";
}

function jawab(benar){
  if(benar){
    skor++;
    alert("✅ Benar!");
    document.getElementById('soal').style.display = "none";
    if (soalIndex >= daftarSoal.length) {
      alert(`🎉 Skor kamu: ${skor} dari ${daftarSoal.length}`);
    } else {
      player.playVideo();
    }
  } else {
    alert("❌ Salah, coba lagi.");
  }
}

/* YouTube API Ready */
window.onYouTubeIframeAPIReady = function () {
  const playerContainer = document.getElementById("player");
  playerContainer.innerHTML = "";

  player = new YT.Player("player", {
    videoId: "888HyVkGw4U",
    playerVars: {
      modestbranding: 1,
      rel: 0,
      controls: 0,
      disablekb: 1,
      playsinline: 1,  // penting biar jalan di mobile
      origin: window.location.origin
    },
    events: {
      onReady: () => console.log("✅ Player siap"),
      onError: (e) => console.error("⚠️ YouTube error:", e.data)
    }
  });

  if (window._ytUpdateInterval) clearInterval(window._ytUpdateInterval);
  window._ytUpdateInterval = setInterval(mainUpdateLoop, 250);
};

/* Main Loop */
function mainUpdateLoop(){
  if (!player?.getDuration) return;
  const dur = player.getDuration();
  if (!dur) return;
  const now = player.getCurrentTime();

  // anti-skip
  if (player.getPlayerState?.() === YT.PlayerState.PLAYING && now > maxWatched + TOLERANCE) {
    player.seekTo(maxWatched, true);
    return;
  }

  if (now > maxWatched) maxWatched = now;

  watchedBar.style.width = ((maxWatched / dur) * 100) + "%";
  if (!dragging) bar.style.width = ((now / dur) * 100) + "%";

  // soal
  if (soalIndex < daftarSoal.length && Math.floor(now) >= daftarSoal[soalIndex].waktu) {
    tampilkanSoal(daftarSoal[soalIndex]);
    soalIndex++;
  }
}

/* Progress bar interaction */
container.addEventListener('mousemove', (e) => {
  const dur = player?.getDuration?.() || 0;
  if (!dur) return;
  const waktuPreview = getTimeFromEvent(e);
  tooltip.textContent = formatTime(waktuPreview);
  const rect = container.getBoundingClientRect();
  let offsetX = e.clientX - rect.left;
  offsetX = Math.max(0, Math.min(rect.width, offsetX));
  tooltip.style.left = (offsetX - tooltip.offsetWidth/2) + "px";
  tooltip.style.opacity = 1;
  if (dragging) {
    bar.style.width = ((waktuPreview / dur) * 100) + "%";
  }
});

container.addEventListener('mouseleave', () => {
  if (!dragging) tooltip.style.opacity = 0;
});

container.addEventListener('mousedown', () => {
  dragging = true;
  wasPlayingBeforeDrag = (player?.getPlayerState?.() === YT.PlayerState.PLAYING);
  player?.pauseVideo?.();
});

document.addEventListener('mouseup', (e) => {
  if (!dragging) return;
  dragging = false;
  tooltip.style.opacity = 0;
  const dur = player?.getDuration?.() || 0;
  if (!dur) return;
  const target = getTimeFromEvent(e);
  if (target <= maxWatched + 0.1) {
    player.seekTo(target, true);
  } else {
    player.seekTo(maxWatched, true);
  }
  if (wasPlayingBeforeDrag) setTimeout(()=>player.playVideo(),150);
});

container.addEventListener('click', (e) => {
  const target = getTimeFromEvent(e);
  if (target <= maxWatched + 0.1) player.seekTo(target, true);
  else player.seekTo(maxWatched, true);
});

/* Buttons */
btnPlay.addEventListener('click', () => player?.playVideo());
btnPause.addEventListener('click', () => player?.pauseVideo());
btnRestart.addEventListener('click', () => {
  skor=0; soalIndex=0; maxWatched=0;
  document.getElementById('soal').style.display="none";
  player.seekTo(0,true);
  setTimeout(()=>player.playVideo(),150);
});