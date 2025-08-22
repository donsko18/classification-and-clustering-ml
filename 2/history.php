<!doctype html>
<html lang="en">
<?php
include '../koneksi.php';
// Pagination
$per_page = 3;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $per_page;

// Hitung total data
$total_query = "SELECT COUNT(*) AS total FROM history_predict";
$total_result = mysqli_query($GLOBALS['conn'], $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_data = $total_row['total'];
$total_pages = ceil($total_data / $per_page);

// Fetch data untuk halaman ini
$query = "SELECT * FROM history_predict ORDER BY tgl_pred DESC LIMIT $start, $per_page";
$sql = mysqli_query($GLOBALS['conn'], $query);
$modal = 1;
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>History</title>
    <link rel="icon" href="../assets/foto/tbri.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <style>
        /* Card */
        .card {
            border-radius: 12px;
        }

        .border-thick {
            border-width: 5px !important;
        }
    </style>
    <script>
        function cetakLaporan(idhistory) {
            // Buat URL untuk cetak laporan, sesuaikan endpoint cetak Anda
            let cetakUrl = `cetak_laporan.php?id_history=${idhistory}`;

            // Buka di tab baru untuk mencetak
            window.open(cetakUrl, '_blank');
        }
    </script>
</head>

<body>
    <!-- Awal Navbar -->
    <?php include 'navbar.php'; ?>
    <!-- Akhir Navbar -->
    <br>
    <!-- Awal Content -->

    <div class="shadow p-3 mb-5 bg-white rounded">
        <div class="container">
            <h2>History Prediksi</h2>
            <br>
            <div class="row">
                <?php
                $datacek = mysqli_query($conn, "SELECT * FROM history_predict");
                if (mysqli_num_rows($datacek) == 0) {
                    ?>
                    <div class="col-12 mb-3"> <!-- Full-width cards -->
                        <div class="card border-thick border-danger">
                            <div class="card-header">
                                <h6 class="card-title"></h6>
                            </div>
                            <div class="card-body d-flex justify-content-center align-items-center" style="height: 150px;">
                                <h5>Data History belum tersedia, beritahu staff operational untuk mengolah data!</h5>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    $query = "SELECT * FROM history_predict ORDER BY tgl_pred DESC LIMIT $start, $per_page";
                    $sql = mysqli_query($GLOBALS['conn'], $query);
                    $modal = 1;

                    while ($data = mysqli_fetch_array($sql)) {
                        if ($data['metoda'] == "km") {
                            $valuemetoda = "K-Means";
                            $namasql = "history_kmeans";
                            $label = "hkm_cluster";
                            $customer = "hkm_customer";
                            $totqty = "hkm_totalqty";
                            $tothar = "hkm_totalharga";
                            $warna = "success";
                            $plot = "Scatter Plot";
                            $labelakurasi = "Sillouhette score";
                            $keterangan = "";
                        } elseif ($data['metoda'] == "dt-dskm") {
                            $valuemetoda = "Decision Tree - label K-Means";
                            $namasql = "history_decisiontree";
                            $label = "hdt_pred";
                            $customer = "hdt_customer";
                            $totqty = "hdt_totalqty";
                            $tothar = "hdt_totalharga";
                            $warna = "primary";
                            $plot = "Pohon Keputusan";
                            $labelakurasi = "Accuracy";
                            $keterangan = "<br>
                                            <h4>Keterangan</h4>
                                            <h6>x[0] merupakan Kolom Total Kuantity</h6>
                                            <h6>x[1] merupakan Kolom Total Harga</h6>
                                            <h6>(<) adalah Lebih kecil</h6>
                                            <h6>(>) adalah Lebih Besar</h6>
                                            <h6>Gini merupakan suatu metrik yang digunakan untuk mengukur ketidakmurnian suatu Node (Yang berbentuk Kotak Bercabang) Semakin kecil nilai Gini semakin murni Nodenya</h6>
                                            <h6>Samples disini merupakan jumlah data yang berada pada suatu Node</h6>
                                            <h6>Value disini berurut, contoh Value=[2,4,15] yang mana [Loyal (1) = 2, Semi-Loyal (2) =4, dan Non-Loyal (3) = 15]</h6>";
                        } elseif ($data['metoda'] == "km-dspb") {
                            $valuemetoda = "K-Means (Perbandingan)";
                            $namasql = "history_kmeans";
                            $label = "hkm_cluster";
                            $customer = "hkm_customer";
                            $totqty = "hkm_totalqty";
                            $tothar = "hkm_totalharga";
                            $warna = "danger";
                            $plot = "Scatter Plot";
                            $labelakurasi = "Accuracy";
                            $keterangan = "";
                        } elseif ($data['metoda'] == "dt") {
                            $valuemetoda = "Decision Tree (Perbandingan)";
                            $namasql = "history_decisiontree";
                            $label = "hdt_pred";
                            $customer = "hdt_customer";
                            $totqty = "hdt_totalqty";
                            $tothar = "hdt_totalharga";
                            $warna = "danger";
                            $plot = "Pohon Keputusan";
                            $labelakurasi = "Accuracy";
                            $keterangan = "<br>
                                            <h4>Keterangan</h4>
                                            <h6>x[0] merupakan Kolom Total Kuantity</h6>
                                            <h6>x[1] merupakan Kolom Total Harga</h6>
                                            <h6>(<) adalah Lebih kecil</h6>
                                            <h6>(>) adalah Lebih Besar</h6>
                                            <h6>Gini merupakan suatu metrik yang digunakan untuk mengukur ketidakmurnian suatu Node (Yang berbentuk Kotak Bercabang) Semakin kecil nilai Gini semakin murni Nodenya</h6>
                                            <h6>Samples disini merupakan jumlah data yang berada pada suatu Node</h6>
                                            <h6>Value disini berurut, contoh Value=[2,4,15] yang mana [Loyal (1) = 2, Semi-Loyal (2) =4, dan Non-Loyal (3) = 15]</h6>";
                        } else {
                            $valuemetoda = "Decision Tree - Label K-Means (Perbandingan)";
                            $namasql = "history_decisiontree";
                            $label = "hdt_pred";
                            $customer = "hdt_customer";
                            $totqty = "hdt_totalqty";
                            $tothar = "hdt_totalharga";
                            $warna = "danger";
                            $plot = "Pohon Keputusan";
                            $labelakurasi = "Accuracy";
                            $keterangan = "<br>
                                            <h4>Keterangan</h4>
                                            <h6>x[0] merupakan Kolom Total Kuantity</h6>
                                            <h6>x[1] merupakan Kolom Total Harga</h6>
                                            <h6>(<) adalah Lebih kecil</h6>
                                            <h6>(>) adalah Lebih Besar</h6>
                                            <h6>Gini merupakan suatu metrik yang digunakan untuk mengukur ketidakmurnian suatu Node (Yang berbentuk Kotak Bercabang) Semakin kecil nilai Gini semakin murni Nodenya</h6>
                                            <h6>Samples disini merupakan jumlah data yang berada pada suatu Node</h6>
                                            <h6>Value disini berurut, contoh Value=[2,4,15] yang mana [Loyal (1) = 2, Semi-Loyal (2) =4, dan Non-Loyal (3) = 15]</h6>";
                        }

                        $foto = $data['foto'];
                        $tgl = $data['tgl_pred'];
                        $idhistory = $data['id_history'];
                        ?>
                        <!-- Set each card to full width -->
                        <div class="col-12 mb-3"> <!-- Full-width cards -->
                            <div class="card border-thick border-<?php echo $warna ?>">
                                <div class="card-header">
                                    <h6 class="card-title"><?php echo $idhistory; ?> | Tanggal : <?php echo $tgl ?>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Algoritma : <?php echo $valuemetoda; ?></p>
                                    <?php
                                    if ($data['metoda'] == "km") {
                                        if ($data['accuracy'] > 0.75) {
                                            $akurasiHasil = $data['accuracy'] . " (Pengelompokan sangat baik)";
                                        } elseif ($data['accuracy'] >= 0.5) {
                                            $akurasiHasil = $data['accuracy'] . " (Pengelompokan baik)";
                                        } elseif ($data['accuracy'] >= 0.25) {
                                            $akurasiHasil = $data['accuracy'] . " (Pengelompokan buruk)";
                                        } else {
                                            $akurasiHasil = $data['accuracy'] . " (Pengelompokan sangat buruk)";
                                        }
                                    } else {
                                        $akurasi = $data['accuracy'] * 100;
                                        $akurasiHasil = $akurasi . "%";
                                    }
                                    ?>
                                    <p class="card-text"><?php echo $labelakurasi ?> : <?php echo $akurasiHasil; ?>
                                    </p>
                                    <p class="card-text">Periode : <?php echo $data['keterangan']; ?></p>
                                    <button type="button" class="btn btn-outline-<?php echo $warna ?> bi bi-eye"
                                        data-toggle="modal" data-target="#detailModal<?php echo $modal; ?>"> Detail</button>
                                    <!-- Tombol Cetak Laporan -->
                                    <button type="button" class="btn btn-outline-info bi bi-printer"
                                        onclick="cetakLaporan('<?php echo $idhistory; ?>')"> Cetak Laporan</button>
                                </div>
                            </div>
                        </div>
                        <!-- Modal View-->
                        <div class="modal fade" id="detailModal<?php echo $modal ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Data hasil prediksi <?php echo $valuemetoda; ?> |
                                            <?php echo $idhistory ?>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped data-table" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Customer</th>
                                                        <th>Total Qty</th>
                                                        <th>Total Harga</th>
                                                        <th>Label</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $nomodal = 1;
                                                    $sqlhistory = mysqli_query($GLOBALS['conn'], "SELECT * FROM $namasql WHERE id_history='$idhistory'");
                                                    while ($datahis = mysqli_fetch_array($sqlhistory)) {
                                                        if ($datahis[$label] == 1) {
                                                            $textLabel = "Loyal";
                                                        } elseif ($datahis[$label] == 2) {
                                                            $textLabel = "Semi-Loyal";
                                                        } else {
                                                            $textLabel = "Non-Loyal";
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $nomodal; ?></td>
                                                            <td><?php echo $datahis[$customer]; ?></td>
                                                            <td><?php echo $datahis[$totqty]; ?></td>
                                                            <td><?php echo $datahis[$tothar]; ?></td>
                                                            <td><?php echo $textLabel; ?></td>
                                                        </tr>
                                                        <?php
                                                        $nomodal++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                        <div class="modal-header">
                                            <h5><?php echo $plot; ?></h5>
                                        </div>
                                        <img src="../upload/<?php echo $foto ?>" alt="<?php echo $plot ?>"
                                            style="display: block; margin: 0 auto; width: 100%; max-width: 1000px;">
                                            <?php
                                            echo $keterangan;
                                            ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir modal view -->
                        <?php
                        $modal++;
                    }
                }
                ?>
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php if ($page <= 1)
                        echo 'disabled'; ?>">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>" tabindex="-1">Previous</a>
                    </li>
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php if ($i == $page)
                            echo 'active'; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?php if ($page >= $total_pages)
                        echo 'disabled'; ?>">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
    <script src="../assets/js/jquery-3.5.1.js"></script>
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap5.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>