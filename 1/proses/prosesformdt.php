<?php
include '../../koneksi.php';
if (isset($_GET['hapus'])) {
    $queryhapus = "DELETE FROM dataset_dt";
    mysqli_query($conn, $queryhapus);
    ?>
    <script> alert("Dataset Decision Tree Sudah dihapus!");
        window.location.href = '../dataset_dt.php';
    </script>
    <?php
}
