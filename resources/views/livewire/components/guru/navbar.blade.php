<div class="flex gap-5 relative">
    <!-- Tombol Notifikasi -->
    <div class="relative inline-block">
        <button wire:click="$dispatch('toggleNotificationPopup')" id="btnNotif"
            class="text-2xl relative">
            <i class="bi bi-bell"></i>
        </button>

    </div>
    <!-- modal notif -->
    <livewire:components.guru.modal.modal-notif />
    <!-- btn profil -->
    <div class="relative">
        <button wire:click="$dispatch('toggleProfilPopup')">
            <img src="{{ asset('img/beruang.jpg') }}" alt="User"
                class="rounded-full w-[30px] hover:brightness-75 transition">
        </button>
        <livewire:components.guru.modal.modal-profil-guru />

        <livewire:components.modal.modal-tema />
    </div>

</div>
