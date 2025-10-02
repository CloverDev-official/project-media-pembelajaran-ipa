
// === Import Word (DOCX) ===
// Tombol Import Word
document.getElementById("importWord").addEventListener("click", () => {
  document.getElementById("uploadWord").click();
});

// Proses file DOCX
document.getElementById("uploadWord").addEventListener("change", function(e) {
  const file = e.target.files[0];
  if(file){
    const reader = new FileReader();
    reader.onload = function(event){
      mammoth.convertToHtml({arrayBuffer: event.target.result})
        .then(result => {
          // Masukkan hasilnya ke TinyMCE
          tinymce.get("teks").setContent(result.value);
        })
        .catch(err => console.error("Error import Word:", err));
    };
    reader.readAsArrayBuffer(file);
  }
});