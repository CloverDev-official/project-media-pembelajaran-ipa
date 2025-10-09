function hexToRgb(hex) {
  hex = hex.replace("#", "");
  if (hex.length === 3)
    hex = hex
      .split("")
      .map((c) => c + c)
      .join("");
  const bigint = parseInt(hex, 16);
  return { r: (bigint >> 16) & 255, g: (bigint >> 8) & 255, b: bigint & 255 };
}

function rgbToHsl(r, g, b) {
  r /= 255;
  g /= 255;
  b /= 255;
  const max = Math.max(r, g, b),
    min = Math.min(r, g, b);
  let h = 0,
    s = 0,
    l = (max + min) / 2;
  if (max !== min) {
    const d = max - min;
    s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
    switch (max) {
      case r:
        h = (g - b) / d + (g < b ? 6 : 0);
        break;
      case g:
        h = (b - r) / d + 2;
        break;
      case b:
        h = (r - g) / d + 4;
        break;
    }
    h /= 6;
  }
  return { h: Math.round(h * 360), s: Math.round(s * 100), l: Math.round(l * 100) };
}

function hslToRgb(h, s, l) {
  h /= 360;
  s /= 100;
  l /= 100;
  if (s === 0) {
    const v = Math.round(l * 255);
    return { r: v, g: v, b: v };
  }
  const q = l < 0.5 ? l * (1 + s) : l + s - l * s;
  const p = 2 * l - q;
  const hue2rgb = (p, q, t) => {
    if (t < 0) t += 1;
    if (t > 1) t -= 1;
    if (t < 1 / 6) return p + (q - p) * 6 * t;
    if (t < 1 / 2) return q;
    if (t < 2 / 3) return p + (q - p) * (2 / 3 - t) * 6;
    return p;
  };
  const r = Math.round(hue2rgb(p, q, h + 1 / 3) * 255);
  const g = Math.round(hue2rgb(p, q, h) * 255);
  const b = Math.round(hue2rgb(p, q, h - 1 / 3) * 255);
  return { r, g, b };
}

function hslToHex(h, s, l) {
  const { r, g, b } = hslToRgb(h, s, l);
  return "#" + [r, g, b].map((x) => x.toString(16).padStart(2, "0")).join("");
}

function generateShades(hex) {
  const { r, g, b } = hexToRgb(hex);
  const hsl = rgbToHsl(r, g, b);
  const lightnessMap = {
    50: 98,
    100: 95,
    200: 90,
    300: 80,
    400: 65,
    500: hsl.l,
    600: hsl.l - 8,
    700: hsl.l - 16,
    800: hsl.l - 24,
    900: hsl.l - 32,
  };
  const shades = {};
  for (const key in lightnessMap) {
    let L = Math.max(2, Math.min(98, lightnessMap[key]));
    shades[key] = hslToHex(hsl.h, hsl.s, L);
  }
  return shades;
}

function applyPalette(name, hex) {
  const shades = generateShades(hex);
  for (const s in shades) {
    document.documentElement.style.setProperty(`--${name}-${s}`, shades[s]);
  }
  localStorage.setItem("palette_" + name, hex);
}

// Restore saat halaman dibuka
document.addEventListener("DOMContentLoaded", () => {
  const saved = localStorage.getItem("palette_primary");
  applyPalette("primary", saved || "#3b82f6");
});

// Fungsi global dipanggil di halaman colorpicker
window.setPrimaryColor = function (hex) {
  applyPalette("primary", hex);
};
