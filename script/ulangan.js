// --- Daftar Soal ---
let soal = [
  {
    pertanyaan: "Pertumbuhan menekankan pada perubahan...",
    pilihan: ["Kuantitatif", "Kualitatif", "Mental", "Perilaku"],
    jawabanBenar: 0,
    gambar: "../img/ulanganBab1.png"
  },
  {
    pertanyaan: "Contoh pertumbuhan adalah...",
    pilihan: ["Suara mulai berubah", "Tinggi badan bertambah", "Muncul jerawat", "Perilaku semakin dewasa"],
    jawabanBenar: 1,
    gambar: "../img/ulanganBab1.png"
  },
  {
    pertanyaan: "Pertumbuhan dapat diukur dengan...",
    pilihan: ["Timbangan dan penggaris", "Tes IQ", "Tes kepribadian", "Pengamatan sosial"],
    jawabanBenar: 0,
    gambar: ""
  }
];

// --- Fungsi untuk mengacak array ---
function acakArray(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]];
  }
  return array;
}

// --- Acak urutan soal ---
soal = acakArray(soal);

// --- Variabel Utama ---
let currentSoal = 0;
let jawabanUser = new Array(soal.length).fill(null);
const waktuMulai = 2 * 60; // 2 menit
let sisaWaktu = waktuMulai;
let timerInterval;

// --- Elemen HTML ---
const soalContainer = document.getElementById("soalContainer");
const nextBtn = document.getElementById("nextBtn");
const pagination = document.getElementById("pagination");
const progressBar = document.getElementById("progressBar");
const progressText = document.getElementById("progressText");
const modalPeringatan = document.getElementById("modalPeringatan");
const closeModal = document.getElementById("closeModal");
const hasilContainer = document.getElementById("hasilContainer");
const hasilList = document.getElementById("hasilList");

// --- Fungsi Tampilkan Soal ---
function tampilkanSoal(index) {
  const s = soal[index];
  soalContainer.innerHTML = `
    <div class="bg-main text-white p-4 rounded-lg">
      <p class="text-lg font-semibold">${index + 1}. ${s.pertanyaan}</p>
    </div>

    <div class="mt-6 flex flex-col-reverse lg:flex-row gap-6 justify-between items-start min-h-[45vh] max-h-[45vh]">
      <div class="space-y-3 w-full lg:w-2/4">
        ${s.pilihan.map((p, i) => `
          <label class="flex items-center gap-3 cursor-pointer">
            <input type="radio" name="soal${index}" ${jawabanUser[index] === i ? 'checked' : ''} class="accent-main" onclick="pilihJawaban(${index}, ${i})">
            <span class="text-lg">${p}</span>
          </label>
        `).join('')}
      </div>
      <div class="w-full lg:w-2/4 flex justify-center items-center">
        ${
          s.gambar
            ? `<img src="${s.gambar}" alt="Gambar Soal" class="mt-10 rounded-lg shadow-md max-h-56 object-contain">`
            : `<div class="w-40 h-32 border-2 border-dashed border-gray-300 rounded-lg flex justify-center items-center text-gray-400">
                <span class="text-sm">Tidak ada gambar</span>
              </div>`
        }
      </div>
    </div>
  `;

  updatePagination();
  updateButton();
  updateProgress();
}

// --- Pilih Jawaban ---
function pilihJawaban(index, pilihan) {
  jawabanUser[index] = pilihan;
  updateProgress();
  updatePagination();
}

// --- Update Pagination ---
function updatePagination() {
  pagination.innerHTML = soal.map((_, i) => `
    <button class="px-3 py-1 rounded-lg transition ${i === currentSoal
      ? 'bg-main text-white'
      : jawabanUser[i] !== null
        ? 'bg-green-200 text-green-800'
        : 'bg-gray-200 text-gray-800'
    }" onclick="gantiSoal(${i})">${i + 1}</button>
  `).join('');
}

// --- Ganti Soal ---
function gantiSoal(index) {
  currentSoal = index;
  tampilkanSoal(currentSoal);
}

// --- Update Tombol ---
function updateButton() {
  nextBtn.textContent = currentSoal === soal.length - 1 ? "Kirim Jawaban" : "Selanjutnya";
}

// --- Update Progress Bar & Teks ---
function updateProgress() {
  const terjawab = jawabanUser.filter(j => j !== null).length;
  const persen = (terjawab / soal.length) * 100;
  progressBar.style.width = persen + "%";
  progressText.textContent = `${terjawab}/${soal.length} Soal Terjawab`;
}

// --- Tampilkan Hasil ---
function tampilkanHasil() {
  soalContainer.parentElement.classList.add("hidden");
  hasilContainer.classList.remove("hidden");

  hasilList.innerHTML = soal.map((s, i) => {
    const benar = s.jawabanBenar === jawabanUser[i];
    return `
      <div class="p-4 rounded-lg border ${benar ? 'bg-green-100 border-green-400' : 'bg-red-100 border-red-400'} min-h-[40vh] flex flex-col lg:flex-row justify-between items-start gap-6">
        <div class="w-full lg:w-2/4 flex flex-col justify-center space-y-2">
          <p class="font-semibold">${i + 1}. ${s.pertanyaan}</p>
          <p>Jawaban Kamu: <b>${s.pilihan[jawabanUser[i]] ?? "Belum Dijawab"}</b></p>
          <p>Jawaban Benar: <b>${s.pilihan[s.jawabanBenar]}</b></p>
          <p class="text-sm italic ${benar ? 'text-green-700' : 'text-red-700'}">
            ${benar ? '✅ Jawaban kamu benar' : '❌ Jawaban kamu salah'}
          </p>
        </div>
        <div class="w-full lg:w-2/4 flex justify-center items-center">
          ${
            s.gambar
              ? `<img src="${s.gambar}" alt="Gambar Soal" class="rounded-lg shadow-md max-h-56 object-contain">`
              : `<div class="w-40 h-32 border-2 border-dashed border-gray-300 rounded-lg flex justify-center items-center text-gray-400">
                  <span class="text-sm">Tidak ada gambar</span>
                </div>`
          }
        </div>
      </div>
    `;
  }).join('');
}

// --- Navigasi Soal ---
nextBtn.addEventListener("click", () => {
  if (currentSoal === soal.length - 1) {
    if (jawabanUser.includes(null)) {
      modalPeringatan.classList.remove("hidden");
    } else {
      tampilkanHasil();
      clearInterval(timerInterval);
    }
  } else {
    currentSoal++;
    tampilkanSoal(currentSoal);
  }
});

// --- Tutup Modal ---
closeModal.addEventListener("click", () => {
  modalPeringatan.classList.add("hidden");
});

// --- Timer ---
function mulaiTimer() {
  timerInterval = setInterval(() => {
    const menit = Math.floor(sisaWaktu / 60);
    const detik = sisaWaktu % 60;
    document.getElementById("time").textContent = `${menit.toString().padStart(2, "0")}:${detik.toString().padStart(2, "0")}`;
    sisaWaktu--;

    if (sisaWaktu < 0) {
      clearInterval(timerInterval);
      tampilkanHasil();
    }
  }, 1000);
}

// --- Jalankan ---
tampilkanSoal(0);
mulaiTimer();
