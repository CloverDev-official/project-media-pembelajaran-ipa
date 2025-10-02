document.addEventListener("DOMContentLoaded", () => {
  const popupTema = document.getElementById("popupTema");
  const btnOpenTema = document.getElementById("openTema");
  const btnOpenTemaMobile = document.getElementById("openTemaMobile");
  const btnCloseTema = document.getElementById("closeTema");

  // Tombol tema
  const btnTemaDefault = document.getElementById("btnTemaDefault");
  const btnTemaPink = document.getElementById("btnTemaPink");
  const btnTemaBlue = document.getElementById("btnTemaBlue");
  const themeButtons = [btnTemaDefault, btnTemaPink, btnTemaBlue];

  function openPopup() {
    popupTema.classList.remove("opacity-0", "pointer-events-none");
    popupTema.classList.add("opacity-100", "scale-100", "pointer-events-auto");
  } 

  function closePopup() {
    popupTema.classList.add("opacity-0", "pointer-events-none");
    popupTema.classList.remove("opacity-100", "scale-100", "pointer-events-auto");
  }

  function togglePopup() {
    if (popupTema.classList.contains("opacity-0")) {
      openPopup();
    } else {
      closePopup();
    }
  }

  // Klik tombol buka
  btnOpenTema?.addEventListener("click", (e) => {
    e.stopPropagation();
    togglePopup();
  });

  // Klik tombol buka
  btnOpenTemaMobile?.addEventListener("click", (e) => {
    e.stopPropagation();
    togglePopup();
  });

  

  // Klik tombol close
  btnCloseTema?.addEventListener("click", (e) => {
    e.stopPropagation();
    closePopup();
  });

  // Klik di luar modal (overlay)
  popupTema.addEventListener("click", (e) => {
    if (e.target === popupTema) { // hanya klik overlay, bukan isi modal
      closePopup();
    }
  });

  // === Theme change ===
  function setTheme(theme, activeBtn = null) {
    document.body.setAttribute("data-theme", theme);
    localStorage.setItem("theme", theme);

    themeButtons.forEach(btn => btn?.classList.remove("bg-subtle"));

    if (activeBtn) activeBtn.classList.add("bg-subtle");
  }

  btnTemaDefault?.addEventListener("click", () => setTheme("default", btnTemaDefault));
  btnTemaPink?.addEventListener("click", () => setTheme("pink", btnTemaPink));
  btnTemaBlue?.addEventListener("click", () => setTheme("blue", btnTemaBlue));

  // Load tema dari localStorage
  const savedTheme = localStorage.getItem("theme") || "default";
  let activeBtn = btnTemaDefault;
  if (savedTheme === "pink") activeBtn = btnTemaPink;
  if (savedTheme === "blue") activeBtn = btnTemaBlue;
  setTheme(savedTheme, activeBtn);
});
