
<!doctype html>
<html lang="en">
<?php
include '../koneksi.php';
function tampildata()
{
    $query = "SELECT * FROM history_predict ORDER BY tgl_pred DESC";
    $sql = mysqli_query($GLOBALS['conn'], $query);
    // Coba
    $no = 1;

    while ($data = mysqli_fetch_array($sql)) {
        $valuemetoda = ($data['metoda'] == "km") ? "K-Means" : "Decision Tree";
        $namasql = ($data['metoda'] == "km") ? "history_kmeans" : "history_decisiontree";
        $label = ($data['metoda'] == "km") ? "hkm_cluster" : "hdt_pred";
        $customer = ($data['metoda'] == "km") ? "hkm_customer" : "hdt_customer";
        $totqty = ($data['metoda'] == "km") ? "hkm_totalqty" : "hdt_totalqty";
        $tothar = ($data['metoda'] == "km") ? "hkm_totalharga" : "hdt_totalharga";
        $idhistory = $data['id_history'];
        ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $data['id_history']; ?></td>
            <td><?php echo $valuemetoda; ?></td>
            <td><?php echo $data['tgl_pred']; ?></td>
            <td><?php echo $data['keterangan']; ?></td>
            <td>
                <a href="#" class="btn btn-outline-primary tombol-detail bi bi-eye" data-toggle="modal"
                    data-target="#editModal<?php echo $no ?>"> View</a>
            </td>

            <!-- Modal -->
            <div class="modal fade" id="editModal<?php echo $no ?>" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">History Prediksi <?php echo $valuemetoda ?></h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="example<?php echo $no ?>" class="table table-striped data-table" style="width: 100%">
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
                                        $sqlhistory = mysqli_query($GLOBALS['conn'], "SELECT * FROM $namasql WHERE id_history='$idhistory' ORDER BY $label ASC");
                                        while ($datahis = mysqli_fetch_array($sqlhistory)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $nomodal; ?></td>
                                                <td><?php echo $datahis[$customer]; ?></td>
                                                <td><?php echo $datahis[$totqty]; ?></td>
                                                <td><?php echo $datahis[$tothar]; ?></td>
                                                <td><?php echo $datahis[$label]; ?></td>
                                            </tr>
                                            <?php
                                            $nomodal++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </tr>
        <?php
        $no++;
        // End Coba
    }
}
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
    <script>
        $(document).on('click', '.btn-outline-primary', function () {
            let target = $(this).data('target');
            $(target).modal('show');
        });

    </script>
</head>

<body>
    <!-- Awal Navbar -->
    <?php include 'navbar.php'; ?>
    <!-- Akhir Navbar -->
    <br>
    <!-- Awal Content -->
    <div class="shadow p-3 mb-5 bg-white rounded">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-3">
                <div class="card">
                    <div class="card-header">
                        <form action="proses/prosesdskm.php" post="GET">
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
                                    <button type="submit" class="btn btn-primary">Export</button>
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
                                        <th>ID History</th>
                                        <th>Metoda</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    tampildata();
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