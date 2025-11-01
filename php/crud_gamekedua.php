<?php
// php/crud_gamekedua.php

header('Content-Type: application/json');

// Ambil input JSON
$input = json_decode(file_get_contents('php://input'), true);

// Validasi input
if (!isset($input['action']) || !isset($input['filePath'])) {
    echo json_encode(['success' => false, 'message' => 'Input tidak valid.']);
    exit;
}

$action = $input['action'];
$filePath = $input['filePath'];

// Validasi path file (opsional, untuk keamanan)
$allowedPaths = ['../data/gamekedua_data.json'];
if (!in_array($filePath, $allowedPaths)) {
    echo json_encode(['success' => false, 'message' => 'Path file tidak diizinkan.']);
    exit;
}

// Fungsi bantu
function readData($path) {
    if (!file_exists($path)) return ['sequences' => []];
    $json = file_get_contents($path);
    return json_decode($json, true) ?: ['sequences' => []];
}

function writeData($path, $data) {
    return file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) !== false;
}

// Proses berdasarkan aksi
switch ($action) {
    case 'read':
        $data = readData($filePath);
        echo json_encode(['success' => true, 'data' => $data]);
        break;

    case 'create':
        if (!isset($input['sequence'])) {
            echo json_encode(['success' => false, 'message' => 'Data urutan tidak ditemukan.']);
            break;
        }
        $newSeq = $input['sequence'];
        if (empty($newSeq['id']) || empty($newSeq['title']) || empty($newSeq['items'])) {
            echo json_encode(['success' => false, 'message' => 'Data urutan tidak lengkap.']);
            break;
        }

        $data = readData($filePath);
        $existingIds = array_column($data['sequences'], 'id');
        if (in_array($newSeq['id'], $existingIds)) {
            echo json_encode(['success' => false, 'message' => 'ID sudah digunakan.']);
            break;
        }

        $itemIds = array_column($newSeq['items'], 'id');
        if (count($itemIds) !== count(array_unique($itemIds))) {
            echo json_encode(['success' => false, 'message' => 'ID item harus unik.']);
            break;
        }

        $newSeq['correctOrder'] = $itemIds;
        $data['sequences'][] = $newSeq;

        if (writeData($filePath, $data)) {
            echo json_encode(['success' => true, 'message' => 'Berhasil disimpan.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menulis file.']);
        }
        break;

    case 'update':
        if (!isset($input['sequenceId']) || !isset($input['sequence'])) {
            echo json_encode(['success' => false, 'message' => 'Data urutan tidak ditemukan.']);
            break;
        }
        $id = $input['sequenceId'];
        $updatedSeq = $input['sequence'];
        if (empty($updatedSeq['id']) || empty($updatedSeq['title']) || empty($updatedSeq['items'])) {
            echo json_encode(['success' => false, 'message' => 'Data urutan tidak lengkap.']);
            break;
        }

        $data = readData($filePath);
        $found = false;
        foreach ($data['sequences'] as &$seq) {
            if ($seq['id'] === $id) {
                $existingIds = array_column($data['sequences'], 'id');
                if ($updatedSeq['id'] !== $id && in_array($updatedSeq['id'], $existingIds)) {
                     echo json_encode(['success' => false, 'message' => 'ID baru sudah digunakan.']);
                     break 2; // Keluar dari switch
                }
                $itemIds = array_column($updatedSeq['items'], 'id');
                if (count($itemIds) !== count(array_unique($itemIds))) {
                    echo json_encode(['success' => false, 'message' => 'ID item harus unik.']);
                    break 2;
                }
                $seq = $updatedSeq;
                $seq['correctOrder'] = $itemIds;
                $found = true;
                break;
            }
        }

        if (!$found) {
            echo json_encode(['success' => false, 'message' => 'Urutan tidak ditemukan.']);
            break;
        }

        if (writeData($filePath, $data)) {
            echo json_encode(['success' => true, 'message' => 'Berhasil diperbarui.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menulis file.']);
        }
        break;

    case 'delete':
        if (!isset($input['sequenceId'])) {
            echo json_encode(['success' => false, 'message' => 'ID urutan tidak ditemukan.']);
            break;
        }
        $id = $input['sequenceId'];

        $data = readData($filePath);
        $initialCount = count($data['sequences']);
        $data['sequences'] = array_filter($data['sequences'], function($seq) use ($id) { return $seq['id'] !== $id; });
        $data['sequences'] = array_values($data['sequences']); // Re-index

        if (count($data['sequences']) === $initialCount) {
            echo json_encode(['success' => false, 'message' => 'Urutan tidak ditemukan.']);
            break;
        }

        if (writeData($filePath, $data)) {
            echo json_encode(['success' => true, 'message' => 'Berhasil dihapus.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menulis file.']);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Aksi tidak dikenal.']);
        break;
}
?>