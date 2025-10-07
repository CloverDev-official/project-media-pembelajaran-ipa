<div id="latihan" class="mt-5 ">
  <div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="flex bg-main p-3 sm:p-4 rounded-t-lg text-white w-full">
      <p class="font-bold text-lg sm:text-xl"><i class="fa-solid fa-pen-to-square"></i> Latihan</p>
    </div>

    <!-- Card -->
    <div class="relative bg-white rounded-xl shadow-md p-4 sm:p-6">
      <!-- Start Section -->
      <div class="py-5 text-center" id="startSection">
        <button id="startBtn"
          class="w-auto md:w-xs px-2 py-3 text-xl rounded-xl bg-main border-main-dark border border-l-4 border-b-4 text-white font-semibold text-shadow-2xs shadow-sm transition-all duration-150 hover:scale-[01.02] active:scale-95 active:shadow-inner">
          Mulai Latihan
        </button>
      </div>

      <!-- Timer -->
      <div id="timerSection" class="hidden flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-4">
        <p id="timer" class="font-bold text-red-600 text-center sm:text-left">Waktu: 10:00</p>
        <p id="scoreBoard" class="font-semibold text-green-600 text-center sm:text-right"></p>
      </div>

      <!-- Quiz -->
      <div id="quizSection" class="hidden">
        <div id="questionContainer" class="mb-6 text-sm md:text-xl sm:text-base"></div>

        <!-- Navigasi Nomor Soal -->
        <div id="questionNav" class="flex flex-wrap gap-2 mt-10 mb-4 justify-center"></div>

        <div class="flex flex-col sm:flex-row justify-between gap-3">
          <button id="prevBtn" class="px-4 py-2 rounded-xl border bg-linear-to-t from-gray-600 to-gray-500 border-b-4 border-gray-700 text-white font-semibold text-shadow-2xs shadow-sm transition-all duration-150 hover:scale-110 active:scale-95 active:shadow-inner">
            Sebelumnya
          </button>
          <button id="nextBtn" class="px-4 py-2 rounded-xl border bg-linear-to-t from-blue-600 to-blue-500 border-b-4 border-blue-700 text-white font-semibold text-shadow-2xs shadow-sm transition-all duration-150 hover:scale-110 active:scale-95 active:shadow-inner">
            Selanjutnya
          </button>
        </div>
      </div>
      
    </div>
  </div>

  <!-- Modal Peringatan -->
  <div id="warningModal" class="fixed inset-0 flex items-center justify-center bg-black/50 hidden z-50 p-4">
    <div class="bg-white w-full max-w-sm rounded-lg shadow-lg p-6 text-center relative">
      <h2 class="text-lg sm:text-xl font-bold mb-3 text-red-600">
        <i class="bi bi-exclamation-triangle-fill"></i> Peringatan
      </h2>
      <p class="text-gray-700 mb-4 text-sm sm:text-base">
        Harap jawab semua soal terlebih dahulu sebelum mengirim!
      </p>
      <button onclick="closeModal()"
        class="px-6 py-2 rounded-xl border bg-linear-to-t from-green-600 to-green-500 border-b-4 border-green-700 text-white font-semibold text-shadow-2xs shadow-sm transition-all duration-150 hover:scale-110 active:scale-95 active:shadow-inner">
        OK
      </button>
    </div>
  </div>

  <!-- Modal Start (instruksi kuis) -->
  <div id="startModal" class="fixed inset-0 flex items-center justify-center bg-black/50 hidden z-50 p-4">
    <div class="bg-white w-full max-w-sm rounded-lg shadow-lg p-6 text-center relative">
      <h2 class="text-lg sm:text-xl font-bold mb-3 text-green-600">
        <i class="bi bi-play-circle-fill"></i> Siap Memulai?
      </h2>
      <p class="text-gray-700 mb-4 text-sm sm:text-base">
        Latihan ini terdiri dari beberapa soal pilihan ganda. Waktu pengerjaan 10 menit.
      </p>
      <div class="flex justify-center gap-3">
        <button onclick="closeStartModal()"
          class="px-6 py-2 border-l-[4px] border-b-[4px] bg-linear-to-t from-red-600 to-red-500  border-red-700 text-white rounded-lg transition-all  active:border-0 hover:scale-105">Batal</button>
        <button id="confirmStartBtn"
          class="px-6 py-2 border-l-[4px] border-b-[4px] bg-linear-to-t from-green-600 to-green-500  border-green-700 text-white rounded-lg transition-all  active:border-0 hover:scale-105">Mulai</button>
      </div>
    </div>
  </div>
</div>