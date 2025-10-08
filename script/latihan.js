// ==========================
// 🔹 DATA SOAL
// ==========================
let quizData = [
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

// ==========================
// 🔹 VARIABEL GLOBAL
// ==========================
let currentQuestion = 0;
let userAnswers = [];
let timer;
let timeLeft = 600;
let timerDisplay;

// ==========================
// 🔹 INISIALISASI SAAT DOM READY
// ==========================
document.addEventListener("DOMContentLoaded", () => {
  const startSection = document.getElementById("startSection");
  const timerSection = document.getElementById("timerSection");
  const quizSection = document.getElementById("quizSection");
  const questionContainer = document.getElementById("questionContainer");
  const prevBtn = document.getElementById("prevBtn");
  const nextBtn = document.getElementById("nextBtn");
  const startBtn = document.getElementById("startBtn");
  const confirmStartBtn = document.getElementById("confirmStartBtn");
  const cancelStartBtn = document.getElementById("cancelStartBtn");
  const closeWarningBtn = document.getElementById("closeWarningBtn");
  timerDisplay = document.getElementById("timer");

  const optionColors = ["bg-blue-500", "bg-yellow-500", "bg-red-500", "bg-purple-500"];

  // ==========================
  // 🔹 FUNGSI UTILITAS
  // ==========================
  function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
  }

  // ==========================
  // 🔹 TAMPILKAN SOAL
  // ==========================
  function showQuestion(index) {
    const q = quizData[index];

    if (!q.shuffledOptions) {
      let optionsWithIndex = q.options.map((opt, i) => ({
        text: opt,
        isCorrect: i === q.answer
      }));

      optionsWithIndex = shuffleArray(optionsWithIndex);
      q.shuffledOptions = optionsWithIndex;
      q.shuffledAnswerIndex = optionsWithIndex.findIndex(opt => opt.isCorrect);
    }

    questionContainer.innerHTML = `
      <h2 class="text-lg font-bold mb-4">Soal ${index + 1} dari ${quizData.length}</h2>
      <p class="mb-4">${q.question}</p>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 md:gap-4">
        ${q.shuffledOptions.map((opt, i) => {
          const isSelected = userAnswers[index] === i;
          const btnClass = isSelected
            ? "option-btn py-5 px-5 w-[15rem] md:h-[10rem] rounded-lg border-2 font-bold text-xl bg-green-600 text-white border-black"
            : `option-btn py-5 px-5 w-[15rem] md:h-[10rem] rounded-lg border-2 font-bold text-xl ${optionColors[i]} text-white hover:opacity-80`;
          return `
            <div class="flex justify-center">
              <button onclick="selectAnswer(${index}, ${i}, this)" class="${btnClass}">
                ${opt.text}
              </button>
            </div>`;
        }).join("")}
      </div>
    `;

    renderNav();

    prevBtn.style.display = index === 0 ? "none" : "inline-block";
    nextBtn.textContent = index === quizData.length - 1 ? "Kirim Jawaban" : "Selanjutnya";
  }

  // ==========================
  // 🔹 PILIH JAWABAN
  // ==========================
  window.selectAnswer = function (qIndex, optIndex, btn) {
    const buttons = btn.parentNode.parentNode.querySelectorAll("button.option-btn");
    buttons.forEach(b => b.classList.remove("bg-green-600", "border-black"));
    btn.classList.add("bg-green-600", "border-black");
    userAnswers[qIndex] = optIndex;
  };

  // ==========================
  // 🔹 TIMER
  // ==========================
  function updateTimer() {
    if (timeLeft <= 0) {
      clearInterval(timer);
      submitQuiz();
      return;
    }
    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    timerDisplay.textContent = `Waktu: ${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;
    timeLeft--;
  }

  // ==========================
  // 🔹 MULAI QUIZ
  // ==========================
  function startQuiz() {
    quizData = shuffleArray(quizData);
    userAnswers = new Array(quizData.length).fill(null);
    currentQuestion = 0;
    startSection.classList.add("hidden");
    timerSection.classList.remove("hidden");
    quizSection.classList.remove("hidden");
    showQuestion(currentQuestion);
    timer = setInterval(updateTimer, 1000);
  }

  // ==========================
  // 🔹 MODAL
  // ==========================
  function openModal(id) {
    document.getElementById(id).classList.remove("hidden");
    document.body.classList.add("overflow-hidden");
  }

  function closeModal(id) {
    document.getElementById(id).classList.add("hidden");
    document.body.classList.remove("overflow-hidden");
  }

  // ==========================
  // 🔹 EVENT LISTENER
  // ==========================
  startBtn.addEventListener("click", () => openModal("startModal"));
  confirmStartBtn.addEventListener("click", () => {
    closeModal("startModal");
    startQuiz();
  });
  cancelStartBtn.addEventListener("click", () => closeModal("startModal"));
  closeWarningBtn.addEventListener("click", () => closeModal("warningModal"));

  nextBtn.addEventListener("click", () => {
    if (currentQuestion < quizData.length - 1) {
      currentQuestion++;
      showQuestion(currentQuestion);
    } else {
      if (userAnswers.includes(null)) {
        openModal("warningModal");
      } else {
        submitQuiz();
      }
    }
  });

  prevBtn.addEventListener("click", () => {
    if (currentQuestion > 0) {
      currentQuestion--;
      showQuestion(currentQuestion);
    }
  });

  // ==========================
  // 🔹 NAVIGASI NOMOR
  // ==========================
  function renderNav() {
    const nav = document.getElementById("questionNav");
    nav.innerHTML = quizData.map((_, i) => {
      let baseClass = "w-10 h-10 flex items-center justify-center rounded-full font-bold cursor-pointer ";
      if (userAnswers[i] !== null) baseClass += "bg-green-500 text-white";
      else baseClass += "bg-gray-300 text-gray-700";
      if (i === currentQuestion) baseClass += " ring-4 ring-blue-500";
      return `<div class="${baseClass}" onclick="jumpTo(${i})">${i + 1}</div>`;
    }).join("");
  }

  window.jumpTo = function (index) {
    currentQuestion = index;
    showQuestion(currentQuestion);
  };

  // ==========================
  // 🔹 SUBMIT QUIZ
  // ==========================
  function submitQuiz() {
    clearInterval(timer);
    let score = 0;
    quizSection.innerHTML = `
      <h2 class="text-xl font-bold mb-4">Hasil Latihan</h2>
      <div id="resultContainer" class="space-y-6"></div>
      <p class="mt-4">Kamu menjawab benar <b id="finalScore"></b> dari ${quizData.length} soal.</p>
      <button onclick="location.reload()" class="mt-4 px-6 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-600">
        Ulangi Latihan
      </button>
    `;
    const resultContainer = document.getElementById("resultContainer");
    quizData.forEach((q, i) => {
      const userAnswer = userAnswers[i];
      const correctAnswer = q.shuffledAnswerIndex;
      if (userAnswer === correctAnswer) score++;
      const optionsHtml = q.shuffledOptions.map((opt, idx) => {
        let classes = "py-2 px-4 rounded-lg border-2 ";
        if (idx === correctAnswer) classes += "bg-green-500 text-white border-green-600";
        else if (idx === userAnswer && userAnswer !== correctAnswer)
          classes += "bg-red-500 text-white border-red-600";
        else classes += "bg-white text-gray-600 border-gray-300";
        return `<div class="${classes}">${opt.text}</div>`;
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
});