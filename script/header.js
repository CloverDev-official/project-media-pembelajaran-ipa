const header = document.getElementById('site-header');
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const userBtn = document.getElementById('user-btn');
    const userBtnMobile = document.getElementById('user-btn-mobile');
    const userPopup = document.getElementById('user-popup');
    const userPopupMobile = document.getElementById('user-popup-mobile');

    let lastScroll = 0;
    let menuOpen = false;

    // Toggle menu mobile
    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        menuOpen = !menuOpen;
    });

    // Scroll behavior
    window.addEventListener('scroll', () => {
        if (menuOpen) return;

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

    // Toggle user popup
    userBtn.addEventListener('click', () => {
        if (userPopup.classList.contains('hidden')) {
            userPopup.classList.remove('hidden');
            setTimeout(() => {
                userPopup.classList.add('scale-100', 'opacity-100');
                userPopup.classList.remove('scale-95', 'opacity-0');
            }, 10);
        } else {
            userPopup.classList.add('scale-95', 'opacity-0');
            userPopup.classList.remove('scale-100', 'opacity-100');
            setTimeout(() => userPopup.classList.add('hidden'), 200);
        }
    });

    // Toggle user popup mobile
    userBtnMobile.addEventListener('click', () => {
        if (userPopupMobile.classList.contains('hidden')) {
            userPopupMobile.classList.remove('hidden');
            setTimeout(() => {
                userPopupMobile.classList.add('scale-100', 'opacity-100');
                userPopupMobile.classList.remove('scale-95', 'opacity-0');
            }, 10);
        } else {
            userPopupMobile.classList.add('scale-95', 'opacity-0');
            userPopupMobile.classList.remove('scale-100', 'opacity-100');
            setTimeout(() => userPopupMobile.classList.add('hidden'), 200);
        }
    });

    // Klik luar popup → tutup mobile
    document.addEventListener('click', (e) => {
        if (!userBtnMobile.contains(e.target) && !userPopupMobile.contains(e.target)) {
            userPopupMobile.classList.add('hidden');
            userPopupMobile.classList.remove('scale-100', 'opacity-100');
            userPopupMobile.classList.add('scale-95', 'opacity-0');
        }
    });

    // Klik luar popup → tutup
    document.addEventListener('click', (e) => {
        if (!userBtn.contains(e.target) && !userPopup.contains(e.target)) {
            userPopup.classList.add('hidden');
            userPopup.classList.remove('scale-100', 'opacity-100');
            userPopup.classList.add('scale-95', 'opacity-0');
        }
    });