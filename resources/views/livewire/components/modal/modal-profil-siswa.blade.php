<!-- desktop -->
<div x-data="{ open: @entangle('showModalProfil').live }" x-show="open" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
    class="border-gray-300 absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg p-2 z-50 transition transform origin-top scale-95">
    <ul class="flex flex-col gap-2">
        <li>
            <a wire:navigate href="{{ route('profil') }}"
                class="block px-1 py-2 hover:bg-gray-100 active:bg-gray-100 rounded">
                <i class="bi bi-person-fill"></i>
                Profil
            </a>
        </li>

        <li>
            <button wire:click="logout"
                class="block px-3 py-2 text-red-600 hover:bg-red-50 rounded active:bg-red-50">
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </button>
        </li>
    </ul>
</div>
