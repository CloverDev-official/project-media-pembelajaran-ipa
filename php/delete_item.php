<?php
// --- File: php/delete_item.php ---
// Handler khusus untuk menghapus satu item berdasarkan ID

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Tangani preflight request OPTIONS (untuk CORS)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// --- PATH KE FILE DATA ---
// Sesuaikan path ini dengan struktur proyek Anda
$data_file = '../data/gamepertama_data.json';

// --- VALIDASI INPUT ---
$input = json_decode(file_get_contents('php://input'), true);
$idToDelete = isset($input['id']) ? trim(strval($input['id'])) : null;

if (!$idToDelete) {
    http_response_code(400); // Bad Request
    echo json_encode(['success' => false, 'message' => 'ID item tidak diberikan.']);
    exit;
}

// --- BACA DATA ---
if (!file_exists($data_file)) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['success' => false, 'message' => 'File data tidak ditemukan.']);
    exit;
}

$data_json = file_get_contents($data_file);
$data = json_decode($data_json, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['success' => false, 'message' => 'Format JSON file data tidak valid: ' . json_last_error_msg()]);
    exit;
}

if (!isset($data['pasangan']) || !is_array($data['pasangan'])) {
    $data['pasangan'] = [];
}

// --- HAPUS ITEM ---
$originalCount = count($data['pasangan']);

// Filter array untuk menghapus item dengan ID yang cocok
$data['pasangan'] = array_values(
    array_filter($data['pasangan'], function($item) use ($idToDelete) {
        return strval($item['id']) !== $idToDelete;
    })
);

// --- PERIKSA HASIL & SIMPAN ---
if (count($data['pasangan']) < $originalCount) {
    // Item ditemukan dan dihapus
    $jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    if (file_put_contents($data_file, $jsonData) !== false) {
        echo json_encode([
            'success' => true,
            'message' => "Item dengan ID '{$idToDelete}' berhasil dihapus.",
            'deleted_id' => $idToDelete
        ]);
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(['success' => false, 'message' => 'Gagal menyimpan perubahan ke file data.']);
    }
} else {
    // Item tidak ditemukan
    http_response_code(404); // Not Found
    echo json_encode([
        'success' => false,
        'message' => "Item dengan ID '{$idToDelete}' tidak ditemukan."
    ]);
}
exit;

?>