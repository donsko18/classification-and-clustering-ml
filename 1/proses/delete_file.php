<?php
if (isset($_GET['url'])) {
    $file_path = $_GET['url'];

    // Konversi URL ke path lokal
    $file_path_local = str_replace("https://skripsidonnie.my.id/upload/", "../upload/", $file_path);

    // Periksa apakah file ada dan hapus
    if (file_exists($file_path_local)) {
        unlink($file_path_local);
        echo json_encode(["success" => true, "message" => "File deleted"]);
    } else {
        echo json_encode(["success" => false, "message" => "File not found"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "No file URL provided"]);
}
