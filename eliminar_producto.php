<?php
if (!isset($_POST["id_producto"])) {
    exit("No hay datos");
}

include_once "./funciones_carrito.php";
eliminarProducto($_POST["id_producto"]);
header("Location: tienda.php");
