<div class="flex gap-5 relative">
    <!-- btn profil -->
    <div class="relative">
        <button wire:click="$dispatch('toggleProfilPopup')">
            <img src="{{ asset('img/beruang.jpg') }}" alt="User"
                class="rounded-full w-[30px] hover:brightness-75 transition">
        </button>
        <livewire:components.guru.modal.modal-profil-guru />
    </div>

</div>
