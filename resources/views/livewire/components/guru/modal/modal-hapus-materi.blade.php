 <!-- Modal hapus -->
 <div x-data="{ open: @entangle('showModal').live }" x-show="open"
     class="fixed inset-0 flex items-center justify-center z-50">
     <!-- Overlay -->
     <div @click="open = false" id="overlayHapus" class="absolute inset-0 bg-black/50"></div>
     <!-- Konten Modal -->
     <div class="relative bg-white rounded-lg shadow-md p-6 z-10 w-80 md:w-96">
         <div class="flex flex-col mb-4 text-start">
             <h2 class="text-xl font-semibold capitalize">peringatan</h2>
             <p class="font-normal text-gray-400 text-sm capitalize">apakah anda yakin ingin
                 menghapus materi ini?</p>
         </div>

         <form id="formHapus" class="flex flex-col gap-4" wire:submit.prevent="confirmDelete">
             <div class="flex justify-between gap-2 mt-4">
                <button wire:click='close' type="button" id="btnCloseHapus"
                    class="flex items-center gap-1 px-4 py-2 bg-red-200 text-red-700 rounded-lg transition-all duration-150 hover:bg-red-300 hover:scale-105 active:scale-95">
                        <iconify-icon icon="line-md:close-small"></iconify-icon>
                        Batal
                </button>
                <button type="submit"
                    class="flex items-center gap-1 px-4 py-2 bg-green-200 text-green-700 rounded-lg transition-all duration-150 hover:bg-green-300 hover:scale-105 active:scale-95">
                        <iconify-icon icon="line-md:trash" class="text-sm"></iconify-icon>
                        hapus
                </button>
             </div>
         </form>
     </div>
 </div>
