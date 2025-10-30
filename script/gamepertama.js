// --- Konstanta dan Variabel Global ---
let gameData = null;
let terms = [];
let definitions = [];
let shuffledTerms = [];
let shuffledDefinitions = [];
let matchedPairs = [];

let isDragging = false;
let scrollInterval = null;
let lastMouseY = 0; // Untuk menyimpan posisi Y mouse terakhir

// --- Fungsi-Fungsi Utama ---

async function loadData() {
    try {
        const response = await fetch('../php/getgamepertama.php');
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        gameData = await response.json();
        console.log("Data game pencocokan berhasil dimuat:", gameData);

        if (gameData && gameData.pasangan) {
            terms = [...gameData.pasangan];
            definitions = [...gameData.pasangan];

            shuffledTerms = [...gameData.pasangan].sort(() => Math.random() - 0.5);
            shuffledDefinitions = [...gameData.pasangan].sort(() => Math.random() - 0.5);

            renderGame();
        } else {
            console.error("Struktur data tidak valid.");
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

    termsContainer.innerHTML = '<h3>Istilah</h3>';
    definitionsContainer.innerHTML = '<h3>Definisi</h3>';

    shuffledTerms.forEach(item => {
        const termDiv = document.createElement('div');
        termDiv.className = 'term-item';
        const randomColorClass = `bg-accent-${Math.floor(Math.random() * 10) + 1}`;
        termDiv.classList.add(randomColorClass);
        termDiv.textContent = item.istilah;
        termDiv.dataset.id = item.id;
        termDiv.draggable = true;
        termDiv.addEventListener('dragstart', handleDragStart);
        termDiv.addEventListener('dragend', handleDragEnd);
        termsContainer.appendChild(termDiv);
    });

    shuffledDefinitions.forEach(item => {
        const wrapperDiv = document.createElement('div');
        wrapperDiv.className = 'definition-wrapper';

        const defDiv = document.createElement('div');
        defDiv.className = 'definition-item';
        defDiv.dataset.id = item.id;
        defDiv.dataset.expectedTermId = item.id;

        const defTextDiv = document.createElement('div');
        defTextDiv.className = 'def-text';
        defTextDiv.textContent = item.definisi;
        defDiv.appendChild(defTextDiv);

        wrapperDiv.appendChild(defDiv);

        const dropZone = document.createElement('div');
        dropZone.className = 'drop-zone';
        dropZone.dataset.expectedTermId = item.id;

        dropZone.addEventListener('dragover', handleDragOver);
        dropZone.addEventListener('dragenter', handleDragEnter);
        dropZone.addEventListener('dragleave', handleDragLeave);
        dropZone.addEventListener('drop', handleDrop);

        wrapperDiv.appendChild(dropZone);

        definitionsContainer.appendChild(wrapperDiv);
    });

    matchedPairs = [];
    updateMatchedDisplay();
    clearStatusMessage();
}

function handleDragStart(e) {
    const draggedTerm = e.target;
    if (draggedTerm.classList.contains('matched')) {
        e.preventDefault();
        return;
    }

    e.dataTransfer.setData('text/plain', draggedTerm.dataset.id);
    e.dataTransfer.setData('text/type', 'term');

    draggedTerm.classList.add('dragging');

    startAutoScroll(e.clientY);
}

function handleDragEnd(e) {
    const draggedTerm = e.target;
    draggedTerm.classList.remove('dragging');
    stopAutoScroll();
}

function handleDragOver(e) {
    e.preventDefault();
    lastMouseY = e.clientY; // Update posisi mouse
}

function handleDragEnter(e) {
    e.preventDefault();
    const target = e.currentTarget;
    if (target.classList.contains('drop-zone') && !target.classList.contains('matched')) {
        target.classList.add('highlight');
    }
}

function handleDragLeave(e) {
    if (!e.currentTarget.contains(e.relatedTarget)) {
        e.currentTarget.classList.remove('highlight');
    }
}

function handleDrop(e) {
    e.preventDefault();
    const dropTarget = e.currentTarget;
    dropTarget.classList.remove('highlight');

    const draggedTermId = e.dataTransfer.getData('text/plain');
    if (!draggedTermId) return;

    const termCardToMove = document.querySelector(`.term-item[data-id="${draggedTermId}"]`);
    if (!termCardToMove) {
        console.error(`Term card dengan ID ${draggedTermId} tidak ditemukan.`);
        return;
    }

    const existingItemInTarget = dropTarget.querySelector('.term-item');

    if (!existingItemInTarget) {
        dropTarget.appendChild(termCardToMove);
        dropTarget.classList.add('has-item');
        termCardToMove.draggable = false;
    } else {
        const termToSwap = existingItemInTarget;

        const currentParent = termCardToMove.parentElement;
        if (currentParent && currentParent !== dropTarget) {
            currentParent.removeChild(termCardToMove);
        }

        dropTarget.removeChild(termToSwap);

        dropTarget.appendChild(termCardToMove);
        termCardToMove.draggable = false;

        if (currentParent && currentParent.classList.contains('definition-wrapper')) {
            const sourcePlaceholder = currentParent.querySelector('.drop-zone');
            sourcePlaceholder.appendChild(termToSwap);
            sourcePlaceholder.classList.add('has-item');
            termToSwap.draggable = true;
        } else {
            document.getElementById('terms-container').appendChild(termToSwap);
            termToSwap.draggable = true;
        }
    }

    stopAutoScroll();
}

function checkAnswers() {
    const allDropZones = document.querySelectorAll('.drop-zone');
    const dropZonesWithoutTerm = Array.from(allDropZones).filter(zone => !zone.classList.contains('has-item'));

    if (dropZonesWithoutTerm.length > 0) {
        document.getElementById('popup-message').textContent = `Harap masukkan istilah ke semua kotak definisi sebelum mengecek jawaban. Masih ada ${dropZonesWithoutTerm.length} kotak yang kosong.`;
        document.getElementById('popup-title');
        document.getElementById('popup-overlay').style.display = 'block';
        return;
    }

    clearStatusMessage();

    document.querySelectorAll('.term-item, .definition-item, .drop-zone').forEach(item => {
        item.classList.remove('matched', 'correct', 'incorrect');
    });

    matchedPairs = [];

    document.querySelectorAll('.drop-zone.has-item').forEach(dropZoneElement => {
        const attemptedTermItem = dropZoneElement.querySelector('.term-item');
        const expectedTermId = parseInt(dropZoneElement.dataset.expectedTermId);
        if (attemptedTermItem) {
            const attemptedTermId = parseInt(attemptedTermItem.dataset.id);

            matchedPairs.push({ expectedTermId: expectedTermId, attemptedTermId: attemptedTermId });
        }
    });

    let correctCount = 0;
    matchedPairs.forEach(pair => {
        const isCorrect = pair.expectedTermId === pair.attemptedTermId;

        const dropZoneElement = document.querySelector(`.drop-zone[data-expected-term-id="${pair.expectedTermId}"]`);
        const termElement = document.querySelector(`.term-item[data-id="${pair.attemptedTermId}"]`);

        if (isCorrect) {
            correctCount++;
            if (dropZoneElement) dropZoneElement.classList.add('matched', 'correct');
            if (termElement) termElement.classList.add('matched', 'correct');
        } else {
            if (dropZoneElement) dropZoneElement.classList.add('matched', 'incorrect');
            if (termElement) termElement.classList.add('matched', 'incorrect');
        }
    });

    const totalTerms = terms.length;
    let message = '';
    let statusClass = '';

    if (correctCount === totalTerms) {
        message = `Selamat! Kamu berhasil mencocokkan semua pasangan dengan benar.`;
        statusClass = 'status-success';
        document.getElementById('popup-message').textContent = message;
        document.getElementById('popup-title').textContent = "Selamat!";
        document.getElementById('popup-overlay').style.display = 'block';
    } else {
        message = `Kamu berhasil mencocokkan ${correctCount} dari ${totalTerms} pasangan.`;
        statusClass = 'status-fail';
        const statusDiv = document.getElementById('status-message');
        statusDiv.textContent = message;
        statusDiv.className = `status-message ${statusClass}`;
    }
}

function updateMatchedDisplay() {
    document.getElementById('matched-list').innerHTML = '';
}

function clearStatusMessage() {
    document.getElementById('status-message').textContent = '';
    document.getElementById('status-message').className = 'status-message';
}

function resetGame() {
    renderGame();
    clearStatusMessage();
    document.getElementById('popup-overlay').style.display = 'none';
}

// --- Fungsi Autoscroll untuk Mobile & Desktop ---

function startAutoScroll(mouseY) {
    // Autoscroll aktif di semua perangkat
    // if (window.innerWidth >= 768) return; // Hapus baris ini

    isDragging = true;
    lastMouseY = mouseY; // Simpan posisi awal mouse

    scrollInterval = setInterval(() => {
        if (!isDragging) return; // Hentikan jika tidak sedang drag

        const currentMouseY = lastMouseY; // Gunakan posisi mouse terakhir yang di-update oleh handleDragOver
        const viewportHeight = window.innerHeight;
        const scrollThreshold = 50; // Jarak dari tepi viewport untuk memicu scroll

        let scrollDirection = 0;
        if (currentMouseY < scrollThreshold) {
            scrollDirection = -1; // Scroll ke atas
        } else if (currentMouseY > viewportHeight - scrollThreshold) {
            scrollDirection = 1; // Scroll ke bawah
        }

        if (scrollDirection !== 0) {
            // Gulir dengan kecepatan 15px dan interval cepat (10ms) di semua perangkat
            window.scrollBy(0, scrollDirection * 15);
        }
        // Jika mouse tidak di dekat tepi, tidak scroll
    }, 10); // Periksa setiap 10ms
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

    document.getElementById('popup-close-btn').addEventListener('click', function() {
        document.getElementById('popup-overlay').style.display = 'none';
    });

    document.getElementById('popup-overlay').addEventListener('click', function(e) {
        if (e.target === this) {
            this.style.display = 'none';
        }
    });

    // Update posisi mouse untuk autoscroll saat dragover
    document.addEventListener('dragover', (e) => {
        if (isDragging) {
            lastMouseY = e.clientY; // Simpan posisi mouse terbaru saat drag
        }
    });
});