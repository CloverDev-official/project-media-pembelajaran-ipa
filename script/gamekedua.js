// script/gamekedua.js
let gameData = null;
let currentSequence = null;
let draggedItem = null;
let dropSlots = [];

// Konfigurasi autoscroll
const SCROLL_THRESHOLD = 50; // Jarak dari tepi layar dalam pixel untuk memicu scroll
const SCROLL_SPEED = 12;      // Kecepatan scroll dalam pixel

let scrollInterval = null; // Untuk menyimpan interval scroll

// Fungsi untuk mengacak array (Fisher-Yates Shuffle)
function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

// Fungsi untuk mendapatkan array warna acak unik sebanyak jumlah item dari array warna yang diberikan
function getRandomColors(count, colorArray) {
    if (count > colorArray.length) {
        console.warn("Jumlah item melebihi jumlah warna yang tersedia. Beberapa warna mungkin akan digunakan ulang.");
        let extendedColors = [];
        while (extendedColors.length < count) {
            extendedColors = extendedColors.concat(colorArray);
        }
        return shuffleArray(extendedColors).slice(0, count);
    }
    const shuffledColors = [...colorArray]; // Salin array
    shuffleArray(shuffledColors);
    return shuffledColors.slice(0, count);
}

document.addEventListener('DOMContentLoaded', function() {
    // Ambil path JSON dari HTML
    const jsonDataElement = document.getElementById('jsonDataPath');
    const jsonDataPath = JSON.parse(jsonDataElement.textContent).jsonPath;

    // Fetch data JSON saat halaman dimuat
    fetch(jsonDataPath)
        .then(response => response.json())
        .then(data => {
            gameData = data;
            loadSequenceList();
        })
        .catch(error => {
            console.error('Error loading ', error);
            document.body.innerHTML = '<p class="text-red-500 text-center mt-10">Gagal memuat data game. Silakan coba lagi nanti.</p>';
        });

    document.getElementById('validateBtn').addEventListener('click', validateOrder);
    document.getElementById('resetBtn').addEventListener('click', resetGame);
    document.getElementById('closePopupBtn').addEventListener('click', closePopup);
    document.getElementById('sequenceSelect').addEventListener('change', loadSequence);
    document.getElementById('nextLevelBtn').addEventListener('click', nextLevel);
});

function loadSequenceList() {
    if (!gameData) return;
    const select = document.getElementById('sequenceSelect');
    select.innerHTML = '<option value="">-- Pilih Studi Kasus --</option>';
    gameData.sequences.forEach(seq => {
        const option = document.createElement('option');
        option.value = seq.id;
        option.textContent = seq.title;
        select.appendChild(option);
    });

    // --- Perubahan: Otomatis pilih dan muat pilihan pertama ---
    if (select.options.length > 1) { // Pastikan ada pilihan selain placeholder
        select.selectedIndex = 1; // Pilih indeks 1 (pilihan pertama setelah placeholder)
        const event = new Event('change'); // Buat event 'change'
        select.dispatchEvent(event); // Picu event 'change' secara manual
    }
    // ---
}

function loadSequence(event) {
    const sequenceId = event.target.value;
    if (!sequenceId) {
        document.getElementById('gameArea').classList.add('hidden');
        return;
    }

    currentSequence = gameData.sequences.find(seq => seq.id === sequenceId);
    if (currentSequence) {
        displaySequence(currentSequence);
        document.getElementById('gameArea').classList.remove('hidden');
        document.getElementById('nextLevelBtn').classList.add('hidden');
    }
}

function displaySequence(sequence) {
    document.getElementById('sequenceTitle').textContent = sequence.title;
    document.getElementById('sequenceDescription').textContent = sequence.description;

    const itemContainer = document.getElementById('itemContainer');
    const dropContainer = document.getElementById('dropContainer');

    itemContainer.innerHTML = '';
    dropContainer.innerHTML = '';

    // Ambil dan acak urutan items
    const shuffledItems = [...sequence.items].sort(() => Math.random() - 0.5);

    // Ambil warna acak unik untuk setiap item
    // Gunakan warna Tailwind yang lebih cerah dan berbeda
    const bgColors = [
        'bg-red-200 text-red-800', 'bg-blue-200 text-blue-800', 'bg-green-200 text-green-800', 'bg-yellow-200 text-yellow-800', 'bg-purple-200 text-purple-800',
        'bg-pink-200 text-pink-800', 'bg-indigo-200 text-indigo-800', 'bg-teal-200 text-teal-800', 'bg-orange-200 text-orange-800', 'bg-cyan-200 text-cyan-800',
        'bg-lime-200 text-lime-800', 'bg-emerald-200 text-emerald-800', 'bg-violet-200 text-violet-800', 'bg-fuchsia-200 text-fuchsia-800', 'bg-rose-200 text-rose-800'
    ];
    const itemColors = getRandomColors(shuffledItems.length, bgColors);

    // Buat slot untuk drop dengan nomor urut
    dropSlots = [];
    sequence.correctOrder.forEach((_, index) => {
        const slot = document.createElement('div');
        // Tambahkan elemen untuk nomor urut di dalam slot
        const slotNumber = document.createElement('div');
        slotNumber.className = 'absolute top-0 left-0 m-1 text-xs font-bold bg-gray-200 rounded-full w-6 h-6 flex items-center justify-center';
        slotNumber.textContent = index + 1;

        slot.className = 'bg-white border-2 border-gray-300 rounded-xl p-4 w-full text-center min-h-[80px] flex items-center justify-center cursor-pointer hover:border-blue-500 transition-all duration-200 relative shadow-sm'; // Gunakan rounded-xl dan padding lebih besar
        slot.id = `drop-slot-${index}`;
        slot.setAttribute('data-index', index);
        slot.setAttribute('data-occupied', 'false');
        slot.setAttribute('data-correct-id', '');
        slot.appendChild(slotNumber);

        dropContainer.appendChild(slot);
        dropSlots.push(slot);
    });

    // Buat item untuk drag dengan warna acak
    shuffledItems.forEach((item, index) => {
        const itemElement = document.createElement('div');
        // Gunakan flexbox dan kelas Tailwind yang diperbarui
        itemElement.className = `border-2 border-gray-300 rounded-xl p-4 cursor-move select-none shadow-md hover:shadow-lg transition-all duration-200 ${itemColors[index]} flex items-center justify-center max-h-[150px] max-w-[200px]`; // Tambahkan max-w-[200px] agar tidak terlalu lebar
        itemElement.id = `item-${item.id}`;
        itemElement.setAttribute('draggable', 'true');

        const textElement = document.createElement('span');
        textElement.textContent = item.text;
        textElement.className = 'text-center font-medium break-words';
        itemElement.appendChild(textElement);

        itemElement.addEventListener('dragstart', dragStart);
        itemContainer.appendChild(itemElement);
    });

    // Tambahkan event listener untuk drop
    dropSlots.forEach(slot => {
        slot.addEventListener('dragover', dragOver);
        slot.addEventListener('dragenter', dragEnter);
        slot.addEventListener('dragleave', dragLeave);
        slot.addEventListener('drop', drop);
    });

    document.addEventListener('dragend', dragEnd);
}

function dragStart(e) {
    draggedItem = e.target;
    e.dataTransfer.setData('text/plain', draggedItem.id);
    // Tambahkan efek visual saat drag start
    draggedItem.classList.add('opacity-70', 'scale-105');
    // Hapus max-w-[200px] saat mulai di-drag (jika sebelumnya berada di slot)
    draggedItem.classList.remove('max-w-[200px]');
    // Tambahkan max-w-[200px] kembali jika item berasal dari container (tidak dari slot)
    // Kita asumsikan item yang di-drag dari container tidak memiliki min-h-[80px] atau bg-white
    if (!draggedItem.classList.contains('min-h-\\[80px\\]')) { // Indikator kasar bahwa item berasal dari container
        draggedItem.classList.add('max-w-[200px]');
    }
    setTimeout(() => {
        draggedItem.classList.add('opacity-50');
    }, 0);

    // Mulai autoscroll saat drag dimulai
    document.addEventListener('dragover', handleDragOverAutoscroll);
}

function handleDragOverAutoscroll(e) {
    if (!draggedItem) return; // Hanya autoscroll jika ada item yang sedang di-drag

    const windowWidth = window.innerWidth;
    const windowHeight = window.innerHeight;
    const mouseX = e.clientX;
    const mouseY = e.clientY;

    let scrollX = 0;
    let scrollY = 0;

    // Cek horizontal
    if (mouseX < SCROLL_THRESHOLD) {
        scrollX = -SCROLL_SPEED;
    } else if (mouseX > windowWidth - SCROLL_THRESHOLD) {
        scrollX = SCROLL_SPEED;
    }

    // Cek vertikal
    if (mouseY < SCROLL_THRESHOLD) {
        scrollY = -SCROLL_SPEED;
    } else if (mouseY > windowHeight - SCROLL_THRESHOLD) {
        scrollY = SCROLL_SPEED;
    }

    // Jika perlu scroll, lakukan scroll
    if (scrollX !== 0 || scrollY !== 0) {
        window.scrollBy(scrollX, scrollY);
    }
}

function dragOver(e) {
    e.preventDefault();
}

function dragEnter(e) {
    e.preventDefault();
    if (e.target.classList.contains('bg-white') && e.target.getAttribute('data-occupied') === 'false') {
        e.target.classList.add('border-blue-500', 'bg-blue-50', 'scale-105');
    }
}

function dragLeave(e) {
    if (e.target.classList.contains('bg-blue-50')) {
        e.target.classList.remove('border-blue-500', 'bg-blue-50', 'scale-105');
    }
}

function drop(e) {
    e.preventDefault();
    if (e.target.classList.contains('bg-blue-50')) {
        e.target.classList.remove('border-blue-500', 'bg-blue-50', 'scale-105');
    }

    const slotIndex = e.target.getAttribute('data-index');
    const isOccupied = e.target.getAttribute('data-occupied');

    // Jika slot kosong
    if (isOccupied === 'false') {
        // Jika ada item di slot sebelumnya, kembalikan ke container item
        const existingItem = e.target.querySelector('[draggable]');
        if (existingItem) {
            const itemId = existingItem.id.replace('item-', '');
            const originalItemElement = document.getElementById(`item-${itemId}`);
            if (originalItemElement) {
                // Kembalikan max-w-[200px] ke item yang dikeluarkan
                originalItemElement.classList.remove('min-h-\\[80px\\]'); // Hapus min-h dari slot
                originalItemElement.classList.add('max-w-[200px]'); // Tambahkan max-w untuk container
                e.target.removeChild(existingItem); // Hapus dari slot
                document.getElementById('itemContainer').appendChild(originalItemElement); // Tambahkan ke container
            }
        }

        // Pindahkan item yang di-drag ke slot
        e.target.appendChild(draggedItem);
        // Hapus max-w-[200px] dan tambahkan min-h-[80px] saat masuk ke slot
        draggedItem.classList.remove('max-w-[200px]');
        draggedItem.classList.add('min-h-\\[80px\\]');
        e.target.setAttribute('data-occupied', 'true');
        e.target.setAttribute('data-correct-id', draggedItem.id.replace('item-', '')); // Simpan ID item yang ditempatkan
    } else {
        // Jika slot terisi, kembalikan item yang di-drag ke container item
        document.getElementById('itemContainer').appendChild(draggedItem);
        // Kembalikan max-w-[200px] jika item kembali ke container tanpa masuk slot
        draggedItem.classList.remove('min-h-\\[80px\\]'); // Hapus min-h jika sebelumnya ditambahkan karena dragStart dari slot
        draggedItem.classList.add('max-w-[200px]'); // Pastikan max-w ada di container
    }
}

function dragEnd() {
    // Hentikan autoscroll saat drag selesai
    document.removeEventListener('dragover', handleDragOverAutoscroll);

    if (draggedItem) {
        draggedItem.classList.remove('opacity-50', 'scale-105');
        // Pastikan max-w-[200px] aktif jika item kembali ke container tanpa drop ke slot
        // Kita cek apakah item saat ini berada di drop container
        const dropContainer = document.getElementById('dropContainer');
        if (dropContainer.contains(draggedItem)) {
            // Jika berada di drop container, biarkan seperti itu (sudah ditangani oleh drop)
            // Tapi pastikan min-h-[80px] aktif jika berada di slot
            if (draggedItem.parentElement.classList.contains('bg-white')) { // Indikator bahwa berada di slot
                 // Sudah ditangani oleh drop, biarkan min-h-[80px] aktif
                 draggedItem.classList.remove('max-w-[200px]');
                 draggedItem.classList.add('min-h-\\[80px\\]');
            } else {
                 // Jika ternyata tidak berada di slot yang valid, kembalikan ke container
                 // Ini adalah kasus edge jika drop gagal total
                 document.getElementById('itemContainer').appendChild(draggedItem);
                 draggedItem.classList.remove('min-h-\\[80px\\]');
                 draggedItem.classList.add('max-w-[200px]');
            }
        } else {
            // Jika tidak berada di drop container, pastikan max-w-[200px] aktif
            draggedItem.classList.remove('min-h-\\[80px\\]');
            draggedItem.classList.add('max-w-[200px]');
        }
        draggedItem = null;
    }

    // Perbaikan Bug: Ketika item di-drag keluar dari slot dan dilepas di luar dropzone,
    // kita perlu memeriksa apakah item tersebut masih berada di dalam salah satu slot.
    // Jika tidak, maka kita harus mereset status slot yang sebelumnya terisi.
    dropSlots.forEach(slot => {
        const isCurrentlyOccupied = slot.getAttribute('data-occupied') === 'true';
        const hasItem = slot.querySelector('[draggable]') !== null;

        // Jika slot sebelumnya terisi tapi sekarang tidak ada item di dalamnya,
        // maka kita reset statusnya menjadi kosong.
        if (isCurrentlyOccupied && !hasItem) {
            slot.setAttribute('data-occupied', 'false');
            slot.setAttribute('data-correct-id', '');
        }
    });
}

function validateOrder() {
    if (!currentSequence) return;

    const currentOrder = dropSlots.map(slot => {
        const item = slot.querySelector('[draggable]');
        return item ? item.id.replace('item-', '') : null;
    });

    const correctOrder = currentSequence.correctOrder;

    // Reset semua border slot ke warna default
    dropSlots.forEach(slot => {
        slot.classList.remove('border-green-500', 'border-red-500');
        slot.classList.add('border-gray-300');
    });

    let allCorrect = true;
    let correctCount = 0;
    let incorrectSlots = [];

    currentOrder.forEach((itemId, index) => {
        const slot = dropSlots[index];
        const expectedId = correctOrder[index];

        if (itemId === expectedId) {
            // Slot benar
            slot.classList.remove('border-gray-300', 'border-red-500');
            slot.classList.add('border-green-500');
            correctCount++;
        } else {
            // Slot salah
            allCorrect = false;
            slot.classList.remove('border-gray-300', 'border-green-500');
            slot.classList.add('border-red-500');
            incorrectSlots.push(index + 1); // Tambahkan nomor urut (1-based) ke array
        }
    });

    if (allCorrect) {
        showPopup('Jawaban Benar!', 'Selamat! Kamu berhasil menyusun urutan dengan benar.', true);
        document.getElementById('nextLevelBtn').classList.remove('hidden');
    } else {
        let incorrectMessage = '';
        if (incorrectSlots.length > 0) {
            incorrectMessage = ` Perhatian: Urutan pada slot ${incorrectSlots.join(', ')} belum benar.`;
        }
        showPopup('Jawaban Salah!', `Coba periksa kembali urutan tahapannya.${incorrectMessage}`, false);
        document.getElementById('nextLevelBtn').classList.add('hidden'); // Sembunyikan tombol jika salah
    }
}

function resetGame() {
    if (currentSequence) {
        displaySequence(currentSequence);
        document.getElementById('nextLevelBtn').classList.add('hidden');
    }
}

function nextLevel() {
    document.getElementById('sequenceSelect').value = '';
    document.getElementById('gameArea').classList.add('hidden');
    document.getElementById('nextLevelBtn').classList.add('hidden');
}

function showPopup(title, message, isSuccess) {
    const popup = document.getElementById('notificationPopup');
    const titleElement = document.getElementById('popupTitle');
    const messageElement = document.getElementById('popupMessage');

    titleElement.textContent = title;
    messageElement.textContent = message;
    titleElement.className = isSuccess ? 'text-xl font-bold mb-2 text-green-600' : 'text-xl font-bold mb-2 text-red-600';

    popup.classList.remove('hidden');
}

function closePopup() {
    document.getElementById('notificationPopup').classList.add('hidden');
}