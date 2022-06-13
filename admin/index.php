
<?php session_start();
if (!isset($_SESSION['admin'])) {
    header('location: loginAdmin.php');
} else {
    header('location: productos.php');
}

?>


