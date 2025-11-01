// script/admin_gamekedua.js

// Path ke file JSON dan script PHP untuk CRUD
const DATA_FILE_PATH = '../data/gamekedua_data.json';
const CRUD_PHP_PATH = '../php/crud_gamekedua.php';

// --- FUNGSI-FUNGSI NOTIFIKASI ---

// Fungsi untuk membuat dan menampilkan popup kustom untuk notifikasi
function showNotificationPopup(message, isSuccess = true) {
    // Hapus popup lama jika ada
    const existingPopup = document.getElementById('notificationPopup');
    if (existingPopup) {
        existingPopup.remove();
    }

    // Buat elemen popup
    const popup = document.createElement('div');
    popup.id = 'notificationPopup';
    popup.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50';
    popup.innerHTML = `
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-sm w-full">
            <h3 class="text-xl font-bold mb-2 ${isSuccess ? 'text-green-600' : 'text-red-600'}">${isSuccess ? 'Sukses!' : 'Error!'}</h3>
            <p class="mb-4">${message}</p>
            <div class="flex justify-end">
                <button id="closeNotificationPopupBtn" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md">
                    OK
                </button>
            </div>
        </div>
    `;
    document.body.appendChild(popup);

    // Tambahkan event listener untuk tombol OK
    document.getElementById('closeNotificationPopupBtn').addEventListener('click', function() {
        document.body.removeChild(popup);
    });
}

// Fungsi untuk membuat dan menampilkan popup kustom untuk konfirmasi
function showCustomPopup(title, message, onConfirm, onCancel) {
    // Hapus popup lama jika ada
    const existingPopup = document.getElementById('customPopup');
    if (existingPopup) {
        existingPopup.remove();
    }

    // Buat elemen popup
    const popup = document.createElement('div');
    popup.id = 'customPopup';
    popup.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50';
    popup.innerHTML = `
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-sm w-full">
            <h3 class="text-xl font-bold mb-2">${title}</h3>
            <p class="mb-4">${message}</p>
            <div class="flex justify-end gap-2">
                <button id="popupCancelBtn" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md">
                    Cancel
                </button>
                <button id="popupOkBtn" class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-2 px-4 rounded-md">
                    OK
                </button>
            </div>
        </div>
    `;
    document.body.appendChild(popup);

    // Tambahkan event listener
    document.getElementById('popupOkBtn').addEventListener('click', function() {
        document.body.removeChild(popup);
        if (typeof onConfirm === 'function') {
            onConfirm();
        }
    });

    document.getElementById('popupCancelBtn').addEventListener('click', function() {
        document.body.removeChild(popup);
        if (typeof onCancel === 'function') {
            onCancel();
        }
    });
}

// --- FUNGSI-FUNGSI CRUD ---

// Fungsi untuk memuat data dari server
function loadData() {
    fetch(CRUD_PHP_PATH, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ action: 'read', filePath: DATA_FILE_PATH })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            displaySequences(data.data.sequences);
            // --- PERUBAHAN: Tampilkan notifikasi sukses refresh ---
            // Cek apakah ini dipicu oleh tombol refresh (flag)
            if (window.isRefreshingData) {
                showNotificationPopup('Data berhasil diperbarui.');
                window.isRefreshingData = false; // Reset flag
            }
            // ---
        } else {
            showNotificationPopup('Gagal memuat data: ' + data.message, false);
        }
    })
    .catch(error => {
        console.error('Error loading data:', error);
        showNotificationPopup('Terjadi kesalahan saat memuat data.', false);
    });
}

// Fungsi untuk menampilkan daftar urutan
function displaySequences(sequences) {
    const listContainer = document.getElementById('sequencesList');
    if (!listContainer) return; // Jika elemen tidak ada, keluar
    listContainer.innerHTML = ''; // Kosongkan kontainer

    sequences.forEach(seq => {
        // Buat elemen card utama untuk urutan
        const seqCard = document.createElement('div');
        seqCard.className = 'border border-gray-200 rounded-lg p-4 mb-4'; // Tambahkan margin bottom

        // Buat kontainer flex untuk header (judul & tombol)
        // Gunakan flex-wrap untuk memastikan tombol turun ke baris baru jika perlu
        // Gunakan items-start agar item tidak diregangkan
        const headerContainer = document.createElement('div');
        headerContainer.className = 'flex flex-wrap items-start justify-between gap-2 mb-3'; // Tambahkan gap untuk jarak

        // Buat div untuk teks (judul, deskripsi, ID)
        const textDiv = document.createElement('div');
        textDiv.className = 'flex-grow min-w-[200px]'; // Izinkan tumbuh, tetapi batasi lebar min untuk tombol

        const title = document.createElement('h3');
        title.className = 'text-lg font-semibold text-gray-800 truncate'; // Gunakan truncate untuk teks panjang
        title.title = seq.title; // Tooltip berisi teks penuh
        title.textContent = seq.title;

        const description = document.createElement('p');
        description.className = 'text-sm text-gray-600 truncate'; // Gunakan truncate untuk teks panjang
        description.title = seq.description; // Tooltip berisi teks penuh
        description.textContent = seq.description;

        const idText = document.createElement('p');
        idText.className = 'text-xs text-gray-500 mt-1';
        idText.textContent = `ID: ${seq.id}`;

        textDiv.appendChild(title);
        textDiv.appendChild(description);
        textDiv.appendChild(idText);

        // Buat div untuk tombol
        const buttonsDiv = document.createElement('div');
        buttonsDiv.className = 'flex flex-shrink-0 gap-2'; // Mencegah tombol menyusut dan menambahkan jarak

        const editButton = document.createElement('button');
        editButton.className = 'bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded-md text-sm transition duration-200 whitespace-nowrap';
        editButton.textContent = 'Edit';
        editButton.onclick = () => editSequence(seq.id); // Tambahkan event listener

        const deleteButton = document.createElement('button');
        deleteButton.className = 'bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded-md text-sm transition duration-200 whitespace-nowrap';
        deleteButton.textContent = 'Hapus';
        deleteButton.onclick = () => deleteSequence(seq.id); // Tambahkan event listener

        buttonsDiv.appendChild(editButton);
        buttonsDiv.appendChild(deleteButton);

        // Gabungkan header
        headerContainer.appendChild(textDiv);
        headerContainer.appendChild(buttonsDiv);

        // Buat elemen untuk daftar item (seperti sebelumnya)
        const itemsDiv = document.createElement('div');
        itemsDiv.className = 'mt-4';
        itemsDiv.innerHTML = '<h4 class="font-medium text-gray-700 mb-2">Item:</h4>';
        const itemList = document.createElement('ul');
        itemList.className = 'list-disc pl-5 space-y-1';
        seq.items.forEach(item => {
            const li = document.createElement('li');
            li.textContent = item.text;
            itemList.appendChild(li);
        });
        itemsDiv.appendChild(itemList);

        // Gabungkan semua ke dalam card
        seqCard.appendChild(headerContainer);
        seqCard.appendChild(itemsDiv);

        listContainer.appendChild(seqCard);
    });
}

// Fungsi untuk menambahkan form item baru di form tambah urutan
function addNewItemToForm() {
    const container = document.getElementById('newItemsContainer');
    if (!container) return; // Jika elemen tidak ada, keluar
    const index = container.children.length;
    const itemDiv = document.createElement('div');
    itemDiv.className = 'flex items-center gap-2';
    itemDiv.innerHTML = `
        <input type="text" placeholder="Teks Item ${index + 1}" class="flex-grow p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="button" class="remove-item-btn bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded-md transition duration-200">X</button>
    `;
    container.appendChild(itemDiv);

    // Tambahkan event listener untuk tombol hapus item
    itemDiv.querySelector('.remove-item-btn').addEventListener('click', function() {
        container.removeChild(itemDiv);
    });
}

// Fungsi untuk menyimpan urutan baru
function saveNewSequence() {
    const id = document.getElementById('newSequenceId').value.trim();
    const title = document.getElementById('newSequenceTitle').value.trim();
    const description = document.getElementById('newSequenceDescription').value.trim();

    if (!id || !title) {
        showNotificationPopup('ID dan Judul harus diisi.', false);
        return;
    }

    const items = [];
    const itemInputs = document.querySelectorAll('#newItemsContainer input[type="text"]');
    let hasEmptyItem = false;
    itemInputs.forEach(input => {
        if (input.value.trim() === '') {
            hasEmptyItem = true;
        } else {
            items.push({
                id: `${items.length + 1}`, // ID otomatis untuk item baru
                text: input.value.trim()
            });
        }
    });

    if (hasEmptyItem) {
        showNotificationPopup('Pastikan semua teks item diisi.', false);
        return;
    }

    if (items.length === 0) {
        showNotificationPopup('Minimal harus ada satu item dalam urutan.', false);
        return;
    }

    // Buat urutan baru
    const newSequence = {
        id: id,
        title: title,
        description: description,
        items: items,
        correctOrder: items.map(item => item.id) // Urutan benar adalah urutan input
    };

    // Kirim ke server
    fetch(CRUD_PHP_PATH, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ action: 'create', filePath: DATA_FILE_PATH, sequence: newSequence })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            showNotificationPopup('Urutan berhasil ditambahkan.');
            // Reset form
            document.getElementById('addSequenceForm').reset();
            document.getElementById('newItemsContainer').innerHTML = '';
            // TIDAK ADA loadData() DI SINI
        } else {
            showNotificationPopup('Gagal menambahkan urutan: ' + data.message, false);
        }
    })
    .catch(error => {
        console.error('Error saving sequence:', error);
        showNotificationPopup('Terjadi kesalahan saat menyimpan urutan.', false);
    });
}

// Fungsi untuk menampilkan form edit dan mengisi datanya
function editSequence(id) {
    fetch(CRUD_PHP_PATH, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ action: 'read', filePath: DATA_FILE_PATH })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            const sequenceToEdit = data.data.sequences.find(seq => seq.id === id);
            if (sequenceToEdit) {
                // Isi form edit
                document.getElementById('editingSequenceId').value = sequenceToEdit.id;
                document.getElementById('editSequenceId').value = sequenceToEdit.id;
                document.getElementById('editSequenceTitle').value = sequenceToEdit.title;
                document.getElementById('editSequenceDescription').value = sequenceToEdit.description;

                // Isi item di form edit
                const editItemsContainer = document.getElementById('editItemsContainer');
                if (!editItemsContainer) {
                    showNotificationPopup('Elemen editItemsContainer tidak ditemukan.', false);
                    return;
                }
                editItemsContainer.innerHTML = ''; // Kosongkan dulu
                sequenceToEdit.items.forEach((item, index) => {
                    const itemDiv = document.createElement('div');
                    itemDiv.className = 'flex items-center gap-2';
                    itemDiv.innerHTML = `
                        <input type="text" value="${item.text}" data-item-id="${item.id}" class="flex-grow p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <button type="button" class="remove-item-btn bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded-md transition duration-200">X</button>
                    `;
                    editItemsContainer.appendChild(itemDiv);

                    // Tambahkan event listener untuk tombol hapus item di form edit
                    itemDiv.querySelector('.remove-item-btn').addEventListener('click', function() {
                        editItemsContainer.removeChild(itemDiv);
                    });
                });

                // Tampilkan form edit
                const editFormContainer = document.getElementById('editSequenceFormContainer');
                if (editFormContainer) {
                    editFormContainer.classList.remove('hidden');
                } else {
                    showNotificationPopup('Elemen editSequenceFormContainer tidak ditemukan.', false);
                    return;
                }

                // Sembunyikan form tambah
                const addFormContainer = document.getElementById('addSequenceFormContainer');
                if (addFormContainer) {
                    addFormContainer.classList.add('hidden');
                } else {
                    showNotificationPopup('Elemen addSequenceFormContainer tidak ditemukan.', false);
                    // Tetap lanjutkan jika form tambah tidak ada
                }
            } else {
                showNotificationPopup(`Urutan dengan ID "${id}" tidak ditemukan untuk diedit.`, false);
            }
        } else {
            showNotificationPopup(`Gagal memuat data untuk edit: ${data.message}`, false);
        }
    })
    .catch(error => {
        console.error('Error fetching sequence for edit:', error);
        showNotificationPopup(`Terjadi kesalahan saat mengambil data untuk edit: ${error.message}`, false);
    });
}

// Fungsi untuk menyimpan perubahan urutan
function saveEditSequence() {
    const originalId = document.getElementById('editingSequenceId').value;
    const id = document.getElementById('editSequenceId').value.trim();
    const title = document.getElementById('editSequenceTitle').value.trim();
    const description = document.getElementById('editSequenceDescription').value.trim();

    if (!id || !title) {
        showNotificationPopup('ID dan Judul harus diisi.', false);
        return;
    }

    const items = [];
    const itemInputs = document.querySelectorAll('#editItemsContainer input[type="text"]');
    let hasEmptyItem = false;
    itemInputs.forEach(input => {
        if (input.value.trim() === '') {
            hasEmptyItem = true;
        } else {
            const itemId = input.getAttribute('data-item-id') || `${items.length + 1}`; // Gunakan ID lama jika ada
            items.push({
                id: itemId, // Gunakan ID asli item jika mungkin
                text: input.value.trim()
            });
        }
    });

    if (hasEmptyItem) {
        showNotificationPopup('Pastikan semua teks item diisi.', false);
        return;
    }

    if (items.length === 0) {
        showNotificationPopup('Minimal harus ada satu item dalam urutan.', false);
        return;
    }

    // Buat urutan yang diperbarui
    const updatedSequence = {
        id: id,
        title: title,
        description: description,
        items: items,
        correctOrder: items.map(item => item.id) // Urutan benar adalah urutan input
    };

    // Kirim ke server
    fetch(CRUD_PHP_PATH, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ action: 'update', filePath: DATA_FILE_PATH, sequenceId: originalId, sequence: updatedSequence })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            showNotificationPopup('Urutan berhasil diperbarui.');
            // Sembunyikan form edit
            const editFormContainer = document.getElementById('editSequenceFormContainer');
            if (editFormContainer) editFormContainer.classList.add('hidden');
            // Tampilkan form tambah kembali
            const addFormContainer = document.getElementById('addSequenceFormContainer');
            if (addFormContainer) addFormContainer.classList.remove('hidden');
            // Reset form edit
            document.getElementById('editSequenceForm').reset();
            document.getElementById('editItemsContainer').innerHTML = '';
            // TIDAK ADA loadData() DI SINI
        } else {
            showNotificationPopup('Gagal memperbarui urutan: ' + data.message, false);
        }
    })
    .catch(error => {
        console.error('Error updating sequence:', error);
        showNotificationPopup('Terjadi kesalahan saat memperbarui urutan.', false);
    });
}

// Fungsi untuk membatalkan edit dan menyembunyikan form edit
function cancelEdit() {
    const editFormContainer = document.getElementById('editSequenceFormContainer');
    if (editFormContainer) editFormContainer.classList.add('hidden');
    const addFormContainer = document.getElementById('addSequenceFormContainer');
    if (addFormContainer) addFormContainer.classList.remove('hidden'); // Tampilkan form tambah kembali
    document.getElementById('editSequenceForm').reset();
    document.getElementById('editItemsContainer').innerHTML = '';
}

// Fungsi untuk menghapus urutan
function deleteSequence(id) {
    showCustomPopup(
        'Konfirmasi Penghapusan',
        `Apakah kamu yakin ingin menghapus urutan "${id}"?`,
        () => { // onConfirm
            fetch(CRUD_PHP_PATH, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ action: 'delete', filePath: DATA_FILE_PATH, sequenceId: id })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    showNotificationPopup('Urutan berhasil dihapus.');
                    // TIDAK ADA loadData() DI SINI
                } else {
                    showNotificationPopup('Gagal menghapus urutan: ' + data.message, false);
                }
            })
            .catch(error => {
                console.error('Error deleting sequence:', error);
                showNotificationPopup('Terjadi kesalahan saat menghapus urutan.', false);
            });
        },
        () => { // onCancel
            // Jika cancel, tidak lakukan apa-apa
        }
    );
}

// --- INISIALISASI DAN EVENT LISTENER ---

// Muat data saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    // Flag untuk mengetahui apakah refresh dipicu oleh tombol
    window.isRefreshingData = false;

    // Tambahkan event listener setelah halaman dimuat
    document.getElementById('addNewItemBtn')?.addEventListener('click', addNewItemToForm);
    document.getElementById('saveNewSequenceBtn')?.addEventListener('click', saveNewSequence);
    document.getElementById('addEditItemBtn')?.addEventListener('click', function() {
        const container = document.getElementById('editItemsContainer');
        if (!container) return;
        const index = container.children.length;
        const itemDiv = document.createElement('div');
        itemDiv.className = 'flex items-center gap-2';
        itemDiv.innerHTML = `
            <input type="text" placeholder="Teks Item ${index + 1}" class="flex-grow p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
            <button type="button" class="remove-item-btn bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded-md transition duration-200">X</button>
        `;
        container.appendChild(itemDiv);

        // Tambahkan event listener untuk tombol hapus item di form edit
        itemDiv.querySelector('.remove-item-btn').addEventListener('click', function() {
            container.removeChild(itemDiv);
        });
    });
    document.getElementById('saveEditSequenceBtn')?.addEventListener('click', saveEditSequence);
    document.getElementById('cancelEditBtn')?.addEventListener('click', cancelEdit);
    
    // --- PERUBAHAN: Tambahkan event listener untuk tombol refresh dengan notifikasi ---
    document.getElementById('refreshDataBtn')?.addEventListener('click', function() {
        window.isRefreshingData = true; // Set flag
        loadData(); // Muat ulang data
    });
    // ---

    // Muat data awal
    loadData();
});