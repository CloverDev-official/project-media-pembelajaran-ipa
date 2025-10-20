<?php include("../shared/link.php"); ?>
<div id="sidebar-container">
    <!-- Tombol Sidebar -->
    <button id="sidebarButton" onclick="toggleSidebar()"
        class="fixed right-0 transition-transform duration-300 top-1/2 -translate-y-1/2 z-9 bg-main not-last-of-type:not-only-of-type: text-white px-3 py-2 rounded-l-lg shadow-lg  hidden">
        <i class="bi bi-layout-sidebar-inset-reverse"></i>
    </button>

    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0  bg-opacity-50 hidden z-10" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <div id="sidebar"
        class="fixed  top-44 right-0 h-[25rem] w-64 rounded-lg bg-white shadow-lg transform translate-x-full transition-transform duration-300 z-20 ">
        <div class="bg-main p-3 px-5 flex justify-between items-center rounded-tl-lg">
            <h1 class="text-white font-bold">Side Bar</h1>
            <button onclick="toggleSidebar()" class="text-white text-xl"><i class="bi bi-arrow-right-circle"></i></button>
        </div>
        <div class="p-3 flex flex-col gap-2 ">
            <a href="../view/bab1.php#pengertian" class="bg-hover-subtle p-2 rounded">1. Pengertian Pertumbuhan dan
                Perkembangan</a>
            <a href="../view/bab1.php#subBabPertama" class="bg-hover-subtle p-2 rounded">A. Pertumbuhan dan Perkembangan pada
                Manusia</a>
            <a href="#3" class="bg-hover-subtle p-2 rounded">B. Pertumbuhan dan Perkembangan
                Hewan</a>
            <a href="#4" class="bg-hover-subtle p-2 rounded">C. Pertumbuhan dan Perkembangan
                Tumbuhan</a>
            <a href="../view/bab1.php#latihan" class="bg-hover-subtle p-2 rounded">Latihan</a>
        </div>
    </div>
</div>