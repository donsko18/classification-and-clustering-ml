<?php
session_start();
include 'koneksi.php';
// Periksa apakah pengguna sudah login
if (isset($_SESSION['login']) && isset($_SESSION['role'])) {
    switch ($_SESSION['role']) {
        case '1':
            header("Location: 1/");
            break;
        case '2':
            header("Location: 2/");
            break;
        case '3':
            header("Location: 3/");
            break;
    }
    exit();
}
if (isset($_POST['login'])) {
    $uname = $_POST['uname'];
    $pwd = md5($_POST['pwd']);
    $_SESSION['login'] = $_POST['login'];
    $querylogin = "SELECT * FROM tbl_user WHERE uname='$uname'";
    $sql = mysqli_query($conn, $querylogin);

    if (mysqli_num_rows($sql) === 1) {
        $data = mysqli_fetch_assoc($sql);

        if ($pwd == $data['password']) {
            $_SESSION['uname'] = $data['uname'];
            $_SESSION['nama'] = $data['nama'];
            switch ($data['role']) {
                case '1':
                    $_SESSION['role'] = 1;
                    ?>
                    <script>
                        alert('Selamat datang <?php echo $_SESSION['nama'] ?>!');
                        window.location = '1/';
                    </script>
                    <?php
                    exit();
                case '2':
                    $_SESSION['role'] = 2;
                    ?>
                    <script>
                        alert('Selamat datang <?php echo $_SESSION['nama'] ?>!');
                        window.location = '2/';
                    </script>
                    <?php
                    exit();
                case '3':
                    $_SESSION['role'] = 3;
                    ?>
                    <script>
                        alert('Selamat datang <?php echo $_SESSION['nama'] ?>!');
                        window.location = '3/';
                    </script>
                    <?php
                    exit();
                case '4':
                    $_SESSION['role'] = 4;
                    ?>
                    <script>
                        alert('Selamat datang <?php echo $_SESSION['nama'] ?>!');
                        window.location = '4/';
                    </script>
                    <?php
                    exit();
            }
        } else {
            ?>
            <script>
                alert('Password salah!');
                window.location = 'index.php';
            </script>
            <?php
            exit();
        }
    } else {
        ?>
        <script>
            alert('Username tidak ditemukan!');
            window.location = 'index.php';
        </script>
        <?php
        exit();
    }
}


?>