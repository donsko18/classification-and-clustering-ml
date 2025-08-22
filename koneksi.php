<?php
 $host = 'localhost';
 $user = 'root';
 $password = '';
 $db = 'skripsibackup';

$conn = mysqli_connect(
    $host,
    $user,
    $password,
    $db
);
mysqli_select_db($conn, $db);
?>