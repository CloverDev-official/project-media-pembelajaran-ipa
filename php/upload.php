<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// folder penyimpanan relatif terhadap project root
$uploadFolder = "img/";  
$targetDir = $_SERVER['DOCUMENT_ROOT'] . "/" . $uploadFolder;

// bikin folder kalau belum ada
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

if (isset($_FILES['file']['name'])) {
    // rapikan nama file (hapus spasi dan karakter aneh)
    $fileName = time() . "_" . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', basename($_FILES['file']['name']));
    $targetFile = $targetDir . $fileName;

    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (!in_array($fileType, $allowedTypes)) {
        http_response_code(400);
        echo json_encode(['error' => 'Format tidak diizinkan']);
        exit;
    }

    if ($_FILES['file']['size'] > 5 * 1024 * 1024) {
        http_response_code(400);
        echo json_encode(['error' => 'Maksimal 5MB']);
        exit;
    }

    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
        // buat base URL otomatis
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' 
                    || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $host = $_SERVER['HTTP_HOST'];

        // path relatif dari root project
        $fileUrl = $protocol . $host . "/" . $uploadFolder . $fileName;

        echo json_encode([
            'location' => $fileUrl
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Upload gagal']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Tidak ada file']);
}
