<div x-data="{
    videoId: @js($video->id),
    videoUrl: @js($videoUrl),
    interactiveQuestions: @js($interactiveQuestions),
    currentTime: 0,
    duration: 0,
    isPlaying: false,
    showQuestion: false,
    currentQuestion: null,
    selectedAnswer: null,
    isCorrect: false,
    answers: {},
    videoElement: null,

    // --- VARIABEL BARU UNTUK SKOR ---
    showScore: false,
    correctAnswersCount: 0,
    totalQuestionsCount: 0,

    init() {
        this.$nextTick(() => {
            this.videoElement = this.$refs.video;
            if (this.videoElement) {
                // Inisialisasi jumlah total pertanyaan
                this.totalQuestionsCount = this.interactiveQuestions.length;
                console.log('Interactive Video Player Initialized. Video element found.');

                this.videoElement.addEventListener('timeupdate', () => {
                    this.currentTime = this.videoElement.currentTime;
                    this.checkInteractiveMoments();
                });

                this.videoElement.addEventListener('loadedmetadata', () => {
                    this.duration = this.videoElement.duration;
                });

                this.videoElement.addEventListener('play', () => {
                    this.isPlaying = true;
                });

                this.videoElement.addEventListener('pause', () => {
                    this.isPlaying = false;
                });

                this.videoElement.addEventListener('ended', () => {
                    this.isPlaying = false;
                    // --- PEMANGGILAN FUNGSI BARU KETIKA VIDEO SELESAI ---
                    this.calculateAndShowScore();
                });
            } else {
                console.error('Video element not found!');
            }
        });
    },

    checkInteractiveMoments() {
        this.interactiveQuestions.forEach(question => {
            // Periksa apakah pertanyaan sudah dijawab sebelumnya
            if (this.answers[question.id] !== undefined) {
                // Tandai bahwa pertanyaan ini sudah dijawab
                question.answered = true;
            }

            // Hanya trigger jika belum dijawab dan belum di-trigger
            if (Math.abs(this.currentTime - parseFloat(question.time_marker)) < 0.5 &&
                !question.triggered &&
                !question.answered) {
                this.triggerInteractiveMoment(question);
            }
        });
    },

    triggerInteractiveMoment(question) {
        question.triggered = true;
        this.videoElement.pause();
        this.currentQuestion = question;
        this.showQuestion = true;
        this.selectedAnswer = null;
        this.isCorrect = false;

        // Ambil jawaban yang sudah disimpan jika ada
        if (this.answers[question.id]) {
            this.selectedAnswer = this.answers[question.id].selected_answer;
            this.isCorrect = this.answers[question.id].is_correct;
        }
    },

    selectAnswer(answer) {
        // Jangan proses jika pertanyaan sudah dijawab sebelumnya
        if (this.answers[this.currentQuestion.id] !== undefined) {
            return;
        }

        this.selectedAnswer = answer;
        this.isCorrect = this.currentQuestion.correct_answer.toLowerCase() === answer.toLowerCase();

        this.answers[this.currentQuestion.id] = {
            question_id: this.currentQuestion.id,
            selected_answer: answer,
            is_correct: this.isCorrect
        };

        if (this.isCorrect) {
            setTimeout(() => {
                this.continueVideo();
            }, 1500);
        }
    },

    continueVideo() {
        this.showQuestion = false;
        this.videoElement.play();
    },

    restartVideo() {
        this.videoElement.currentTime = 0;
        // Reset hanya status trigger, tidak reset jawaban
        this.interactiveQuestions.forEach(q => {
            q.triggered = false;
            q.answered = false; // Reset status answered juga
        });
        this.videoElement.play();
    },

    togglePlayPause() {
        if (this.videoElement.paused) {
            this.videoElement.play();
        } else {
            this.videoElement.pause();
        }
    },

    // --- FUNGSI BARU UNTUK MENGHITUNG DAN MENAMPILKAN SKOR ---
    calculateAndShowScore() {
        if (this.totalQuestionsCount === 0) {
            return; // Tidak ada pertanyaan, tidak perlu tampilkan skor
        }

        // Hitung jawaban benar
        this.correctAnswersCount = Object.values(this.answers).filter(answer => answer.is_correct).length;

        // Tampilkan overlay skor
        this.showScore = true;
    },

    // --- FUNGSI BARU UNTUK MENUTUP OVERLAY SKOR ---
    closeScoreOverlay() {
        this.showScore = false;
    },

    formatTime(seconds) {
        if (isNaN(seconds)) return '0:00';
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return mins + ':' + String(secs).padStart(2, '0');
    }
}"
    class="relative max-w-4xl mx-auto bg-white rounded-lg shadow-2xl overflow-hidden">
    <!-- Video Player -->
    <div class="relative bg-black">
        <video x-ref="video" :src="videoUrl" class="w-full aspect-video bg-black"></video>

        <!-- Progress Bar Kustom (HANYA UNTUK TAMPILAN) -->
        <div
            class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/90 to-transparent px-4 pb-2">
            <div class="w-full bg-gray-600 h-1 rounded-full mb-2">
                <div class="bg-blue-500 h-full rounded-full transition-all"
                    :style="`width: ${(currentTime / duration) * 100}%`">
                </div>
            </div>
            <div class="flex items-center justify-between text-white text-sm">
                <span x-text="formatTime(currentTime)">0:00</span>
                <span x-text="formatTime(duration)">0:00</span>
            </div>
        </div>
    </div>

    <!-- TOMBOL DI BAWAH VIDEO -->
    <div class="bg-gradient-to-r from-gray-800 to-gray-900 p-4">
        <div
            class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-4">
            <!-- Tombol Restart -->
            <button @click="restartVideo"
                class="flex items-center justify-center space-x-2 px-4 py-2.5 sm:px-6 sm:py-3 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold rounded-lg shadow-lg transition-all transform hover:scale-105 active:scale-95"
                title="Mulai dari Awal">
                <i class="fas fa-undo text-lg sm:text-xl"></i>
                <span class="text-sm sm:text-base">Restart</span>
            </button>

            <!-- Tombol Play/Pause -->
            <button @click="togglePlayPause"
                class="flex items-center justify-center space-x-2 px-6 py-3 sm:px-8 sm:py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-xl transition-all transform hover:scale-105 active:scale-95"
                title="Putar/Jeda">
                <span x-show="!isPlaying" class="flex items-center space-x-2">
                    <i class="fas fa-play text-xl sm:text-2xl"></i>
                    <span class="text-base sm:text-lg">Putar</span>
                </span>
                <span x-show="isPlaying" class="flex items-center space-x-2">
                    <i class="fas fa-pause text-xl sm:text-2xl"></i>
                    <span class="text-base sm:text-lg">Jeda</span>
                </span>
            </button>

            <!-- Kontrol Volume -->
            <div
                class="flex items-center justify-center space-x-2 px-3 py-2.5 sm:px-4 sm:py-3 bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors">
                <i class="fas fa-volume-up text-white text-sm sm:text-base"></i>
                <input type="range" min="0" max="100" value="100"
                    @input="videoElement.volume = $event.target.value / 100"
                    class="w-24 sm:w-20 h-2 bg-gray-500 rounded-lg appearance-none cursor-pointer accent-blue-500">
            </div>
        </div>

        <!-- Indikator Pertanyaan Interaktif -->
        <div class="mt-3 text-center text-gray-300 text-sm"
            x-show="interactiveQuestions.length > 0">
            <i class="fas fa-question-circle"></i>
            <span x-text="interactiveQuestions.length + ' pertanyaan interaktif tersedia'"></span>
        </div>
    </div>

    <!-- Overlay Pertanyaan Interaktif -->
    <div x-show="showQuestion" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
        class="absolute inset-0 bg-black/90 flex items-center justify-center z-20 p-4"
        style="display: none;">
        <div
            class="bg-white rounded-xl w-full max-w-2xl h-full max-h-[90vh] flex flex-col shadow-2xl">
            <div class="flex-grow overflow-y-auto p-4 sm:p-6">
                <div class="flex items-center justify-between mb-4 pb-4 border-b">
                    <div class="flex items-center space-x-2">
                        <div
                            class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-question text-white"></i>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-gray-800">Pertanyaan Interaktif
                        </h3>
                    </div>
                </div>

                <p class="text-base sm:text-lg font-semibold mb-6 text-gray-700 break-words"
                    x-text="currentQuestion?.question"></p>

                <div class="space-y-3">
                    <template
                        x-for="(option, key) in {a: currentQuestion?.option_a, b: currentQuestion?.option_b, c: currentQuestion?.option_c, d: currentQuestion?.option_d}"
                        :key="key">
                        <button @click="selectAnswer(key)"
                            class="w-full text-left p-3 sm:p-4 rounded-lg border-2 transition-all duration-200 font-medium"
                            :class="{
                                // Jika sudah dijawab, tampilkan status jawaban
                                'border-green-500 bg-green-50 shadow-lg': answers[currentQuestion
                                        ?.id] && answers[currentQuestion?.id].selected_answer ===
                                    key && answers[currentQuestion?.id].is_correct,
                                'border-red-500 bg-red-50': answers[currentQuestion?.id] && answers[
                                    currentQuestion?.id].selected_answer === key && !answers[
                                    currentQuestion?.id].is_correct,
                                // Jika belum dijawab, tampilkan status normal
                                'border-blue-500 bg-blue-50 shadow-md transform scale-[1.02]': selectedAnswer ===
                                    key && !isCorrect && selectedAnswer !== null && !answers[
                                        currentQuestion?.id],
                                'border-gray-300 hover:bg-gray-50 hover:border-gray-400': selectedAnswer !==
                                    key && selectedAnswer === null && !answers[currentQuestion?.id],
                                'opacity-50 cursor-not-allowed': answers[currentQuestion?.id] !==
                                    undefined
                            }"
                            :disabled="answers[currentQuestion?.id] !== undefined">
                            <span class="font-bold" x-text="key.toUpperCase() + '.'"></span>
                            <span x-text="' ' + option"></span>
                        </button>
                    </template>
                </div>
            </div>

            <div class="flex-shrink-0 p-4 bg-gray-50 border-t rounded-b-xl">
                <div x-show="answers[currentQuestion?.id]"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="mb-4 p-3 sm:p-4 rounded-lg flex items-center space-x-3"
                    :class="answers[currentQuestion?.id]?.is_correct ?
                        'bg-green-100 border-2 border-green-500' :
                        'bg-red-100 border-2 border-red-500'">
                    <div class="flex-shrink-0">
                        <i
                            :class="answers[currentQuestion?.id]?.is_correct ?
                                'fas fa-check-circle text-green-600 text-xl sm:text-2xl' :
                                'fas fa-times-circle text-red-600 text-xl sm:text-2xl'"></i>
                    </div>
                    <div>
                        <span class="font-bold"
                            :class="answers[currentQuestion?.id]?.is_correct ? 'text-green-800' :
                                'text-red-800'"
                            x-text="answers[currentQuestion?.id]?.is_correct ? 'Jawaban Benar!' : 'Jawaban Salah!'"></span>
                        <p x-show="!answers[currentQuestion?.id]?.is_correct"
                            class="text-sm text-red-700 mt-1">
                            Jawaban yang benar: <span class="font-bold"
                                x-text="currentQuestion?.correct_answer?.toUpperCase()"></span>
                        </p>
                    </div>
                </div>

                <button @click="continueVideo"
                    class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all shadow-lg hover:shadow-xl transform hover:scale-105 active:scale-95"
                    x-show="answers[currentQuestion?.id] || selectedAnswer"
                    x-transition:enter="transition ease-out duration-200 delay-300"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100">
                    <i class="fas fa-play-circle mr-2"></i>
                    <span>Lanjutkan</span>
                </button>
            </div>
        </div>
    </div>

    <!-- --- OVERLAY BARU: SKOR AKHIR --- -->
    <div x-show="showScore" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
        class="absolute inset-0 bg-black/90 flex items-center justify-center z-40 p-4"
        style="display: none;">
        <div class="bg-white rounded-xl p-6 sm:p-8 max-w-md w-full text-center shadow-2xl">
            <div class="mb-4">
                <i class="fas fa-trophy text-6xl text-yellow-500"></i>
            </div>
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Video Selesai!</h2>
            <p class="text-gray-600 mb-6">Terima kasih telah menonton. Ini adalah skor Anda:</p>

            <!-- TAMPILAN SKOR -->
            <div class="text-5xl sm:text-6xl font-bold text-blue-600 mb-6">
                <span x-text="correctAnswersCount">0</span>
                <span class="text-gray-500">/</span>
                <span x-text="totalQuestionsCount">0</span>
            </div>

            <p class="text-sm text-gray-500 mb-6">
                <span x-text="correctAnswersCount"></span> jawaban benar dari <span
                    x-text="totalQuestionsCount"></span> pertanyaan.
            </p>

            <!-- TOMBOL TUTUP -->
            <button @click="closeScoreOverlay()"
                class="w-full px-6 py-3 bg-gray-700 hover:bg-gray-800 text-white font-semibold rounded-lg transition-all shadow-lg hover:shadow-xl transform hover:scale-105 active:scale-95">
                <i class="fas fa-times mr-2"></i>
                Tutup
            </button>
        </div>
    </div>
</div>
