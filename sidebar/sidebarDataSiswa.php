
<div id="sidebar" class="lg:w-2/12 fixed top-0 left-0 min-h-screen  bg-green-500 p-4 
     rounded-r-3xl shadow-2xl transform transition-transform duration-300 ease-in-out
     -translate-x-full z-20 flex flex-col justify-between">

    <!-- Bagian atas (button + menu) -->
    <div>
        <!-- isi sidebar -->
        <div class="flex justify-start items-center gap-6  mt-2 pl-2">
            <button onclick="toggleSidebar()" class=" text-white ">
                <i class="bi bi-list text-3xl"></i>
            </button>

        </div>

        <ul class="mt-3 flex flex-col gap-5 text-white text-xl font-semibold capitalize">
            <li>
                <a href="../panelGuru/index.php" class="hover:bg-green-700 pl-3 py-3 rounded-lg relative">
                    <i class="bi bi-speedometer2"></i>
                    <span class="menu-text">dasboard</span>
                    <span class="tooltip">dasboard</span>
                </a>
            </li>
            <li class="transition-all rounded-lg  bg-green-700 relative">
                <a href="../panelGuru/dataSiswa.php" class="pl-3 py-3">
                    <i class="bi bi-mortarboard-fill"></i>
                    <span class="menu-text">data siswa</span>
                    <span class="tooltip">data siswa</span>
                </a>
            </li>
            <li class="transition-all rounded-lg  hover:bg-green-700 relative">
                <a href="../panelGuru/rekapNilai.php" class="pl-3 py-3">
                    <i class="bi bi-folder-fill"></i>
                    <span class="menu-text">rekap nilai</span>
                    <span class="tooltip">rekap nilai</span>
                </a>
            </li>
        </ul>

    </div>

    <!-- Bagian bawah -->
    <div class="bg-white p-1 rounded-md mt-5">
        <img src="../img/logo.svg" alt="Logo" class="w-32 mx-auto">
    </div>
</div>
<!-- Navbar Bottom (Mobile Only) -->
<div class="md:hidden fixed bottom-0 left-0 right-0 bg-green-500 shadow-md z-20">
    <ul class="flex justify-around items-center p-2">
        <!-- Dashboard -->
        <li class="px-3 py-1 rounded-lg hover:bg-green-600">
        <a href="../panelGuru/index.php" class="flex flex-col items-center text-white">
            <i class="bi bi-speedometer2 text-xl"></i>
            <span class="text-xs capitalize">Dashboard</span>
        </a>
        </li>
        <!-- data siswa -->
        <li class="px-3 py-1 rounded-lg bg-green-600">
        <a href="../panelGuru/dataSiswa.php" class="flex flex-col items-center text-white">
            <i class="bi bi-mortarboard"></i>
            <span class="text-xs capitalize">data siswa</span>
        </a>
        </li>
        <!-- rekap nilai -->
        <li class="px-3 py-1 rounded-lg hover:bg-green-600">
        <a href="../panelGuru/rekapNilai.php" class="flex flex-col items-center text-white">
            <i class="bi bi-folder"></i>
            <span class="text-xs capitalize">rekap nilai</span>
        </a>
        </li>
    </ul>
</div>