<?php
session_start();
if(!isset($_SESSION['login'])){
    header("location:../index.php");
    exit();
}
$rolesession = 2;
if ($_SESSION['role'] != $rolesession){
    ?>
    <script>
    alert('Maaf, Untuk mengakses halaman ini, anda harus login dengan role "Manager Operational" terlebih dahulu, terima kasih!');
    document.location='../index.php'
    </script>
    <?php
}

?>
<div class="logo-atas">
    <a href="index.php">
        <img src="../assets/foto/tbri.png" alt="TBRI">
    </a>
</div>
<nav class="navbar navbar-expand-lg navbar-dark mx-auto rounded my-3" style="width: 95%; background-color: #0000ff;">
    <a class="navbar-brand" href="index.php">
        <img src="../assets/foto/tbri.png" alt="TBRI" class="d-inline-block align-top" id="navbar-logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link active" href="index.php">Dashboard <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                    Master
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="history.php">History Prediksi</a>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <a href="logout.php" class="btn btn-outline-light my-2 my-sm-0" type="submit">Logout
                <i class="bi bi-box-arrow-right"></i>
            </a>
        </form>
    </div>
</nav>

<style>
    .logo-atas {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 10px;
        margin-bottom: 10px;
        /* Adjust the margin as needed */
    }

    .logo-atas img {
        max-width: 100px;
        /* Adjust the size as needed */
        height: 80px;
    }

    .navbar {
        padding: 5px 10px;
        border-radius: 20px;
        background-color: #0000ff;
    }

    /* .nav-item .dropdown-menu {
            background-color: #0000ff;
        } */

    .nav-link {
        color: #ffffff;
    }

    .nav-link:hover,
    .nav-link:focus {
        color: #bbbbbb;
    }

    .navbar-toggler {
        border-color: rgba(255, 255, 255, 0.1);
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%2888, 88, 88, 1%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }

    .btn-outline-light {
        color: #ffffff;
        border-color: #ffffff;
    }

    .btn-outline-light:hover {
        color: #000000;
        background-color: #ffffff;
        border-color: #ffffff;
    }

    #navbar-logo {
        max-height: 40px;
        margin-right: 10px;
    }
</style>