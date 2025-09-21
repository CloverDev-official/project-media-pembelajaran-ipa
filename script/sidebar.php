<script>
  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const sidebarContainer = document.getElementById('sidebar-container');
    const sidebarButton = document.getElementById('sidebarButton');

    // toggle animasi sidebar
    sidebar.classList.toggle('translate-x-full');
    // sidebar.classList.toggle('right-0');

    // toggle overlay
    overlay.classList.toggle('hidden');

    // toggle lebar container
    sidebarContainer.classList.toggle('w-1/4');

    // animasi tombol sidebar
    sidebarButton.classList.toggle('right-[-10rem]');
  }

  // --- tampilkan tombol hanya setelah hero section ---
  window.addEventListener("scroll", function () {
    const hero = document.querySelector(".hero");
    const button = document.getElementById("sidebarButton");

    if (!hero || !button) return; // cegah error kalau elemen tidak ada

    const heroHeight = hero.offsetHeight;
    if (window.scrollY > heroHeight - 100) {
      button.classList.remove("hidden");
    } else {
      button.classList.add("hidden");
    }
  });
</script>