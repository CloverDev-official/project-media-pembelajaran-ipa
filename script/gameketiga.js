// script/gameketiga.js
let gameData = null;
let currentSequence = null;

document.addEventListener('DOMContentLoaded', function() {
    const jsonDataElement = document.getElementById('jsonDataPath');
    const jsonDataPath = JSON.parse(jsonDataElement.textContent).jsonPath;

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

    document.getElementById('validateBtn').addEventListener('click', validateAnswers);
    document.getElementById('resetBtn').addEventListener('click', resetGame);
    document.getElementById('sequenceSelect').addEventListener('change', loadSequence);
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

    if (gameData.sequences.length > 0) {
        select.selectedIndex = 1;
        const event = new Event('change');
        select.dispatchEvent(event);
    }
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
        resetGame();
    }
}

function displaySequence(sequence) {
    document.getElementById('sequenceTitle').textContent = sequence.title;
    document.getElementById('sequenceDescription').textContent = sequence.description;
    document.getElementById('caseStudyContent').textContent = sequence.case_study;

    const questionsContainer = document.getElementById('questionsContainer');
    questionsContainer.innerHTML = '';

    sequence.questions.forEach((q, index) => {
        const questionDiv = document.createElement('div');
        questionDiv.className = 'mb-4 p-3 border border-gray-200 rounded-md bg-gray-50';
        let optionsHtml = '';
        q.options.forEach((optObj, optIndex) => {
            const optionText = typeof optObj === 'object' && optObj !== null ? optObj.text : optObj;
            const letter = String.fromCharCode(65 + optIndex);

            optionsHtml += `
                <label class="flex items-start space-x-2 p-2 rounded hover:bg-gray-100 cursor-pointer">
                    <input type="radio" name="question_${q.id}" value="${letter}" data-consequence="${typeof optObj === 'object' && optObj !== null ? optObj.consequence || '' : ''}" class="mt-1 text-blue-600 focus:ring-blue-500">
                    <span class="font-medium">${letter}.</span>
                    <span>${optionText}</span>
                </label>
            `;
        });
        questionDiv.innerHTML = `
            <p class="font-medium mb-2"><span class="font-bold">Pertanyaan ${index + 1}:</span> ${q.question}</p>
            <div class="space-y-2">
                ${optionsHtml}
            </div>
            <div id="consequence_${q.id}" class="mt-2 p-2 rounded-md text-sm hidden"></div>
        `;
        questionsContainer.appendChild(questionDiv);
    });
}

function validateAnswers() {
    if (!currentSequence) return;

    currentSequence.questions.forEach(q => {
        const selectedRadio = document.querySelector(`input[name="question_${q.id}"]:checked`);
        const consequenceDiv = document.getElementById(`consequence_${q.id}`);

        if (consequenceDiv) {
            if (!selectedRadio) {
                consequenceDiv.textContent = "⚠️ Belum dijawab.";
                consequenceDiv.className = "mt-2 p-2 rounded-md text-sm bg-yellow-100 text-yellow-800";
                consequenceDiv.classList.remove('hidden');
                return; // Lanjut ke pertanyaan berikutnya
            }

            const userAnswerLetter = selectedRadio.value;
            const isCorrect = userAnswerLetter === q.correct_answer;
            const consequence = selectedRadio.getAttribute('data-consequence') || '';

            if (isCorrect) {
                const consequenceText = consequence
                consequenceDiv.textContent = `✅ Benar! ${consequenceText}`;
                consequenceDiv.className = "mt-2 p-2 rounded-md text-sm bg-green-100 text-green-800";
            } else {
                const consequenceText = consequence || `❌ Jawaban ${userAnswerLetter} salah.`;
                consequenceDiv.innerHTML = `<span class="font-medium">❌ </span> ${consequenceText}`;
                consequenceDiv.className = "mt-2 p-2 rounded-md text-sm bg-red-100 text-red-800";
            }
            consequenceDiv.classList.remove('hidden');
        }
    });
}

function resetGame() {
    if (currentSequence) {
        document.querySelectorAll('input[type="radio"]').forEach(radio => radio.checked = false);
        document.querySelectorAll('[id^="consequence_"]').forEach(div => {
            div.classList.add('hidden');
            div.textContent = '';
        });
    }
}