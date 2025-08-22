<?php
include '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dataset Perbandingan</title>
    <link rel="icon" href="../assets/foto/tbri.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
        function confirmSave(event) {
            // Tampilkan dialog konfirmasi
            var result = confirm("Apakah Anda yakin untuk menghapus dataset?");
            if (result) {
                // Jika pengguna memilih "Yes", arahkan ke proses/proseshistorykm.php
                // window.location.href = 'proses/proseshistorykm.php';
            } else {
                // Jika pengguna memilih "No", cegah pengiriman form
                event.preventDefault();
                alert("Hapus dataset dibatalkan.");
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
                        <h4>Dataset Perbandingan</h4>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <?php include 'proses/prosesdsperbandingan.php'; ?>
                            <div class="input-group">
                                <form method="post" enctype="multipart/form-data">
                                    <input type="file" class="form-control-sm me-2 w-40" id="inputxls" name="inputxls"
                                        aria-describedby="uploadxls" aria-label="Upload" required>
                                    <button class="btn btn-primary" type="submit" id="uploadxls" name="uploadxls"><i
                                            class="bi bi-upload"></i>
                                        Upload File XLSX</button>
                                </form>
                                <form action="" method="post" onsubmit="confirmSave(event)">
                                    <button class="btn btn-danger" type="submit" id="deleteds" name="deleteds"><i
                                            class="bi bi-trash"></i> Hapus
                                        Dataset</button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped data-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Customer</th>
                                            <th>Customer</th>
                                            <th>Total Qty</th>
                                            <th>Total Harga</th>
                                            <th>Label</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM dataset_dtnative";
                                        $sql = mysqli_query($GLOBALS['conn'], $query);
                                        if (mysqli_num_rows($sql) > 0) {
                                            while ($data = mysqli_fetch_array($sql)) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        echo $data['id_dt'];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $data['kode_customer'];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $data['customer'];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $data['total_qty'];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $data['total_harga'];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $data['label'];
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6">
                                                    <p style="color: red; font-weight: bold;">
                                                        Dataset tidak tersedia, Silahkan upload file excel terlebih dahulu
                                                    </p>
                                                </td>
                                            </tr>
                                            <?php

                                        }
                                        ?>
                                    </tbody>
                                </table>
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