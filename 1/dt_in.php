<?php
include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decision Tree</title>
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
                        <h4>Decision Tree</h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form id="dynamicForm" method="get">
                                <div class="form-group">
                                    <!-- Label dan Select Dataset -->
                                    <label for="selectBox1" class="col-form-label font-weight-bold">Pilih
                                        Dataset:</label>
                                    <div class="form-row">
                                        <div class="col-md-3 mb-3">
                                            <select id="selectBox1" class="form-control">
                                                <option value="">-- Pilih --</option>
                                                <option value="hasilDT.php">Dataset Perbandingan</option>
                                                <option value="kombinasi_hasilDT_perbandingan.php">(Perbandingan)
                                                    Dataset K-Means</option>
                                                <option value="kombinasi_hasilDT.php">Dataset K-Means</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Label dan Select Test Size -->
                                    <label for="testSize" class="col-form-label font-weight-bold">Pilih Ukuran Data
                                        Uji:</label>
                                    <div class="form-row">
                                        <div class="col-md-3 mb-3">
                                            <select name="testSize" id="testSize" class="form-control" required>
                                            <option value="">-- Pilih --</option>
                                                <?php
                                                // Menambahkan opsi jumlah cluster dari 0.1 hingga 0.5
                                                for ($i = 0.1; $i <= 0.4; $i += 0.1) {
                                                    echo "<option value=\"$i\">$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- Tombol Submit -->
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary btn-block"
                                                id="submitButton">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('dynamicForm').onsubmit = function (event) {
                                        // Ambil nilai dari select box
                                        const select1 = document.getElementById('selectBox1').value;

                                        // Tentukan route berdasarkan nilai yang dipilih
                                        if (select1) {
                                            this.action = select1; // Mengubah action form
                                        } else {
                                            alert('Silakan pilih salah satu opsi!');
                                            event.preventDefault(); // Batalkan submit jika tidak ada opsi yang dipilih
                                        }
                                    };
                                </script>
                            </form>
                            <!--  -->
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