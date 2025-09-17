<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Puzzle Tubuh Manusia & Hewan</title>
    <?php include("../shared/link.php"); ?>
  <style>
    .dropzone {
      transition: all 0.3s ease;
    }
    .card {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }
    .fade-in {
      animation: fadeIn 0.5s ease;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.9); }
      to { opacity: 1; transform: scale(1); }
    }
  </style>
</head>
<body class="bg-gradient-to-br from-pink-200 via-indigo-200 to-blue-200 min-h-screen flex flex-col items-center justify-center p-6 font-sans">

  <h1 class="text-4xl font-extrabold mb-6 text-indigo-900 drop-shadow">Puzzle Tubuh 🧩</h1>
  <p class="mb-6 text-lg text-indigo-800 font-medium">Tarik kartu ke kategori yang menurutmu benar, lalu klik <b>Cek Jawaban</b>.</p>

  <!-- Area kartu -->
  <div id="cards" class="flex flex-wrap gap-4 mb-8 justify-center">
    <div draggable="true" data-answer="Panca Indra" class="card cursor-move px-4 py-2 bg-white shadow rounded-xl">👁️ Mata</div>
    <div draggable="true" data-answer="Panca Indra" class="card cursor-move px-4 py-2 bg-white shadow rounded-xl">👂 Telinga</div>
    <div draggable="true" data-answer="Organ" class="card cursor-move px-4 py-2 bg-white shadow rounded-xl">❤️ Jantung</div>
    <div draggable="true" data-answer="Rangka" class="card cursor-move px-4 py-2 bg-white shadow rounded-xl">🦴 Tulang</div>
    <div draggable="true" data-answer="Organ" class="card cursor-move px-4 py-2 bg-white shadow rounded-xl">🫁 Paru-paru</div>
    <div draggable="true" data-answer="Rangka" class="card cursor-move px-4 py-2 bg-white shadow rounded-xl">💀 Tengkorak</div>
    <div draggable="true" data-answer="Panca Indra" class="card cursor-move px-4 py-2 bg-white shadow rounded-xl">👃 Hidung</div>
  </div>

  <!-- Area kategori -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-5xl mb-6">
    <div data-category="Panca Indra" class="dropzone bg-blue-200/80 p-4 rounded-2xl min-h-[220px] shadow-lg">
      <h2 class="font-bold text-blue-900 mb-3 text-xl text-center">👀 Panca Indra</h2>
    </div>
    <div data-category="Rangka" class="dropzone bg-green-200/80 p-4 rounded-2xl min-h-[220px] shadow-lg">
      <h2 class="font-bold text-green-900 mb-3 text-xl text-center">🦴 Rangka</h2>
    </div>
    <div data-category="Organ" class="dropzone bg-red-200/80 p-4 rounded-2xl min-h-[220px] shadow-lg">
      <h2 class="font-bold text-red-900 mb-3 text-xl text-center">🫀 Organ</h2>
    </div>
  </div>

  <!-- Tombol aksi -->
  <div class="flex gap-4">
    <button id="checkBtn" class="px-6 py-3 bg-indigo-600 text-white font-bold rounded-xl shadow hover:bg-indigo-700 transition">
      ✅ Cek Jawaban
    </button>
    <button id="resetBtn" class="px-6 py-3 bg-gray-600 text-white font-bold rounded-xl shadow hover:bg-gray-700 transition">
      🔄 Reset
    </button>
  </div>

  <!-- Hasil -->
  <div id="result" class="mt-6 text-2xl font-extrabold text-indigo-900 drop-shadow"></div>

  <script>
  const cards = document.querySelectorAll('[draggable="true"]');
  const dropzones = document.querySelectorAll('.dropzone');
  const cardArea = document.getElementById('cards');
  let draggedCard = null;

  function makeDraggable(card) {
    card.addEventListener('dragstart', e => {
      draggedCard = card; // simpan referensi asli
      setTimeout(() => card.classList.add('hidden'), 0); // sembunyikan saat dragging
    });
    card.addEventListener('dragend', () => {
      card.classList.remove('hidden'); // tampilkan lagi setelah drop
      draggedCard = null;
    });
  }

  cards.forEach(makeDraggable);

  dropzones.forEach(zone => {
    zone.addEventListener('dragover', e => {
      e.preventDefault();
      zone.classList.add('ring-4', 'ring-indigo-400');
    });
    zone.addEventListener('dragleave', () => {
      zone.classList.remove('ring-4', 'ring-indigo-400');
    });
    zone.addEventListener('drop', e => {
      e.preventDefault();
      zone.classList.remove('ring-4', 'ring-indigo-400');
      if (draggedCard) {
        zone.appendChild(draggedCard); // pindahkan, bukan duplikat
      }
    });
  });

  // Cek jawaban
  document.getElementById('checkBtn').addEventListener('click', () => {
    let total = 0, benar = 0;
    dropzones.forEach(zone => {
      const category = zone.dataset.category;
      const items = zone.querySelectorAll('[draggable="true"]');
      items.forEach(item => {
        total++;
        if (item.dataset.answer === category) {
          benar++;
          item.classList.add('bg-green-300');
        } else {
          item.classList.add('bg-red-300');
        }
      });
    });
    document.getElementById('result').textContent = `🎯 Skor kamu: ${benar} / ${total}`;
  });

  // Reset
  document.getElementById('resetBtn').addEventListener('click', () => {
    dropzones.forEach(zone => {
      const title = zone.querySelector('h2').textContent;
      zone.innerHTML = `<h2 class="font-bold text-xl mb-3">${title}</h2>`;
    });

    cardArea.innerHTML = "";
    const defaultCards = [
      { text: "👁️ Mata", answer: "Panca Indra" },
      { text: "👂 Telinga", answer: "Panca Indra" },
      { text: "❤️ Jantung", answer: "Organ" },
      { text: "🦴 Tulang", answer: "Rangka" },
      { text: "🫁 Paru-paru", answer: "Organ" },
      { text: "💀 Tengkorak", answer: "Rangka" },
      { text: "👃 Hidung", answer: "Panca Indra" },
    ];
    defaultCards.forEach(c => {
      const el = document.createElement("div");
      el.draggable = true;
      el.dataset.answer = c.answer;
      el.className = "card cursor-move px-4 py-2 bg-white shadow rounded-xl";
      el.textContent = c.text;
      makeDraggable(el);
      cardArea.appendChild(el);
    });
    document.getElementById('result').textContent = "";
  });
</script>

</body>
</html>
