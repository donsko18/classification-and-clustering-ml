<?php
include '../koneksi.php';
// Logika Data user baru
if(isset($_POST['newUser'])){
    $nama = $_POST['nama'];
    $uname = $_POST['uname'];
    $rolenew = $_POST['rolenew'];
    $pwd = md5($_POST['password']);
    $querynew = "INSERT INTO tbl_user (uname, nama, password, role) VALUES ('$uname', '$nama', '$pwd', $rolenew)";
    $sqlnew = mysqli_query($conn, $querynew);
    ?>
        <script> alert("Data USER berhasil ditambahkan!");
            window.location.href = 'index.php';
        </script>
    <?php
}
// Logika Edit user
if(isset($_POST['edit'])) {
    $idedit = $_POST['editid'];
    $edituser = $_POST['edituser'];
    $editrole =$_POST['editrole'];
    $queryedit = "UPDATE tbl_user SET nama='$edituser', role='$editrole' WHERE id_user='$idedit'";
    $sqledit = mysqli_query($conn, $queryedit);
    ?>
        <script> alert("Data Sudah Diperbaharui!");
            window.location.href = 'index.php';
        </script>
    <?php
}
// Logika Hapus user
if(isset($_POST['hapus'])) {
    $hapusid = $_POST['hapusid'];
    $queryhapus = "DELETE FROM tbl_user where id_user='$hapusid'";
    $sqlhapus = mysqli_query($conn, $queryhapus);
    ?>
        <script> alert("Data Sudah Dihapus!");
            window.location.href = 'index.php';
        </script>
    <?php
}
// Logika Reset password
if(isset($_POST['reset'])){
    $resetid = $_POST['resetid'];
    $passreset = md5('1234');
    $queryreset = "UPDATE tbl_user SET password='$passreset' where id_user='$resetid'";
    $sqlreset = mysqli_query($conn, $queryreset);
    ?>
        <script> alert("Password sudah ter-RESET!");
            window.location.href = 'index.php';
        </script>
    <?php
}
?>