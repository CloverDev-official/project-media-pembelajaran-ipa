<header id="site-header" class="bg-gray-100 sticky top-0 shadow-md transition-transform duration-300 z-50">
    <nav class="flex justify-between items-center p-5">
        <h1 class="text-xl font-bold">Science Explorer</h1>
        <ul class="hidden md:flex gap-10 items-center">
            <li>Beranda</li>
            <li>Materi</li>
            <li>Gim</li>
            <li>Jelajahi</li>
            <li>Bantuan</li>
            <li><i class="bi bi-person-circle text-xl"></i></li>
        </ul>
        <button id="menu-btn" class="md:hidden text-2xl">☰</button>
    </nav>

    <!-- Menu mobile -->
    <ul id="mobile-menu" class="hidden flex-col gap-10 p-5 bg-gray-200 md:hidden">
        <li>Beranda</li>
        <li>Materi</li>
        <li>Gim</li>
        <li>Jelajahi</li>
        <li>Bantuan</li>
        <li><i class="bi bi-person-circle text-xl"></i></li>
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
