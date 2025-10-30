<?php
header('Content-Type: application/json');

// Hanya izinkan POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo json_encode(['success' => false, 'message' => 'Method not allowed']);
  exit;
}

// Baca data JSON dari body
$input = json_decode(file_get_contents('php://input'), true);

if (json_last_error() !== JSON_ERROR_NONE) {
  echo json_encode(['success' => false, 'message' => 'Invalid JSON data']);
  exit;
}

// Simpan ke file data.json
$result = file_put_contents('../data/data.json', json_encode($input, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

if ($result === false) {
  echo json_encode(['success' => false, 'message' => 'Gagal menulis ke file data.json']);
} else {
  echo json_encode(['success' => true, 'message' => 'Data berhasil disimpan']);
}

?>