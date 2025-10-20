const formPengaturan = document.getElementById("formPengaturan");
const formSoal = document.getElementById("formSoal");
const containerSoal = document.getElementById("containerSoal");
const btnSelanjutnya = document.getElementById("btnSelanjutnya");
const btnKembali = document.getElementById("btnKembali");

btnSelanjutnya.addEventListener("click", () => {
  const jumlah = parseInt(document.getElementById("jumlahSoal").value);
  const jam = document.getElementById("jam").value || 0;
  const menit = document.getElementById("menit").value || 0;
  const detik = document.getElementById("detik").value || 0;

  if (!jumlah || jumlah < 1 || jumlah > 100) {
    alert("Jumlah soal harus antara 1 sampai 100!");
    return;
  }

  console.log(`Waktu pengerjaan: ${jam} jam ${menit} menit ${detik} detik`);

  // Ganti tampilan form
  formPengaturan.classList.add("hidden");
  formSoal.classList.remove("hidden");

  // Kosongkan isi soal sebelum generate baru
  containerSoal.innerHTML = "";

  for (let i = 1; i <= jumlah; i++) {
    const soalHTML = `
      <div class="border border-gray-300 rounded-xl p-4 mb-6 bg-gray-50">
        <h3 class="font-bold text-lg mb-2 text-blue-700">Soal ${i}</h3>

        <!-- Pertanyaan -->
        <textarea name="soal${i}" placeholder="Tulis pertanyaan..." class="w-full border p-2 rounded-lg mb-3"></textarea>

        <!-- Upload Gambar -->
        <div class="mb-3">
          <label class="font-semibold">Tambahkan Gambar (opsional):</label>
          <input type="file" name="gambar${i}" accept="image/*" class="block mt-2 w-full border p-2 rounded-lg">
          <img id="preview${i}" class="mt-2 hidden rounded-lg max-h-40 border">
        </div>

        <!-- Pilihan Jawaban -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
          <input type="text" name="a${i}" placeholder="Pilihan A" class="border p-2 rounded-lg">
          <input type="text" name="b${i}" placeholder="Pilihan B" class="border p-2 rounded-lg">
          <input type="text" name="c${i}" placeholder="Pilihan C" class="border p-2 rounded-lg">
          <input type="text" name="d${i}" placeholder="Pilihan D" class="border p-2 rounded-lg">
        </div>

        <!-- Jawaban Benar -->
        <div class="mt-3">
          <label class="font-semibold">Jawaban Benar:</label>
          <select name="benar${i}" class="border p-2 rounded-lg ml-2">
            <option value="">Pilih</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
          </select>
        </div>
      </div>
    `;
    containerSoal.insertAdjacentHTML("beforeend", soalHTML);
  }

  // Tambahkan preview gambar per soal
  for (let i = 1; i <= jumlah; i++) {
    const inputFile = document.querySelector(`input[name='gambar${i}']`);
    const previewImg = document.getElementById(`preview${i}`);

    inputFile.addEventListener("change", () => {
      const file = inputFile.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = e => {
          previewImg.src = e.target.result;
          previewImg.classList.remove("hidden");
        };
        reader.readAsDataURL(file);
      } else {
        previewImg.classList.add("hidden");
      }
    });
  }
});

// Tombol Kembali
btnKembali.addEventListener("click", () => {
  formSoal.classList.add("hidden");
  formPengaturan.classList.remove("hidden");
  containerSoal.innerHTML = "";
});

// Tombol Simpan Semua
formSoal.addEventListener("submit", (e) => {
  e.preventDefault();
  alert("Semua soal berhasil disimpan!");
  // Di sini bisa pakai FormData untuk dikirim ke server (PHP)
});