<?php
// php/crud_gameketiga.php

// MATIKAN SEMUA ERROR REPORTING UNTUK MENCEGAH OUTPUT YANG TIDAK DIINGINKAN
error_reporting(0);
ini_set('display_errors', 0);

// Mulai output buffering untuk menangkap semua output sebelum header
ob_start();

// Set header untuk JSON
header('Content-Type: application/json');

// Ambil input JSON
$input_raw = file_get_contents('php://input');
$input = json_decode($input_raw, true);

$action = $input['action'] ?? '';
$filePath = $input['filePath'] ?? '';

// Validasi action dan filePath (opsional, untuk keamanan)
$allowedActions = ['read', 'create', 'update', 'delete'];
$allowedFilePaths = ['../data/gameketiga_data.json']; // Tambahkan path lain jika diperlukan

if (!in_array($action, $allowedActions) || !in_array($filePath, $allowedFilePaths)) {
    echo json_encode(['success' => false, 'message' => 'Aksi atau path file tidak valid.']);
    exit; // Hentikan eksekusi
}

// Fungsi bantu
function readJsonFile($path) {
    if (!file_exists($path)) {
        return null;
    }
    $content = file_get_contents($path);
    if ($content === false) {
        return null;
    }
    $data = json_decode($content, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return null;
    }
    return $data;
}

function writeJsonFile($path, $data) {
    $jsonString = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    if ($jsonString === false) {
        return false;
    }
    return file_put_contents($path, $jsonString) !== false;
}

// Proses berdasarkan aksi
switch ($action) {
    case 'read':
        $data = readJsonFile($filePath);
        if ($data !== null) {
            // Jika file tidak ada atau kosong, buat struktur dasar
            if (!isset($data['sequences']) || !is_array($data['sequences'])) {
                 $data = ['sequences' => []];
            }
            echo json_encode(['success' => true, 'data' => $data]);
        } else {
            // Jika file tidak bisa dibaca atau rusak, kembalikan array kosong
            echo json_encode(['success' => true, 'data' => ['sequences' => []]]);
        }
        break;

    case 'create':
        $newSequence = $input['sequence'] ?? null;
        if (!$newSequence || !isset($newSequence['id']) || !isset($newSequence['title']) || !isset($newSequence['case_study']) || !isset($newSequence['questions']) || !is_array($newSequence['questions']) || count($newSequence['questions']) === 0) {
            echo json_encode(['success' => false, 'message' => 'Data urutan tidak lengkap.']);
            break;
        }

        $data = readJsonFile($filePath);
        if ($data === null) {
            $data = ['sequences' => []];
        }

        $existingIds = array_column($data['sequences'], 'id');
        if (in_array($newSequence['id'], $existingIds)) {
            echo json_encode(['success' => false, 'message' => 'ID urutan sudah ada.']);
            break;
        }

        // Validasi struktur pertanyaan
        foreach ($newSequence['questions'] as $q) {
            // Periksa struktur dasar pertanyaan
            if (!isset($q['id']) || !isset($q['question']) || !isset($q['options']) || !isset($q['correct_answer']) || !is_array($q['options']) || count($q['options']) < 2) {
                echo json_encode(['success' => false, 'message' => 'Struktur pertanyaan tidak valid (kurang elemen dasar).']);
                break 2; // Keluar dari switch
            }
            // Periksa apakah correct_answer adalah string dan sesuai dengan ID opsi
            if (!is_string($q['correct_answer']) || strlen($q['correct_answer']) !== 1) {
                 echo json_encode(['success' => false, 'message' => 'Format jawaban benar tidak valid.']);
                 break 2;
            }
            $validOptionIds = ['A', 'B', 'C', 'D'];
            if (!in_array($q['correct_answer'], $validOptionIds)) {
                 echo json_encode(['success' => false, 'message' => 'Jawaban benar harus berupa A, B, C, atau D.']);
                 break 2;
            }

            foreach ($q['options'] as $opt) {
                // Asumsikan format objek {id: "...", text: "...", consequence: "..."}
                if (!isset($opt['id']) || !isset($opt['text']) || !is_string($opt['id']) || !is_string($opt['text'])) {
                    echo json_encode(['success' => false, 'message' => 'Struktur opsi jawaban tidak valid (kurang id atau text).']);
                    break 3; // Keluar dari switch
                }
                // Validasi ID opsi
                if (!in_array($opt['id'], $validOptionIds)) {
                     echo json_encode(['success' => false, 'message' => 'ID opsi harus A, B, C, atau D.']);
                     break 3;
                }
            }
        }

        $data['sequences'][] = $newSequence;

        if (writeJsonFile($filePath, $data)) {
            echo json_encode(['success' => true, 'message' => 'Studi kasus berhasil ditambahkan.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menulis ke file.']);
        }
        break;

    case 'update':
        $sequenceId = $input['sequenceId'] ?? null;
        $updatedSequence = $input['sequence'] ?? null;

        if (!$sequenceId || !$updatedSequence || !isset($updatedSequence['id']) || !isset($updatedSequence['title']) || !isset($updatedSequence['case_study']) || !isset($updatedSequence['questions']) || !is_array($updatedSequence['questions']) || count($updatedSequence['questions']) === 0) {
            echo json_encode(['success' => false, 'message' => 'Data urutan untuk update tidak lengkap.']);
            break;
        }

        $data = readJsonFile($filePath);
        if ($data === null) {
            echo json_encode(['success' => false, 'message' => 'Gagal membaca file.']);
            break;
        }

        $found = false;
        foreach ($data['sequences'] as &$seq) {
            if ($seq['id'] === $sequenceId) {
                // Cek ID baru jika berbeda
                if ($updatedSequence['id'] !== $sequenceId) {
                    $existingIds = array_column($data['sequences'], 'id');
                    if (in_array($updatedSequence['id'], $existingIds) && $updatedSequence['id'] !== $sequenceId) {
                        echo json_encode(['success' => false, 'message' => 'ID studi kasus baru sudah digunakan.']);
                        break 2; // Keluar dari switch
                    }
                }

                // Validasi struktur pertanyaan yang diperbarui (sama seperti create)
                foreach ($updatedSequence['questions'] as $q) {
                    if (!isset($q['id']) || !isset($q['question']) || !isset($q['options']) || !isset($q['correct_answer']) || !is_array($q['options']) || count($q['options']) < 2) {
                        echo json_encode(['success' => false, 'message' => 'Struktur pertanyaan tidak valid (kurang elemen dasar).']);
                        break 2; // Keluar dari switch
                    }
                    if (!is_string($q['correct_answer']) || strlen($q['correct_answer']) !== 1) {
                         echo json_encode(['success' => false, 'message' => 'Format jawaban benar tidak valid.']);
                         break 2;
                    }
                    $validOptionIds = ['A', 'B', 'C', 'D'];
                    if (!in_array($q['correct_answer'], $validOptionIds)) {
                         echo json_encode(['success' => false, 'message' => 'Jawaban benar harus berupa A, B, C, atau D.']);
                         break 2;
                    }

                    foreach ($q['options'] as $opt) {
                        if (!isset($opt['id']) || !isset($opt['text']) || !is_string($opt['id']) || !is_string($opt['text'])) {
                            echo json_encode(['success' => false, 'message' => 'Struktur opsi jawaban tidak valid (kurang id atau text).']);
                            break 3; // Keluar dari switch
                        }
                        if (!in_array($opt['id'], $validOptionIds)) {
                             echo json_encode(['success' => false, 'message' => 'ID opsi harus A, B, C, atau D.']);
                             break 3;
                        }
                    }
                }

                $seq = $updatedSequence;
                $found = true;
                break;
            }
        }

        if (!$found) {
            echo json_encode(['success' => false, 'message' => 'Studi kasus tidak ditemukan.']);
            break;
        }

        if (writeJsonFile($filePath, $data)) {
            echo json_encode(['success' => true, 'message' => 'Studi kasus berhasil diperbarui.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menulis ke file.']);
        }
        break;

    case 'delete':
        $sequenceId = $input['sequenceId'] ?? null;
        if (!$sequenceId) {
            echo json_encode(['success' => false, 'message' => 'ID urutan tidak diberikan.']);
            break;
        }

        $data = readJsonFile($filePath);
        if ($data === null) {
            echo json_encode(['success' => false, 'message' => 'Gagal membaca file.']);
            break;
        }

        $found = false;
        foreach ($data['sequences'] as $index => $seq) {
            if ($seq['id'] === $sequenceId) {
                unset($data['sequences'][$index]);
                $found = true;
                break;
            }
        }

        if (!$found) {
            echo json_encode(['success' => false, 'message' => 'Studi kasus tidak ditemukan.']);
            break;
        }

        // Re-index array
        $data['sequences'] = array_values($data['sequences']);

        if (writeJsonFile($filePath, $data)) {
            echo json_encode(['success' => true, 'message' => 'Studi kasus berhasil dihapus.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menulis ke file.']);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Aksi tidak dikenal.']);
        break;
}

// Hapus output buffering sebelum akhir script
ob_end_flush();
?>