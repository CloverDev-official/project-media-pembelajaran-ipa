<!-- Modal Tambah Pertanyaan -->
<div id="tambahPertanyaan"
  class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4 overflow-y-auto">
  
  <!-- Tambahkan max-h dan overflow-y di container dalam -->
  <div class="bg-white rounded-lg shadow-md p-6 w-80 md:w-[60rem] relative max-h-[90vh] overflow-y-auto">
    <h2 class="text-xl font-semibold capitalize text-center mb-4">Tambah Pertanyaan</h2>

    <!-- Langkah 1: Pilih jumlah soal -->
    <div id="pilihJumlahSoal" class="text-center">
      <label for="jumlahSoal" class="block text-lg font-semibold mb-2">Pilih Jumlah Soal</label>
      <select id="jumlahSoal" class="w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
        <option value="" disabled selected>Pilih jumlah</option>
      </select>

      <button id="mulaiSoalBtn"
        class="mt-4 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all duration-150 hover:scale-105 active:scale-95">
        Mulai
      </button>
    </div>

    <!-- Langkah 2: Form Soal -->
    <form id="formSoal" class="hidden flex flex-col gap-4">
      <div class="text-center mb-2">
        <h3 id="judulSoal" class="font-semibold text-lg capitalize">Soal 1</h3>
      </div>

      <div>
        <label class="font-semibold text-lg capitalize">Pertanyaan</label>
        <input  type="text" id="pertanyaan" class="w-full mt-2 py-2 px-3 border rounded-lg focus:ring-2 focus:ring-green-400">
      </div>

      <div>
        <label class="font-semibold text-lg capitalize">Pilihan A</label>
        <input  type="text" id="pilihanA" class="w-full mt-2 py-2 px-3 border rounded-lg focus:ring-2 focus:ring-green-400">
      </div>
      <div>
        <label class="font-semibold text-lg capitalize">Pilihan B</label>
        <input  type="text" id="pilihanB" class="w-full mt-2 py-2 px-3 border rounded-lg focus:ring-2 focus:ring-green-400">
      </div>
      <div>
        <label class="font-semibold text-lg capitalize">Pilihan C</label>
        <input  type="text" id="pilihanC" class="w-full mt-2 py-2 px-3 border rounded-lg focus:ring-2 focus:ring-green-400">
      </div>
      <div>
        <label class="font-semibold text-lg capitalize">Pilihan D</label>
        <input  type="text" id="pilihanD" class="w-full mt-2 py-2 px-3 border rounded-lg focus:ring-2 focus:ring-green-400">
      </div>

      <div>
        <label class="font-semibold text-lg capitalize">Jawaban Benar</label>
        <select id="jawaban" class="w-full mt-2 py-2 px-3 border rounded-lg focus:ring-2 focus:ring-green-400">
          <option value="" disabled selected>Pilih jawaban</option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="C">C</option>
          <option value="D">D</option>
        </select>
      </div>

      <!-- 🕒 Input waktu tampil dalam menit -->
      <div>
        <label class="font-semibold text-lg capitalize">Waktu Tampil (menit)</label>
        <input  
          type="number" 
          id="waktuTampil" 
          min="1" 
          class="w-full mt-2 py-2 px-3 border rounded-lg focus:ring-2 focus:ring-green-400" 
          placeholder="Masukkan durasi tampil (dalam menit)">
      </div>

      <div class="flex justify-between gap-2 mt-4">
        <button type="button" id="prevSoalBtn"
          class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition-all duration-150 hover:scale-105 active:scale-95">
          Sebelumnya
        </button>
        <button type="button" id="nextSoalBtn"
          class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all duration-150 hover:scale-105 active:scale-95">
          Selanjutnya
        </button>
      </div>
    </form>

    <button id="closePopupBtn" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl">&times;</button>
  </div>
</div>
