<?php
include '../koneksi.php';
if (isset($_GET['testSize'])) {
    $testSize = $_GET['testSize'];
    $cekdataset = mysqli_query($conn, "SELECT * FROM dataset_kombinasipb");
    if (mysqli_num_rows($cekdataset) > 0) {
        // URL API FLASK dengan parameter waktu untuk mencegah cache
        $timestamp = time(); // Menambahkan parameter waktu (timestamp)
        $api_url_dt = "http://127.0.0.1:5000/decision-tree-kombinasi-perbandingan?testSize=$testSize&timestamp=$timestamp";

        // Ambil data dari API
        $response = file_get_contents($api_url_dt);

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
        $testSizepy = $response_data['testSize'];
        $classification_report = $response_data['classification_report'];
        $confusion_matrix = $response_data['confusion_matrix'];
        $confusion_matrixaktual = $response_data['adjusted_confusion_matrix'];
        $accuracyAktual = $response_data['adjusted_accuracy'];
        $labels = $response_data['labels'];
        $adjust_label = $response_data['adjust_labels'];
        // Decode JSON response
        $finalTest = json_decode($response_data['finalTest'], true);
        $outputData = json_decode($response_data['outputData'], true);
    } else {
        ?>
        <script>
            alert('Dataset hasil K-Means belum tersedia, silahkan ke olah data K-Means dengan dataset perbandingan!');
            window.location.href = 'kmeans.php';
        </script>
        <?php
    }
} else {
    die("Parameter testSize tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decision Tree Analysis</title>
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
        // Lokasi file asli
        $original_file_path = '../upload/tree_plot.png';

        // Mendapatkan timestamp saat ini
        $timestamp = time();

        // Nama baru untuk file duplikat
        $new_file_name = "tree_plot_" . $timestamp . ".png";

        // Lokasi penyimpanan file baru
        $new_file_path = '../upload/' . $new_file_name;
        $metoda = "dt-kbpb";
        $querycekhis = "SELECT * 
        FROM history_predict 
        WHERE metoda IN ('dt', 'dt-dskm', 'dt-kbpb') 
        ORDER BY id_history DESC 
        LIMIT 1;";
        $sqlcekhis = mysqli_query($conn, $querycekhis);
        if (mysqli_num_rows($sqlcekhis) == 0) {
            $idhis = "DT0001";
            copy($original_file_path, $new_file_path);
            $sqlhisin = "INSERT INTO history_predict (id_history, metoda, accuracy, foto, keterangan) VALUES ('$idhis', '$metoda', $accuracy, '$new_file_name', '$keterangan')";
            mysqli_query($conn, $sqlhisin);
            foreach ($dataArray as $indexkm => $datakm) {
                $customerkm = $datakm['customer'];
                $total_qtykm = $datakm['total_qty'];
                $total_hargakm = $datakm['total_harga'];
                $aktualdt = $datakm['aktual'];
                $predictdt = $datakm['predict'];
                $sqlhskm = "INSERT INTO history_decisiontree (hdt_customer, hdt_totalqty, hdt_totalharga, hdt_aktualkm, hdt_pred, id_history) VALUES ('$customerkm', $total_qtykm, $total_hargakm, $aktualdt, $predictdt, '$idhis')";
                mysqli_query($conn, $sqlhskm);

            }
        } else {
            // Jika ada data, ambil ID terakhir dan tambahkan 1
            $rowhis = mysqli_fetch_assoc($sqlcekhis);
            $last_id = $rowhis['id_history']; // ID terakhir, misalnya "DT0005"
            $numberhis = (int) substr($last_id, 2) + 1; // Ambil angka terakhir dan tambahkan 1
            $idhis = "DT" . str_pad($numberhis, 4, "0", STR_PAD_LEFT); // Format ke "KM###"
            copy($original_file_path, $new_file_path);

            $sqlhisin = "INSERT INTO history_predict (id_history, metoda, accuracy, foto, keterangan) VALUES ('$idhis', '$metoda', $accuracy, '$new_file_name', '$keterangan')";
            mysqli_query($conn, $sqlhisin);
            foreach ($dataArray as $indexkm => $datakm) {
                $customerkm = $datakm['customer'];
                $total_qtykm = $datakm['total_qty'];
                $total_hargakm = $datakm['total_harga'];
                $aktualdt = $datakm['aktual'];
                $predictdt = $datakm['predict'];
                $sqlhskm = "INSERT INTO history_decisiontree (hdt_customer, hdt_totalqty, hdt_totalharga, hdt_aktualkm, hdt_pred, id_history) VALUES ('$customerkm', $total_qtykm, $total_hargakm, $aktualdt, $predictdt, '$idhis')";
                mysqli_query($conn, $sqlhskm);

            }
        }
        echo "<script>
                alert('Data history Decision Tree berhasil disimpan!');
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
                    <div class="card-header">
                        <h2>Hasil Decision Tree (Label K-Means) | Dataset Perbandingan</h2>
                        <h5><strong>Test Size:</strong> <?php echo htmlspecialchars($testSizepy); ?></h5>
                        <h5><strong>Akurasi terhadap data perbandingan :</strong>
                            <?php echo htmlspecialchars($accuracyAktual); ?></h5>
                        <h5><strong>Akurasi terhadap label K-Means: </strong>
                            <?php echo htmlspecialchars($classification_report['accuracy']); ?></h5>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3>Confusion Matrix terhadap label data perbandingan</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <?php
                                            foreach ($adjust_label as $labelpb) {
                                                echo "<th>Predicted $labelpb</th>"; // Gunakan label dari JSON
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Iterasi setiap baris confusion matrix dengan label yang benar
                                        foreach ($confusion_matrixaktual as $rowIndex1 => $row2) {
                                            echo "<tr>";
                                            // Menampilkan label actual pada setiap baris
                                            echo "<td>Actual " . $adjust_label[$rowIndex1] . "</td>"; // Pakai label dari JSON
                                        
                                            // Iterasi setiap nilai dalam confusion matrix
                                            foreach ($row2 as $value2) {
                                                echo "<td>$value2</td>";
                                            }
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Confusion Matrix -->
                <div class="card">
                    <div class="card-header">
                        <h3>Confusion Matrix Terhadap Label K-Means</h3>
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
                                    // Iterasi setiap baris confusion matrix dengan label yang benar
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
                </div>
                <!-- Hasil prediksi  -->
                <div class="card">
                    <div class="card-header">
                        <h3>Hasil Prediksi</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped data-table" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Customer</th>
                                        <th>total qty</th>
                                        <th>total harga</th>
                                        <th>Actual Label</th>
                                        <th>Prediction Label</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $number = 1;
                                    foreach ($finalTest as $testData) {

                                        ?>
                                        <tr>
                                            <td><?php echo $number; ?></td>
                                            <td><?php echo htmlspecialchars($testData['customer']); ?></td>
                                            <td><?php echo round($testData['feature1']); ?></td>
                                            <td><?php echo round($testData['feature2']); ?></td>
                                            <td><?php echo $testData['0']; ?></td>
                                            <td><?php echo $testData['1']; ?></td>
                                        </tr>
                                        <?php
                                        $number++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Data Keseluruhan -->
                <div class="card">
                    <div class="card-header">
                        <h3>Hasil Gabungan Data Test dan Predict</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped data-table" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Customer</th>
                                        <th>total qty</th>
                                        <th>total harga</th>
                                        <th>Actual Label</th>
                                        <th>Prediction Label</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $number = 1;
                                    $historydt = [];
                                    foreach ($outputData as $data) {

                                        ?>
                                        <tr>
                                            <td><?php echo $number; ?></td>
                                            <td><?php echo htmlspecialchars($data['customer']); ?></td>
                                            <td><?php echo round($data['feature1']); ?></td>
                                            <td><?php echo round($data['feature2']); ?></td>
                                            <td><?php echo $data['0']; ?></td>
                                            <td><?php echo $data['1']; ?></td>
                                        </tr>
                                        <?php
                                        $cus = htmlspecialchars($data['customer']);
                                        $totqty = round($data['feature1']);
                                        $tothar = round($data['feature2']);
                                        $aktual = $data['0'];
                                        $predict = $data['1'];
                                        $number++;

                                        // array history
                                        $historydt[] = [
                                            'customer' => $cus,
                                            'total_qty' => $totqty,
                                            'total_harga' => $tothar,
                                            'aktual' => $aktual,
                                            'predict' => $predict
                                        ];
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3>Pohon Keputusan</h3>
                    </div>
                    <div class="card-body">
                        <img src="<?php echo $response_data['tree_plot_url']; ?>" alt="Tree Plot"
                            style="display: block; margin: 0 auto; width: 100%; max-width: 500px;">
                        <!-- Form dengan event listener untuk validasi -->
                        <form action="" method="post" onsubmit="confirmSave(event)">
                            <?php
                            foreach ($historydt as $indexs => $dat) {
                                ?>
                                <input type="hidden" name="data[<?php echo $indexs; ?>][customer]"
                                    value="<?php echo htmlspecialchars($dat['customer']); ?>">
                                <input type="hidden" name="data[<?php echo $indexs; ?>][total_qty]"
                                    value="<?php echo round($dat['total_qty']); ?>">
                                <input type="hidden" name="data[<?php echo $indexs; ?>][total_harga]"
                                    value="<?php echo round($dat['total_harga']); ?>">
                                <input type="hidden" name="data[<?php echo $indexs; ?>][aktual]"
                                    value="<?php echo $dat['aktual']; ?>">
                                <input type="hidden" name="data[<?php echo $indexs; ?>][predict]"
                                    value="<?php echo $dat['predict']; ?>">
                                <?php
                            }
                            ;
                            ?>
                            <input type="hidden" name="accuracy" value="<?php echo htmlspecialchars($accuracyAktual);
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

</html>