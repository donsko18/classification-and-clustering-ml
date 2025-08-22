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
    if ($data['metoda'] == "km") {
        $valuemetoda = "K-Means";
        $namasql = "history_kmeans";
        $label = "hkm_cluster";
        $customer = "hkm_customer";
        $totqty = "hkm_totalqty";
        $tothar = "hkm_totalharga";
        $labelakurasi = "Sillouhette score : ";
        if ($data['accuracy'] > 0.75) {
            $akurasiHasil = $data['accuracy'] . " (Pengelompokan sangat baik)";
        } elseif ($data['accuracy'] >= 0.5) {
            $akurasiHasil = $data['accuracy'] . " (Pengelompokan baik)";
        } elseif ($data['accuracy'] >= 0.25) {
            $akurasiHasil = $data['accuracy'] . " (Pengelompokan buruk)";
        } else {
            $akurasiHasil = $data['accuracy'] . " (Pengelompokan sangat buruk)";
        }
    } elseif ($data['metoda'] == "dt-dskm") {
        $valuemetoda = "Decision Tree - label K-Means";
        $namasql = "history_decisiontree";
        $label = "hdt_pred";
        $customer = "hdt_customer";
        $totqty = "hdt_totalqty";
        $tothar = "hdt_totalharga";
        $labelakurasi = "Accuracy : ";
        $akurasi = $data['accuracy'] * 100;
        $akurasiHasil = $akurasi . "%";
    } elseif ($data['metoda'] == "km-dspb") {
        $valuemetoda = "K-Means (Perbandingan)";
        $namasql = "history_kmeans";
        $label = "hkm_cluster";
        $customer = "hkm_customer";
        $totqty = "hkm_totalqty";
        $tothar = "hkm_totalharga";
        $labelakurasi = "Accuracy : ";
        $akurasi = $data['accuracy'] * 100;
        $akurasiHasil = $akurasi . "%";
    } elseif ($data['metoda'] == "dt") {
        $valuemetoda = "Decision Tree (Perbandingan)";
        $namasql = "history_decisiontree";
        $label = "hdt_pred";
        $customer = "hdt_customer";
        $totqty = "hdt_totalqty";
        $tothar = "hdt_totalharga";
        $labelakurasi = "Accuracy : ";
        $akurasi = $data['accuracy'] * 100;
        $akurasiHasil = $akurasi . "%";
    } else {
        $valuemetoda = "Decision Tree - Label K-Means (Perbandingan)";
        $namasql = "history_decisiontree";
        $label = "hdt_pred";
        $customer = "hdt_customer";
        $totqty = "hdt_totalqty";
        $tothar = "hdt_totalharga";
        $labelakurasi = "Accuracy : ";
        $akurasi = $data['accuracy'] * 100;
        $akurasiHasil = $akurasi . "%";
    }
    $detailQuery = "SELECT * FROM $namasql WHERE id_history='$idhistory'";
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
    $pdf->Cell(50, 10, $valuemetoda, 0, 1);
    $pdf->Cell(40, 10, $labelakurasi);
    $pdf->Cell(50, 10, $akurasiHasil, 0, 1);
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
        if ($row[$label] == 1) {
            $tier = "Loyal";
        } elseif ($row[$label] == 2) {
            $tier = "Semi-Loyal";
        } else {
            $tier = "Non-Loyal";
        }
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