<main class="mt-5 mb-20 min-h-screen">
    <form wire:submit.prevent="save">

        @foreach ($daftarSoal as $index => $soal)
            <div class="border border-gray-300 rounded-xl p-4 mb-6 bg-white">
                <h3 class="font-bold text-lg mb-2 text-blue-700">Soal {{ $index + 1 }}</h3>

                {{-- Upload Gambar --}}
                <div class="mb-4">
                    <label class="font-semibold block mb-1">Gambar (opsional)</label>
                    <input type="file" wire:model="daftarSoal.{{ $index }}.gambar"
                        class="block w-full text-sm text-gray-700 border rounded-lg p-2 cursor-pointer" />

                    {{-- Preview Gambar --}}
                    @if ($soal['gambar'])
                        <div class="mt-2">
                            <img src="{{ $soal['gambar'] instanceof TemporaryUploadedFile
                                ? $soal['gambar']->temporaryUrl()
                                : asset('storage/' . $soal['gambar']) }}"
                                class="w-40 h-40 object-cover rounded-lg border">
                        </div>
                    @endif
                </div>

                {{-- Pertanyaan --}}
                <textarea wire:model.defer="daftarSoal.{{ $index }}.soal" placeholder="Tulis soal..."
                    class="w-full border p-2 rounded-lg mb-3"></textarea>

                {{-- Pilihan Jawaban --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    @foreach (['a', 'b', 'c', 'd'] as $huruf)
                        <input type="text"
                            wire:model.defer="daftarSoal.{{ $index }}.{{ $huruf }}"
                            placeholder="Pilihan {{ strtoupper($huruf) }}"
                            class="border p-2 rounded-lg">
                    @endforeach
                </div>

                {{-- Jawaban Benar --}}
                <div class="mt-3">
                    <label class="font-semibold">Jawaban Benar:</label>
                    <select wire:model.defer="daftarSoal.{{ $index }}.benar"
                        class="border p-2 rounded-lg ml-2">
                        <option value="" disabled>Pilih</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
            </div>
        @endforeach

        <div class="flex gap-3">
            <button type="submit"
                class="capitalize flex items-center gap-1 px-4 py-3 shadow-sm bg-green-200 text-green-700 rounded-xl transition-all duration-150 hover:bg-green-300 hover:scale-105 active:scale-95">
                    <iconify-icon icon="mdi:content-save" class="text-lg"></iconify-icon>
                    Simpan ulangan
            </button>
        </div>
    </form>
</main>
