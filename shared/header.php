<header id="site-header" class="bg-gray-100 sticky top-0 shadow-md transition-transform duration-300 z-50">
    <nav class="flex justify-between items-center p-5">
        <!-- Logo -->
        <img src="../img/logo.svg" class="w-[6rem]" alt="Logo">

        <!-- Menu Desktop -->
        <ul class="hidden md:flex gap-10 items-center">
            <li>
                <a href="../view/beranda.php" class="relative overflow-hidden font-semibold hover:text-green-700 
                  after:content-[''] after:absolute after:left-1/2 after:bottom-0 
                  after:h-[2px] after:w-0 after:bg-green-700 
                  after:transition-all after:duration-300 
                  hover:after:left-0 hover:after:w-full 
                  active:after:left-0 active:after:w-full 
                  focus:outline-none capitalize">
                    beranda
                </a>
            </li>

            <li>
                <a href="../view/materi.php" class="relative overflow-hidden font-semibold hover:text-green-700 
                  after:content-[''] after:absolute after:left-1/2 after:bottom-0 
                  after:h-[2px] after:w-0 after:bg-green-700 
                  after:transition-all after:duration-300 
                  hover:after:left-0 hover:after:w-full 
                  active:after:left-0 active:after:w-full 
                  focus:outline-none capitalize">
                    materi
                </a>
            </li>

            <li>
                <a href="../view/gim.php" class="relative font-semibold hover:text-green-700 
                  after:content-[''] after:absolute after:left-1/2 after:bottom-0 
                  after:h-[2px] after:w-0 after:bg-green-700 
                  after:transition-all after:duration-300 
                  hover:after:left-0 hover:after:w-full 
                  active:after:left-0 active:after:w-full 
                  focus:outline-none capitalize">
                    gim
                </a>
            </li>

            <li>
                <a href="../view/beranda.php#jelajahi" class="relative font-semibold hover:text-green-700 
                  after:content-[''] after:absolute after:left-1/2 after:bottom-0 
                  after:h-[2px] after:w-0 after:bg-green-700 
                  after:transition-all after:duration-300 
                  hover:after:left-0 hover:after:w-full 
                  active:after:left-0 active:after:w-full 
                  focus:outline-none">
                    Jelajahi
                </a>
            </li>

            <li>
                <a href="../view/kuis.php" class="relative font-semibold hover:text-green-700 
                  after:content-[''] after:absolute after:left-1/2 after:bottom-0 
                  after:h-[2px] after:w-0 after:bg-green-700 
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

                <div id="user-popup" class="hidden border-l-[3px] border-b-[3px] border-gray-300 absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg p-2 z-50 
                    transition transform origin-top scale-95 opacity-0">
                    <ul class="flex flex-col gap-2">
                        <li><a href="../view/profile.php" class="block px-3 py-2 hover:bg-gray-100 rounded"> <i
                                    class="bi bi-person-fill"></i> Profil</a>
                        </li>
                        <li><a href="../view/settings.php" class="flex gap-1 px-3 py-2 hover:bg-gray-100 rounded "> <img
                                    src="../img/gear-fill.svg" alt="" class="animate-spin"> Pengaturan</a></li>
                        <li><a href="../view/index.php" class="block px-3 py-2 text-red-600 hover:bg-red-50 rounded"><i
                                    class="bi bi-box-arrow-right"></i> Logout</a></li>
                    </ul>
                </div>
            </li>
        </ul>

        <!-- Menu Mobile -->
        <div class="flex gap-5 md:hidden text-2xl">
            <button id="menu-btn"><i class="bi bi-list font-semibold"></i></button>

            <!-- User btn mobile -->
            <button id="user-btn-mobile"
                class="bg-gray-200  p-2 rounded-full hover:bg-gray-300 transition-colors duration-150">
                <img src="../img/person-fill.svg" alt="User" />
            </button>

            <div id="user-popup-mobile" class="hidden absolute border-l-[3px] border-b-[3px] border-gray-300 right-2 mt-4 w-40 bg-white rounded-lg shadow-sm p-2 z-50 
                    transition transform origin-top scale-95 opacity-0">
                <ul class="flex flex-col gap-2 text-sm">
                    <li><a href="../view/profile.php" class="block px-3 py-2 hover:bg-gray-100 rounded"> <i
                                class="bi bi-person-fill"></i> Profil</a>
                    </li>
                    <li><a href="../view/settings.php" class="flex gap-1 px-3 py-2 hover:bg-gray-100 rounded "> <img
                                src="../img/gear-fill.svg" alt="" class="animate-spin"> Pengaturan</a></li>
                    <li><a href="../view/index.php" class="block px-3 py-2 text-red-600 hover:bg-red-50 rounded"><i
                                class="bi bi-box-arrow-right"></i> Logout</a></li>
                </ul>
            </div>
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
<script src="../script/header.js"></script>