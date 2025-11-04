// script/admin_gameketiga.js

// Path ke file JSON dan script PHP untuk CRUD
const DATA_FILE_PATH = '../data/gameketiga_data.json';
const CRUD_PHP_PATH = '../php/crud_gameketiga.php';

// Fungsi untuk menampilkan notifikasi toast
function showNotification(message, isSuccess = true) {
    const toast = document.getElementById('notificationToast');
    toast.textContent = message;
    toast.className = `fixed top-4 right-4 z-50 p-4 rounded-md shadow-lg text-white font-medium ${isSuccess ? 'bg-green-500' : 'bg-red-500'}`;
    toast.classList.remove('hidden');

    setTimeout(() => {
        toast.classList.add('hidden');
    }, 3000);
}

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
        } else {
            showNotification('Gagal memuat  ' + data.message, false);
        }
    })
    .catch(error => {
        console.error('Error loading ', error);
        showNotification('Terjadi kesalahan saat memuat data.', false);
    });
}

// Fungsi untuk menampilkan daftar studi kasus
function displaySequences(sequences) {
    const listContainer = document.getElementById('sequencesList');
    listContainer.innerHTML = '';

    sequences.forEach(seq => {
        const seqDiv = document.createElement('div');
        seqDiv.className = 'border border-gray-200 rounded-lg p-4';

        const titleDiv = document.createElement('div');
        titleDiv.className = 'flex flex-col sm:flex-row sm:justify-between sm:items-start mb-2 gap-2 sm:gap-0';
        titleDiv.innerHTML = `
            <div>
                <h3 class="text-lg font-semibold text-gray-800">${seq.title}</h3>
                <p class="text-sm text-gray-600">${seq.description}</p>
                <p class="text-xs text-gray-500 mt-1">ID: ${seq.id}</p>
            </div>
            <div class="flex space-x-2 mt-2 sm:mt-0"> <!-- Tambahkan margin untuk mobile -->
                <button onclick="editSequence('${seq.id}')" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded-md text-sm transition duration-200">Edit</button>
                <button onclick="deleteSequence('${seq.id}')" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded-md text-sm transition duration-200">Hapus</button>
            </div>
        `;
        seqDiv.appendChild(titleDiv);

        const itemsDiv = document.createElement('div');
        itemsDiv.className = 'mt-4';
        itemsDiv.innerHTML = '<h4 class="font-medium text-gray-700 mb-2">Pertanyaan:</h4>';
        const itemList = document.createElement('ul');
        itemList.className = 'list-disc pl-5 space-y-1';
        seq.questions.forEach(q => {
            const li = document.createElement('li');
            // Menampilkan jawaban benar berdasarkan ID opsi
            const correctOption = q.options.find(opt => opt.id === q.correct_answer);
            const correctAnswerDisplay = correctOption ? `Opsi ${correctOption.id} (${correctOption.text})` : 'Tidak Valid';
            li.innerHTML = `<strong>${q.question}</strong><br><em>Jawaban Benar: ${correctAnswerDisplay}</em>`;
            itemList.appendChild(li);
        });
        itemsDiv.appendChild(itemList);
        seqDiv.appendChild(itemsDiv);

        listContainer.appendChild(seqDiv);
    });
}

// Fungsi untuk menambahkan form pertanyaan baru di form tambah/edit studi kasus
function addNewItemToForm(containerId) {
    const container = document.getElementById(containerId);
    const index = container.children.length;
    const questionDiv = document.createElement('div');
    questionDiv.className = 'border p-4 rounded-md bg-gray-50 space-y-4 mb-4';

    // Opsi A-D untuk dropdown jawaban benar
    const correctAnswerOptions = ['A', 'B', 'C', 'D'];

    questionDiv.innerHTML = `
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Pertanyaan ${index + 1}:</label>
            <input type="text" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 question-text text-base sm:text-lg" placeholder="Masukkan pertanyaan..." required>
        </div>

        <div class="space-y-4">
            <label class="block text-sm font-medium text-gray-600">Pilihan Jawaban:</label>
            <div class="space-y-4">
                <!-- Opsi A -->
                <div class="space-y-2">
                    <div class="flex items-center space-x-3">
                        <span class="font-bold text-lg">A.</span>
                        <input type="text" class="flex-grow p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 option-text text-base sm:text-lg" placeholder="Teks Opsi A" required>
                    </div>
                    <textarea rows="3" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 option-consequence resize-vertical text-base sm:text-lg leading-relaxed min-h-[80px]" placeholder="Konsekuensi jika dipilih"></textarea>
                </div>
                <!-- Opsi B -->
                <div class="space-y-2">
                    <div class="flex items-center space-x-3">
                        <span class="font-bold text-lg">B.</span>
                        <input type="text" class="flex-grow p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 option-text text-base sm:text-lg" placeholder="Teks Opsi B" required>
                    </div>
                    <textarea rows="3" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 option-consequence resize-vertical text-base sm:text-lg leading-relaxed min-h-[80px]" placeholder="Konsekuensi jika dipilih"></textarea>
                </div>
                <!-- Opsi C -->
                <div class="space-y-2">
                    <div class="flex items-center space-x-3">
                        <span class="font-bold text-lg">C.</span>
                        <input type="text" class="flex-grow p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 option-text text-base sm:text-lg" placeholder="Teks Opsi C" required>
                    </div>
                    <textarea rows="3" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 option-consequence resize-vertical text-base sm:text-lg leading-relaxed min-h-[80px]" placeholder="Konsekuensi jika dipilih"></textarea>
                </div>
                <!-- Opsi D -->
                <div class="space-y-2">
                    <div class="flex items-center space-x-3">
                        <span class="font-bold text-lg">D.</span>
                        <input type="text" class="flex-grow p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 option-text text-base sm:text-lg" placeholder="Teks Opsi D" required>
                    </div>
                    <textarea rows="3" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 option-consequence resize-vertical text-base sm:text-lg leading-relaxed min-h-[80px]" placeholder="Konsekuensi jika dipilih"></textarea>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <label class="block text-sm font-medium text-gray-600">Jawaban Benar:</label>
            <select class="correct-answer-select w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base sm:text-lg">
                <option value="">-- Pilih Jawaban Benar --</option>
                ${correctAnswerOptions.map(opt => `<option value="${opt}" class="text-base sm:text-lg">${opt}</option>`).join('')}
            </select>
        </div>

        <button type="button" class="remove-question-btn bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md text-base sm:text-lg transition duration-200 mt-3 w-full sm:w-auto">
            Hapus Pertanyaan
        </button>
    `;

    container.appendChild(questionDiv);

    questionDiv.querySelector('.remove-question-btn').addEventListener('click', function() {
        container.removeChild(questionDiv);
    });
}

// Fungsi untuk menyimpan studi kasus baru
document.getElementById('saveNewSequenceBtn').addEventListener('click', function() {
    const id = document.getElementById('newSequenceId').value.trim();
    const title = document.getElementById('newSequenceTitle').value.trim();
    const description = document.getElementById('newSequenceDescription').value.trim();
    const caseStudy = document.getElementById('newCaseStudyContent').value.trim();

    if (!id || !title || !caseStudy) {
        showNotification('ID, Judul, dan Isi Studi Kasus harus diisi.', false);
        return;
    }

    const questions = [];
    const questionContainers = document.querySelectorAll('#newQuestionsContainer > div');
    let hasIncompleteQuestion = false;

    questionContainers.forEach((qContainer, qIndex) => {
        const questionText = qContainer.querySelector('.question-text').value.trim();
        const optionInputs = qContainer.querySelectorAll('.option-text');
        const consequenceInputs = qContainer.querySelectorAll('.option-consequence');
        const correctAnswerSelect = qContainer.querySelector('.correct-answer-select');

        if (!questionText) {
            hasIncompleteQuestion = true;
            console.error(`Pertanyaan ${qIndex + 1} tidak diisi.`);
            return; // Lanjutkan ke pertanyaan berikutnya
        }

        let optionTexts = [];
        let optionConsequences = [];
        let allOptionsFilled = true;
        optionInputs.forEach((input, optIndex) => {
            const text = input.value.trim();
            if (text === '') {
                allOptionsFilled = false;
                console.error(`Opsi ${String.fromCharCode(65 + optIndex)} pada Pertanyaan ${qIndex + 1} kosong.`);
            }
            optionTexts.push(text);
            optionConsequences.push(consequenceInputs[optIndex].value.trim());
        });

        if (!allOptionsFilled) {
            hasIncompleteQuestion = true;
            return; // Lanjutkan ke pertanyaan berikutnya
        }

        const correctAnswer = correctAnswerSelect.value;
        if (!correctAnswer) {
            hasIncompleteQuestion = true;
            console.error(`Jawaban benar untuk Pertanyaan ${qIndex + 1} tidak dipilih.`);
            return; // Lanjutkan ke pertanyaan berikutnya
        }

        const questionObject = {
            id: `${qIndex + 1}`, // ID otomatis
            question: questionText,
            options: [],
            correct_answer: correctAnswer // Gunakan nilai dari dropdown
        };

        optionTexts.forEach((text, idx) => {
            questionObject.options.push({
                id: String.fromCharCode(65 + idx), // A, B, C, D
                text: text,
                consequence: optionConsequences[idx]
            });
        });

        questions.push(questionObject);
    });

    if (hasIncompleteQuestion) {
        showNotification('Pastikan semua teks pertanyaan, teks opsi, konsekuensi, dan jawaban benar untuk setiap pertanyaan diisi.', false);
        return;
    }

    if (questions.length === 0) {
        showNotification('Minimal harus ada satu pertanyaan dalam studi kasus.', false);
        return;
    }

    const newSequence = {
        id: id,
        title: title,
        description: description,
        case_study: caseStudy,
        questions: questions
    };

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
            showNotification('Studi kasus berhasil ditambahkan.');
            document.getElementById('addSequenceForm').reset();
            document.getElementById('newQuestionsContainer').innerHTML = '';
            loadData();
        } else {
            showNotification('Gagal menambahkan studi kasus: ' + data.message, false);
        }
    })
    .catch(error => {
        console.error('Error saving sequence:', error);
        showNotification('Terjadi kesalahan saat menyimpan studi kasus.', false);
    });
});

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
                document.getElementById('editingSequenceId').value = sequenceToEdit.id;
                document.getElementById('editSequenceId').value = sequenceToEdit.id;
                document.getElementById('editSequenceTitle').value = sequenceToEdit.title;
                document.getElementById('editSequenceDescription').value = sequenceToEdit.description;
                document.getElementById('editCaseStudyContent').value = sequenceToEdit.case_study;

                const editQuestionsContainer = document.getElementById('editQuestionsContainer');
                editQuestionsContainer.innerHTML = '';

                sequenceToEdit.questions.forEach((q, qIndex) => {
                    const questionDiv = document.createElement('div');
                    questionDiv.className = 'border p-4 rounded-md bg-gray-50 space-y-4 mb-4';

                    const correctAnswerOptions = ['A', 'B', 'C', 'D'];

                    // Buat HTML untuk pertanyaan dan opsi, isi dengan data dari JSON
                    let optionsHtml = '';
                    q.options.forEach((opt, optIndex) => {
                        optionsHtml += `
                            <div class="space-y-2">
                                <div class="flex items-center space-x-3">
                                    <span class="font-bold text-lg">${opt.id}.</span>
                                    <input type="text" class="flex-grow p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-yellow-500 option-text text-base sm:text-lg" value="${opt.text}" required>
                                </div>
                                <textarea rows="3" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-yellow-500 option-consequence resize-vertical text-base sm:text-lg leading-relaxed min-h-[80px]" placeholder="Konsekuensi jika dipilih">${opt.consequence || ''}</textarea>
                            </div>
                        `;
                    });

                    // Buat dropdown jawaban benar dan pilih yang sesuai
                    let correctAnswerSelectHtml = `<select class="correct-answer-select w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-base sm:text-lg">`;
                    correctAnswerOptions.forEach(opt => {
                        const selected = (opt === q.correct_answer) ? 'selected' : '';
                        correctAnswerSelectHtml += `<option value="${opt}" class="text-base sm:text-lg" ${selected}>${opt}</option>`;
                    });
                    correctAnswerSelectHtml += '</select>';

                    questionDiv.innerHTML = `
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Pertanyaan ${qIndex + 1}:</label>
                            <input type="text" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 question-text text-base sm:text-lg" value="${q.question}" required>
                        </div>
                        <div class="space-y-4">
                            <label class="block text-sm font-medium text-gray-600">Pilihan Jawaban:</label>
                            <div class="space-y-4">
                                ${optionsHtml}
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="block text-sm font-medium text-gray-600">Jawaban Benar:</label>
                            ${correctAnswerSelectHtml}
                        </div>
                        <button type="button" class="remove-question-btn bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md text-base sm:text-lg transition duration-200 mt-3 w-full sm:w-auto">
                            Hapus Pertanyaan
                        </button>
                    `;

                    editQuestionsContainer.appendChild(questionDiv);

                    questionDiv.querySelector('.remove-question-btn').addEventListener('click', function() {
                        editQuestionsContainer.removeChild(questionDiv);
                    });
                });

                document.getElementById('editSequenceFormContainer').classList.remove('hidden');
                document.getElementById('addSequenceForm').closest('.bg-white').classList.add('hidden');
            } else {
                showNotification(`Studi kasus dengan ID "${id}" tidak ditemukan untuk diedit.`, false);
            }
        } else {
            showNotification(`Gagal memuat data untuk edit: ${data.message}`, false);
        }
    })
    .catch(error => {
        console.error('Error fetching sequence for edit:', error);
        showNotification(`Terjadi kesalahan saat mengambil data untuk edit: ${error.message}`, false);
    });
}

// Fungsi untuk menyimpan perubahan studi kasus
document.getElementById('saveEditSequenceBtn').addEventListener('click', function() {
    const originalId = document.getElementById('editingSequenceId').value;
    const id = document.getElementById('editSequenceId').value.trim();
    const title = document.getElementById('editSequenceTitle').value.trim();
    const description = document.getElementById('editSequenceDescription').value.trim();
    const caseStudy = document.getElementById('editCaseStudyContent').value.trim();

    if (!id || !title || !caseStudy) {
        showNotification('ID, Judul, dan Isi Studi Kasus harus diisi.', false);
        return;
    }

    const questions = [];
    const questionContainers = document.querySelectorAll('#editQuestionsContainer > div');
    let hasIncompleteQuestion = false;

    questionContainers.forEach((qContainer, qIndex) => {
        const questionText = qContainer.querySelector('.question-text').value.trim();
        const optionInputs = qContainer.querySelectorAll('.option-text');
        const consequenceInputs = qContainer.querySelectorAll('.option-consequence');
        const correctAnswerSelect = qContainer.querySelector('.correct-answer-select');

        if (!questionText) {
            hasIncompleteQuestion = true;
            console.error(`Pertanyaan ${qIndex + 1} tidak diisi.`);
            return;
        }

        let optionTexts = [];
        let optionConsequences = [];
        let allOptionsFilled = true;
        optionInputs.forEach((input, optIndex) => {
            const text = input.value.trim();
            if (text === '') {
                allOptionsFilled = false;
                console.error(`Opsi ${String.fromCharCode(65 + optIndex)} pada Pertanyaan ${qIndex + 1} kosong.`);
            }
            optionTexts.push(text);
            optionConsequences.push(consequenceInputs[optIndex].value.trim());
        });

        if (!allOptionsFilled) {
            hasIncompleteQuestion = true;
            return;
        }

        const correctAnswer = correctAnswerSelect.value;
        if (!correctAnswer) {
            hasIncompleteQuestion = true;
            console.error(`Jawaban benar untuk Pertanyaan ${qIndex + 1} tidak dipilih.`);
            return;
        }

        const questionObject = {
            id: `${qIndex + 1}`, // ID otomatis
            question: questionText,
            options: [],
            correct_answer: correctAnswer // Gunakan nilai dari dropdown
        };

        optionTexts.forEach((text, idx) => {
            questionObject.options.push({
                id: String.fromCharCode(65 + idx),
                text: text,
                consequence: optionConsequences[idx]
            });
        });

        questions.push(questionObject);
    });

    if (hasIncompleteQuestion) {
        showNotification('Pastikan semua teks pertanyaan, teks opsi, konsekuensi, dan jawaban benar untuk setiap pertanyaan diisi.', false);
        return;
    }

    if (questions.length === 0) {
        showNotification('Minimal harus ada satu pertanyaan dalam studi kasus.', false);
        return;
    }

    const updatedSequence = {
        id: id,
        title: title,
        description: description,
        case_study: caseStudy,
        questions: questions
    };

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
            showNotification('Studi kasus berhasil diperbarui.');
            document.getElementById('editSequenceFormContainer').classList.add('hidden');
            document.getElementById('addSequenceForm').closest('.bg-white').classList.remove('hidden');
            document.getElementById('editSequenceForm').reset();
            document.getElementById('editQuestionsContainer').innerHTML = ''; // Perbaikan: gunakan ID yang benar
            loadData();
        } else {
            showNotification('Gagal memperbarui studi kasus: ' + data.message, false);
        }
    })
    .catch(error => {
        console.error('Error updating sequence:', error);
        showNotification('Terjadi kesalahan saat memperbarui studi kasus.', false);
    });
});

// Fungsi untuk membatalkan edit
document.getElementById('cancelEditBtn').addEventListener('click', function() {
    document.getElementById('editSequenceFormContainer').classList.add('hidden');
    document.getElementById('addSequenceForm').closest('.bg-white').classList.remove('hidden');
    document.getElementById('editSequenceForm').reset();
    document.getElementById('editQuestionsContainer').innerHTML = ''; // Perbaikan: gunakan ID yang benar
});

// Fungsi untuk menghapus studi kasus
function deleteSequence(id) {
    if (confirm(`Apakah kamu yakin ingin menghapus studi kasus "${id}"?`)) {
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
                showNotification('Studi kasus berhasil dihapus.');
                loadData();
            } else {
                showNotification('Gagal menghapus studi kasus: ' + data.message, false);
            }
        })
        .catch(error => {
            console.error('Error deleting sequence:', error);
            showNotification('Terjadi kesalahan saat menghapus studi kasus.', false);
        });
    }
}

// Tambahkan event listener untuk tombol tambah pertanyaan di form tambah
document.getElementById('addNewQuestionBtn').addEventListener('click', function() {
    addNewItemToForm('newQuestionsContainer');
});

// Tambahkan event listener untuk tombol tambah pertanyaan di form edit
document.getElementById('addEditQuestionBtn').addEventListener('click', function() {
    addNewItemToForm('editQuestionsContainer');
});

// Muat data saat halaman dimuat
document.addEventListener('DOMContentLoaded', loadData);
