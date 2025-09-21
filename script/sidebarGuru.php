<script>
  const sidebar = document.getElementById("sidebar");
  const content = document.getElementById("content");
  const overlay = document.getElementById("overlay");
  const openSidebarBtn = document.getElementById("openSidebarBtn");

  document.addEventListener("DOMContentLoaded", () => {
    if (window.innerWidth >= 768) {
      // Desktop → sidebar default terbuka penuh
      sidebar.classList.remove("-translate-x-full");
      content.classList.add("md:ml-[16.6667%]");
      openSidebarBtn.classList.add("hidden");
    } else {
      // Mobile → sidebar default tertutup
      sidebar.classList.add("-translate-x-full");
      overlay.classList.add("hidden");
      openSidebarBtn.classList.remove("hidden");
    }
  });

  function toggleSidebar() {
  if (window.innerWidth >= 768) {
    // --- DESKTOP ---
    sidebar.classList.toggle("sidebar-collapsed");

    if (sidebar.classList.contains("sidebar-collapsed")) {
      content.classList.remove("md:ml-[16.6667%]");
      content.classList.add("md:ml-20"); 
    } else {
      content.classList.remove("md:ml-20");
      content.classList.add("md:ml-[16.6667%]");
    }
  } else {
    // --- MOBILE ---
    sidebar.classList.toggle("-translate-x-full");

    if (sidebar.classList.contains("-translate-x-full")) {
      overlay.classList.add("hidden");
      openSidebarBtn.classList.remove("hidden");
    } else {
      overlay.classList.remove("hidden");
      openSidebarBtn.classList.add("hidden");
    }
  }
}

</script>
