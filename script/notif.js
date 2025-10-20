const btnNotif = document.getElementById('btnNotif');
const btnProfil = document.getElementById('btnProfil');
const popupNotif = document.getElementById('popupNotif');
const popupProfil = document.getElementById('popupProfil');
const closeNotifBtn = document.getElementById('closeNotif');
const tabs = document.querySelectorAll('.tabNotif');
const notifItems = document.querySelectorAll('.notif-item');

// ===== Fungsi popup =====
function openPopup(popup) {
  closeAll();
  popup.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
  popup.classList.add('opacity-100', 'scale-100');
}

function closePopup(popup) {
  popup.classList.remove('opacity-100', 'scale-100');
  popup.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
}

function closeAll() {
  [popupNotif, popupProfil].forEach(p => closePopup(p));
}

// Toggle popup notifikasi
btnNotif.addEventListener('click', (e) => {
  e.stopPropagation();
  const isOpen = popupNotif.classList.contains('opacity-100');
  if (isOpen) closePopup(popupNotif);
  else openPopup(popupNotif);
});

// Toggle popup profil
btnProfil.addEventListener('click', (e) => {
  e.stopPropagation();
  const isOpen = popupProfil.classList.contains('opacity-100');
  if (isOpen) closePopup(popupProfil);
  else openPopup(popupProfil);
});

// Tombol close popup notif
closeNotifBtn.addEventListener('click', () => closePopup(popupNotif));

// Klik di luar popup menutup semua
document.addEventListener('click', (e) => {
  if (!popupNotif.contains(e.target) && !btnNotif.contains(e.target)) closePopup(popupNotif);
  if (!popupProfil.contains(e.target) && !btnProfil.contains(e.target)) closePopup(popupProfil);
});

// ===== Filter Tabs Notifikasi =====
tabs.forEach(tab => {
  tab.addEventListener('click', () => {
    // Reset tampilan tab
    tabs.forEach(t => {
      t.classList.remove('bg-main', 'font-medium', 'text-white');
      t.classList.add('bg-hover-subtle');
    });

    // Aktifkan tab yang diklik
    tab.classList.add('bg-main', 'font-medium', 'text-white');
    tab.classList.remove('bg-hover-subtle');

    const filter = tab.dataset.filter;

    notifItems.forEach(item => {
      const waktu = item.querySelector('.waktu');

      // === Jika tab "Semua" ===
      if (filter === 'all') {
        item.classList.remove('hidden');   // tampilkan semua grup
        waktu.classList.remove('hidden');  // tampilkan label waktu
      }

      // === Jika tab sesuai (hari ini, kemarin, minggu ini) ===
      else if (item.dataset.group === filter) {
        item.classList.remove('hidden');   // tampilkan grup yang sesuai
        waktu.classList.add('hidden');     // sembunyikan label waktu
      }

      // === Grup lain disembunyikan ===
      else {
        item.classList.add('hidden');
        waktu.classList.add('hidden');
      }
    });
  });
});



