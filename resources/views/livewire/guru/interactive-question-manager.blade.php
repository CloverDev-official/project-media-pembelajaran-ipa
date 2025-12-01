<div>
    <!-- Notifikasi ToastMagic -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd"></path>
            </svg>
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                    clip-rule="evenodd"></path>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6 mb-6 mt-10">
        <h3 class="text-3xl font-semibold mb-4 capitalize">tambah pertanyaan video interaktif {{ $video->title }}</h3>
        <form wire:submit.prevent="addQuestion" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Muncul
                        (detik)</label>
                    <input type="number" wire:model="newQuestion.time_marker"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Detik ke berapa pertanyaan muncul">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jawaban
                        Benar</label>
                    <select wire:model="newQuestion.correct_answer"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih jawaban benar</option>
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pertanyaan</label>
                <textarea wire:model="newQuestion.question" rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan pertanyaan"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilihan A</label>
                    <input type="text" wire:model="newQuestion.option_a"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Pilihan A">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilihan B</label>
                    <input type="text" wire:model="newQuestion.option_b"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Pilihan B">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilihan C</label>
                    <input type="text" wire:model="newQuestion.option_c"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Pilihan C">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilihan D</label>
                    <input type="text" wire:model="newQuestion.option_d"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Pilihan D">
                </div>
            </div>

            <button type="submit"
                class="mt-4 flex items-center gap-1 px-4 py-2 bg-green-200 text-green-700 rounded-lg transition-all duration-150 hover:bg-green-300 hover:scale-105 active:scale-95">
                    <iconify-icon icon="line-md:plus" class="text-sm"></iconify-icon>
                        Tambah Pertanyaan
            </button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold mb-4">Daftar Pertanyaan</h3>
        <div class="space-y-4">
            @forelse($questions as $question)
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <span
                                class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">
                                Detik ke {{ $question['time_marker'] }}
                            </span>
                            <h4 class="font-medium text-gray-800 mt-1">{{ $question['question'] }}
                            </h4>
                        </div>
                        <button wire:click="deleteQuestion({{ $question['id'] }})"
                            class="text-red-600 hover:text-red-800 text-sm">
                            Hapus
                        </button>
                    </div>
                    <div class="grid grid-cols-2 gap-2 mt-2">
                        <div class="flex items-center">
                            <span
                                class="font-semibold mr-2 @if ($question['correct_answer'] === 'a') text-green-600 @endif">A.</span>
                            <span>{{ $question['option_a'] }}</span>
                        </div>
                        <div class="flex items-center">
                            <span
                                class="font-semibold mr-2 @if ($question['correct_answer'] === 'b') text-green-600 @endif">B.</span>
                            <span>{{ $question['option_b'] }}</span>
                        </div>
                        <div class="flex items-center">
                            <span
                                class="font-semibold mr-2 @if ($question['correct_answer'] === 'c') text-green-600 @endif">C.</span>
                            <span>{{ $question['option_c'] }}</span>
                        </div>
                        <div class="flex items-center">
                            <span
                                class="font-semibold mr-2 @if ($question['correct_answer'] === 'd') text-green-600 @endif">D.</span>
                            <span>{{ $question['option_d'] }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Belum ada pertanyaan</p>
            @endforelse
        </div>
    </div>
</div>
