const TOLERANCE = 1.5;
let player, soalIndex = 0, skor = 0;
let maxWatched = 0, dragging = false, wasPlayingBeforeDrag = false;
let totalAnswered = 0;
let isSoalActive = false, soalTimeReached = false;
let videoOverlay = null, videoStarted = false;

const container = document.getElementById('progress-container');
const bar = document.getElementById('progress-bar');
const watchedBar = document.getElementById('watched-bar');
const tooltip = document.getElementById('progress-tooltip');

/* === Tooltip Hover Progress Bar === */
container.addEventListener("mousemove", (e) => {
  const rect = container.getBoundingClientRect();
  const offsetX = e.clientX - rect.left;
  const dur = player?.getDuration?.() || 0;
  const percentage = Math.min(Math.max(offsetX / rect.width, 0), 1);
  const previewTime = percentage * dur;

  // Format jadi menit:detik
  tooltip.textContent = formatTime(previewTime);
  tooltip.style.display = "block";

  // Clamp biar tooltip tidak keluar sisi kiri/kanan
  let leftPos = offsetX - tooltip.offsetWidth / 2;
  if (leftPos < 0) leftPos = 0;
  if (leftPos > rect.width - tooltip.offsetWidth) {
    leftPos = rect.width - tooltip.offsetWidth;
  }

  tooltip.style.left = leftPos + "px";
  tooltip.style.top = "-30px";
});

container.addEventListener("mouseleave", () => {
  tooltip.style.display = "none";
});


/* --- Daftar Soal --- */
const daftarSoal = [
  { waktu: 30, pertanyaan: "1. Apa yang dimaksud dengan pertumbuhan pada makhluk hidup?", opsi: [
    { teks:"Bertambahnya ukuran dan volume sel", benar:true },
    { teks:"Perubahan bentuk menuju kedewasaan", benar:false },
    { teks:"Perubahan perilaku sosial", benar:false }
  ]},
  { waktu: 50, pertanyaan: "2. Organisme yang mengalami metamorfosis sempurna adalah?", opsi: [
    { teks:"Kucing", benar:false },
    { teks:"Kupu-kupu", benar:true },
    { teks:"Ikan", benar:false }
  ]}
];

/* --- Util --- */
function formatTime(sec){
  sec = Math.max(0, Math.floor(sec||0));
  return `${Math.floor(sec/60)}:${(sec % 60).toString().padStart(2,'0')}`;
}
function getTimeFromEvent(e){
  const rect = container.getBoundingClientRect();
  const clientX = e.touches ? e.touches[0].clientX : e.clientX;
  const pct = Math.max(0, Math.min(1, (clientX - rect.left) / rect.width));
  return pct * ((player && player.getDuration && player.getDuration()) || 0);
}

/* --- Popup Notifikasi --- */
function showPopup(msg, type){
  const popup = document.createElement('div');
  popup.className = `fixed top-4 right-4 z-[9999] px-6 py-3 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full 
                     ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`;
  popup.textContent = msg;
  document.body.appendChild(popup);
  setTimeout(() => popup.classList.remove('translate-x-full'), 10);
  setTimeout(() => { popup.classList.add('translate-x-full'); setTimeout(()=>popup.remove(), 300); }, 2000);
}

/* --- Modal Soal --- */
function tampilkanSoal(soal){
  isSoalActive = true; soalTimeReached = false;
  if (player?.pauseVideo) player.pauseVideo();
  document.getElementById('control-buttons').classList.add('hidden');
  document.getElementById('progress-container-wrapper').classList.add('hidden');
  document.getElementById('pertanyaan').textContent = soal.pertanyaan;

  const opsiDiv = document.getElementById('opsi');
  opsiDiv.innerHTML = "";
  soal.opsi.forEach((opsi, idx) => {
    const btn = document.createElement("button");
    btn.textContent = opsi.teks;
    btn.className = "border bg-gradient-to-t from-blue-600 to-blue-500 border-b-4 border-blue-700 py-3 px-4 rounded-xl shadow text-lg text-white font-bold transition-transform duration-150 hover:scale-105 active:border-b-0 w-full video-option-btn";
    btn.style.minHeight = '60px';
    btn.style.marginBottom = '15px';
    btn.onclick = () => jawab(opsi.benar, idx, soal);
    opsiDiv.appendChild(btn);
  });

  document.getElementById('feedback').className = "mt-6 text-center font-semibold hidden";
  document.getElementById('soal-modal').classList.remove('hidden');
  document.body.style.overflow = 'hidden';
}

/* --- Jawaban Soal --- */
function jawab(benar, index){
  isSoalActive = false; soalTimeReached = false;
  const feedback = document.getElementById('feedback');
  const opsiButtons = document.querySelectorAll('#opsi button');
  opsiButtons.forEach(b => { b.disabled = true; b.style.opacity = '0.7'; b.style.cursor = 'not-allowed'; });

  if (benar){
    skor++; feedback.textContent = "✅ Benar!"; feedback.className = "mt-6 text-center font-semibold text-green-600";
    opsiButtons[index].style.background = '#10b981';
    showPopup("✅ Jawaban Benar!", "success");
  } else {
    feedback.textContent = "❌ Salah!"; feedback.className = "mt-6 text-center font-semibold text-red-600";
    opsiButtons[index].style.background = '#ef4444';
    showPopup("❌ Jawaban Salah!", "error");
  }

  setTimeout(() => {
    document.getElementById('soal-modal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    document.getElementById('control-buttons').classList.remove('hidden');
    document.getElementById('progress-container-wrapper').classList.remove('hidden');
    totalAnswered++;
    if (totalAnswered >= daftarSoal.length) showFinalScore();
    else player?.playVideo();
  }, 2000);
}

/* --- Skor Akhir --- */
function showFinalScore(){
  const modal = document.createElement('div');
  modal.className = "fixed inset-0 bg-black/75 z-[9999] flex items-center justify-center p-4";
  modal.innerHTML = `
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-8">
      <h2 class="text-2xl font-bold mb-4 text-center">Skor Akhir</h2>
      <p class="text-xl text-center mb-6">Skor kamu: <span class="font-bold text-blue-600">${skor}</span> dari ${daftarSoal.length}</p>
      <div class="flex justify-center gap-4">
        <button id="restart-score" class="px-6 py-2 rounded-xl bg-green-600 text-white font-bold">Main Lagi</button>
        <button id="close-score" class="px-6 py-2 rounded-xl bg-gray-600 text-white font-bold">Selesai</button>
      </div>
    </div>`;
  document.body.appendChild(modal); document.body.style.overflow = 'hidden';
  modal.querySelector("#restart-score").onclick = () => { modal.remove(); resetQuiz(); };
  modal.querySelector("#close-score").onclick = () => { modal.remove(); resetQuiz(); };
}
function resetQuiz(){
  skor = 0; soalIndex = 0; totalAnswered = 0; maxWatched = 0;
  document.getElementById('soal-modal').classList.add('hidden');
  document.getElementById('control-buttons').classList.remove('hidden');
  document.getElementById('progress-container-wrapper').classList.remove('hidden');
  document.body.style.overflow = 'auto';
  if (player?.seekTo) { player.seekTo(0, true); setTimeout(()=>player.playVideo?.(), 150); }
}

/* --- Loop Utama --- */
function mainUpdateLoop(){
  if (!player?.getDuration) return;
  const dur = player.getDuration(); if (!dur) return;
  const now = player.getCurrentTime();
  if (player.getPlayerState?.() === YT.PlayerState.PLAYING && now > maxWatched + TOLERANCE){
    player.seekTo(maxWatched, true); return;
  }
  if (now > maxWatched) maxWatched = now;
  if (!dragging){ bar.style.width = `${(now/dur)*100}%`; }
  watchedBar.style.width = `${(maxWatched/dur)*100}%`;
  if (soalIndex < daftarSoal.length && Math.floor(now) >= daftarSoal[soalIndex].waktu){
    soalTimeReached = true; tampilkanSoal(daftarSoal[soalIndex]); soalIndex++;
  }
}

/* --- YouTube API --- */
window.onYouTubeIframeAPIReady = function(){
  player = new YT.Player("player", {
    events: { 
      onReady: () => { enableButtons(); setupMobileControls(); setupMobileProgressBar(); setupDoubleTapPrevention(); },
      onError: (e) => console.error("⚠️ YouTube error:", e.data)
    }
  });
  clearInterval(window._ytUpdateInterval);
  window._ytUpdateInterval = setInterval(mainUpdateLoop, 250);
};

/* --- Tombol Kontrol --- */
function enableButtons(){
  const makeBtn = (id, label, handler) => {
    const btn = document.getElementById(id);
    btn.onclick = () => { handler(); btn.style.transform="scale(0.95)"; setTimeout(()=>btn.style.transform="",100); };
  };
  makeBtn("btnPlay", "▶ Play", ()=>{ player?.playVideo(); videoStarted=true; });
  makeBtn("btnPause", "⏸ Pause", ()=>player?.pauseVideo());
  makeBtn("btnRestart", "🔄 Restart", ()=>resetQuiz());
}

/* --- Init --- */
document.addEventListener('DOMContentLoaded', ()=>{
  if (typeof YT === 'undefined'){ 
    const tag=document.createElement('script'); tag.src="https://www.youtube.com/iframe_api"; 
    document.head.appendChild(tag); 
  }
});
