<div x-data="{ open: @entangle('showModalProfil').live }" x-show="open" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
    class="border-gray-300 absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg p-2 z-50 transition transform origin-top scale-95">
    <div class="flex flex-col text-lg">
        <button wire:click="logout"
            class=" hover:bg-gray-100 py-2 px-2 text-red-500 rounded-lg text-start active:bg-red-200">
            <i class="bi bi-box-arrow-right"></i> Keluar</button>
    </div>
</div>
