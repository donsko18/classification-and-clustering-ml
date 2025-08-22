<?php
include '../../koneksi.php';
if (isset($_GET['hapus'])) {
    $queryhapus = "DELETE FROM dataset_kombinasipb";
    mysqli_query($conn, $queryhapus);
    ?>
    <script> alert("Dataset Kombinasi Decision Tree Sudah dihapus!");
        window.location.href = '../datasetpb_kombinasi.php';
    </script>
    <?php
}
