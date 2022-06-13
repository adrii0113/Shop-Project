<?php include_once "./funciones_carrito.php";

$bd = obtenerConexion();
$productos = obtenerProductosEnCarrito();

vaciarCarrito();
header('Location: shoping-cart.php');
?>