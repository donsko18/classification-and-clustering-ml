<?php
include 'proseslogin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="icon" href="assets/foto/tbri.png" type="image/png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="login-container">
        <img src="assets/foto/tbri.png" alt="Logo">
        <form method="post">
            <div class="form-group row">
                <label for="uname" class="col-sm-3 col-form-label">Username</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Masukan Username" id="uname" name="uname" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="pwd" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" placeholder="Masukan Password" id="pwd" name="pwd" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
        </form>
        <div class="footer-text">
            <i class="bi bi-c-circle"></i> <a href="https://www.instagram.com/donnievarya/">Donsko Prastowo</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
