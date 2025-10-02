const btnNotif = document.getElementById('btnNotif');
const btnProfil = document.getElementById('btnProfil');
const popupNotif = document.getElementById('popupNotif');
const popupProfil = document.getElementById('popupProfil');
const closeNotifBtn = document.getElementById('closeNotif');
const tabs = document.querySelectorAll('.tabNotif');
const notifItems = document.querySelectorAll('.notif-item');

// Fungsi buka popup
function openPopup(popup) {
  closeAll(); // tutup semua dulu
  popup.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
  popup.classList.add('opacity-100', 'scale-100');
}

// Fungsi tutup popup
function closePopup(popup) {
  popup.classList.remove('opacity-100', 'scale-100');
  popup.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
}

// Tutup semua popup
function closeAll() {
  [popupNotif, popupProfil].forEach(p => {
    closePopup(p);
  });
}

// Toggle popup notif
btnNotif.addEventListener('click', (e) => {
  e.stopPropagation();
  const isOpen = popupNotif.classList.contains('opacity-100');
  if (isOpen) {
    closePopup(popupNotif);
  } else {
    openPopup(popupNotif);
  }
});

// Toggle popup profil
btnProfil.addEventListener('click', (e) => {
  e.stopPropagation();
  const isOpen = popupProfil.classList.contains('opacity-100');
  if (isOpen) {
    closePopup(popupProfil);
  } else {
    openPopup(popupProfil);
  }
});

// tombol close di popup notif
closeNotifBtn.addEventListener('click', () => {
  closePopup(popupNotif);
});

// klik di luar area untuk menutup popup
document.addEventListener('click', (e) => {
  if (!popupNotif.contains(e.target) && !btnNotif.contains(e.target)) {
    closePopup(popupNotif);
  }
  if (!popupProfil.contains(e.target) && !btnProfil.contains(e.target)) {
    closePopup(popupProfil);
  }
});

// filter tabs notifikasi
tabs.forEach(tab => {
  tab.addEventListener('click', () => {
    // reset style semua tab
    tabs.forEach(t => t.classList.remove('bg-gray-200', 'font-medium'));
    tab.classList.add('bg-gray-200', 'font-medium');

    const filter = tab.dataset.filter;
    notifItems.forEach(item => {
      if (filter === 'all' || item.dataset.group === filter) {
        item.classList.remove('hidden');
      } else {
        item.classList.add('hidden');
      }
    });
  });
});





