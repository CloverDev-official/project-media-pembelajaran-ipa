/* ============ Import PDF (.pdf) ============ */
document.getElementById("importPDF").addEventListener("click", () => {
  document.getElementById("uploadPDF").click();
});

document.getElementById("uploadPDF").addEventListener("change", function(e){
  const file = e.target.files[0];
  if(file){
    const reader = new FileReader();
    reader.onload = async function(event){
      const pdfData = new Uint8Array(event.target.result);
      const pdf = await pdfjsLib.getDocument({data: pdfData}).promise;
      let textContent = "";

      for(let i = 1; i <= pdf.numPages; i++){
        const page = await pdf.getPage(i);
        const text = await page.getTextContent();
        text.items.forEach(item => {
          textContent += item.str + " ";
        });
        textContent += "<br><br>";
      }

      // Masukkan ke TinyMCE
      tinymce.get("teks").setContent(textContent);
    };
    reader.readAsArrayBuffer(file);
  }
});