<?php
include '../koneksi.php';
$cekdataset = mysqli_query($conn, "SELECT * FROM dataset_dtnative");
if (mysqli_num_rows($cekdataset) > 0) {
    // Ambil jumlah cluster dari URL parameter
    // $php_cluster = $_GET['php_cluster'];

    // URL API Flask
    $api_url_kmeans = "http://backend.skripsidonnie.my.id/perbandingan-kmeans-process";

    // Ambil data dari API
    $response = file_get_contents($api_url_kmeans);

    // Periksa apakah ada masalah saat mengambil data
    if ($response === FALSE) {
        die("Gagal mengambil data dari API.");
    }

    // Decode response JSON dari API
    $response_data = json_decode($response, true);

    // Periksa apakah terdapat error dalam response
    if (isset($response_data['error'])) {
        die("Error dari API: " . $response_data['error']);
    }

    // Ambil hasil analisis dari API
    $n_clusters = $response_data['n_clusters'];
    $centroids = $response_data['centroids'];
    $confusion_matrix = $response_data['confusion_matrix'];
    $accuracy = $response_data['accuracy'];
    $silhouette_score = $response_data['silhouette_score'];
    $labels = $response_data['labels'];
    $df = $response_data['df'];
} else {
    ?>
    <script>
        alert('Dataset belum tersedia, silahkan ke kolom dataset Perbandingan!');
        window.location.href = 'dataset_perbandingan.php';
    </script>
    <?php
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil KMeans (Dataset Perbandingan)</title>
    <link rel="icon" href="../assets/foto/tbri.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <?php
    // Memeriksa apakah tombol 'Simpan history' ditekan
    if (isset($_POST['historykm'])) {

        // Mengambil data history
        $dataArray = $_POST['data'];
        $accuracy = $_POST['accuracy'];
        $keterangan = $_POST['keterangan'];
        // foreach ($dataArray as $indexkm => $datakm) {
        //     $customerkm = $datakm['customer'];
        //     $total_qtykm = $datakm['total_qty'];
        //     $total_hargakm = $datakm['total_harga'];
        //     $clusterkm = $datakm['cluster'];
        // Lokasi file asli
        $original_file_path = '../upload/scatter_plot.png';

        // Mendapatkan timestamp saat ini
        $timestamp = time();

        // Nama baru untuk file duplikat
        $new_file_name = "scatter_plot_" . $timestamp . ".png";

        // Lokasi penyimpanan file baru
        $new_file_path = '../upload/' . $new_file_name;
        $metoda = "km-dspb";
        $querycekhis = "SELECT * 
        FROM history_predict 
        WHERE metoda IN ('km', 'km-dspb') 
        ORDER BY id_history DESC 
        LIMIT 1;";
        $sqlcekhis = mysqli_query($conn, $querycekhis);
        if (mysqli_num_rows($sqlcekhis) == 0) {
            $idhis = "KM0001";
            copy($original_file_path, $new_file_path);
            $sqlhisin = "INSERT INTO history_predict (id_history, metoda, accuracy, foto, keterangan) VALUES ('$idhis', '$metoda', $accuracy, '$new_file_name', '$keterangan')";
            mysqli_query($conn, $sqlhisin);
            foreach ($dataArray as $indexkm => $datakm) {
                $customerkm = $datakm['customer'];
                $total_qtykm = $datakm['total_qty'];
                $total_hargakm = $datakm['total_harga'];
                $clusterkm = $datakm['cluster'];
                $sqlhskm = "INSERT INTO history_kmeans (hkm_customer, hkm_totalqty, hkm_totalharga, hkm_cluster, id_history) VALUES ('$customerkm', $total_qtykm, $total_hargakm, $clusterkm, '$idhis')";
                mysqli_query($conn, $sqlhskm);

            }
        } else {
            // Jika ada data, ambil ID terakhir dan tambahkan 1
            $rowhis = mysqli_fetch_assoc($sqlcekhis);
            $last_id = $rowhis['id_history']; // ID terakhir, misalnya "KM005"
            $numberhis = (int) substr($last_id, 2) + 1; // Ambil angka terakhir dan tambahkan 1
            $idhis = "KM" . str_pad($numberhis, 4, "0", STR_PAD_LEFT); // Format ke "KM###"
            copy($original_file_path, $new_file_path);

            $sqlhisin = "INSERT INTO history_predict (id_history, metoda, accuracy, foto, keterangan) VALUES ('$idhis', '$metoda', $accuracy, '$new_file_name', '$keterangan')";
            mysqli_query($conn, $sqlhisin);
            foreach ($dataArray as $indexkm => $datakm) {
                $customerkm = $datakm['customer'];
                $total_qtykm = $datakm['total_qty'];
                $total_hargakm = $datakm['total_harga'];
                $clusterkm = $datakm['cluster'];
                $sqlhskm = "INSERT INTO history_kmeans (hkm_customer, hkm_totalqty, hkm_totalharga, hkm_cluster, id_history) VALUES ('$customerkm', $total_qtykm, $total_hargakm, $clusterkm, '$idhis')";
                mysqli_query($conn, $sqlhskm);

            }
        }
        echo "<script>
                alert('Data history KMeans berhasil disimpan!');
                window.location.href = 'history.php'; // Redirect ke halaman lain setelah alert
              </script>";

    }
    ?>
    <script>
        function confirmSave(event) {
            // Tampilkan dialog konfirmasi
            var result = confirm("Apakah Anda yakin ingin menyimpan history?");
            if (result) {
                // Jika pengguna memilih "Yes", arahkan ke proses/proseshistorykm.php
                // window.location.href = 'proses/proseshistorykm.php';
            } else {
                // Jika pengguna memilih "No", cegah pengiriman form
                event.preventDefault();
                alert("Penyimpanan history dibatalkan.");
            }
        }
    </script>
</head>

<body>
    <?php
    include 'navbar.php';
    ?>
    <div class="shadow p-3 mb-5 bg-white rounded">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Hasil K-Means Clustering</h4>

                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h6>Jumlah Cluster: <?php echo $n_clusters; ?></h6>
                            <h6>Silhouette Score: <?php echo round($silhouette_score, 4); ?></h6>
                            <h6>Accuracy: <?php echo round($accuracy, 4); ?></h6>
                        </div>
                        <div class="card-header">
                            <h3>Confusion Matrix dengan label aktual dataset perbandingan</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <?php
                                           foreach ($labels as $label) {
                                            echo "<th>Predicted $label</th>"; // Gunakan label dari JSON
                                        }   
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Iterasi setiap baris pada confusion matrix
                                        foreach ($confusion_matrix as $rowIndex => $row) {
                                            echo "<tr>";
                                            // Menampilkan label actual pada setiap baris
                                            echo "<td>Actual " . $labels[$rowIndex] . "</td>"; // Pakai label dari JSON
                                            
                                            // Iterasi setiap nilai dalam confusion matrix
                                            foreach ($row as $value) {
                                                echo "<td>$value</td>";
                                            }
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3>Centroids:</h3>
                            <div class="table-responsive">
                                <table id="example" class="table table-striped data-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Cluster</th>
                                            <th>Total Qty</th>
                                            <th>Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $noclust = 1;
                                        foreach ($centroids as $index => $centroid) {
                                            echo "<tr>";
                                            echo "<td>Cluster " . ($noclust) . "</td>";
                                            echo "<td>" . round($centroid[0], 4) . "</td>";
                                            echo "<td>" . round($centroid[1], 4) . "</td>";
                                            echo "</tr>";
                                            $noclust++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <h3>Hasil Pengelompokan:</h3>
                            <div class="table-responsive">
                                <table id="example" class="table table-striped data-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>customer</th>
                                            <th>Total Qty</th>
                                            <th>Total Harga</th>
                                            <th>Cluster</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $cekdata = "SELECT * FROM dataset_kombinasipb";
                                        $cekquery = mysqli_query($conn, $cekdata);
                                        $historykm = [];
                                        // validasi data ada atau tidak
                                        if (mysqli_num_rows($cekquery) > 0) {
                                            $deldata = "DELETE FROM dataset_kombinasipb";
                                            mysqli_query($conn, $deldata);

                                            foreach ($df as $index => $datas) {
                                                $no = ($index + 1);
                                                $cus = htmlspecialchars($datas['customer']);
                                                $totqty = round($datas['total_qty'], 4);
                                                $tothar = round($datas['total_harga'], 4);
                                                $clus = $datas['Cluster'];
                                                echo "<tr>";
                                                echo "<td>" . $no . "</td>";
                                                echo "<td>" . $cus . "</td>";  // Pastikan 'customer' ada
                                                echo "<td>" . $totqty . "</td>";
                                                echo "<td>" . $tothar . "</td>";
                                                echo "<td>" . $clus . "</td>";
                                                echo "</tr>";

                                                // array history
                                                $historykm[] = [
                                                    'customer' => $cus,
                                                    'total_qty' => $totqty,
                                                    'total_harga' => $tothar,
                                                    'cluster' => $clus
                                                ];
                                                $insertquery = "INSERT INTO
                                                 dataset_kombinasipb (id_dt, customer, total_qty, total_harga, label) 
                                                 VALUES ($no, '$cus', $totqty, $tothar, $clus)";
                                                mysqli_query($conn, $insertquery);
                                            }
                                        } else {
                                            foreach ($df as $index => $datas) {
                                                $no = ($index + 1);
                                                $cus = htmlspecialchars($datas['customer']);
                                                $totqty = round($datas['total_qty'], 4);
                                                $tothar = round($datas['total_harga'], 4);
                                                $clus = $datas['Cluster'];
                                                echo "<tr>";
                                                echo "<td>" . $no . "</td>";
                                                echo "<td>" . $cus . "</td>";
                                                echo "<td>" . $totqty . "</td>";
                                                echo "<td>" . $tothar . "</td>";
                                                echo "<td>" . $clus . "</td>";
                                                echo "</tr>";

                                                // array history
                                                $historykm[] = [
                                                    'customer' => $cus,
                                                    'total_qty' => $totqty,
                                                    'total_harga' => $tothar,
                                                    'cluster' => $clus
                                                ];
                                                $insertquery = "INSERT INTO
                                                 dataset_kombinasipb (id_dt, customer, total_qty, total_harga, label) 
                                                 VALUES ($no, '$cus', $totqty, $tothar, $clus)";
                                                mysqli_query($conn, $insertquery);
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <h3>Scatter Plot:</h3>
                                <img src="<?php echo $response_data['scatter_plot_url']; ?>" alt="Scatter Plot"
                                    style="display: block; margin: 0 auto; width: 100%; max-width: 1000px;">
                            </div>
                            <!-- Form dengan event listener untuk validasi -->
                            <form action="" method="post" onsubmit="confirmSave(event)">
                                <?php
                                foreach ($historykm as $indexs => $dat) {
                                    ?>
                                    <input type="hidden" name="data[<?php echo $indexs; ?>][customer]"
                                        value="<?php echo htmlspecialchars($dat['customer']); ?>">
                                    <input type="hidden" name="data[<?php echo $indexs; ?>][total_qty]"
                                        value="<?php echo round($dat['total_qty']); ?>">
                                    <input type="hidden" name="data[<?php echo $indexs; ?>][total_harga]"
                                        value="<?php echo round($dat['total_harga']); ?>">
                                    <input type="hidden" name="data[<?php echo $indexs; ?>][cluster]"
                                        value="<?php echo $dat['cluster']; ?>">
                                    <?php
                                }
                                ;
                                ?>
                                <input type="hidden" name="accuracy" value="<?php echo round($accuracy, 4);
                                ?>">
                                <div class="form-row align-items-center ml-3">
                                    <div class="d-flex align-items-center w-100">
                                        <!-- Label -->
                                        <div class="mr-2">
                                            <label for="keterangan" class="col-form-label">Keterangan :</label>
                                        </div>
                                        <!-- Input -->
                                        <div class="flex-grow-1">
                                            <select class="form-control" id="keterangan" name="keterangan" required>
                                                <option value="">--Pilih Periode--</option>
                                                <option value="1 Bulan">1 Bulan</option>
                                                <option value="3 Bulan">3 Bulan</option>
                                                <option value="6 Bulan">6 Bulan</option>
                                                <option value="1 Tahun">1 Tahun</option>
                                            </select>
                                        </div>
                                        <!-- Tombol Submit -->
                                        <div>
                                            <input type="submit" class="btn btn-primary ml-2" id="historykm"
                                                name="historykm" value="Simpan history">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
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