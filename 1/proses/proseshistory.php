<?php
include '../../koneksi.php';
if (isset($_POST['edit'])){
    $idhistory = $_POST['idhis'];
    $periode = $_POST['ket'];
    $sqledit = mysqli_query($conn, "UPDATE history_predict SET keterangan='$periode' WHERE id_history='$idhistory'");
    ?>
    <script>
        alert("Periode berhasil terupdate pada ID = <?php echo $idhistory?> menjadi <?php echo $periode?>")
        window.location.href = '../history.php';
    </script>
    <?php
}
?>