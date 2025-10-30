// --- File: script/admin_gamepertama.js ---
// Script untuk Admin Panel Game Pencocokan Istilah & Definisi

// --- 1. Konstanta dan Variabel Global ---
const API_URL = '../php/admin_gamepertama_handler.php'; // URL ke handler utama (baca/tambah/update)
const DELETE_URL = '../php/delete_item.php'; // URL ke handler khusus hapus
let itemsData = [];
let isEditing = false;
let currentItem = null;

// --- 2. Fungsi-Fungsi Utilitas ---
function showMessage(message, isSuccess = true) {
    const msgElement = document.getElementById('status-message');
    if (msgElement) {
        msgElement.textContent = message;
        msgElement.className = `message ${isSuccess ? 'success' : 'error'}`;
        msgElement.classList.remove('hidden');
        setTimeout(() => {
            msgElement.classList.add('hidden');
            msgElement.textContent = '';
        }, 5000); // Sembunyikan setelah 5 detik
    }
}

function showLoading(show = true) {
    const loadingEl = document.getElementById('loading');
    const tableEl = document.getElementById('items-table');
    if (loadingEl) loadingEl.classList.toggle('hidden', !show);
    if (tableEl) tableEl.classList.toggle('hidden', show);
    if (!show) {
        // Sembunyikan juga pesan status saat loading selesai
        const msgElement = document.getElementById('status-message');
        if (msgElement) msgElement.classList.add('hidden');
    }
}

// --- 3. Fungsi-Fungsi Utama ---

// 3.1. Muat Data dari Backend
async function loadData() {
    showLoading(true);
    try {
        const response = await fetch(API_URL, {
            method: 'POST', // Gunakan POST dengan action 'read'
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ action: 'read' }) // Kirim action 'read'
        });

        if (!response.ok) {
            const errorData = await response.json().catch(() => ({}));
            throw new Error(`${response.status}: ${errorData.message || response.statusText}`);
        }

        const data = await response.json();
        itemsData = data.pasangan || [];
        renderTable();
        showMessage("Data berhasil dimuat.", true);
    } catch (error) {
        console.error("Gagal memuat data:", error);
        showMessage(`Gagal memuat data. Silakan coba lagi. Error: ${error.message}`, false);
    } finally {
        showLoading(false);
    }
}

// 3.2. Render Tabel
function renderTable() {
    const tbody = document.getElementById('items-body');
    if (!tbody) return;
    tbody.innerHTML = '';

    if (itemsData.length === 0) {
        const row = document.createElement('tr');
        row.innerHTML = '<td colspan="4" style="text-align:center;">Tidak ada data.</td>';
        tbody.appendChild(row);
        return;
    }

    itemsData.forEach(item => {
        const row = document.createElement('tr');
        // Untuk responsif di mobile
        const idDisplay = String(item.id || 'N/A');
        row.innerHTML = `
            <td data-label="ID">${idDisplay.substring(0, 8)}...</td>
            <td data-label="Istilah">${item.istilah || ''}</td>
            <td data-label="Definisi">${item.definisi || ''}</td>
            <td data-label="Aksi" style="text-align:center;">
                <button onclick='window.editItem("${idDisplay}")' id='edit-btn'>Edit</button>
                <button onclick='window.deleteItem("${idDisplay}")' id='delete-btn'>Hapus</button>
            </td>
        `;
        tbody.appendChild(row);
    });
}

// 3.3. Tambah Item Baru
async function addItem(istilah, definisi) {
    try {
        const response = await fetch(API_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                action: 'add',
                istilah: istilah,
                definisi: definisi
            })
        });

        const result = await response.json();

        if (result.success) {
            showMessage(result.message, true);
            loadData(); // Reload data setelah tambah
            clearForm(); // Bersihkan form
        } else {
            // Tangani error spesifik seperti duplikat
            if(response.status === 409) { // Conflict
                 showMessage("Error: " + result.message, false);
            } else {
                showMessage(result.message || "Gagal menambah item.", false);
            }
        }
    } catch (error) {
        console.error("Error saat menambah item:", error);
        showMessage("Terjadi kesalahan saat menambah item: " + error.message, false);
    }
}

// 3.4. Edit Item (Global agar bisa dipanggil dari HTML)
window.editItem = function(id) {
    const item = itemsData.find(i => String(i.id) === String(id));
    if (item) {
        document.getElementById('item-id').value = item.id;
        document.getElementById('istilah').value = item.istilah || '';
        document.getElementById('definisi').value = item.definisi || '';
        document.getElementById('form-title').textContent = 'Edit Pasangan';
        document.getElementById('cancel-edit-btn').classList.remove('hidden');
        document.getElementById('save-btn').textContent = 'Update';
        isEditing = true;
        currentItem = item;
        window.scrollTo({ top: 0, behavior: 'smooth' }); // Gulir ke atas
    } else {
        showMessage("Item tidak ditemukan untuk diedit.", false);
    }
}

// 3.5. Update Item
async function updateItem(id, istilah, definisi) {
    try {
        const response = await fetch(API_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                action: 'update',
                id: id, // ID asli (bisa integer/string)
                istilah: istilah,
                definisi: definisi
            })
        });

        const result = await response.json();

        if (result.success) {
            showMessage(result.message, true);
            loadData(); // Reload data setelah update
            clearForm(); // Bersihkan form
        } else {
            showMessage(result.message || "Gagal memperbarui item.", false);
        }
    } catch (error) {
        console.error("Error saat memperbarui item:", error);
        showMessage("Terjadi kesalahan saat memperbarui item: " + error.message, false);
    }
}

// 3.6. Hapus Item (Global agar bisa dipanggil dari HTML)
window.deleteItem = function(id) {
    if (!confirm(`Apakah Anda yakin ingin menghapus item dengan ID '${id}' ini?`)) {
        return; // Batalkan jika pengguna tidak konfirmasi
    }
    performDelete(id);
}

async function performDelete(id) {
    showLoading(true);
    try {
        // --- PERUBAHAN: Gunakan endpoint khusus penghapusan ---
        const response = await fetch(DELETE_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: id // Kirim ID item yang akan dihapus
            })
        });
        // --- Akhir PERUBAHAN ---

        const result = await response.json();

        // --- PERUBAHAN: Tangani respon berdasarkan success flag dan status code ---
        if (response.ok && result.success) {
            // HTTP 2xx dan success=true
            showMessage(result.message, true);
            loadData(); // Reload data setelah hapus berhasil
        } else if (response.status === 404) {
             // HTTP 404 Not Found (item tidak ditemukan di backend)
             showMessage("Error 404: " + (result.message || "Item tidak ditemukan di server."), false);
             showLoading(false); // Sembunyikan loading jika error
        } else {
            // Error lainnya (400 Bad Request, 500 Internal Server Error, dll)
            const errorMessage = result.message || `Gagal menghapus item. Status: ${response.status}`;
            showMessage("Error: " + errorMessage, false);
            showLoading(false); // Sembunyikan loading jika error
        }
    } catch (error) {
        console.error("Error saat menghapus item:", error);
        showMessage("Terjadi kesalahan saat menghubungi server: " + (error.message || "Cek koneksi internet."), false);
        showLoading(false); // Sembunyikan loading jika error
    }
}

// 3.7. Bersihkan Form
function clearForm() {
    document.getElementById('item-form').reset();
    document.getElementById('item-id').value = '';
    document.getElementById('form-title').textContent = 'Tambah Pasangan Baru';
    document.getElementById('cancel-edit-btn').classList.add('hidden');
    document.getElementById('save-btn').textContent = 'Simpan';
    isEditing = false;
    currentItem = null;
}

// --- Event Listener ---
document.addEventListener('DOMContentLoaded', () => {
    loadData();

    document.getElementById('item-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const istilah = formData.get('istilah').trim();
        const definisi = formData.get('definisi').trim();

        if (!istilah || !definisi) {
            showMessage("Istilah dan definisi tidak boleh kosong.", false);
            return;
        }

        if (isEditing && currentItem) {
            await updateItem(currentItem.id, istilah, definisi);
        } else {
            await addItem(istilah, definisi);
        }
    });

    document.getElementById('cancel-edit-btn').addEventListener('click', () => {
        clearForm();
    });

    document.getElementById('refresh-btn').addEventListener('click', () => {
         loadData();
    });
});