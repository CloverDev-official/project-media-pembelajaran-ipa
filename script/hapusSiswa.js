
// hapus
const modalHapus = document.getElementById("modalHapus");
const btnHapus = document.getElementById("btn-hapus");
const btnCloseHapus = document.getElementById("btnCloseHapus");
const overlayHapus = document.getElementById("overlayHapus");



overlayHapus.addEventListener("click", closeModalHapus);
btnHapus.addEventListener("click", () => {
  modalHapus.classList.remove("hidden");
  modalHapus.classList.add("flex");
});

function closeModalHapus() {
  modalHapus.classList.remove("flex");
  modalHapus.classList.add("hidden");
}

btnCloseHapus.addEventListener("click", closeModalHapus);
overlayHapus.addEventListener("click", closeModalHapus);



