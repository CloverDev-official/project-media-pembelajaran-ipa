<div class="mt-10 flex flex-col justify-center md:justify-start">
    <!-- wrapper btn tambah -->
    <div class="flex justify-start mb-5">
        <!-- btn tambah -->
        <button id="btn-tambah"
            class="border-l-4 border-b-4 border-green-500 hover:border-green-600 active:scale-95  px-4 py-2 bg-green-400 hover:bg-green-500 rounded-lg text-white text-shadow-md font-semibold transition-all duration-100 shadow-md capitalize">
            tambah
        </button>
    </div>

    <!-- grid -->
    <div class="mt-10 flex justify-start">
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 justify-items-center mb-20">
            <?php for ($i = 1; $i <= 7; $i++): ?>
            <div class="flex justify-center items-center">
                <div
                    class="bg-white border border-l-4 border-b-4 border-gray-300 p-2 rounded-lg min-w-[15rem] shadow">
                    <!-- container gambar -->
                    <div class="flex justify-center">
                        <img src="" class="bg-gray-200 w-full h-[12rem] rounded-lg border-0">
                    </div>

                    <!-- judul dan deskripsi -->
                    <div class="mb-3 py-2">
                        <h2 class="font-bold text-main text-lg capitalize">gim <?= $i ?></h2>
                        <p class="font-normal text-xs capitalize">Lorem ipsum dolor sit amet
                            consectetur adipisicing elit. Laboriosam, eos?</p>
                    </div>

                    <!-- indikator progress -->
                    <h2 class="text-xs font-bold text-main text-end">50%</h2>
                    <div class="w-full bg-gray-300 rounded-full h-2">
                        <div
                            class="bg-main h-2 rounded-full text-center text-xs font-bold text-white w-[50%]">
                        </div>
                    </div>

                    <!-- tombol -->
                    <a href="editGim.php">
                        <button
                            class="mt-2 py-1 font-semibold text-sm w-full rounded-lg transition-all duration-150 bg-yellow-400 hover:bg-yellow-500 active:scale-95 text-white capitalize">
                            edit
                        </button>
                    </a>
                    <button
                        class="btn-hapus mt-2 py-1 font-semibold text-sm w-full rounded-lg transition-all duration-150 bg-red-500 hover:bg-red-600 active:scale-95 text-white capitalize">
                        hapus
                    </button>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</div>
