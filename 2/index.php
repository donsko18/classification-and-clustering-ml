<!doctype html>
<html lang="en">
<?php
include 'proses/prosesdashboard.php';
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="icon" href="../assets/foto/tbri.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body>
    <!-- Awal Navbar -->
    <?php include 'navbar.php'; ?>
    <!-- Akhir Navbar -->
    <br>
    <!-- Awal Content -->
    <div class="shadow p-3 mb-5 bg-white rounded">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card border-primary mb-4" style="max-width: 25rem;">
                        <div class="card-body">
                            <h5 class="card-title">Welcome <?php echo $_SESSION['nama']; ?>!</h5>
                            <p>Manager Operational</p>
                            <a href="#" data-toggle="modal" data-target="#pwdModal">Ubah Password</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card border-success mb-4" style="max-width: 25rem;">
                        <div class="card-body">
                            <?php
                            $kmeanscek = "SELECT id_history, keterangan FROM history_predict WHERE metoda='km' ORDER BY tgl_pred DESC LIMIT 1";
                            $querykmcek = mysqli_query($conn, $kmeanscek);
                            $rowcek = mysqli_fetch_assoc($querykmcek);
                            $ketkm = "0";
                            $idhistorykm = "";
                            if (mysqli_num_rows($querykmcek) == 0) {
                                $isicardkm = 0;
                            } else {

                                $ketkm = $rowcek['keterangan'];
                                $idhistorykm = $rowcek['id_history'];
                                $kmeancount = mysqli_query($conn, "SELECT COUNT(*) AS total FROM history_kmeans WHERE hkm_cluster = 1 and id_history='$idhistorykm'");
                                $rowcountkm = mysqli_fetch_assoc($kmeancount);
                                $isicardkm = $rowcountkm['total'];
                            }
                            ?>
                            <h5 class="card-title">K-Means Model</h5>
                            <p><?php echo $isicardkm ?> customer</p>
                            Jumlah Customer loyal dari KMeans
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card border-danger mb-4" style="max-width: 25rem;">
                        <div class="card-body">
                            <?php
                            $dtcek = "SELECT id_history, keterangan FROM history_predict WHERE metoda='dt-dskm' ORDER BY tgl_pred DESC LIMIT 1";
                            $querydtcek = mysqli_query($conn, $dtcek);
                            $rowcekdt = mysqli_fetch_assoc($querydtcek);
                            $ketdt = "0";
                            $idhistorydt = "";
                            if (mysqli_num_rows($querydtcek) == 0) {
                                $isicarddt = 0;
                            } else {

                                $ketdt = $rowcekdt['keterangan'];
                                $idhistorydt = $rowcekdt['id_history'];
                                $dtcount = mysqli_query($conn, "SELECT COUNT(*) AS total FROM history_decisiontree WHERE hdt_pred = 1 and id_history='$idhistorydt'");
                                $rowcountdt = mysqli_fetch_assoc($dtcount);
                                $isicarddt = $rowcountdt['total'];
                            }
                            ?>
                            <h5 class="card-title">Decision Tree Model</h5>
                            <p><?php echo $isicarddt ?> customer</p>
                            Jumlah Customer loyal dari Decision Tree
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" tabindex="-1" id="pwdModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Konfirmasi</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body">
                                <form action="" method="post">
                                    <input type="hidden" id="uname" name="uname"
                                        value="<?php echo $_SESSION['uname'] ?>">
                                    <div class="mb-3">
                                        <label for="pwdold" class="form-label">Password lama</label>
                                        <input type="password" class="form-control" id="pwdold" name="pwdold"
                                            placeholder="Masukan Password lama anda!" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pwdnew" class="form-label">Password Baru</label>
                                        <input type="password" class="form-control" id="pwdnew" name="pwdnew"
                                            placeholder="Masukan Password baru anda!" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pwd2" class="form-label">Konfirmasi Password Baru</label>
                                        <input type="password" class="form-control" id="pwdnew2" name="pwdnew2"
                                            placeholder="Masukan kembali password baru anda!" required>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="savepwd">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-primary mb-12">
                        <div class="card-body text-center">
                            <h5 class="m-0">Hasil dari dataset K-Means dan Decision Tree dari hasil Kombinasi!</h5>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                        <h6>Hasil K-Means Terbaru  "<?php echo $ketkm ?>"<br>ID : <?php echo $idhistorykm?>  </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped data-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Customer</td>
                                            <td>Tier</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (mysqli_num_rows($querykmcek) == 0) {

                                        } else {
                                            ?>
                                            <tr>
                                                <?php
                                                $no = 1;
                                                $isirowkm = mysqli_query($conn, "SELECT hkm_customer, hkm_cluster FROM history_kmeans where id_history='$idhistorykm' ORDER BY hkm_cluster ASC");
                                                while ($rowkmisi = mysqli_fetch_array($isirowkm)) {
                                                    $customerkm = $rowkmisi['hkm_customer'];
                                                    $clusterkm = $rowkmisi['hkm_cluster'] + 1;
                                                    if ($rowkmisi['hkm_cluster'] == 1) {
                                                        $clusterkm = "Loyal";
                                                    } elseif ($rowkmisi['hkm_cluster'] == 2) {
                                                        $clusterkm = "Semi-Loyal";
                                                    } else {
                                                        $clusterkm = "Non-Loyal";
                                                    }
                                                    ?>
                                                    <td><?php echo $no ?></td>
                                                    <td><?php echo $customerkm ?></td>
                                                    <td><?php echo $clusterkm ?></td>
                                                </tr>
                                                <?php
                                                $no++;
                                                }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h6>Hasil Decision Tree Terbaru  "<?php echo $ketdt ?>"<br>ID : <?php echo $idhistorydt?>  </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped data-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Customer</td>
                                            <td>Tier</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (mysqli_num_rows($querydtcek) == 0) {

                                        } else {
                                            ?>
                                            <tr>
                                                <?php
                                                $nodt = 1;
                                                $isirowdt = mysqli_query($conn, "SELECT hdt_customer, hdt_pred FROM history_decisiontree where id_history='$idhistorydt' ORDER BY hdt_pred ASC");
                                                while ($rowdtisi = mysqli_fetch_array($isirowdt)) {
                                                    $customerdt = $rowdtisi['hdt_customer'];
                                                    if ($rowdtisi['hdt_pred'] == 1) {
                                                        $preddt = "Loyal";
                                                    } elseif ($rowdtisi['hdt_pred'] == 2) {
                                                        $preddt = "Semi-Loyal";
                                                    } else {
                                                        $preddt = "Non-Loyal";
                                                    }
                                                    ?>
                                                    <td><?php echo $nodt ?></td>
                                                    <td><?php echo $customerdt ?></td>
                                                    <td><?php echo $preddt ?></td>
                                                </tr>
                                                <?php
                                                $nodt++;
                                                }
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