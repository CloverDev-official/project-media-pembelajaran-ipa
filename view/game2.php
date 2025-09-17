<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Game Studi Kasus - Tubuh & Kesehatan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .fade-in { animation: fadeIn 0.7s ease-in; }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
  </style>
</head>
<body class="bg-gradient-to-r from-yellow-100 via-green-100 to-blue-100 min-h-screen flex flex-col items-center justify-center font-sans p-4">

  <h1 class="text-3xl font-extrabold text-green-700 mb-4">🧑‍⚖️ Game Studi Kasus Tubuh & Kesehatan</h1>
  <p class="mb-6 text-lg text-indigo-900 font-medium">Pilih solusi terbaik! Jika salah, ada sanksinya 👮</p>

  <!-- Status Bar -->
  <div class="flex justify-between items-center w-full max-w-2xl mb-6">
    <div id="lives" class="text-red-600 text-2xl">❤️❤️❤️</div>
    <div id="score" class="text-indigo-700 text-xl font-bold">⭐ 0</div>
  </div>

  <!-- Arena -->
  <div id="arena" class="w-full max-w-2xl bg-white p-8 rounded-2xl shadow-xl text-center fade-in">
    <div id="case" class="text-lg font-semibold mb-6">Kasus akan tampil di sini</div>
    <div id="options" class="grid grid-cols-1 gap-4"></div>
    <div id="feedback" class="mt-6 text-lg font-extrabold"></div>
    <div id="story" class="mt-4 text-md font-medium text-gray-700"></div>
    <img id="gif" src="" alt="gif" class="mx-auto mt-4 w-48 rounded-xl shadow hidden"/>
    <button id="nextBtn" class="hidden mt-6 px-4 py-2 bg-purple-500 text-white rounded-xl hover:bg-purple-700 transition">➡️ Lanjutkan</button>
  </div>

  <!-- Hasil -->
  <div id="result" class="mt-8 text-3xl font-extrabold hidden"></div>

  <script>
    const cases = [
      {
        case: "Seorang anak lupa mencuci tangan sebelum makan nasi.",
        options: [
          "Tetap makan karena tangan terlihat bersih",
          "Mencuci tangan dengan sabun sebelum makan",
          "Meniup tangan agar kuman hilang"
        ],
        answer: "Mencuci tangan dengan sabun sebelum makan",
        penalty: "Kena sakit perut karena kuman masuk!",
        story: "Karena kamu mencuci tangan dengan sabun, tubuhmu jadi sehat dan bebas kuman. 👍",
        gifCorrect: "https://media3.giphy.com/media/v1.Y2lkPTc5MGI3NjExd3k3dWVhdHc5a2hmeTlqeTl1MTliaDJ2b3RqejB4Z2ZzeGYxYm9rdSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/hVIiqmnlNNIiBc93nr/giphy.gif",
        gifWrong: "https://media0.giphy.com/media/v1.Y2lkPTc5MGI3NjExazMwdjJ0c3AxZW9ienFtNnZndWIwN2hnbmVpNHEzbnlkMTJxa3gwNiZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/CoTpnN8mgGSfm/giphy.gif"
      },
      {
        case: "Seorang anak bermain di luar saat terik matahari tanpa topi.",
        options: [
          "Tetap main, biar hitam nggak masalah",
          "Memakai topi atau payung untuk melindungi diri",
          "Bermain terus sampai pusing"
        ],
        answer: "Memakai topi atau payung untuk melindungi diri",
        penalty: "Kepala pusing kena panas!",
        story: "Karena pakai topi, kamu tetap bisa bermain dengan aman tanpa kepanasan. 🎩☀️",
        gifCorrect: "https://media2.giphy.com/media/v1.Y2lkPTc5MGI3NjExYTUxeG9zNjFpNml2cmFuZ3ZiNTN4Mjd0dGJyNDMzbmZlN2h4eThudSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/hi0s4QcqydR2Qr0J86/giphy.gif",
        gifWrong: "https://media2.giphy.com/media/v1.Y2lkPTc5MGI3NjExbWR4NHBuYnBmempoc2ZoNjZiZXY3OXAzc2oyYXowNGd2Ynd1NXYzeCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/8JQ4hAJ5RzA2JmIeoK/giphy.gif"
      },
      {
        case: "Temanmu sakit batuk, lalu kamu minum dari gelas yang sama.",
        options: [
          "Tidak apa-apa, biar tambah akrab",
          "Segera cuci gelas dan gunakan gelas sendiri",
          "Minum banyak air biar sehat"
        ],
        answer: "Segera cuci gelas dan gunakan gelas sendiri",
        penalty: "Ikut tertular batuk!",
        story: "Karena kamu pakai gelas sendiri, tubuhmu tetap sehat dan tidak tertular. 🥤💪",
        gifCorrect: "https://media0.giphy.com/media/v1.Y2lkPTc5MGI3NjExcDY4YWc3bTcwdmh2NHRlenRjdTV2djh6cnlwcjBhMWdodXdsaXFwNSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/NquOFc59mXTQIvbtkJ/giphy.gif",
        gifWrong: "https://media0.giphy.com/media/v1.Y2lkPTc5MGI3NjExaTdteHBudG5vOGFpcjh3bnZiZ2ZldGNrM2QzMzdtMXNzaWFudDl2ZiZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/Hkya3YFcXcmQ0/giphy.gif"
      }
    ];

    let current = 0;
    let score = 0;
    let lives = 3;

    const caseEl = document.getElementById("case");
    const optionsEl = document.getElementById("options");
    const scoreEl = document.getElementById("score");
    const livesEl = document.getElementById("lives");
    const resultEl = document.getElementById("result");
    const feedbackEl = document.getElementById("feedback");
    const nextBtn = document.getElementById("nextBtn");
    const storyEl = document.getElementById("story");
    const gifEl = document.getElementById("gif");

    function loadCase() {
      if (lives <= 0) { gameOver(false); return; }
      if (current >= cases.length) { gameOver(true); return; }

      const c = cases[current];
      caseEl.textContent = `Kasus ${current + 1}: ${c.case}`;
      feedbackEl.textContent = "";
      storyEl.textContent = "";
      gifEl.src = "";
      gifEl.classList.add("hidden");
      optionsEl.innerHTML = "";
      nextBtn.classList.add("hidden");

      c.options.forEach(opt => {
        const btn = document.createElement("button");
        btn.textContent = opt;
        btn.className = "px-4 py-2 bg-blue-200 rounded-xl shadow hover:bg-blue-400 transition font-bold";
        btn.onclick = () => checkAnswer(opt, c, btn);
        optionsEl.appendChild(btn);
      });
    }

    function checkAnswer(selected, c, btn) {
      [...optionsEl.children].forEach(b => b.disabled = true);

      if (selected === c.answer) {
        score += 10;
        scoreEl.textContent = `⭐ ${score}`;
        feedbackEl.textContent = "🎉 Benar! Kamu memilih solusi yang tepat.";
        feedbackEl.className = "mt-6 text-lg font-extrabold text-green-600 fade-in";
        storyEl.textContent = c.story;
        gifEl.src = c.gifCorrect;
        gifEl.classList.remove("hidden");
        btn.classList.add("bg-green-400");
      } else {
        lives--;
        livesEl.textContent = "❤️".repeat(lives);
        feedbackEl.textContent = `❌ Salah! ${c.penalty}`;
        feedbackEl.className = "mt-6 text-lg font-extrabold text-red-600 fade-in";
        storyEl.textContent = "";
        gifEl.src = c.gifWrong;
        gifEl.classList.remove("hidden");
        btn.classList.add("bg-red-400");
      }

      nextBtn.classList.remove("hidden");
    }

    nextBtn.addEventListener("click", () => {
      current++;
      loadCase();
    });

    function gameOver(win) {
      document.getElementById("arena").classList.add("hidden");
      resultEl.classList.remove("hidden");
      if (win) {
        resultEl.textContent = `🏆 Selamat! Kamu menyelesaikan semua kasus dengan skor ${score}.`;
        resultEl.className = "text-green-700 text-3xl font-extrabold fade-in";
      } else {
        resultEl.textContent = `😢 Game Over! Nyawa habis. Skor akhir: ${score}`;
        resultEl.className = "text-red-700 text-3xl font-extrabold fade-in";
      }
    }

    loadCase();
  </script>
</body>
</html>
