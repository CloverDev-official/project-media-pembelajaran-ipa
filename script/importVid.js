const importVid = document.getElementById("importVid");
const modalVid = document.getElementById("modalVid");
const closeModalVid = document.getElementById("closeModalVid");
const dropArea = document.getElementById("dropArea");
const fileInput = document.getElementById("fileInput");
const preview = document.getElementById("preview");
const previewVideo = preview.querySelector("video");
const removeVideo = document.getElementById("removeVideo");

// buka modal
importVid.addEventListener("click", () => {
  modalVid.classList.remove("hidden");
  modalVid.classList.add("flex");
});

// tutup modal
function closeModal() {
  modalVid.classList.add("hidden");
  modalVid.classList.remove("flex");
}
closeModalVid.addEventListener("click", closeModal);

// drag & drop
dropArea.addEventListener("dragover", (e) => {
  e.preventDefault();
  dropArea.classList.add("border-green-500", "bg-green-50");
});

dropArea.addEventListener("dragleave", () => {
  dropArea.classList.remove("border-green-500", "bg-green-50");
});

dropArea.addEventListener("drop", (e) => {
  e.preventDefault();
  dropArea.classList.remove("border-green-500", "bg-green-50");
  const file = e.dataTransfer.files[0];
  handleFile(file);
});

// browse file
fileInput.addEventListener("change", () => {
  const file = fileInput.files[0];
  handleFile(file);
});

function handleFile(file) {
  if (file && file.type.startsWith("video/")) {
    const url = URL.createObjectURL(file);
    previewVideo.src = url;
    preview.classList.remove("hidden");

    // tutup modal setelah video dipilih
    closeModal();
  } else {
    alert("Harap pilih file video!");
  }
}

function handleFile(file) {
  if (file && file.type.startsWith("video/")) {
    const url = URL.createObjectURL(file);
    previewVideo.src = url;
    preview.classList.remove("hidden"); // tampilkan preview

    // tutup modal setelah video dipilih
    closeModal();
  } else {
    alert("Harap pilih file video!");
  }
}

// hapus video
removeVideo.addEventListener("click", () => {
  previewVideo.src = "";
  preview.classList.add("hidden"); // sembunyikan lagi preview
  fileInput.value = ""; // reset input file
});
