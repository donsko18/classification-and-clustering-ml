<?php
include '../koneksi.php';
// Ubah Password
if (isset($_POST['savepwd'])) {
    $uname = $_POST['uname'];
    $pwd = md5($_POST['pwdold']);
    $pwdnew = md5($_POST['pwdnew']);
    $pwdnew2 = md5($_POST['pwdnew2']);
    $querycheck = mysqli_query($conn, "select * from tbl_user where uname='$uname' ");
    $verif = mysqli_fetch_array($querycheck);
  
    if ($verif) {
      if ($verif['password'] === $pwd) {
        if ($pwdnew === $pwdnew2) {
          $update = mysqli_query($conn, "update tbl_user set password='$pwdnew' where uname='$uname'");
          ?>
          <script>
            alert("Password anda berhasil diubah");
            window.location.href = '../'
          </script>
          <?php
        } else {
          ?>
          <script>
            alert("Password baru anda tidak sama dengan kolom konfirmasinya!");
            window.location.href = '';
          </script>
          <?php
        }
      } else {
        ?>
        <script>
          alert("Password lama anda salah!");
          window.location.href = '';
        </script>
        <?php
      }
    }
  }
?>