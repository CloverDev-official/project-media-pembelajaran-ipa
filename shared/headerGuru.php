<div class="flex gap-5 relative">
    <!-- Tombol Notifikasi -->
    <div class="relative inline-block">
        <button id="btnNotif" class="text-2xl relative">
            <i class="bi bi-bell"></i>
        </button>
        
    </div>  
    <!-- modal notif -->
    <?php include("../modalPopUp/modalNotif.php") ?>
    <!-- btn profil -->
    <div class="relative">
        <img id="btnProfil" src="../img/beruang.jpg" class="w-8 h-8 rounded-full hover:brightness-75 transition-colors duration-150 cursor-pointer" alt="">
        <!-- Popup Profil -->
        <?php include("../modalPopUp/modalProfilGuru.php") ?>
        <!-- modal tema -->
        <?php include("../modalPopUp/modalTema.php") ?>
    </div>
</div>