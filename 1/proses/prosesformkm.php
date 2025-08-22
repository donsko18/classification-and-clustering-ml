<?php
include '../../koneksi.php';
if (isset($_GET['export'])) {
    $month = $_GET['sortData'];
    // Validasi nilai bulan (opsional)
    
            $query = "SELECT 
        customer, 
        SUM(qty_keluar) AS total_qty, 
        SUM(total_harga) AS total_harga 
    FROM 
        tbl_bout
    WHERE 
        tanggal_out BETWEEN (
            SELECT DATE_SUB(LAST_DAY(MAX(tanggal_out)), INTERVAL $month MONTH) 
            FROM tbl_bout
        ) AND (
            SELECT LAST_DAY(MAX(tanggal_out)) 
            FROM tbl_bout
        )
    GROUP BY 
        customer";

        $sql = mysqli_query($conn, $query);
        if (!$sql) {
            echo "Query tidak berjalan";
        }
        $no = 1;
        $cek = "SELECT * FROM dataset_km";
        $ceksql = mysqli_query($conn, $cek);
        ?>
        <?php
        if (mysqli_num_rows($ceksql) > 0) {
            mysqli_query($conn, "DELETE FROM dataset_km");
            while ($data = mysqli_fetch_array($sql)) {
                $customer = $data['customer'];
                $total_harga = (int) $data['total_harga'];
                $total_qty = (int) $data['total_qty'];
                $insertquery = "INSERT INTO dataset_km (id_ds, customer, total_qty, total_harga)
            VALUES ($no, '$customer', $total_qty, $total_harga)
            ";
                $sqlinsert = mysqli_query($conn, $insertquery);
                $no++;
            }
            ?>
            <script> alert("Dataset <?php echo $month ?> bulan K-Means Sudah Diperbaharui!");
                window.location.href = '../dataset_km.php';
            </script>
            <?php
        } else {
            while ($data = mysqli_fetch_array($sql)) {
                $customer = $data['customer'];
                $total_harga = (int) $data['total_harga'];
                $total_qty = (int) $data['total_qty'];

                $insertquery = "INSERT INTO dataset_km (id_ds, customer, total_qty, total_harga)
            VALUES ($no, '$customer', $total_qty, $total_harga)
            ";
                $sqlinsert = mysqli_query($conn, $insertquery);
                $no++;
            }
            ?>
            <script> alert("Dataset <?php echo $month ?> bulan K-Means Sudah Dimasukan!");
                window.location.href = '../dataset_km.php';
            </script>
            <?php
        }
} elseif (isset($_GET['hapus'])) {
    $queryhapus = "DELETE FROM dataset_km";
    mysqli_query($conn, $queryhapus);
    ?>
    <script> alert("Dataset K-Means Sudah dihapus!");
        window.location.href = '../dataset_km.php';
    </script>
    <?php
}
