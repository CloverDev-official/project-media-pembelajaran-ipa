<?php
// --- File: php/admin_gamepertama_handler.php ---
// Handler utama untuk Admin Panel Game Pencocokan Istilah & Definisi (Baca, Tambah, Update)

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Tangani preflight request OPTIONS (untuk CORS)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// --- PATH KE FILE DATA ---
// Sesuaikan path ini jika struktur foldernya berbeda
$data_file = '../data/gamepertama_data.json';

// --- FUNGSI PEMBACA DATA ---
function readData($file_path) {
    if (!file_exists($file_path)) {
        // Buat file kosong jika tidak ada
        $initial_data = ['materi' => 'Game Pencocokan', 'pasangan' => []];
        file_put_contents($file_path, json_encode($initial_data, JSON_PRETTY_PRINT));
    }

    $data_json = file_get_contents($file_path);
    $data = json_decode($data_json, true);

    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Gagal membaca file data JSON: ' . json_last_error_msg()]);
        exit;
    }

    // Pastikan struktur data sesuai
    if (!isset($data['pasangan']) || !is_array($data['pasangan'])) {
         $data['pasangan'] = []; // Inisialisasi array jika tidak ada
    }
    // Tambahkan ID unik jika belum ada (untuk keperluan edit/delete di frontend)
    foreach ($data['pasangan'] as &$item) {
        if (!isset($item['id']) || empty($item['id'])) {
             // Buat ID sederhana berdasarkan uniqid jika tidak ada
             $item['id'] = uniqid('item_', true);
        }
        // Konversi ID ke string untuk konsistensi
        $item['id'] = strval($item['id']);
    }
    // Simpan kembali ke file jika ada perubahan (misalnya penambahan ID)
    // Hanya simpan jika benar-benar perlu, atau biarkan saja untuk saat ini
    // file_put_contents($file_path, json_encode($data, JSON_PRETTY_PRINT));

    return $data;
}

// --- FUNGSI PENULISAN DATA ---
function writeData($file_path, $data) {
    // Backup file sebelumnya (opsional)
    // if (file_exists($file_path)) {
    //     copy($file_path, $file_path . '.bak');
    // }
    $result = file_put_contents($file_path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    return $result !== false;
}

// --- ROUTING BERDASARKAN METHOD DAN ACTION ---
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

if ($method === 'GET' || ($method === 'POST' && isset($input['action']) && $input['action'] === 'read')) {
    // --- Baca Data ---
    $data = readData($data_file);
    echo json_encode($data);
    exit;

} elseif ($method === 'POST') {
    // --- Manipulasi Data (Tambah/Edit) ---
    $action = isset($input['action']) ? $input['action'] : '';

    if (empty($action)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Action tidak didefinisikan.']);
        exit;
    }

    $data = readData($data_file); // Baca data terbaru

    switch ($action) {
        case 'add':
            $newItem = [
                'id' => uniqid('item_', true), // Buat ID unik
                'istilah' => isset($input['istilah']) ? trim($input['istilah']) : '',
                'definisi' => isset($input['definisi']) ? trim($input['definisi']) : ''
            ];

            if (empty($newItem['istilah']) || empty($newItem['definisi'])) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Istilah dan definisi tidak boleh kosong.']);
                exit;
            }

            // Cek duplikat (opsional)
            $isDuplicate = false;
            foreach ($data['pasangan'] as $existingItem) {
                if ($existingItem['istilah'] === $newItem['istilah'] && $existingItem['definisi'] === $newItem['definisi']) {
                    $isDuplicate = true;
                    break;
                }
            }
            if ($isDuplicate) {
                 http_response_code(409); // Conflict
                 echo json_encode(['success' => false, 'message' => 'Pasangan istilah dan definisi sudah ada.']);
                 exit;
            }


            $data['pasangan'][] = $newItem;

            if (writeData($data_file, $data)) {
                echo json_encode(['success' => true, 'message' => 'Item berhasil ditambahkan.', 'data' => $newItem]);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data.']);
            }
            break;

        case 'update':
            $idToUpdate = isset($input['id']) ? $input['id'] : '';
            $updatedIstilah = isset($input['istilah']) ? trim($input['istilah']) : '';
            $updatedDefinisi = isset($input['definisi']) ? trim($input['definisi']) : '';

            if (empty($idToUpdate) || empty($updatedIstilah) || empty($updatedDefinisi)) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'ID, istilah, dan definisi tidak boleh kosong untuk update.']);
                exit;
            }

            $found = false;
            foreach ($data['pasangan'] as &$item) {
                if ($item['id'] === $idToUpdate) {
                    $item['istilah'] = $updatedIstilah;
                    $item['definisi'] = $updatedDefinisi;
                    $found = true;
                    break;
                }
            }

            if ($found) {
                if (writeData($data_file, $data)) {
                    echo json_encode(['success' => true, 'message' => 'Item berhasil diperbarui.']);
                } else {
                    http_response_code(500);
                    echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data yang diperbarui.']);
                }
            } else {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Item dengan ID tersebut tidak ditemukan.']);
            }
            break;

        default:
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Action tidak dikenali.']);
            break;
    }
    exit;
} else {
    // Method tidak didukung
    http_response_code(405); // Method Not Allowed
    echo json_encode(['success' => false, 'message' => 'Method tidak diizinkan.']);
    exit;
}
?>