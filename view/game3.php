<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Petualangan Si Singa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-b from-yellow-100 to-orange-200 min-h-screen flex items-center justify-center p-6">

  <div class="bg-white shadow-2xl rounded-2xl p-6 max-w-2xl text-center">
    <h1 class="text-3xl font-bold text-yellow-600 mb-4">🦁 Petualangan Si Singa</h1>
    <p id="story" class="text-lg mb-6">Hari ini, Si Singa menjelajah sabana. Bantu dia membuat keputusan yang tepat!</p>
    
    <div id="gifArea" class="mb-4">
      <img id="gif" src="https://media.giphy.com/media/l0ExdMHUDKteztyfe/giphy.gif" class="mx-auto rounded-xl shadow-lg w-64">
    </div>

    <div id="choices" class="grid grid-cols-2 gap-4 mb-6"></div>

    <button id="nextBtn" class="hidden px-5 py-2 bg-yellow-500 text-white font-bold rounded-xl shadow hover:bg-yellow-600">Lanjutkan ➡️</button>
    <p id="result" class="text-lg font-semibold mt-4"></p>
  </div>

  <script>
    const steps = [
      {
        question: "Singa lapar. Apa yang harus ia buru?",
        organ: "Zebra",
        correctGif: "https://media.giphy.com/media/26AHONQ79FdWZhAI0/giphy.gif",
        story: "Hebat! Singa berhasil menangkap zebra untuk makan siang.",
        wrongGif: "https://media.giphy.com/media/3ohzdOrcdpiD26TPt6/giphy.gif",
        wrongStory: "Ups! Singa mencoba menangkap gajah, tapi malah terlempar jauh. 🐘💨"
      },
      {
        question: "Ada gerombolan gajah lewat. Apa yang harus Singa lakukan?",
        organ: "Menghindar",
        correctGif: "https://media.giphy.com/media/3o6ZtaO9BZHcOjmErm/giphy.gif",
        story: "Cerdas! Singa menyingkir dan aman dari gerombolan gajah.",
        wrongGif: "https://media.giphy.com/media/3o7btNhMBytxAM6YBa/giphy.gif",
        wrongStory: "Waduh! Singa malah menantang gajah, akhirnya terpojok."
      },
      {
        question: "Siang hari sangat panas. Dimana Singa harus berlindung?",
        organ: "Di bawah pohon",
        correctGif: "https://media.giphy.com/media/3oEjHWXddc6IhXKlnW/giphy.gif",
        story: "Nyaman! Singa beristirahat di bawah pohon rindang.",
        wrongGif: "https://media.giphy.com/media/26AHONQ79FdWZhAI0/giphy.gif",
        wrongStory: "Oh tidak! Singa tetap di tengah sabana dan kepanasan."
      },
      {
        question: "Malam sudah tiba. Dimana Singa harus tidur?",
        organ: "Di gua aman",
        correctGif: "https://media.giphy.com/media/l0HlvtIPzPdt2usKs/giphy.gif",
        story: "Zzz... Singa tidur nyenyak di gua yang aman. Petualangan selesai! 🎉",
        wrongGif: "https://media.giphy.com/media/26BRv0ThflsHCqDrG/giphy.gif",
        wrongStory: "Bahaya! Tidur di tanah terbuka membuat Singa diganggu hyena."
      }
    ];

    let currentStep = 0;
    const storyEl = document.getElementById("story");
    const gifEl = document.getElementById("gif");
    const choicesEl = document.getElementById("choices");
    const resultEl = document.getElementById("result");
    const nextBtn = document.getElementById("nextBtn");

    function loadChoices() {
      choicesEl.innerHTML = "";
      resultEl.textContent = "";
      nextBtn.classList.add("hidden");

      storyEl.textContent = steps[currentStep].question;

      const correct = steps[currentStep].organ;
      const wrong = steps[currentStep].wrongStory.includes("gajah") ? "Gajah"
                  : steps[currentStep].wrongStory.includes("menantang") ? "Menyerang"
                  : steps[currentStep].wrongStory.includes("sabana") ? "Tetap di sabana"
                  : "Tidur di tanah terbuka";

      const options = [correct, wrong].sort(() => Math.random() - 0.5);

      options.forEach(opt => {
        const btn = document.createElement("button");
        btn.textContent = opt;
        btn.className = "px-4 py-2 bg-orange-400 hover:bg-orange-500 text-white font-bold rounded-xl shadow";
        btn.onclick = () => checkAnswer(opt);
        choicesEl.appendChild(btn);
      });
    }

    function checkAnswer(choice) {
      if (choice === steps[currentStep].organ) {
        gifEl.src = steps[currentStep].correctGif;
        storyEl.textContent = steps[currentStep].story;
        resultEl.textContent = "✅ Benar!";
        resultEl.className = "text-green-600 font-bold mt-4";
        nextBtn.classList.remove("hidden");
      } else {
        gifEl.src = steps[currentStep].wrongGif;
        storyEl.textContent = steps[currentStep].wrongStory;
        resultEl.textContent = "❌ Salah! Coba lagi.";
        resultEl.className = "text-red-600 font-bold mt-4";
      }
    }

    nextBtn.addEventListener("click", () => {
      currentStep++;
      if (currentStep < steps.length) {
        loadChoices();
      } else {
        storyEl.textContent = "🎉 Selamat! Kamu berhasil menemani Si Singa menyelesaikan petualangannya.";
        choicesEl.innerHTML = "";
        nextBtn.classList.add("hidden");
      }
    });

    loadChoices();
  </script>

</body>
</html>
