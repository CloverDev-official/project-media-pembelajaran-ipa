<header id="site-header" class="bg-gray-100 sticky top-0 shadow-md transition-transform duration-300 z-50">
    <nav class="flex justify-between items-center p-5">
        <h1 class="text-xl font-bold">Science Explorer</h1>
        <ul class="hidden md:flex gap-10 items-center">
            <a href="../view/beranda.php"><li>Beranda</li></a>
            <a href="../view/materi.php"><li>Materi</li></a>
            <a href="../view/gim.php"><li>Gim</li></a>
            <a href="../view/.php"><li>Jelajahi</li></a>
            <a href="../view/.php"><li>Bantuan</li></a>
            <a href="../view/.php"><li><i class="bi bi-person-circle text-xl"></i></li></a>
        </ul>
        <div class="flex gap-5 md:hidden text-2xl">
            <button id="menu-btn" ><i class="bi bi-list font-semibold"></i></button>
            <a href="../view/.php" ><i class="bi bi-person-circle text-2xl"></i></a>
        </div>
        
    </nav>

    <!-- Menu mobile -->
    <ul id="mobile-menu" class="hidden flex-col gap-10 p-5 bg-gray-200 md:hidden">
        <a href="../view/beranda.php" class="text-lg mt-0 m-3 font-semibold"><li>Beranda</li></a>
        <a href="../view/materi.php" class="text-lg mt-0 m-3 font-semibold"><li>Materi</li></a>
        <a href="../view/gim.php" class="text-lg mt-0 m-3 font-semibold"><li>Gim</li></a>
        <a href="../view/.php" class="text-lg mt-0 m-3 font-semibold"><li>Jelajahi</li></a>
        <a href="../view/.php" class="text-lg mt-0 m-3 font-semibold"><li>Bantuan</li></a>
        
    </ul>
</header>

<script>
    const header = document.getElementById('site-header');
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    let lastScroll = 0;
    let menuOpen = false; // status menu

    // Toggle menu mobile
    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        menuOpen = !menuOpen; // ubah status
    });

    // Scroll behavior
    window.addEventListener('scroll', () => {
        if (menuOpen) return; // kalau menu terbuka, jangan hide header

        let currentScroll = window.scrollY;

        if (currentScroll <= 0) {
            header.style.transform = 'translateY(0)';
        } else if (currentScroll > lastScroll) {
            header.style.transform = 'translateY(-100%)';
        } else {
            header.style.transform = 'translateY(0)';
        }

        lastScroll = currentScroll;
    });
</script>