// --- Konstanta dan Variabel Global ---
let gameData = null;
let terms = [];
let definitions = [];
let shuffledTerms = [];
let shuffledDefinitions = [];
let matchedPairs = [];

let isDragging = false;
let scrollInterval = null;
let lastMouseY = 0;

// --- Fungsi-Fungsi Utama ---

async function loadData() {
    try {
        const response = await fetch('../php/getgamepertama.php');
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        gameData = await response.json();
        console.log("Data game pencocokan berhasil dimuat:", gameData);

        if (gameData && gameData.pasangan) {
            terms = [...gameData.pasangan];
            definitions = [...gameData.pasangan];

            shuffledTerms = [...gameData.pasangan].sort(() => Math.random() - 0.5);
            shuffledDefinitions = [...gameData.pasangan].sort(() => Math.random() - 0.5);

            renderGame();
        } else {
            document.getElementById('error-message').textContent = "Data game tidak valid.";
        }
    } catch (error) {
        console.error("Error memuat data game pencocokan:", error);
        document.getElementById('error-message').textContent = "Gagal memuat data game. Silakan coba lagi.";
    }
}

function renderGame() {
    const termsContainer = document.getElementById('terms-container');
    const definitionsContainer = document.getElementById('definitions-container');

    // Kosongkan kontainer
    termsContainer.innerHTML = '';
    definitionsContainer.innerHTML = '';

    // Render Istilah
    shuffledTerms.forEach(item => {
        const termDiv = document.createElement('div');
        // Palet warna cerah dan berbeda - Gunakan warna Tailwind 200 untuk latar dan 800 untuk teks
        const colorClasses = [
            'bg-red-200 text-red-800', 'bg-blue-200 text-blue-800', 'bg-green-200 text-green-800', 'bg-yellow-200 text-yellow-800', 'bg-purple-200 text-purple-800',
            'bg-pink-200 text-pink-800', 'bg-indigo-200 text-indigo-800', 'bg-teal-200 text-teal-800', 'bg-orange-200 text-orange-800', 'bg-cyan-200 text-cyan-800'
        ];
        const randomColorClass = colorClasses[Math.floor(Math.random() * colorClasses.length)];
        
        // Gunakan kelas Tailwind yang lebih modern
        termDiv.className = `p-4 border-2 border-dashed border-gray-300 rounded-xl cursor-grab ${randomColorClass} text-center font-medium shadow-md hover:shadow-lg transition-all duration-200`;
        termDiv.textContent = item.istilah;
        termDiv.dataset.id = item.id;
        termDiv.draggable = true;
        termDiv.addEventListener('dragstart', handleDragStart);
        termDiv.addEventListener('dragend', handleDragEnd);
        termsContainer.appendChild(termDiv);
    });

    // Render Definisi + Drop Zone
    shuffledDefinitions.forEach(item => {
        const defWrapper = document.createElement('div');
        defWrapper.className = 'bg-gray-50 rounded-xl p-5 border border-gray-200 shadow-sm';

        const defText = document.createElement('div');
        defText.className = 'p-4 bg-white rounded-lg text-gray-700 text-center leading-relaxed mb-4 font-medium';
        defText.textContent = item.definisi;

        // Drop Zone: Gunakan kelas Tailwind yang lebih modern dan tetapkan tinggi tetap
        const dropZone = document.createElement('div');
        dropZone.className = 'border-2 border-dashed border-gray-300 rounded-xl bg-white flex items-center justify-center text-gray-400 text-sm italic transition-colors duration-200 h-16';
        dropZone.dataset.expectedTermId = item.id;

        dropZone.addEventListener('dragover', handleDragOver);
        dropZone.addEventListener('dragenter', handleDragEnter);
        dropZone.addEventListener('dragleave', handleDragLeave);
        dropZone.addEventListener('drop', handleDrop);

        defWrapper.appendChild(defText);
        defWrapper.appendChild(dropZone);
        definitionsContainer.appendChild(defWrapper);
    });

    matchedPairs = [];
    clearStatusMessage();
}

function handleDragStart(e) {
    const draggedTerm = e.target;
    if (draggedTerm.classList.contains('cursor-default')) return; // Jika sudah dicocokkan

    e.dataTransfer.setData('text/plain', draggedTerm.dataset.id);
    e.dataTransfer.setData('text/type', 'term');

    // Efek saat drag start - Gunakan kelas Tailwind
    draggedTerm.classList.add('opacity-70', 'scale-95', 'shadow-xl', 'z-[1000]');
    startAutoScroll(e.clientY);
}

function handleDragEnd(e) {
    const draggedTerm = e.target;
    draggedTerm.classList.remove('opacity-70', 'scale-95', 'shadow-xl', 'z-[1000]');
    stopAutoScroll();
}

function handleDragOver(e) {
    e.preventDefault();
    lastMouseY = e.clientY;
}

function handleDragEnter(e) {
    e.preventDefault();
    const target = e.currentTarget;
    if (target.classList.contains('border-dashed') && !target.classList.contains('pointer-events-none')) {
        target.classList.replace('border-gray-300', 'border-blue-500');
        target.classList.replace('bg-white', 'bg-blue-50');
        target.classList.add('scale-105');
    }
}

function handleDragLeave(e) {
    if (!e.currentTarget.contains(e.relatedTarget)) {
        const target = e.currentTarget;
        target.classList.replace('border-blue-500', 'border-gray-300');
        target.classList.replace('bg-blue-50', 'bg-white');
        target.classList.remove('scale-105');
    }
}

function handleDrop(e) {
    e.preventDefault();
    const dropTarget = e.currentTarget;
    dropTarget.classList.replace('border-blue-500', 'border-gray-300');
    dropTarget.classList.replace('bg-blue-50', 'bg-white');
    dropTarget.classList.remove('scale-105');

    const draggedTermId = e.dataTransfer.getData('text/plain');
    if (!draggedTermId) return;

    const termCardToMove = document.querySelector(`[data-id="${draggedTermId}"]`);
    if (!termCardToMove) return;

    const existingItemInTarget = dropTarget.querySelector('.p-4.cursor-default');

    if (!existingItemInTarget) {
        // Tidak ada item, langsung masukkan
        dropTarget.appendChild(termCardToMove);
        dropTarget.classList.replace('border-dashed', 'border-solid');
        dropTarget.classList.replace('border-gray-300', 'border-green-500');
        dropTarget.classList.replace('bg-white', 'bg-green-50');
        termCardToMove.classList.remove('cursor-grab');
        termCardToMove.classList.add('cursor-default', 'pointer-events-none', 'my-2'); // <-- Tambahkan my-2
    } else {
        // Ada item, tukar
        const termToSwap = existingItemInTarget;

        const currentParent = termCardToMove.parentElement;
        if (currentParent && currentParent !== dropTarget) {
            currentParent.removeChild(termCardToMove);
        }

        dropTarget.removeChild(termToSwap);

        dropTarget.appendChild(termCardToMove);
        termCardToMove.classList.remove('cursor-grab');
        termCardToMove.classList.add('cursor-default', 'pointer-events-none', 'my-2'); // <-- Tambahkan my-2

        if (currentParent && currentParent.classList.contains('bg-gray-50')) {
            const sourcePlaceholder = currentParent.querySelector('.border-dashed');
            sourcePlaceholder.appendChild(termToSwap);
            sourcePlaceholder.classList.replace('border-solid', 'border-dashed');
            sourcePlaceholder.classList.replace('border-green-500', 'border-gray-300');
            sourcePlaceholder.classList.replace('bg-green-50', 'bg-white');
            termToSwap.classList.remove('cursor-default', 'pointer-events-none');
            termToSwap.classList.add('cursor-grab', 'my-2'); // <-- Tambahkan my-2
        } else {
            document.getElementById('terms-container').appendChild(termToSwap);
            termToSwap.classList.remove('cursor-default', 'pointer-events-none');
            termToSwap.classList.add('cursor-grab', 'my-2'); // <-- Tambahkan my-2
        }
    }

    stopAutoScroll();
}

function checkAnswers() {
    const allDropZones = document.querySelectorAll('.border-dashed, .border-solid');
    const emptyDropZones = Array.from(allDropZones).filter(zone => zone.children.length === 0);

    if (emptyDropZones.length > 0) {
        document.getElementById('popup-message').textContent = `Masih ada ${emptyDropZones.length} kotak definisi yang kosong. Harap isi semua sebelum mengecek jawaban.`;
        document.getElementById('popup-title').textContent = "⚠️ Peringatan";
        document.getElementById('popup-overlay').classList.remove('hidden');
        return;
    }

    clearStatusMessage();

    // Hapus semua kelas status sebelumnya
    document.querySelectorAll('.p-4.cursor-grab, .p-4.cursor-default, .border-dashed, .border-solid').forEach(item => {
        item.classList.remove('bg-green-300', 'border-green-500', 'text-white', 'bg-red-300', 'border-red-500', 'cursor-default', 'pointer-events-none');
    });

    matchedPairs = [];

    allDropZones.forEach(dropZoneElement => {
        const attemptedTermItem = dropZoneElement.querySelector('.p-4');
        const expectedTermId = parseInt(dropZoneElement.dataset.expectedTermId);
        if (attemptedTermItem) {
            const attemptedTermId = parseInt(attemptedTermItem.dataset.id);
            matchedPairs.push({ expectedTermId, attemptedTermId });
        }
    });

    let correctCount = 0;
    matchedPairs.forEach(pair => {
        const isCorrect = pair.expectedTermId === pair.attemptedTermId;

        const dropZoneElement = document.querySelector(`.border-dashed[data-expected-term-id="${pair.expectedTermId}"], .border-solid[data-expected-term-id="${pair.expectedTermId}"]`);
        const termElement = document.querySelector(`[data-id="${pair.attemptedTermId}"]`);

        if (isCorrect) {
            correctCount++;
            if (dropZoneElement) {
                dropZoneElement.classList.add('bg-green-300', 'border-green-500');
            }
            if (termElement) {
                termElement.classList.add('bg-green-300', 'border-green-500', 'text-white');
            }
        } else {
            if (dropZoneElement) {
                dropZoneElement.classList.add('bg-red-300', 'border-red-500');
            }
            if (termElement) {
                termElement.classList.add('bg-red-300', 'border-red-500', 'text-white');
            }
        }
    });

    // Nonaktifkan interaksi setelah cek
    document.querySelectorAll('.p-4.cursor-grab, .p-4.cursor-default, .border-dashed, .border-solid').forEach(item => {
        item.classList.add('cursor-default', 'pointer-events-none');
    });

    const totalTerms = terms.length;
    let message = '';
    let statusClass = '';

    if (correctCount === totalTerms) {
        message = `🎉 Selamat! Kamu berhasil mencocokkan semua pasangan dengan benar.`;
        statusClass = 'bg-green-100 text-green-800 border border-green-200';
        document.getElementById('popup-message').textContent = message;
        document.getElementById('popup-title').textContent = "🎉 Selamat!";
        document.getElementById('popup-overlay').classList.remove('hidden');
    } else {
        message = `📝 Kamu berhasil mencocokkan ${correctCount} dari ${totalTerms} pasangan.`;
        statusClass = 'bg-red-100 text-red-800 border border-red-200';
        const statusDiv = document.getElementById('status-message');
        statusDiv.textContent = message;
        statusDiv.className = `p-4 rounded-lg shadow-md font-semibold text-center ${statusClass}`;
    }
}

function clearStatusMessage() {
    document.getElementById('status-message').textContent = '';
    document.getElementById('status-message').className = 'p-4 rounded-lg shadow-md font-semibold text-center hidden';
}

function resetGame() {
    renderGame();
    clearStatusMessage();
    document.getElementById('popup-overlay').classList.add('hidden');
}

// --- Autoscroll ---

function startAutoScroll(mouseY) {
    isDragging = true;
    lastMouseY = mouseY;

    scrollInterval = setInterval(() => {
        if (!isDragging) return;

        const currentMouseY = lastMouseY;
        const viewportHeight = window.innerHeight;
        const scrollThreshold = 50;

        let scrollDirection = 0;
        if (currentMouseY < scrollThreshold) {
            scrollDirection = -1;
        } else if (currentMouseY > viewportHeight - scrollThreshold) {
            scrollDirection = 1;
        }

        if (scrollDirection !== 0) {
            window.scrollBy(0, scrollDirection * 15);
        }
    }, 10);
}

function stopAutoScroll() {
    isDragging = false;
    if (scrollInterval) {
        clearInterval(scrollInterval);
        scrollInterval = null;
    }
}

// --- Inisialisasi ---

document.addEventListener('DOMContentLoaded', () => {
    loadData();

    document.getElementById('reset-btn').addEventListener('click', resetGame);
    document.getElementById('check-btn').addEventListener('click', checkAnswers);

    document.getElementById('popup-close-btn').addEventListener('click', () => {
        document.getElementById('popup-overlay').classList.add('hidden');
    });

    document.getElementById('popup-overlay').addEventListener('click', (e) => {
        if (e.target === e.currentTarget) {
            e.currentTarget.classList.add('hidden');
        }
    });

    // Update posisi mouse untuk autoscroll
    document.addEventListener('dragover', (e) => {
        if (isDragging) lastMouseY = e.clientY;
    });
});