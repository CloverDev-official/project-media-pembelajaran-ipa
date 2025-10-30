<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Sesuaikan origin jika perlu

// Lokasi file data UNTUK GAME PENCOCOKAN
$data_file = '../data/gamepertama_data.json';

// Baca file JSON
$data_json = file_get_contents($data_file);

// Decode JSON menjadi array PHP
$data = json_decode($data_json, true);

// Cek apakah decode berhasil
if ($data === null) {
    http_response_code(500); // Internal Server Error
    echo json_encode(["error" => "Gagal membaca file gamepertama_data.json"]);
    exit;
}

// Kirim data sebagai JSON
echo json_encode($data);
?>