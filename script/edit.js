// edit
const btnCloseEdit = document.getElementById("btnCloseEdit");
const modalEdit = document.getElementById("modalEdit");
const btnEdit = document.getElementById("btn-edit");
const overlayEdit = document.getElementById("overlayEdit");

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
