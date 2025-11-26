<div x-data="{ open: @entangle('showModal').live }" x-show="open" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
    @click="open = false" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div @click.stop class="bg-white shadow-lg rounded-xl w-80 h-72 md:w-96 pb-10">
        <!-- Header -->
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-400">
            <h2 class="text-lg font-semibold capitalize">Menu Tema</h2>
            <button wire:click="close"
                class="text-gray-500 hover:text-black hover:scale-105 active:scale-95">✕</button>
        </div>

        <!-- Tabs -->
        <div class="flex gap-2 px-4 py-2 border-b border-gray-400 text-sm">
            <button wire:click="switchTab('tema')"
                class="tabTema px-3 py-1 rounded-full capitalize font-medium {{ $activeTab === 'tema' ? 'bg-main text-white' : 'bg-hover-subtle' }}">
                Tema
            </button>
            <button wire:click="switchTab('customTema')"
                class="tabTema px-3 py-1 rounded-full capitalize font-medium {{ $activeTab === 'customTema' ? 'bg-main text-white' : 'bg-hover-subtle' }}">
                Custom Tema
            </button>
        </div>

        <!-- Tema Preset -->
        @if ($activeTab === 'tema')
            <div class="flex flex-col">
                <button wire:click="pilihTema('green')"
                    class="px-4 py-3 flex items-center gap-3 hover:bg-green-50 border-b border-gray-100 text-green-600">
                    <div class="w-6 h-6 rounded-full bg-green-500"></div>
                    <span class="font-medium">Hijau</span>
                </button>
                <button wire:click="pilihTema('pink')"
                    class="px-4 py-3 flex items-center gap-3 hover:bg-pink-50 border-b border-gray-100 text-pink-600">
                    <div class="w-6 h-6 rounded-full bg-pink-500"></div>
                    <span class="font-medium">Pink</span>
                </button>
                <button wire:click="pilihTema('blue')"
                    class="px-4 py-3 flex items-center gap-3 hover:bg-blue-50 border-b border-gray-100 text-blue-600">
                    <div class="w-6 h-6 rounded-full bg-blue-500"></div>
                    <span class="font-medium">Biru</span>
                </button>
            </div>
        @endif

        <!-- Custom Tema -->
        @if ($activeTab === 'customTema')
            <div class="flex flex-col">
                <div
                    class="px-4 py-3 flex items-center gap-3 hover:bg-gray-100 border-b border-gray-100">
                    <input type="color" wire:change="pilihTema($event.target.value)"
                        class="w-12 h-12 rounded-full border border-gray-300 cursor-pointer">
                    <span class="font-medium">Pilih warna tema</span>
                </div>
            </div>
        @endif
    </div>
</div>
