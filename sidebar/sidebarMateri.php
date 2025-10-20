
        <div id="sidebar" class="sidebar-collapsed md:w-2/12 fixed top-0 left-0 min-h-screen  bg-main p-4 rounded-tr-3xl shadow-2xl transform transition-transform duration-300 ease-in-out -translate-x-full  flex flex-col justify-between">

            <!-- Bagian atas (button + menu) -->
            <div>
                <!-- isi sidebar -->
                <div class="flex justify-start items-center gap-6 mt-2 pl-2">
                    <button onclick="toggleSidebar()" class=" text-white ">
                        <i class="bi bi-list text-3xl"></i>
                    </button>
                </div>

                <ul class="mt-3 flex flex-col gap-5 text-white text-xl font-semibold capitalize">
                    <!-- dasboard -->
                    <li>
                        <a href="../panelGuru/index.php" class="bg-hover-dark pl-3 py-3 rounded-lg relative">
                            <iconify-icon icon="material-symbols:dashboard-outline" class="text-2xl"></iconify-icon>
                            <span class="menu-text">dasboard</span>
                            <span class="tooltip">dasboard</span>
                        </a>
                    </li>
                    <!-- data siswa -->
                    <li class="transition-all rounded-lg  bg-hover-dark relative">
                        <a href="../panelGuru/dataSiswa.php" class="pl-3 py-3">
                            <iconify-icon icon="hugeicons:student" class="text-2xl"></iconify-icon>
                            <span class="menu-text">data siswa</span>
                            <span class="tooltip">data siswa</span>
                        </a>
                    </li>
                    <!-- rekap nilai -->
                    <li class="transition-all rounded-lg bg-hover-dark relative">
                        <a href="../panelGuru/rekapNilai.php" class="pl-3 py-3">
                            <iconify-icon icon="healthicons:i-exam-qualification-outline" class="text-2xl"></iconify-icon>
                            <span class="menu-text">rekap nilai</span>
                            <span class="tooltip">rekap nilai</span>
                        </a>
                    </li>
                    <!-- tambah materi -->
                    <li class="transition-all rounded-lg  bg-main-dark relative">
                        <a href="../panelGuru/kustomMateri.php" class="pl-3 py-3">
                            <iconify-icon icon="fluent:book-add-28-filled" class="text-2xl"></iconify-icon>
                            <span class="menu-text">materi</span>
                            <span class="tooltip">materi</span>
                        </a>
                    </li>
                    <!-- ulangan -->
                    <li class="transition-all rounded-lg  bg-hover-dark relative">
                        <a href="../panelGuru/ulangan.php" class="pl-3 py-3">
                            <iconify-icon icon="healthicons:i-exam-multiple-choice-outline" class="text-2xl"></iconify-icon>
                            <span class="menu-text">ulangan</span>
                            <span class="tooltip">ulangan</span>
                        </a>
                    </li>
                    <!-- game -->
                    <li class="transition-all rounded-lg  bg-hover-dark relative">
                        <a href="../panelGuru/kustomGim.php" class="pl-3 py-3">
                            <iconify-icon icon="bx:joystick" class="text-2xl" ></iconify-icon>
                            <span class="menu-text">gim</span>
                            <span class="tooltip">gim</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Bagian bawah -->
             <div class="bg-white p-1 rounded-md mt-5">
                <h1 class="text-center text-3xl text-blue-500 text-shadow-2xs font-extrabold uppercase logo ">ipa<span class="text-yellow-400">verse</span></h1>
            </div>
        </div>
        <!-- Navbar Bottom (Mobile Only) -->
        <div class="md:hidden fixed bottom-0 left-0 right-0 bg-main shadow-md z-20">
            <ul class="flex justify-start items-center p-2 space-x-4 overflow-x-auto flex-nowrap scrollbar-hide">
                <!-- Dashboard -->
                <li class="flex-shrink-0 px-3 py-1 rounded-lg ">
                    <a href="../panelGuru/index.php" class="flex flex-col items-center text-white">
                        <iconify-icon icon="material-symbols:dashboard-outline" class="text-2xl"></iconify-icon>
                    </a>
                </li>
                <!-- data siswa -->
                <li class="flex-shrink-0 px-3 py-1 rounded-lg">
                    <a href="../panelGuru/dataSiswa.php" class="flex flex-col items-center text-white">
                        <iconify-icon icon="hugeicons:student" class="text-2xl"></iconify-icon>
                    </a>
                </li>
                <!-- rekap nilai -->
                <li class="flex-shrink-0 px-3 py-1 rounded-lg">
                    <a href="../panelGuru/rekapNilai.php" class="flex flex-col items-center text-white">
                        <iconify-icon icon="healthicons:i-exam-qualification-outline" class="text-2xl"></iconify-icon>
                    </a>
                </li>
                <!-- tambah materi -->
                <li class="flex-shrink-0 px-3 py-1 rounded-lg bg-main-dark">
                    <a href="../panelGuru/kustomMateri.php" class="flex flex-col items-center text-white">
                        <iconify-icon icon="fluent:book-add-28-filled" class="text-2xl"></iconify-icon>
                        <span class="text-xs capitalize">materi</span>
                    </a>
                </li>
                <!-- ulangan -->
                <li class="flex-shrink-0 px-3 py-1 rounded-lg">
                    <a href="../panelGuru/ulangan.php" class="flex flex-col items-center text-white">
                        <iconify-icon icon="healthicons:i-exam-multiple-choice-outline" class="text-2xl"></iconify-icon>
                    </a>
                </li>
                <!-- game -->
                <li class="flex-shrink-0 px-3 py-1 rounded-lg">
                    <a href="../panelGuru/kustomGim.php" class="flex flex-col items-center text-white">
                        <iconify-icon icon="bx:joystick" class="text-2xl" ></iconify-icon>
                    </a>
                </li>
            </ul>
        </div>
