<?php
require '../assets/vendor/autoload.php';
include '../koneksi.php';

if (isset($_POST['uploadxls'])) {
    $err = "";
    $success = "";

    if (!isset($_FILES['inputxls']) || $_FILES['inputxls']['error'] != UPLOAD_ERR_OK) {
        $err .= "<li>Silakan unggah file Excel yang valid.</li>";
    } else {
        $file_name = $_FILES['inputxls']['name']; // Nama file
        $file_data = $_FILES['inputxls']['tmp_name']; // File temp
        $ekstensi = pathinfo($file_name, PATHINFO_EXTENSION); // Ekstensi file
        $file_size = $_FILES['inputxls']['size']; // Ukuran file dalam byte

        // Validasi ukuran file (misalnya, maksimum 2 MB)
        $max_size = 2 * 1024 * 1024; // 2 MB
        if ($file_size > $max_size) {
            $err .= "<li>Ukuran file terlalu besar. Maksimal ukuran file adalah 2 MB.</li>";
        }

        // Validasi ekstensi file
        $ekstensi_allowed = array("xlsx");
        if (!in_array($ekstensi, $ekstensi_allowed)) {
            $err .= "<li>Silakan unggah file dengan ekstensi <b>xlsx</b>. File yang diunggah: <b>$file_name</b> (Tipe: <b>$ekstensi</b>).</li>";
        }

        // Jika ada error, hentikan eksekusi dan tampilkan error
        if (!empty($err)) {
            echo "<div class='alert alert-danger'><ul>$err</ul></div>";
            return;
        }

        try {
            // Menghitung penggunaan memori sebelum memulai pembacaan file
            $initialMemory = memory_get_usage();

            // Coba membaca file menggunakan PhpSpreadsheet
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
            $spreadsheet = $reader->load($file_data);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            // Periksa apakah terjadi kehabisan memori setelah memuat file
            $finalMemory = memory_get_usage();
            $memoryUsed = $finalMemory - $initialMemory;

            // Batasi memori yang digunakan
            $maxMemoryUsage = 100 * 1024 * 1024; // Misalnya, 100 MB
            if ($memoryUsed > $maxMemoryUsage) {
                throw new Exception("Penggunaan memori terlalu besar. Silakan unggah file yang lebih kecil.");
            }

            // Validasi apakah file memiliki data
            if (count($sheetData) <= 1) { // Hanya header atau kosong
                $err .= "<li>File Excel tidak memiliki data atau hanya berisi header.</li>";
            }
        } catch (Exception $e) {
            $err .= "<li>Gagal membaca file Excel: " . htmlspecialchars($e->getMessage()) . "</li>";
        }
    }

    // Proses insert hanya jika tidak ada error
    if (empty($err)) {
        $jumlahData = 0;
        for ($i = 1; $i < count($sheetData); $i++) {
            $id_dt = $sheetData[$i][0] ?? "";
            $kode_customer = $sheetData[$i][1] ?? "";
            $customer = $sheetData[$i][2] ?? "";
            $total_qty = $sheetData[$i][3] ?? "";
            $total_harga = $sheetData[$i][4] ?? "";
            $label = $sheetData[$i][5] ?? "";
            // Validasi format kode_customer (harus seperti "CUS000") 
            if (!preg_match('/^CUST\d{3}$/', $kode_customer)) {
                $err .= "<li>Format kode_customer tidak valid pada baris ke-" . ($i + 1) . ". Format harus CUST000.</li>";
            } else {
                // Pastikan semua kolom memiliki data yang valid
                if ($id_dt && $kode_customer && $total_qty && $total_harga && $customer) {
                    $sqlinsertdata = "INSERT INTO dataset_dtnative(
                    id_dt, kode_customer, customer, total_qty, total_harga, label
                ) VALUES (
                    '$id_dt', '$kode_customer', '$customer', '$total_qty', '$total_harga', '$label'
                )";
                    mysqli_query($conn, $sqlinsertdata);
                    $jumlahData++;
                } else {
                    // $err .= "<li>Baris ke-" . ($i + 1) . " tidak memiliki data lengkap dan dilewati.</li>";
                }
            }



        }

        if ($jumlahData > 0) {
            $success = "$jumlahData data berhasil dimasukkan ke database!";
        } else {
            $err .= "<li>Semua data gagal dimasukkan ke database karena atributenya tidak sesuai dan ada data yang kosong.</li>";
        }
    }

    // Tampilkan pesan error atau sukses
    if ($err) {
        echo "<div class='alert alert-danger'><ul>$err</ul></div>";
    }
    if ($success) {
        echo "<div class='alert alert-success'><ul>$success</ul></div>";
    }
}

if (isset($_POST['deleteds'])) {
    $sqldelete = mysqli_query($conn, "DELETE FROM dataset_dtnative");
    ?>
    <script>
        alert("Dataset berhasil terhapus")
    </script>
    <?php
}

?>