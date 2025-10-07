// tambah
const modalTambah = document.getElementById("modalTambah");
const btnTambah = document.getElementById("btn-tambah");
const btnCloseTambah = document.getElementById("btnCloseTambah");
const overlayTambah = document.getElementById("overlayTambah");

// tambah
btnTambah.addEventListener("click", () => {
  modalTambah.classList.remove("hidden");
  modalTambah.classList.add("flex");
});

function closeModalTambah() {
  modalTambah.classList.remove("flex");
  modalTambah.classList.add("hidden");
}

btnCloseTambah.addEventListener("click", closeModalTambah);
