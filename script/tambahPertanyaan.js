const modal = document.getElementById("tambahPertanyaan");
const jumlahSelect = document.getElementById("jumlahSoal");
const mulaiBtn = document.getElementById("mulaiSoalBtn");
const formSoal = document.getElementById("formSoal");
const pilihJumlahSoal = document.getElementById("pilihJumlahSoal");
const judulSoal = document.getElementById("judulSoal");
const prevBtn = document.getElementById("prevSoalBtn");
const nextBtn = document.getElementById("nextSoalBtn");
const closeBtn = document.getElementById("closePopupBtn");
const openPopupBtn = document.getElementById("openPopupBtn");

let jumlahSoal = 0;
let indexSoal = 0;
let dataSoal = [];

// 🔹 Generate opsi jumlah soal (1–10)
for (let i = 1; i <= 10; i++) {
  const opt = document.createElement("option");
  opt.value = i;
  opt.textContent = i;
  jumlahSelect.appendChild(opt);
}

// 🔹 Buka modal popup
openPopupBtn.addEventListener("click", () => {
  modal.classList.remove("hidden");
  modal.classList.add("flex");
  document.body.style.overflow = "hidden"; // 🔒 Nonaktifkan scroll halaman
});

// 🔹 Tutup modal popup
closeBtn.addEventListener("click", () => {
  modal.classList.add("hidden");
  document.body.style.overflow = "auto"; // 🔓 Aktifkan kembali scroll
});

// 🔹 Klik tombol mulai
mulaiBtn.addEventListener("click", () => {
  jumlahSoal = parseInt(jumlahSelect.value);
  if (!jumlahSoal) return alert("Pilih jumlah soal terlebih dahulu!");

  // Siapkan data kosong
  dataSoal = Array.from({ length: jumlahSoal }, () => ({
    pertanyaan: "",
    pilihanA: "",
    pilihanB: "",
    pilihanC: "",
    pilihanD: "",
    jawaban: "",
    waktuTampil: "",
  }));

  pilihJumlahSoal.classList.add("hidden");
  formSoal.classList.remove("hidden");
  tampilkanSoal();
});

// 🔹 Fungsi menampilkan soal berdasarkan index
function tampilkanSoal() {
  const soal = dataSoal[indexSoal];
  judulSoal.textContent = `Soal ${indexSoal + 1}`;

  document.getElementById("pertanyaan").value = soal.pertanyaan;
  document.getElementById("pilihanA").value = soal.pilihanA;
  document.getElementById("pilihanB").value = soal.pilihanB;
  document.getElementById("pilihanC").value = soal.pilihanC;
  document.getElementById("pilihanD").value = soal.pilihanD;
  document.getElementById("jawaban").value = soal.jawaban;
  document.getElementById("waktuTampil").value = soal.waktuTampil;

  prevBtn.style.display = indexSoal === 0 ? "none" : "inline-block";
  nextBtn.textContent =
    indexSoal === jumlahSoal - 1 ? "Simpan Semua" : "Selanjutnya";
}

// 🔹 Simpan data ke array
function simpanData() {
  dataSoal[indexSoal] = {
    pertanyaan: document.getElementById("pertanyaan").value.trim(),
    pilihanA: document.getElementById("pilihanA").value.trim(),
    pilihanB: document.getElementById("pilihanB").value.trim(),
    pilihanC: document.getElementById("pilihanC").value.trim(),
    pilihanD: document.getElementById("pilihanD").value.trim(),
    jawaban: document.getElementById("jawaban").value.trim(),
    waktuTampil: document.getElementById("waktuTampil").value.trim(),
  };
}

// 🔹 Validasi input wajib diisi
function validasiInput() {
  const pertanyaan = document.getElementById("pertanyaan").value.trim();
  const pilihanA = document.getElementById("pilihanA").value.trim();
  const pilihanB = document.getElementById("pilihanB").value.trim();
  const pilihanC = document.getElementById("pilihanC").value.trim();
  const pilihanD = document.getElementById("pilihanD").value.trim();
  const jawaban = document.getElementById("jawaban").value.trim();
  const waktuTampil = document.getElementById("waktuTampil").value.trim();

  if (
    !pertanyaan ||
    !pilihanA ||
    !pilihanB ||
    !pilihanC ||
    !pilihanD ||
    !jawaban ||
    !waktuTampil
  ) {
    alert("⚠️ Semua input wajib diisi sebelum melanjutkan!");
    return false;
  }
  return true;
}

// 🔹 Tombol "Selanjutnya" / "Simpan Semua"
nextBtn.addEventListener("click", () => {
  if (!validasiInput()) return; // 🔒 Cegah lanjut jika belum diisi semua

  simpanData();

  if (indexSoal === jumlahSoal - 1) {
    console.log("✅ Semua Data Soal:", dataSoal);
    alert("Semua soal berhasil disimpan!");
    modal.classList.add("hidden");
    document.body.style.overflow = "auto"; // 🔓 Aktifkan scroll kembali
  } else {
    indexSoal++;
    tampilkanSoal();
  }
});

// 🔹 Tombol "Sebelumnya"
prevBtn.addEventListener("click", () => {
  simpanData();
  if (indexSoal > 0) indexSoal--;
  tampilkanSoal();
});
