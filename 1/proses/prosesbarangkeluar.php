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
            $id_out = $sheetData[$i][0] ?? "";
            $tanggal_out = $sheetData[$i][1] ?? "";
            $nomor_po = $sheetData[$i][2] ?? "";
            $kode_barang = $sheetData[$i][3] ?? "";
            $nama_barang = $sheetData[$i][4] ?? "";
            $merek = $sheetData[$i][5] ?? "";
            $ukuran = $sheetData[$i][6] ?? "";
            $harga = $sheetData[$i][7] ?? "";
            $qty_keluar = $sheetData[$i][8] ?? "";
            $total_harga = $sheetData[$i][9] ?? "";
            $kode_customer = $sheetData[$i][10] ?? "";
            $customer = $sheetData[$i][11] ?? "";

            // Validasi format tanggal (DD/MM/YYYY ke YYYY-MM-DD)
            $tanggal_out_explode = explode("/", $tanggal_out);
            if (count($tanggal_out_explode) == 3) {
                $tanggal_out = $tanggal_out_explode[2] . "-" . $tanggal_out_explode[1] . "-" . $tanggal_out_explode[0];
            } else {
                $tanggal_out = null;
            }

            // Pastikan semua kolom memiliki data yang valid
            if ($id_out && $tanggal_out && $nomor_po && $kode_barang && $nama_barang) {
                $sqlinsertdata = "INSERT INTO tbl_bout(
                    id_out, tanggal_out, nomor_po, kode_barang, nama_barang, merek, ukuran, harga, qty_keluar, total_harga, kode_customer, customer
                ) VALUES (
                    '$id_out', '$tanggal_out', '$nomor_po', '$kode_barang', '$nama_barang', '$merek', '$ukuran', '$harga', '$qty_keluar', '$total_harga', '$kode_customer', '$customer'
                )";
                mysqli_query($conn, $sqlinsertdata);
                $jumlahData++;
            } else {
                // $err .= "<li>Baris ke-" . ($i + 1) . " tidak memiliki data lengkap dan dilewati.</li>";
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
    $sqldelete = mysqli_query($conn, "DELETE FROM tbl_bout");
    ?>
    <script>
        alert("Dataset berhasil terhapus")
    </script>
    <?php
}

?>