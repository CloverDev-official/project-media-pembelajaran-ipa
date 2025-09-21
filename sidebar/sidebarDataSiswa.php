
<div id="sidebar" class="lg:w-2/12 fixed top-0 left-0 min-h-screen  bg-green-500 p-4 
     rounded-r-3xl shadow-2xl transform transition-transform duration-300 ease-in-out
     -translate-x-full z-20 flex flex-col justify-between">

    <!-- Bagian atas (button + menu) -->
    <div>
        <!-- isi sidebar -->
        <div class="flex justify-start items-center gap-6  mt-2">
            <button onclick="toggleSidebar()" class=" text-white ">
                <i class="bi bi-list text-3xl"></i>
            </button>

        </div>

        <ul class="mt-10 flex flex-col gap-5 text-white text-xl font-semibold capitalize">
            <li>
                <a href="#" class="bg-green-700 pl-3 py-1  rounded-lg relative">
                    <i class="bi bi-speedometer2"></i>
                    <span class="menu-text">dasboard</span>
                    <span class="tooltip">dasboard</span>
                </a>
            </li>
            <li class="transition-all rounded-lg  hover:bg-green-700 relative">
                <a href="" class="pl-3 py-1">
                    <i class="bi bi-mortarboard-fill"></i>
                    <span class="menu-text">siswa</span>
                    <span class="tooltip">siswa</span>
                </a>
            </li>
            <li class="transition-all rounded-lg  hover:bg-green-700 relative">
                <a href="" class="pl-3 py-1">
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