<?php
# Es responsabilidad del programador hacer algo con los productos
include_once "./funciones_carrito.php";


// include_once('./../modelos/conexion.php');
$bd = obtenerConexion();
// $idProducto = 0;
$productos = obtenerProductosEnCarrito();
// $bd = obtenerConexion();
// iniciarSesionSiNoEstaIniciada();
// // $sentencia = $bd->prepare("SELECT productos.idProducto
// //      FROM productos
// //      INNER JOIN carrito_usuarios
// //      ON productos.idProducto = carrito_usuarios.idProducto
// //      WHERE carrito_usuarios.id_sesion = ?");
// // $idSesion = session_id();
// // $sentencia->execute([$idSesion]);

// // var_dump($productos);
// // foreach ($productos as $producto ) {
// //     $idProducto= $producto->idProducto;
// // }
// // $idProducto = 0;
// $sentencia = "SELECT productos.idProducto FROM productos INNER JOIN carrito_usuarios ON productos.idProducto = carrito_usuarios.idProducto";
// $sentencia =$bd->prepare($sentencia);
// $idSesion = session_id();
// $sentencia->execute([$idSesion]);

// $arrDatos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// foreach ($arrDatos as $value) {
//     $idProducto= $value['idProducto'];
// }
// echo 'hello';
// $dniCliente = '111';
$clientes = obtenerClientes();
$dniCliente = '';
foreach ($clientes as $cliente) {
    if ($cliente->nombre == $_SESSION['nombre']) {
        $dniCliente = $cliente->dniCliente;
    }
}
$total = 0;
// $dniCliente = '1111';
foreach ($productos as $producto) {
 $total += $producto->precio;

    $idProducto = $producto->idProducto;

$fecha = date('Y-m-d');
$sql = "insert into ventas(fechaVenta,importe,idProducto,dniCliente) values(:fecha,:importe,:idProducto,:dniCliente)";
$sql = $bd->prepare($sql);
$sql->bindParam(':fecha', $fecha);
$sql->bindParam(':importe', $total, PDO::PARAM_INT);
$sql->bindParam(':idProducto', $idProducto);
$sql->bindParam(':dniCliente', $dniCliente);


if ($sql->execute()) {
    
    vaciarCarrito();
    header('Location: plantilla.php');
} else {

    print_r($sql->errorInfo());
}

}
// # Puede que solo quieras los ids, para ello invoca a obtenerIdsDeProductosEnCarrito();
// var_dump($productos);
