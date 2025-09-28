<header id="site-header" class="bg-white sticky top-0 shadow-md transition-transform duration-300 z-50">
    <nav class="flex justify-between items-center p-5">
        <!-- Logo -->
        <img src="../img/logo.svg" class="w-[6rem]" alt="Logo">
        <!-- Menu Desktop -->
        <ul class="hidden md:flex gap-10 items-center">
            <!-- beranda -->
            <li>
                <a href="../view/beranda.php" class="relative overflow-hidden font-semibold text-hover-dark 
                after:content-[''] after:absolute after:left-1/2 after:bottom-0 
                after:h-[2px] after:w-0 bg-after-dark
                after:transition-all after:duration-300 
                hover:after:left-0 hover:after:w-full 
                active:after:left-0 active:after:w-full 
                focus:outline-none capitalize">
                    beranda
                </a>
            </li>
            <!-- materi -->
            <li>
                <a href="../view/materi.php" class="relative overflow-hidden font-semibold text-hover-dark 
                after:content-[''] after:absolute after:left-1/2 after:bottom-0 
                after:h-[2px] after:w-0 bg-after-dark
                after:transition-all after:duration-300 
                hover:after:left-0 hover:after:w-full 
                active:after:left-0 active:after:w-full 
                focus:outline-none capitalize">
                    materi
                </a>
            </li>
            <!-- gim -->
            <li>
                <a href="../view/gim.php" class="relative font-semibold text-hover-dark 
                after:content-[''] after:absolute after:left-1/2 after:bottom-0 
                after:h-[2px] after:w-0 bg-after-dark
                after:transition-all after:duration-300 
                hover:after:left-0 hover:after:w-full 
                active:after:left-0 active:after:w-full 
                focus:outline-none capitalize">
                    gim
                </a>
            </li>
            <!-- jelajahi -->
            <li>
                <a href="../view/beranda.php#jelajahi" class="relative font-semibold text-hover-dark 
                after:content-[''] after:absolute after:left-1/2 after:bottom-0 
                after:h-[2px] after:w-0 bg-after-dark
                after:transition-all after:duration-300 
                hover:after:left-0 hover:after:w-full 
                active:after:left-0 active:after:w-full 
                focus:outline-none">
                    Jelajahi
                </a>
            </li>
            <!-- ulangan -->
            <li>
                <a href="../view/kuis.php" class="relative font-semibold text-hover-dark 
                after:content-[''] after:absolute after:left-1/2 after:bottom-0 
                after:h-[2px] after:w-0 bg-after-dark 
                after:transition-all after:duration-300 
                hover:after:left-0 hover:after:w-full 
                active:after:left-0 active:after:w-full 
                focus:outline-none capitalize">
                    ulangan
                </a>
            </li>
            <!-- User Dropdown -->
            <li class="relative">
                <button id="user-btn">
                    <img src="../img/beruang.jpg" alt="User"
                        class="rounded-full w-[30px] transition-colors duration-150 hover:brightness-75">
                </button>
                <!-- user pop up dekstop -->
                <?php include("../modalPopUp/modalProfilSiswa.php") ?>                    
            </li>
        </ul>
        <!-- Menu Mobile -->
        <div class="flex gap-5 md:hidden text-2xl">
            <!-- hamburger -->
            <button id="menu-btn"><i class="bi bi-list font-semibold"></i></button>
            <!-- User btn mobile -->
            <button id="user-btn-mobile" class="bg-gray-200  p-2 rounded-full hover:bg-gray-300 transition-colors duration-150">
                <img src="../img/person-fill.svg" alt="User" />
            </button>
            <!-- user pop up mobile -->
            <?php include("../modalPopUp/modalProfilSiswaMobile.php") ?>
        </div>
    </nav>
       
        <!-- Dropdown Mobile Menu -->
        <ul id="mobile-menu" class="hidden flex-col gap-5 p-5 bg-gray-200 md:hidden">
            <a href="../view/beranda.php" class="text-lg font-semibold capitalize">
                <li>beranda</li>
            </a>
            <a href="../view/materi.php" class="text-lg font-semibold capitalize">
                <li>materi</li>
            </a>
            <a href="../view/gim.php" class="text-lg font-semibold capitalize">
                <li>gim</li>
            </a>
            <a href="../view/beranda.php#jelajahi" class="text-lg font-semibold capitalize">
                <li>jelajahi</li>
            </a>
            <a href="../view/kuis.php" class="text-lg font-semibold capitalize">
                <li>Kuis</li>
            </a>
        </ul>

        
</header>
<!-- modal tema -->
<?php include("../modalPopUp/modalTema.php") ?>

