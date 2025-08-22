<?php
require('../assets/fpdf/fpdf.php'); // Pastikan path ke library FPDF benar
include '../koneksi.php'; // Pastikan file koneksi ada

// Ambil idhistory dari parameter URL
$idhistory = isset($_GET['id_history']) ? $_GET['id_history'] : null;

if ($idhistory) {
    // Ambil data utama berdasarkan idhistory
    $query = "SELECT * FROM history_predict WHERE id_history = '$idhistory'";
    $result = mysqli_query($GLOBALS['conn'], $query);
    $data = mysqli_fetch_assoc($result);

    // Ambil data detail berdasarkan idhistory
    $namasql = ($data['metoda'] == "km") ? "history_kmeans" : "history_decisiontree";
    $label = ($data['metoda'] == "km") ? "hkm_cluster" : "hdt_pred";
    $customer = ($data['metoda'] == "km") ? "hkm_customer" : "hdt_customer";
    $totqty = ($data['metoda'] == "km") ? "hkm_totalqty" : "hdt_totalqty";
    $tothar = ($data['metoda'] == "km") ? "hkm_totalharga" : "hdt_totalharga";
    $detailQuery = "SELECT * FROM $namasql WHERE id_history='$idhistory' ORDER BY $label ASC";
    $details = mysqli_query($GLOBALS['conn'], $detailQuery);

    // Buat PDF menggunakan FPDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // Header
    $pdf->Cell(0, 10, 'Laporan Prediksi - ID: ' . $idhistory, 0, 1, 'C');
    $pdf->Ln(10);

    // Info Utama
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(40, 10, 'Tanggal Prediksi :');
    $pdf->Cell(50, 10, $data['tgl_pred'], 0, 1);
    $pdf->Cell(40, 10, 'Algoritma :');
    $pdf->Cell(50, 10, ($data['metoda'] == "km") ? "K-Means" : "Decision Tree", 0, 1);
    $pdf->Cell(40, 10, 'Accuracy :');
    $pdf->Cell(50, 10, $data['accuracy'], 0, 1);
    $pdf->Cell(40, 10, 'Periode :');
    $pdf->Cell(50, 10, $data['keterangan'], 0, 1);
    $pdf->Ln(10);

    // Tabel Data Detail
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(10, 10, 'No', 1);
    $pdf->Cell(60, 10, 'Customer', 1);
    $pdf->Cell(30, 10, 'Total Qty', 1);
    $pdf->Cell(40, 10, 'Total Harga', 1);
    $pdf->Cell(40, 10, 'Predikat', 1);
    $pdf->Ln();

    $pdf->SetFont('Arial', '', 12);
    $no = 1;
    while ($row = mysqli_fetch_assoc($details)) {
        $tier = $row[$label] + 1;
        $pdf->Cell(10, 10, $no++, 1);
        $pdf->Cell(60, 10, $row[$customer], 1);
        $pdf->Cell(30, 10, $row[$totqty], 1);
        $pdf->Cell(40, 10, $row[$tothar], 1);
        $pdf->Cell(40, 10, $tier, 1);
        $pdf->Ln();
    }

    // Output PDF
    $pdf->Output('I', 'Laporan_Tier_customer_' . $idhistory . '.pdf');
} else {
    echo "<script>
                alert('ID history tidak ada!');
                window.location.href = 'index.php'; // Redirect ke halaman lain setelah alert
              </script>";
}
?>