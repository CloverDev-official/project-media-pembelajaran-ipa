const quizData = [
{
question: "Pertumbuhan menekankan pada perubahan...",
options: ["Kualitatif", "Kuantitatif", "Mental", "Perilaku"],
answer: 1
},
{
question: "Perkembangan lebih mengarah pada perubahan...",
options: ["Ukuran tubuh", "Jumlah sel", "Kualitas (fungsi/kedewasaan)", "Berat badan"],
answer: 2
},
{
question: "Contoh pertumbuhan adalah...",
options: ["Suara mulai berubah", "Tinggi badan bertambah", "Muncul jerawat", "Perilaku semakin dewasa"],
answer: 1
},
{
question: "Pertumbuhan dapat diukur dengan...",
options: ["Timbangan dan penggaris", "Tes IQ", "Tes kepribadian", "Pengamatan sosial"],
answer: 0
},
{
question: "Perubahan suara pada masa pubertas termasuk contoh...",
options: ["Pertumbuhan", "Perkembangan", "Kuantitatif", "Fisiologis saja"],
answer: 1
},
{
question: "Pertumbuhan terjadi karena...",
options: ["Penambahan jumlah dan ukuran sel", "Meningkatnya kedewasaan", "Perubahan sikap", "Kematangan berpikir"],
answer: 0
},
{
question: "Perkembangan psikomotorik dapat dilihat dari...",
options: ["Tinggi badan", "Berat badan", "Kemampuan berjalan", "Ukuran kepala"],
answer: 2
},
{
question: "Faktor utama yang memengaruhi pertumbuhan adalah...",
options: ["Nutrisi, hormon, dan genetik", "Pengalaman hidup", "Hubungan sosial", "Latihan keterampilan"],
answer: 0
},
{
question: "Perkembangan intelektual dapat dicontohkan dengan...",
options: ["Bertambahnya berat badan", "Mampu memecahkan masalah", "Tulang semakin panjang", "Jumlah gigi bertambah"],
answer: 1
},
{
question: "Pertumbuhan dan perkembangan berlangsung...",
options: ["Statis", "Dinamis dan berkesinambungan", "Sekali saja", "Tidak dapat diprediksi"],
answer: 1
}
];


let currentQuestion = 0;
let userAnswers = new Array(quizData.length).fill(null);
let timer;
let timeLeft = 600; // 10 menit

const startSection = document.getElementById("startSection");
const timerSection = document.getElementById("timerSection");
const quizSection = document.getElementById("quizSection");
const questionContainer = document.getElementById("questionContainer");
const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");
const timerDisplay = document.getElementById("timer");
const startBtn = document.getElementById("startBtn");
const confirmStartBtn = document.getElementById("confirmStartBtn");

// warna opsi
const optionColors = ["bg-blue-500", "bg-yellow-500", "bg-red-500", "bg-purple-500"];

// tampilkan soal
function showQuestion(index) {
const q = quizData[index];
questionContainer.innerHTML = `
<h2 class="text-lg font-bold mb-4">Soal ${index + 1} dari ${quizData.length}</h2>
<p class="mb-4">${q.question}</p>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 md:gap-4">
  ${q.options.map((opt, i) => {
  // jika jawaban sudah dipilih, beri hijau
  const isSelected = userAnswers[index] === i;
  const btnClass = isSelected
  ? "option-btn py-5 px-5 w-[15rem] md:h-[10rem] md rounded-lg border-2 font-bold text-xl text-center transition-all active:scale-95 bg-green-600 text-white border-black"
  : `option-btn py-5 px-5 w-[15rem] md:h-[10rem] rounded-lg border-2 font-bold text-xl text-center transition-all
  active:scale-95 ${optionColors[i]} text-white hover:opacity-80`;

  return `
  <div class="flex justify-center">
    <button onclick="selectAnswer(${index}, ${i}, this)" class="${btnClass}">
      ${opt}
    </button>
  </div>
  `;
  }).join("")}
</div>
`;

renderNav();

// kontrol tombol prev/next
if (index === 0) {
prevBtn.style.display = "none";
nextBtn.parentNode.classList.replace("justify-between", "justify-end");
} else {
prevBtn.style.display = "inline-block";
nextBtn.parentNode.classList.replace("justify-end", "justify-between");
}

if (index === quizData.length - 1) {
nextBtn.textContent = "Kirim Jawaban";
nextBtn.classList.replace("bg-linear-to-t from-blue-600 to-blue-500 border-b-4 border-blue-700", "bg-linear-to-t from-red-600 to-red-500 border-b-4 border-red-700"); nextBtn.classList.replace("hover:scale-110", "hover:scale-110");
} else {
nextBtn.textContent = "Selanjutnya";
nextBtn.classList.replace("bg-linear-to-t from-red-600 to-red-500 border-b-4 border-red-700", "bg-linear-to-t from-blue-600 to-blue-500 border-b-4 border-blue-700");
nextBtn.classList.replace("hover:scale-110", "hover:scale-110");
}



// ... kontrol tombol next/prev tetap sama


// kontrol tombol
if (index === 0) {
prevBtn.style.display = "none";
nextBtn.parentNode.classList.replace("justify-between", "justify-end");
} else {
prevBtn.style.display = "inline-block";
nextBtn.parentNode.classList.replace("justify-end", "justify-between");
}

if (index === quizData.length - 1) {
nextBtn.textContent = "Kirim Jawaban";
nextBtn.classList.replace("bg-linear-to-t from-blue-600 to-blue-500 border-b-4 border-blue-700", "bg-linear-to-t from-red-600 to-red-500 border-b-4 border-red-700");
nextBtn.classList.replace("hover:scale-110", "hover:scale-110");
} else {
nextBtn.textContent = "Selanjutnya";
nextBtn.classList.replace("bg-linear-to-t from-red-600 to-red-500 border-b-4 border-red-700", "bg-linear-to-t from-blue-600 to-blue-500 border-b-4 border-blue-700");
nextBtn.classList.replace("hover:scale-110", "hover:scale-110");
}
}

function selectAnswer(qIndex, optIndex, btn) {
const buttons = btn.parentNode.parentNode.querySelectorAll("button.option-btn");

// reset semua tombol ke warna awal
buttons.forEach((b, idx) => {
b.className = `option-btn py-5 px-5 w-[15rem] md:h-[10rem] rounded-lg border-2 font-bold text-xl text-center
transition-all active:scale-95 ${optionColors[idx]} text-white hover:opacity-80`;
});

// beri warna hijau untuk tombol yang diklik
btn.className = `option-btn py-5 px-5 w-[15rem] md:h-[10rem] rounded-lg border-2 font-bold text-xl text-center
transition-all active:scale-95 bg-green-600 text-white border-black`;

// simpan jawaban
userAnswers[qIndex] = optIndex;
}




// === Timer ===
function updateTimer() {
  let minutes = Math.floor(timeLeft / 60);
  let seconds = timeLeft % 60;

  timerDisplay.textContent = `Waktu: ${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;

  if (timeLeft <= 0) {
    clearInterval(timer);
    submitQuiz();
  }
  timeLeft--;
}

// === Modal Control ===
function openModal() {
  document.getElementById("warningModal").classList.remove("hidden");
  document.body.classList.add("overflow-hidden");
}

function closeModal() {
  document.getElementById("warningModal").classList.add("hidden");
  document.body.classList.remove("overflow-hidden");
}

function openStartModal() {
  document.getElementById("startModal").classList.remove("hidden");
  document.body.classList.add("overflow-hidden");
}

function closeStartModal() {
  document.getElementById("startModal").classList.add("hidden");
  document.body.classList.remove("overflow-hidden");
}

// === Tombol Start ===
startBtn.addEventListener("click", () => {
  openStartModal();
});

confirmStartBtn.addEventListener("click", () => {
  closeStartModal();
  startQuiz();
});


  // mulai quiz
  function startQuiz() {
  startSection.classList.add("hidden");
  timerSection.classList.remove("hidden");
  quizSection.classList.remove("hidden");
  showQuestion(currentQuestion);
  timer = setInterval(updateTimer, 1000);
  }

  // navigasi next
  nextBtn.addEventListener("click", () => {
  if (currentQuestion < quizData.length - 1) { currentQuestion++; showQuestion(currentQuestion); } else { if
    (userAnswers.includes(null)) { openModal(); return; } submitQuiz(); } }); // navigasi prev
    prevBtn.addEventListener("click", ()=> {
    if (currentQuestion > 0) {
    currentQuestion--;
    showQuestion(currentQuestion);
    }
    });

    // render nomor soal
    function renderNav() {
    const nav = document.getElementById("questionNav");
    nav.innerHTML = quizData.map((_, i) => {
    let baseClass = "w-10 h-10 flex items-center justify-center rounded-full font-bold cursor-pointer ";

    if (userAnswers[i] !== null) {
    baseClass += "bg-green-500 text-white"; // sudah dijawab
    } else {
    baseClass += "bg-gray-300 text-gray-700"; // belum dijawab
    }

    if (i === currentQuestion) {
    baseClass += " ring-4 ring-blue-500"; // soal aktif
    }

    return `<div class="${baseClass}" onclick="jumpTo(${i})">${i + 1}</div>`;
    }).join("");
    }

    // lompat ke soal tertentu
    function jumpTo(index) {
    currentQuestion = index;
    showQuestion(currentQuestion);
    }








    // submit quiz
    function submitQuiz() {
    clearInterval(timer);
    let score = 0;

    quizSection.innerHTML = `
    <h2 class="text-xl font-bold mb-4">Hasil Latihan</h2>
    <div id="resultContainer" class="space-y-6"></div>
    <p class="mt-4">Kamu menjawab benar <b id="finalScore"></b> dari ${quizData.length} soal.</p>
    <button onclick="location.reload()"
      class="mt-4 px-6 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-600">
      Ulangi Latihan
    </button>
    `;

    const resultContainer = document.getElementById("resultContainer");

    quizData.forEach((q, i) => {
    const userAnswer = userAnswers[i];
    const correctAnswer = q.answer;

    if (userAnswer === correctAnswer) score++;

    const optionsHtml = q.options.map((opt, idx) => {
    let classes = "py-2 px-4 rounded-lg border-2 ";

    if (idx === correctAnswer) {
    classes += "bg-green-500 text-white border-green-600";
    } else if (idx === userAnswer && userAnswer !== correctAnswer) {
    classes += "bg-red-500 text-white border-red-600";
    } else {
    classes += "bg-white text-gray-600 border-gray-300";
    }

    return `<div class="${classes}">${opt}</div>`;
    }).join("");

    resultContainer.innerHTML += `
    <div class="p-4 border rounded-lg shadow">
      <p class="font-semibold mb-2">Soal ${i + 1}: ${q.question}</p>
      <div class="grid gap-2">${optionsHtml}</div>
    </div>
    `;
    });

    document.getElementById("finalScore").textContent = score;
    }
    