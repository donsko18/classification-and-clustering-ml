<?php
session_start();

if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit();
}

switch ($_SESSION['role']) {
    case 1:
        header("Location: 1/");
        break;
    case 2:
        header("Location: 2/");
        break;
    case 3:
        header("Location: 3/");
        break;
    default:
        header("Location: index.php");
}
exit();
?>
