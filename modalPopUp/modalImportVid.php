
<!-- Modal Background -->
<div id="modalVid" class="fixed inset-0 bg-black/50 bg-opacity-40 hidden items-center justify-center z-50">
  <div class="bg-white w-[90%] max-w-lg p-6 rounded-2xl shadow-lg relative">
    
    <!-- Tombol Close -->
    <button type="button" id="closeModalVid" class="absolute top-3 right-3 text-gray-500 hover:text-black text-2xl font-bold">&times;</button>
    
    <h2 class="text-lg font-semibold mb-4">Upload Video Interaktif</h2>
    
    <!-- Area Drag & Drop -->
    <div id="dropArea" class="border-2 border-dashed border-main rounded-xl p-6 text-center cursor-pointer border-hover-dark transition">
      <p class="mb-2 text-gray-600">Drag & Drop file ke sini</p>
      <p class="text-gray-400">atau</p>
      <label for="fileInput" class="cursor-pointer mt-2 inline-block border-l-4 border-b-4 border-main-dark px-4 py-2 bg-main hover:scale-[01.1] active:scale-95  rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md capitalize">
        browse file
      </label>
      <input type="file" id="fileInput" class="hidden" accept="video/*">
    </div>
  </div>
</div>

