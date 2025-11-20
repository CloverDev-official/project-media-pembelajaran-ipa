<main class="mt-5 mb-20 min-h-screen">
    <form wire:submit.prevent="save">

        @foreach ($daftarSoal as $index => $soal)
            <div class="border border-gray-300 rounded-xl p-4 mb-6 bg-white">
                <h3 class="font-bold text-lg mb-2 text-blue-700">Soal {{ $index + 1 }}</h3>
                {{-- Pertanyaan --}}
                <textarea wire:model.defer="daftarSoal.{{ $index }}.soal" placeholder="Tulis soal..."
                    class="w-full border p-2 rounded-lg mb-3"></textarea>

                {{-- Pilihan Jawaban --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <input type="text" wire:model.defer="daftarSoal.{{ $index }}.a"
                        placeholder="Pilihan A" class="border p-2 rounded-lg">
                    <input type="text" wire:model.defer="daftarSoal.{{ $index }}.b"
                        placeholder="Pilihan B" class="border p-2 rounded-lg">
                    <input type="text" wire:model.defer="daftarSoal.{{ $index }}.c"
                        placeholder="Pilihan C" class="border p-2 rounded-lg">
                    <input type="text" wire:model.defer="daftarSoal.{{ $index }}.d"
                        placeholder="Pilihan D" class="border p-2 rounded-lg">
                </div>

                {{-- Jawaban Benar --}}
                <div class="mt-3">
                    <label class="font-semibold">Jawaban Benar:</label>
                    <select wire:model.defer="daftarSoal.{{ $index }}.benar"
                        class="border p-2 rounded-lg ml-2">
                        <option value="" disabled>Pilih</option>
                        <option value="A" selected>A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
            </div>
        @endforeach

        <div class="flex gap-3">
            <button type="submit"
                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Simpan</button>
        </div>
    </form>
</main>
