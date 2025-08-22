<?php
include '../koneksi.php';
if (isset($_POST['uploadcsv'])) {
    if (isset($_FILES['inputcsv'])) {
        if ($_FILES['inputcsv']['error'] !== UPLOAD_ERR_OK) {
            echo "Error dengan kode: " . $_FILES['inputcsv']['error'];
        } else {
            // Tentukan folder tujuan untuk menyimpan file
            $targetDirectory = "../upload/";

            // Tentukan nama file dan lokasi penyimpanan
            $fileName = basename($_FILES['inputcsv']['name']);
            $targetFilePath = $targetDirectory . $fileName;

            // Pindahkan file yang diunggah ke folder tujuan
            if (move_uploaded_file($_FILES['inputcsv']['tmp_name'], $targetFilePath)) {
                ?>
                <script>
                    alert("File CSV berhasil diupload ke folder <?= $targetDirectory ?>.");
                    window.location.href = 'kmeans.php';
                </script>
                <?php
            } else {
                echo "Gagal memindahkan file ke folder $targetDirectory.";
            }
        }
    } else {
        echo "Tidak ada file yang diunggah.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-Means Clustering</title>
    <link rel="icon" href="../assets/foto/tbri.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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
                        <h4>K-Means Clustering</h4>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <!-- <span><i class="bi bi-table me-2"></i></span> Input dataset untuk memulai mengolah data!
                            <form method="post" enctype="multipart/form-data">
                                <label for="inputcsv" style="margin-right: 10px;">Upload Dataset :</label>
                                <input type="file" class="form-control-sm me-2 w-40" id="inputcsv" name="inputcsv"
                                    aria-describedby="uploadcsv" aria-label="Upload" required>
                                <button class="btn btn-primary" type="submit" id="uploadcsv" name="uploadcsv"><i
                                        class="bi bi-upload"></i>
                                    Upload</button>
                            </form> -->
                            <div class="form-group">
                                <!-- Label dan Select Dataset -->
                                <label for="selectBox1" class="col-form-label font-weight-bold">Pilih Dataset:</label>
                                <div class="input-group" style="max-width: 300px;">
                                    <select id="selectBox1" class="form-control form-control-sm">
                                        <option value="">-- Pilih --</option>
                                        <option value="process_kmeans.php">Dataset K-Means</option>
                                        <option value="perbandingan_process_kmeans.php">(Perbandingan) Dataset K-Means
                                        </option>
                                    </select>
                                    <div class="input-group-append">
                                        <button id="submitButton" class="btn btn-sm btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>

                            <script>
                                document.getElementById('submitButton').onclick = function () {
                                    // Ambil nilai dari setiap select box
                                    const select1 = document.getElementById('selectBox1').value;

                                    // Tentukan route berdasarkan nilai yang dipilih
                                    let route = '';

                                    if (select1) {
                                        route = select1;
                                    } else {
                                        alert('Silakan pilih salah satu opsi!');
                                        return;
                                    }

                                    // Arahkan ke route yang dipilih
                                    window.location.href = route;
                                };
                            </script>
                            <?php
                            // $qcek = "SELECT * FROM dataset_km";
                            // $sqlcek = mysqli_query($conn, $qcek);
                            // $button = "";
                            // $text = "";
                            // if (mysqli_num_rows($sqlcek) > 0) {
                            //     $button = "enabled";
                            //     $text = "<p>Lanjut mencari cluster yang terbaik menggunakan Elbow Method</p>";
                            // } else {
                            //     $button = "hidden";
                            //     $text = '<p style="color: red; font-weight: bold;">
                            //                             Dataset tidak tersedia, silahkan export data terlebih dahulu
                            //                             <a href="dataset_km.php">export data</a>
                            //                         </p>';
                            // }
                            // echo $text;
                            // ?>

                            <!-- <button onclick="window.location.href='plot.php'" class="btn btn-primary" <?php echo $button ?>>Elbow plot</button> -->
                            <?php
                            ?>
                        </div>
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