<?php
// include('./admin/index.php')

if (isset($_SESSION)) {
    header("Location: plantilla.php");
} else {

    header("Location: login.php");
}

;


?>