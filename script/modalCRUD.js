// tambah
const modalTambah = document.getElementById("modalTambah");
const btnTambah = document.getElementById("btn-tambah");
const btnCloseTambah = document.getElementById("btnCloseTambah");
const overlayTambah = document.getElementById("overlayTambah");
// hapus
const modalHapus = document.getElementById("modalHapus");
const btnHapus = document.getElementById("btn-hapus");
const btnCloseHapus = document.getElementById("btnCloseHapus");
const overlayHapus = document.getElementById("overlayHapus");
// edit
const btnCloseEdit = document.getElementById("btnCloseEdit");
const modalEdit = document.getElementById("modalEdit");
const btnEdit = document.getElementById("btn-edit");
const overlayEdit = document.getElementById("overlayEdit");


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



// edit
btnEdit.addEventListener("click", () => {
  modalEdit.classList.remove("hidden");
  modalEdit.classList.add("flex");
});

function closeModalEdit() {
  modalEdit.classList.remove("flex");
  modalEdit.classList.add("hidden");
}

btnCloseEdit.addEventListener("click", closeModalEdit);
overlayEdit.addEventListener("click", closeModalEdit);
