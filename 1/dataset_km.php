<?php
include '../koneksi.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dataset K-Means</title>
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
                        <h4>Dataset K-Means</h4>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <form action="proses/prosesformkm.php" post="GET">
                                <div class="form-row align-items-center">
                                    <!-- Label -->
                                    <div class="col-auto">
                                        <label for="sortData" class="col-form-label">Export dataset untuk
                                            K-Means:</label>
                                    </div>
                                    <!-- Select -->
                                    <div class="col-auto">
                                        <select name="sortData" id="sortData" class="form-control">
                                            <option value="1">1 bulan</option>
                                            <option value="3">3 bulan</option>
                                            <option value="6">6 bulan</option>
                                            <option value="12">1 tahun</option>
                                        </select>
                                    </div>
                                    <!-- Button -->
                                    <div class="col-auto">
                                        <button type="submit" name="export" class="btn btn-primary">Export</button>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" name="hapus" class="btn btn-danger">Delete data</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped data-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Customer</th>
                                            <th>Total Qty</th>
                                            <th>Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM dataset_km";
                                        $sql = mysqli_query($GLOBALS['conn'], $query);
                                        if (mysqli_num_rows($sql) > 0) {
                                            while ($data = mysqli_fetch_array($sql)) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        echo $data['id_ds'];
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
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="4">
                                                    <p style="color: red; font-weight: bold;">
                                                        Dataset tidak tersedia, silahkan export data terlebih dahulu
                                                        <a href="barangkeluar.php">export data</a>
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