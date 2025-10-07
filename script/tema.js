document.addEventListener("DOMContentLoaded", () => {
  const popupTema = document.getElementById("popupTema");
  const btnOpenTema = document.getElementById("openTema");
  const btnOpenTemaMobile = document.getElementById("openTemaMobile");
  const btnCloseTema = document.getElementById("closeTema");
  const tabs = document.querySelectorAll(".tabTema");
  const temaItems = document.querySelectorAll(".tema-item");

  const btnTemaDefault = document.getElementById("btnTemaDefault");
  const btnTemaPink = document.getElementById("btnTemaPink");
  const btnTemaBlue = document.getElementById("btnTemaBlue");
  const themeButtons = [btnTemaDefault, btnTemaPink, btnTemaBlue];
  const btnTemaCustom = document.getElementById("picker");

  // === Popup open/close ===
  function openPopup() {
    popupTema.classList.remove("opacity-0", "pointer-events-none", "scale-95");
    popupTema.classList.add("opacity-100", "scale-100", "pointer-events-auto");
  }
  function closePopup() {
    popupTema.classList.add("opacity-0", "pointer-events-none", "scale-95");
    popupTema.classList.remove("opacity-100", "scale-100", "pointer-events-auto");
  }
  function togglePopup() {
    popupTema.classList.contains("opacity-0") ? openPopup() : closePopup();
  }
  btnOpenTema?.addEventListener("click", e => { e.stopPropagation(); togglePopup(); });
  btnOpenTemaMobile?.addEventListener("click", e => { e.stopPropagation(); togglePopup(); });
  btnCloseTema?.addEventListener("click", e => { e.stopPropagation(); closePopup(); });
  popupTema.addEventListener("click", e => { if (e.target === popupTema) closePopup(); });

  // === Utils (HEX ↔ HSL) ===
  function hexToHSL(H) {
    let r = 0, g = 0, b = 0;
    if (H.length == 4) {
      r = "0x" + H[1] + H[1];
      g = "0x" + H[2] + H[2];
      b = "0x" + H[3] + H[3];
    } else if (H.length == 7) {
      r = "0x" + H[1] + H[2];
      g = "0x" + H[3] + H[4];
      b = "0x" + H[5] + H[6];
    }
    r /= 255; g /= 255; b /= 255;
    const cmin = Math.min(r, g, b), cmax = Math.max(r, g, b), delta = cmax - cmin;
    let h = 0, s = 0, l = 0;

    if (delta === 0) h = 0;
    else if (cmax === r) h = ((g - b) / delta) % 6;
    else if (cmax === g) h = (b - r) / delta + 2;
    else h = (r - g) / delta + 4;

    h = Math.round(h * 60);
    if (h < 0) h += 360;

    l = (cmax + cmin) / 2;
    s = delta === 0 ? 0 : delta / (1 - Math.abs(2 * l - 1));
    s = +(s * 100).toFixed(1);
    l = +(l * 100).toFixed(1);
    return { h, s, l };
  }

  function hslToHex(h, s, l) {
    s /= 100; l /= 100;
    const c = (1 - Math.abs(2 * l - 1)) * s;
    const x = c * (1 - Math.abs((h / 60) % 2 - 1));
    const m = l - c / 2;
    let r = 0, g = 0, b = 0;

    if (0 <= h && h < 60) { r = c; g = x; b = 0; }
    else if (60 <= h && h < 120) { r = x; g = c; b = 0; }
    else if (120 <= h && h < 180) { r = 0; g = c; b = x; }
    else if (180 <= h && h < 240) { r = 0; g = x; b = c; }
    else if (240 <= h && h < 300) { r = x; g = 0; b = c; }
    else { r = c; g = 0; b = x; }

    r = Math.round((r + m) * 255);
    g = Math.round((g + m) * 255);
    b = Math.round((b + m) * 255);

    return "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1).toUpperCase();
  }

  // === Custom Theme ===
  function generateCustomPalette(baseColor) {
    const hsl = hexToHSL(baseColor);
    const steps = {50:95,100:88,200:75,300:60,400:50,500:45,600:38,700:30,800:22,900:15,950:10};
    for (let key in steps) {
      const color = hslToHex(hsl.h, hsl.s, steps[key]);
      document.documentElement.style.setProperty(`--primary-${key}`, color);
    }
    document.body.setAttribute("data-theme", "custom");
    localStorage.setItem("theme", "custom");
    localStorage.setItem("primaryPalette", JSON.stringify({ baseColor }));
  }

  btnTemaCustom?.addEventListener("input", e => {
    generateCustomPalette(e.target.value);
    themeButtons.forEach(btn => btn?.classList.remove("bg-subtle"));
  });

  // === Preset Theme ===
  function setPresetTheme(theme, activeBtn = null) {
    document.body.setAttribute("data-theme", theme);

    // Hapus semua variable custom
    [50,100,200,300,400,500,600,700,800,900,950].forEach(i => {
      document.documentElement.style.removeProperty(`--primary-${i}`);
    });

    // Simpan preset
    localStorage.setItem("theme", theme);

    // Reset highlight tombol
    themeButtons.forEach(btn => btn?.classList.remove("bg-subtle"));
    if (activeBtn) activeBtn.classList.add("bg-subtle");
  }

  btnTemaDefault?.addEventListener("click", () => setPresetTheme("default", btnTemaDefault));
  btnTemaPink?.addEventListener("click", () => setPresetTheme("pink", btnTemaPink));
  btnTemaBlue?.addEventListener("click", () => setPresetTheme("blue", btnTemaBlue));

  // === Tabs Filter ===
  tabs.forEach(tab => {
    tab.addEventListener("click", () => {
      tabs.forEach(t => t.classList.remove("bg-main","font-medium","text-white"));
      tab.classList.add("bg-main","font-medium","text-white");

      const filter = tab.dataset.filter;
      temaItems.forEach(item => {
        if (filter === "all" || item.dataset.group === filter) item.classList.remove("hidden");
        else item.classList.add("hidden");
      });
    });
  });

  // === Load saved theme ===
  let savedTheme = localStorage.getItem("theme");
  if (!savedTheme) {
    savedTheme = "default";
    localStorage.setItem("theme", "default");
  }

  if (savedTheme === "default") setPresetTheme("default", btnTemaDefault);
  else if (savedTheme === "pink") setPresetTheme("pink", btnTemaPink);
  else if (savedTheme === "blue") setPresetTheme("blue", btnTemaBlue);
  else if (savedTheme === "custom") {
    const savedPalette = localStorage.getItem("primaryPalette");
    if (savedPalette) {
      const { baseColor } = JSON.parse(savedPalette);
      if (baseColor) generateCustomPalette(baseColor);
      if (btnTemaCustom) btnTemaCustom.value = baseColor;
    }
  }
});

// === Elemen DOM ===
const popupTema = document.getElementById("popupTema");
const modalTema = document.getElementById("modalTema");
const closeTema = document.getElementById("closeTema");

const tabsTema = document.querySelectorAll(".tabTema");
const temaItems = document.querySelectorAll(".tema-item");

const btnTemaDefault = document.getElementById("btnTemaDefault");
const btnTemaPink = document.getElementById("btnTemaPink");
const btnTemaBlue = document.getElementById("btnTemaBlue");
const colorPicker = document.getElementById("picker");

const themeButtons = [btnTemaDefault, btnTemaPink, btnTemaBlue];

// === Popup open/close ===
function openPopupTema() {
  popupTema.classList.remove("opacity-0", "scale-95", "pointer-events-none");
}
function closePopupTema() {
  popupTema.classList.add("opacity-0", "scale-95", "pointer-events-none");
}
closeTema?.addEventListener("click", closePopupTema);

// Tutup popup jika klik luar modal
popupTema?.addEventListener("click", e => {
  if (e.target === popupTema) closePopupTema();
});

// === Tabs Filter ===
tabsTema.forEach(tab => {
  tab.addEventListener("click", () => {
    const filter = tab.dataset.filter;

    // aktifkan tab
    tabsTema.forEach(t => {
      t.classList.remove("bg-main", "text-white");
      t.classList.add("bg-hover-subtle");
    });
    tab.classList.add("bg-main", "text-white");
    tab.classList.remove("bg-hover-subtle");

    // tampilkan item sesuai tab
    temaItems.forEach(item => {
      item.classList.add("hidden");
      if (item.dataset.group === filter) item.classList.remove("hidden");
    });
  });
});

// === Preset Themes ===
function setPresetTheme(theme) {
  document.documentElement.setAttribute("data-theme", theme);
  localStorage.setItem("theme", theme);

  // highlight button aktif
  themeButtons.forEach(btn => btn?.classList.remove("bg-subtle"));
  if (theme === "default") btnTemaDefault?.classList.add("bg-subtle");
  if (theme === "pink") btnTemaPink?.classList.add("bg-subtle");
  if (theme === "blue") btnTemaBlue?.classList.add("bg-subtle");
}

// Event preset
btnTemaDefault?.addEventListener("click", () => setPresetTheme("default"));
btnTemaPink?.addEventListener("click", () => setPresetTheme("pink"));
btnTemaBlue?.addEventListener("click", () => setPresetTheme("blue"));

// === Custom Theme ===
function hexToHSL(hex) {
  hex = hex.replace(/^#/, "");
  if (hex.length === 3) {
    hex = hex.split("").map(x => x + x).join("");
  }
  let r = parseInt(hex.substring(0, 2), 16) / 255;
  let g = parseInt(hex.substring(2, 4), 16) / 255;
  let b = parseInt(hex.substring(4, 6), 16) / 255;

  let max = Math.max(r, g, b), min = Math.min(r, g, b);
  let h, s, l = (max + min) / 2;

  if (max === min) {
    h = s = 0;
  } else {
    let d = max - min;
    s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
    switch (max) {
      case r: h = (g - b) / d + (g < b ? 6 : 0); break;
      case g: h = (b - r) / d + 2; break;
      case b: h = (r - g) / d + 4; break;
    }
    h /= 6;
  }
  return { h: Math.round(h * 360), s: Math.round(s * 100), l: Math.round(l * 100) };
}

function hslToHex(h, s, l) {
  s /= 100; l /= 100;
  const k = n => (n + h / 30) % 12;
  const a = s * Math.min(l, 1 - l);
  const f = n => l - a * Math.max(-1, Math.min(k(n)-3, Math.min(9-k(n),1)));
  const toHex = x => Math.round(x * 255).toString(16).padStart(2, "0");
  return `#${toHex(f(0))}${toHex(f(8))}${toHex(f(4))}`;
}

function generateCustomPalette(baseColor) {
  const { h, s, l } = hexToHSL(baseColor);
  const palette = {};
  const steps = { 50:95,100:90,200:80,300:70,400:60,500:50,600:40,700:30,800:20,900:10 };

  for (const [key, lightness] of Object.entries(steps)) {
    palette[key] = hslToHex(h, s, lightness);
  }

  for (const [key, value] of Object.entries(palette)) {
    document.documentElement.style.setProperty(`--primary-${key}`, value);
  }
  document.documentElement.style.setProperty("--primary", baseColor);

  localStorage.setItem("primaryPalette", JSON.stringify({ baseColor }));
}

// Event custom picker
colorPicker?.addEventListener("input", e => {
  generateCustomPalette(e.target.value);
  themeButtons.forEach(btn => btn?.classList.remove("bg-subtle"));
  localStorage.setItem("theme", "custom");
});

// === Load Theme saat reload ===
function loadTheme() {
  const savedTheme = localStorage.getItem("theme") || "default";

  if (savedTheme === "custom") {
    const savedPalette = JSON.parse(localStorage.getItem("primaryPalette") || "{}");
    if (savedPalette.baseColor) {
      generateCustomPalette(savedPalette.baseColor);
      if (colorPicker) colorPicker.value = savedPalette.baseColor;
    }
  } else {
    setPresetTheme(savedTheme);
  }
}
loadTheme();


