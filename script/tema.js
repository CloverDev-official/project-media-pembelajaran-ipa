// === Modal Tema ===
const modalTema = document.getElementById("modalTema");
const temaButtons = [document.getElementById("btnTema"), document.getElementById("btnTemaMobile")];
const closeTema = document.getElementById("closeTema");

// buka modal
temaButtons.forEach(btn => {
  btn?.addEventListener("click", () => {
    modalTema.classList.remove("hidden");
  });
});

// tutup modal
closeTema?.addEventListener("click", () => {
  modalTema.classList.add("hidden");
});

// klik luar modal
modalTema?.addEventListener("click", (e) => {
  if (e.target === modalTema) {
    modalTema.classList.add("hidden");
  }
});


// === Ganti Tema ===
const btnTemaDefault = document.getElementById("btnTemaDefault");
const btnTemaPink = document.getElementById("btnTemaPink");
const btnTemaBlue = document.getElementById("btnTemaBlue");
const themeButtons = [btnTemaDefault, btnTemaPink, btnTemaBlue];

function setTheme(theme, activeBtn = null) {
  document.body.setAttribute("data-theme", theme);
  localStorage.setItem("theme", theme);

  // reset semua tombol
  themeButtons.forEach(btn => {
    btn?.classList.remove("bg-subtle");
  });

  // kasih style merah ke tombol yang dipilih
  if (activeBtn) {
    activeBtn.classList.add("bg-subtle");
  }
}

// event click
btnTemaDefault?.addEventListener("click", () => setTheme("default", btnTemaDefault));
btnTemaPink?.addEventListener("click", () => setTheme("pink", btnTemaPink));
btnTemaBlue?.addEventListener("click", () => setTheme("blue", btnTemaBlue));

// load tema dari localStorage saat reload
window.addEventListener("DOMContentLoaded", () => {
  const savedTheme = localStorage.getItem("theme") || "default";

  // tentukan tombol yang sesuai
  let activeBtn = null;
  if (savedTheme === "default") activeBtn = btnTemaDefault;
  if (savedTheme === "pink") activeBtn = btnTemaPink;
  if (savedTheme === "blue") activeBtn = btnTemaBlue;

  setTheme(savedTheme, activeBtn);
});
