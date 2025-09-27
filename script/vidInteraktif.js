const TOLERANCE = 1.5;
let player, soalIndex = 0, skor = 0;
let maxWatched = 0, dragging = false, wasPlayingBeforeDrag = false;
let totalAnswered = 0; // Tambahkan variabel ini
let isSoalActive = false; // Tambahkan variabel untuk melacak apakah ada soal aktif
let soalTimeReached = false; // Tambahkan variabel untuk melacak apakah waktu soal tercapai
let videoOverlay = null; // Tambahkan variabel untuk overlay video
let videoStarted = false;

const container = document.getElementById('progress-container');
const bar = document.getElementById('progress-bar');
const watchedBar = document.getElementById('watched-bar');
const tooltip = document.getElementById('progress-tooltip');
const btnPlay = document.getElementById('btnPlay');
const btnPause = document.getElementById('btnPause');
const btnRestart = document.getElementById('btnRestart');

/* --- Soal --- */
let daftarSoal = [
  { waktu: 400, pertanyaan: "1. Apa yang dimaksud dengan pertumbuhan pada makhluk hidup?", opsi: [
    { teks:"Bertambahnya ukuran dan volume sel", benar:true },
    { teks:"Perubahan bentuk menuju kedewasaan", benar:false },
    { teks:"Perubahan perilaku sosial", benar:false }
  ]},
  { waktu: 500, pertanyaan: "2.Organisme yang mengalami metamorfosis sempurna adalah?", opsi: [
    { teks:"Kucing", benar:false },
    { teks:"Kupu-kupu", benar:true },
    { teks:"Ikan", benar:false }
  ]}
];

/* Format waktu */
function formatTime(sec){
  sec = Math.max(0, Math.floor(sec||0));
  const m = Math.floor(sec/60);
  const s = (sec % 60).toString().padStart(2,'0');
  return `${m}:${s}`;
}

/* Hitung waktu dari posisi mouse/touch */
function getTimeFromEvent(e){
  const rect = container.getBoundingClientRect();
  const clientX = e.touches ? e.touches[0].clientX : e.clientX;
  const offsetX = clientX - rect.left;
  const pct = Math.max(0, Math.min(1, offsetX / rect.width));
  const dur = (player && player.getDuration && player.getDuration()) || 0;
  return pct * dur;
}

/* Tampilkan soal */
function tampilkanSoal(soal){
  isSoalActive = true; // Tandai bahwa soal aktif
  soalTimeReached = false; // Reset flag waktu soal
  
  if (player && player.pauseVideo) player.pauseVideo();
  
  // Sembunyikan kontrol dan progress bar
  document.getElementById('control-buttons').classList.add('hidden');
  document.getElementById('progress-container-wrapper').classList.add('hidden');
  
  // Update pertanyaan
  document.getElementById('pertanyaan').textContent = soal.pertanyaan;
  
  // Update opsi jawaban
  const opsiDiv = document.getElementById('opsi');
  opsiDiv.innerHTML = "";
  soal.opsi.forEach((opsi, index) => {
    const btn = document.createElement("button");
    btn.textContent = opsi.teks;
    // Ganti style button opsi agar mirip dengan button kontrol video
    btn.className = "border bg-gradient-to-t from-blue-600 to-blue-500 border-b-4 border-blue-700 py-3 px-4 rounded-xl shadow text-lg text-white font-bold transition-transform duration-150 hover:scale-105 active:border-b-0 touch-manipulation mobile-friendly w-full control-button video-option-btn";
    // Perbaikan hitbox tombol
    btn.style.minHeight = '60px'; // Tinggi minimum yang lebih besar
    btn.style.minWidth = '100%'; // Lebar penuh
    btn.style.marginBottom = '15px'; // Jarak antar tombol yang lebih besar
    btn.style.zIndex = '1002'; // Z-index yang lebih tinggi dari overlay
    btn.style.pointerEvents = 'auto'; // Pastikan pointer events diatur ke auto
    btn.style.touchAction = 'manipulation'; // Optimalkan untuk perangkat sentuh
    btn.onclick = () => jawab(opsi.benar, index, soal);
    opsiDiv.appendChild(btn);
  });
  
  // Sembunyikan feedback
  const feedback = document.getElementById('feedback');
  feedback.className = "mt-6 text-center font-semibold hidden";
  
  // Tampilkan modal
  document.getElementById('soal-modal').classList.remove('hidden');
  document.body.style.overflow = 'hidden'; // Mencegah scroll saat modal terbuka
  
  // Pastikan modal dapat menerima events
  document.getElementById('soal-modal').style.pointerEvents = 'auto';
  document.getElementById('soal-modal').style.zIndex = '1001'; // Z-index untuk modal
}

/* Fungsi untuk menampilkan popup */
function showPopup(message, type) {
  // Buat elemen popup
  const popup = document.createElement('div');
  popup.className = `fixed top-4 right-4 z-[9999] px-6 py-3 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full popup-notification`;
  
  // Tambahkan style berdasarkan type
  if (type === 'success') {
    popup.classList.add('bg-green-500', 'text-white');
  } else {
    popup.classList.add('bg-red-500', 'text-white');
  }
  
  // Tambahkan pesan
  popup.textContent = message;
  
  // Tambahkan ke body
  document.body.appendChild(popup);
  
  // Animasi masuk
  setTimeout(() => {
    popup.classList.remove('translate-x-full');
  }, 10);
  
  // Hapus setelah 2 detik
  setTimeout(() => {
    popup.classList.add('translate-x-full');
    setTimeout(() => {
      if (document.body.contains(popup)) {
        document.body.removeChild(popup);
      }
    }, 300);
  }, 2000);
}

/* Fungsi untuk menampilkan skor akhir */
function showFinalScore() {
  // Buat modal untuk skor akhir
  const modal = document.createElement('div');
  modal.className = "fixed inset-0 bg-black bg-opacity-75 z-[9999] flex items-center justify-center p-4 final-score-modal";
  modal.innerHTML = `
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-8 relative">
      <h2 class="text-2xl font-bold mb-4 text-center">Skor Akhir</h2>
      <p class="text-xl text-center mb-6">Skor kamu: <span class="font-bold text-blue-600">${skor}</span> dari ${daftarSoal.length}</p>
      <div class="flex justify-center gap-4">
        <button id="restart-score" class="border bg-gradient-to-t from-green-600 to-green-500 border-b-4 border-green-700 py-2 px-6 rounded-xl shadow text-lg text-white font-bold transition-transform duration-150 hover:scale-105 active:border-b-0 control-button video-control-btn">
          Main Lagi
        </button>
        <button id="close-score" class="border bg-gradient-to-t from-gray-600 to-gray-500 border-b-4 border-gray-700 py-2 px-6 rounded-xl shadow text-lg text-white font-bold transition-transform duration-150 hover:scale-105 active:border-b-0 control-button video-control-btn">
          Selesai
        </button>
      </div>
    </div>
  `;
  
  // Tambahkan ke body
  document.body.appendChild(modal);
  document.body.style.overflow = 'hidden';
  
  // Tambahkan event listener untuk tombol close
  document.getElementById('close-score').addEventListener('click', () => {
    modal.remove();
    document.body.style.overflow = 'auto';
    resetQuiz();
  });
  
  // Tambahkan event listener untuk tombol restart
  document.getElementById('restart-score').addEventListener('click', () => {
    modal.remove();
    document.body.style.overflow = 'auto';
    resetQuiz();
  });
}

/* Fungsi untuk reset quiz */
function resetQuiz() {
  skor = 0;
  soalIndex = 0;
  totalAnswered = 0; // Reset totalAnswered
  isSoalActive = false; // Reset isSoalActive
  soalTimeReached = false; // Reset soalTimeReached
  maxWatched = 0;
  
  document.getElementById('soal-modal').classList.add('hidden');
  document.body.style.overflow = 'auto';
  document.getElementById('control-buttons').classList.remove('hidden');
  document.getElementById('progress-container-wrapper').classList.remove('hidden');
  
  if (player && player.seekTo) {
    player.seekTo(0, true);
    setTimeout(() => {
      if (player && player.playVideo) {
        player.playVideo();
      }
    }, 150);
  }
}

function jawab(benar, index, soal) {
  isSoalActive = false; // Tandai bahwa soal tidak aktif lagi
  soalTimeReached = false; // Reset flag waktu soal
  
  const feedback = document.getElementById('feedback');
  const opsiButtons = document.querySelectorAll('#opsi button');
  
  // Nonaktifkan semua tombol setelah jawaban dipilih
  opsiButtons.forEach(btn => {
    btn.disabled = true;
    btn.style.opacity = '0.7';
    btn.style.cursor = 'not-allowed';
  });
  
  if (benar) {
    skor++;
    feedback.textContent = "✅ Benar!";
    feedback.className = "mt-6 text-center font-semibold correct";
    
    // Tandai jawaban benar dengan hijau
    opsiButtons[index].style.background = '#10b981';
    
    // Tampilkan popup benar
    showPopup("✅ Jawaban Benar!", "success");
    
    // Tutup modal setelah 2 detik
    setTimeout(() => {
      document.getElementById('soal-modal').classList.add('hidden');
      document.body.style.overflow = 'auto'; // Kembalikan scroll
      
      // Tampilkan kembali kontrol dan progress bar
      document.getElementById('control-buttons').classList.remove('hidden');
      document.getElementById('progress-container-wrapper').classList.remove('hidden');
      
      // Tambah jumlah soal yang sudah dijawab
      totalAnswered++;
      
      // Periksa apakah semua soal sudah dijawab
      if (totalAnswered >= daftarSoal.length) {
        // Tampilkan skor akhir
        showFinalScore();
      } else {
        // Lanjutkan ke video
        player.playVideo();
      }
    }, 2000);
  } else {
    feedback.textContent = "❌ Salah!";
    feedback.className = "mt-6 text-center font-semibold incorrect";
    
    // Tandai jawaban salah dengan merah
    opsiButtons[index].style.background = '#ef4444';
    
    // Tampilkan popup salah
    showPopup("❌ Jawaban Salah!", "error");
    
    // Tutup modal setelah 2 detik
    setTimeout(() => {
      document.getElementById('soal-modal').classList.add('hidden');
      document.body.style.overflow = 'auto'; // Kembalikan scroll
      
      // Tampilkan kembali kontrol dan progress bar
      document.getElementById('control-buttons').classList.remove('hidden');
      document.getElementById('progress-container-wrapper').classList.remove('hidden');
      
      // Tambah jumlah soal yang sudah dijawab
      totalAnswered++;
      
      // Periksa apakah semua soal sudah dijawab
      if (totalAnswered >= daftarSoal.length) {
        // Tampilkan skor akhir
        showFinalScore();
      } else {
        // Lanjutkan ke video
        player.playVideo();
      }
    }, 2000);
  }
}

/* --- YouTube API Ready --- */
window.onYouTubeIframeAPIReady = function () {
  player = new YT.Player("player", {
    events: {
      onReady: () => {
        console.log("✅ Player siap - tombol aktif");
        enableButtons();
        setupMobileControls();
        setupMobileProgressBar();
        setupDoubleTapPrevention();
      },
      onError: (e) => {
        console.error("⚠️ YouTube error:", e.data);
      }
    }
  });

  if (window._ytUpdateInterval) clearInterval(window._ytUpdateInterval);
  window._ytUpdateInterval = setInterval(mainUpdateLoop, 250);
};

/* --- Main Loop --- */
function mainUpdateLoop(){
  if (!player || !player.getDuration) return;
  const dur = player.getDuration();
  if (!dur) return;
  const now = player.getCurrentTime();

  if (player.getPlayerState && player.getPlayerState() === YT.PlayerState.PLAYING && now > maxWatched + TOLERANCE) {
    player.seekTo(maxWatched, true);
    return;
  }

  if (now > maxWatched) maxWatched = now;

 // progress bar
  if (!dragging) {
    if (videoStarted) {
      bar.style.width = `calc(10px + ${(now / dur) * 100}%)`;
    } else {
      bar.style.width = "0px";
    }
  }

  // watched bar
  if (videoStarted) {
    watchedBar.style.width = `calc(10px + ${(maxWatched / dur) * 100}%)`;
  } else {
    watchedBar.style.width = "0px";
  }



  if (soalIndex < daftarSoal.length && Math.floor(now) >= daftarSoal[soalIndex].waktu) {
    soalTimeReached = true; // Tandai bahwa waktu soal tercapai
    tampilkanSoal(daftarSoal[soalIndex]);
    soalIndex++;
  }
}

/* --- Progress Bar --- */
function setupMobileProgressBar() {
  // Deteksi perangkat mobile
  const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
  
  if (isMobile) {
    // Hapus event mouse untuk mobile
    container.removeEventListener('mousemove', handleMouseMove);
    container.removeEventListener('mouseleave', handleMouseLeave);
    container.removeEventListener('mousedown', handleMouseDown);
    document.removeEventListener('mouseup', handleMouseUp);
    
    // Tambahkan event touch khusus untuk progress bar di mobile
    container.addEventListener('touchstart', handleTouchStart, { passive: false });
    container.addEventListener('touchmove', handleTouchMove, { passive: false });
    container.addEventListener('touchend', handleTouchEnd);
    container.addEventListener('touchcancel', handleTouchCancel);
  }
}

function handleTouchStart(e) {
  e.preventDefault();
  dragging = true;
  wasPlayingBeforeDrag = (player && player.getPlayerState && player.getPlayerState() === YT.PlayerState.PLAYING);
  if (player && player.pauseVideo) player.pauseVideo();
  
  const waktu = getTimeFromEvent(e);
  bar.style.width = (waktu / player.getDuration()) * 100 + "%";
  tooltip.textContent = formatTime(waktu);
  tooltip.style.opacity = '1';
}

function handleTouchMove(e) {
  e.preventDefault();
  if (!dragging) return;
  
  const waktu = getTimeFromEvent(e);
  bar.style.width = (waktu / player.getDuration()) * 100 + "%";
  tooltip.textContent = formatTime(waktu);
  
  const rect = container.getBoundingClientRect();
  const clientX = e.touches[0].clientX;
  const offsetX = clientX - rect.left;
  tooltip.style.left = (offsetX - tooltip.offsetWidth/2) + "px";
}

function handleTouchEnd(e) {
  if (!dragging) return;
  dragging = false;
  tooltip.style.opacity = '0';
  
  const waktu = getTimeFromEvent(e);
  if (waktu <= maxWatched + 0.1) {
    player.seekTo(waktu, true);
  } else {
    player.seekTo(maxWatched, true);
  }
  
  if (wasPlayingBeforeDrag) {
    setTimeout(() => {
      if (player && player.playVideo) player.playVideo();
    }, 150);
  }
}

function handleTouchCancel(e) {
  if (!dragging) return;
  dragging = false;
  tooltip.style.opacity = '0';
  
  if (wasPlayingBeforeDrag) {
    setTimeout(() => {
      if (player && player.playVideo) player.playVideo();
    }, 150);
  }
}

// Event handler untuk desktop
function handleMouseMove(e) {
  const dur = (player && player.getDuration && player.getDuration()) || 0;
  if (!dur) return;
  const waktuPreview = getTimeFromEvent(e);
  tooltip.textContent = formatTime(waktuPreview);
  const rect = container.getBoundingClientRect();
  let offsetX = e.clientX - rect.left;
  offsetX = Math.max(0, Math.min(rect.width, offsetX));
  tooltip.style.left = (offsetX - tooltip.offsetWidth/2) + "px";
  tooltip.style.opacity = '1';
  if (dragging) {
    bar.style.width = Math.max(0, Math.min(100, (waktuPreview / dur) * 100)) + "%";
  }
}

function handleMouseLeave() {
  if (!dragging) tooltip.style.opacity = '0';
}

function handleMouseDown(e) {
  dragging = true;
  wasPlayingBeforeDrag = (player && player.getPlayerState && player.getPlayerState() === YT.PlayerState.PLAYING);
  if (player && player.pauseVideo) player.pauseVideo();
}

function handleMouseUp(e) {
  if (!dragging) return;
  dragging = false;
  tooltip.style.opacity = '0';
  const dur = (player && player.getDuration && player.getDuration()) || 0;
  if (!dur) return;
  const target = getTimeFromEvent(e);
  if (target <= maxWatched + 0.1) player.seekTo(target, true);
  else player.seekTo(maxWatched, true);
  if (wasPlayingBeforeDrag) setTimeout(() => player.playVideo(), 150);
}

// Event handler untuk desktop
["mousemove", "mouseleave"].forEach(evt => {
  container.addEventListener(evt, (e) => {
    if (evt === "mousemove") handleMouseMove(e);
    else handleMouseLeave();
  });
});

container.addEventListener('mousedown', handleMouseDown);
document.addEventListener('mouseup', handleMouseUp);

container.addEventListener('click', (e) => {
  const target = getTimeFromEvent(e);
  if (target <= maxWatched + 0.1) player.seekTo(target, true);
  else player.seekTo(maxWatched, true);
});

/* --- Mencegah Double-Tap Skip --- */
function setupDoubleTapPrevention() {
  const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
  
  if (isMobile) {
    // Buat overlay untuk menangani touch events
    videoOverlay = document.createElement('div');
    videoOverlay.style.position = 'absolute';
    videoOverlay.style.top = '0';
    videoOverlay.style.left = '2px';
    videoOverlay.style.width = '100%';
    videoOverlay.style.height = '100%';
    videoOverlay.style.zIndex = '999'; // Z-index untuk video overlay
    videoOverlay.style.pointerEvents = 'none'; // Default: tidak menangani events
    videoOverlay.style.touchAction = 'none'; // Mencegah double-tap zoom
    
    // Tambahkan overlay ke dalam video container
    const videoContainer = document.getElementById('video-container');
    videoContainer.style.position = 'relative';
    videoContainer.appendChild(videoOverlay);
    
    // Fungsi untuk memeriksa apakah touch pada area yang diizinkan
    function isAllowedArea(element) {
      // Izinkan pada tombol kontrol dan opsi jawaban
      return element.closest('.control-button') || 
             element.closest('.video-control-btn') || 
             element.closest('.video-option-btn');
    }
    
    // Set pointer events ke 'auto' untuk video area
    videoOverlay.addEventListener('touchstart', function(e) {
      const currentTime = new Date().getTime();
      
      // Reset tap count jika lebih dari 300ms sejak tap terakhir
      if (currentTime - lastTapTime > 300) {
        tapCount = 0;
      }
      
      tapCount++;
      lastTapTime = currentTime;
      
      // Deteksi double-tap
      if (tapCount === 2) {
        e.preventDefault();
        e.stopPropagation();
        
        // Cari elemen yang di-tap
        const touch = e.touches[0];
        const element = document.elementFromPoint(touch.clientX, touch.clientY);
        
        // Jika tap pada area yang bukan tombol, cegah skip
        if (!isAllowedArea(element)) {
          // Jika ada soal aktif atau waktu soal tercapai, jangan izinkan skip
          if (isSoalActive || soalTimeReached) {
            // Cancel skip dengan seek ke waktu sebelumnya
            const currentTime = player.getCurrentTime();
            player.seekTo(currentTime, true);
            
            // Reset tap count
            tapCount = 0;
            return;
          }
          
          // Cancel skip dengan seek ke waktu sebelumnya
          const currentTime = player.getCurrentTime();
          player.seekTo(currentTime, true);
          
          // Reset tap count
          tapCount = 0;
        }
      }
    }, { passive: false });
    
    // Mencegah double-tap zoom pada seluruh halaman
    let lastTouchEnd = 0;
    document.addEventListener('touchend', function(event) {
      const now = (new Date()).getTime();
      if (now - lastTouchEnd <= 300) {
        event.preventDefault();
      }
      lastTouchEnd = now;
    }, false);
    
    // Atur pointer events untuk video container
    videoContainer.style.pointerEvents = 'none';
    videoContainer.style.touchAction = 'none';
    
    // Atur pointer events untuk iframe
    const iframe = document.getElementById('player');
    if (iframe) {
      iframe.style.pointerEvents = 'none';
      iframe.style.touchAction = 'none';
    }
  }
}

/* --- Enable Buttons after Ready - Diperbaiki untuk Responsivitas --- */
function enableButtons(){
  console.log("🔧 Membuat tombol kontrol video yang responsif...");
  
const playHandler = () => {
  console.log("▶️ Tombol Play ditekan");
  if (player && player.playVideo) {
    player.playVideo();
    videoStarted = true; // tandai video sudah mulai
  }
};


  
  // Fungsi untuk pause
  const pauseHandler = () => {
    console.log("⏸️ Tombol Pause ditekan");
    if (player && player.pauseVideo) {
      player.pauseVideo();
    }
  };
  
  // Fungsi untuk restart
  const restartHandler = () => {
    console.log("🔄 Tombol Restart ditekan");
    resetQuiz();
  };
  
  // Fungsi untuk membuat tombol yang sangat sederhana dan pasti responsif
  const setupButton = (id, text, handler, colorClass) => {
    // Cari tombol yang sudah ada
    let button = document.getElementById(id);
    
    // Jika tidak ada, buat yang baru
    if (!button) {
      button = document.createElement('button');
      button.id = id;
      button.textContent = text;
      
      // Cari parent yang tepat
      const parent = document.querySelector(`#${id}-wrapper`) || 
                    document.querySelector('.control-buttons') || 
                    document.body;
      parent.appendChild(button);
    }
    
    // Hapus semua event listeners lama
    const newButton = button.cloneNode(true);
    button.parentNode.replaceChild(newButton, button);
    button = newButton;

    // Tambahkan event listeners yang sangat sederhana
    button.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      console.log(`🎯 ${id} clicked!`);
      handler();
      // Visual feedback
      button.style.transform = 'scale(0.95)';
      setTimeout(() => {
        button.style.transform = '';
      }, 100);
    });
    
    // Touch event untuk mobile
    button.addEventListener('touchstart', (e) => {
      e.preventDefault();
      e.stopPropagation();
      console.log(`🎯 ${id} touched!`);
      handler();
      // Visual feedback
      button.style.transform = 'scale(0.95)';
    }, { passive: false });
    
    button.addEventListener('touchend', (e) => {
      e.preventDefault();
      setTimeout(() => {
        button.style.transform = '';
      }, 100);
    }, { passive: false });
    
    // Keyboard support
    button.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        console.log(`⌨️ ${id} keydown!`);
        handler();
      }
    });
    
    // Mouse events
    button.addEventListener('mousedown', (e) => {
      e.preventDefault();
      button.style.transform = 'scale(0.95)';
    });
    
    button.addEventListener('mouseup', (e) => {
      e.preventDefault();
      button.style.transform = '';
    });
    
    button.addEventListener('mouseleave', (e) => {
      button.style.transform = '';
    });
    
    return button;
  };
  
  // Buat tombol dengan warna yang berbeda
  const newBtnPlay = setupButton('btnPlay', '▶ Play', playHandler, '#16a34a'); // green
  const newBtnPause = setupButton('btnPause', '⏸ Pause', pauseHandler, '#dc2626'); // red
  const newBtnRestart = setupButton('btnRestart', '🔄 Ulang', restartHandler, '#d97706'); // orange
  
  // Update referensi tombol
  window.btnPlay = newBtnPlay;
  window.btnPause = newBtnPause;
  window.btnRestart = newBtnRestart;
  
  console.log("✅ Tombol kontrol video sudah dibuat dan responsif!");
  
  // Tambahkan ke DOM untuk memastikan visible
  [newBtnPlay, newBtnPause, newBtnRestart].forEach(btn => {
    if (!document.body.contains(btn)) {
      document.body.appendChild(btn);
    }
  });
}

// Fungsi untuk menambahkan event listeners global
function addGlobalButtonListeners() {
  // Pastikan tombol dapat diakses dengan baik
  const buttons = document.querySelectorAll('.video-control-btn');
  buttons.forEach(btn => {
    // Tambahkan hover effects yang lebih baik
    btn.addEventListener('mouseenter', () => {
      btn.style.transform = 'scale(1.05)';
    });
    
    btn.addEventListener('mouseleave', () => {
      btn.style.transform = '';
    });
    
    // Tambahakan keyboard support
    btn.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        btn.click();
      }
    });
  });
}

// Setup untuk mobile
function setupMobileControls() {
  // Deteksi perangkat mobile
  const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
  
  if (isMobile) {
    // Tambahkan class ke body untuk mobile
    document.body.classList.add('mobile-device');
    
    // Atur z-index tombol untuk mobile
    const buttons = document.querySelectorAll('.control-button, .video-control-btn, .video-option-btn');
    buttons.forEach(btn => {
      btn.style.zIndex = '1003'; // Z-index yang lebih tinggi dari overlay video
      btn.style.minHeight = '60px'; // Tinggi minimum yang lebih besar
      btn.style.minWidth = '100%'; // Lebar penuh
      btn.style.marginBottom = '15px'; // Jarak antar tombol yang lebih besar
      btn.style.pointerEvents = 'auto'; // Pastikan pointer events diatur ke auto
      btn.style.touchAction = 'manipulation'; // Optimalkan untuk perangkat sentuh
      
      // Tambahakan visual feedback untuk mobile
      btn.addEventListener('touchstart', () => {
        btn.style.transform = 'scale(0.95)';
      });
      
      btn.addEventListener('touchend', () => {
        btn.style.transform = '';
      });
    });
    
    // Tambahakan event touch untuk video container
    const videoContainer = document.getElementById('video-container');
    videoContainer.addEventListener('touchstart', function(e) {
      // Cek apakah touch terjadi pada tombol
      if (e.target.closest('.control-button') || e.target.closest('.video-control-btn') || e.target.closest('.video-option-btn')) {
        e.preventDefault();
        e.stopPropagation();
        return;
      }
      // Jika tidak, lanjutkan dengan logika drag
      dragging = true;
      wasPlayingBeforeDrag = (player && player.getPlayerState && player.getPlayerState() === YT.PlayerState.PLAYING);
      if (player && player.pauseVideo) player.pauseVideo();
    }, { passive: false });
    
    // Pastikan tombol tidak tertutup oleh overlay
    const overlay = document.getElementById('soal-modal');
    if (overlay) {
      overlay.style.maxHeight = '100vh'; // Ubah agar memenuhi seluruh layar
      overlay.style.overflowY = 'auto';
      overlay.style.pointerEvents = 'auto'; // Pastikan overlay dapat menerima events
      overlay.style.zIndex = '1001'; // Z-index untuk modal (lebih rendah dari tombol)
    }
  }
}

// Pastikan script di-load dengan benar
document.addEventListener('DOMContentLoaded', function() {
  // Inisialisasi YouTube API
  if (typeof YT === 'undefined') {
    const tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    const firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
  }
  
  // Tambahakan event listeners untuk tombol saat DOM ready
  setTimeout(() => {
    addGlobalButtonListeners();
  }, 100);
});