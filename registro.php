<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

</body>

</html>
<!-- Me declaro una funcion que muestra un alert personalizado -->
<script language=javascript type=text/javascript>
    function MiFuncionJS()

    {
        swal("Registro fallido!", "Esta cuenta ya esta registrada!", "error");
    }

    function exito()

    {
        swal("Registro completado!", "Cuenta creada correctamente!", "success");
    }

    function datosIncompletos()

    {
        swal("Registro fallido!", "Tienes que rellenar todos los datos!", "error");
    }

    function emailRepetido()

    {
        swal("Registro fallido!", "El email o el dni que has introducido ya existe!", "error");
    }

    
</script>

<?php
include_once "./funciones_carrito.php";

// require './modelos/conexion.php';
$bd = obtenerConexion();
$message = '';
$estado = true;
$estadodni = true;
if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['dniCliente']) && !empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['direccion']) && !empty($_POST['telefono'])) {
    $sql = "INSERT INTO clientes (dniCliente,nombre,apellidos,email,pass,direccion,telefono) VALUES (:dniCliente, :nombre, :apellidos, :email, MD5(:password), :direccion, :telefono)";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':dniCliente', $_POST['dniCliente']);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':apellidos', $_POST['apellidos']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':password', $_POST['password']);
    $stmt->bindParam(':direccion', $_POST['direccion']);
    $stmt->bindParam(':telefono', $_POST['telefono']);

    if (empty($_POST['dniCliente']) || empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['password']) || empty($_POST['direccion']) || empty($_POST['telefono'])) {
        echo "<script>";

        echo "setInterval(datosIncompletos(), 1000);";

        echo "</script>";
    } else {
    $clientes = obtenerClientes();

    foreach ($clientes as $cliente) {
        if ($cliente->email == $_POST['email'] || $cliente->dniCliente == $_POST['dniCliente']) {

            $estado = false;
        } else {
            $estado = true;
        }

        
    }

    if ($estado == false) {

        echo "<script>";

        echo "setInterval(emailRepetido(), 1000);";

        echo "</script>";
    } else {

        $stmt->execute();

        header("Location: login.php");
    }
  
    }
}





?>

<html>

<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }

        body {
            background: #fff;
        }

        .input-field input[type=date]:focus+label,
        .input-field input[type=text]:focus+label,
        .input-field input[type=email]:focus+label,
        .input-field input[type=password]:focus+label {
            color: #e91e63;
        }

        .input-field input[type=date]:focus,
        .input-field input[type=text]:focus,
        .input-field input[type=email]:focus,
        .input-field input[type=password]:focus {
            border-bottom: 2px solid #e91e63;
            box-shadow: none;
        }
    </style>
</head>

<body>


    <div class="section"></div>
    <main>
        <script>

        </script>
        <center>
            <img class="responsive-img" style="width: 250px;" src="https://i.imgur.com/ax0NCsK.gif" />
            <div class="section"></div>

            <h5 class="indigo-text">Crear cuenta</h5>
            <div class="section"></div>

            <div class="container">
                <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

                    <form class="col s12" method="post">
                        <div class='row'>
                            <div class='col s12'>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' type='text' name='dniCliente' id='dniCliente' pattern="[0-9]{8}[A-Za-z]{1}" title="Debe poner 8 números y una letra" />
                                <label for='dniCliente'>Introduce tu DNI</label>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' type='text' name='nombre' id='nombre' />
                                <label for='nombre'>Introduce tu nombre</label>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' type='text' name='apellidos' id='apellidos' />
                                <label for='apellidos'>Introduce tus apellidos</label>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' type='email' name='email' id='email' />
                                <label for='email'>Introduce tu correo</label>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' type='password' name='password' id='password' />
                                <label for='password'>Introduce tu contraseña</label>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' type='text' name='direccion' id='direccion' />
                                <label for='direccion'>Introduce tu direccion</label>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' type='text' name='telefono' id='telefono' />
                                <label for='telefono'>Introduce tu telefono</label>
                            </div>
                            <label style='float: right;'>
                                <a class='pink-text' href='login.php'><b>Ya tienes cuenta?</b></a>
                            </label>

                        </div>

                        <br />
                        <center>
                            <div class='row'>
                                <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect indigo'>Crear cuenta</button>
                            </div>
                        </center>
                    </form>
                </div>
            </div>
            <a href="./login.php">Iniciar sesion</a>
        </center>

        <div class="section"></div>
        <div class="section"></div>
    </main>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
</body>

</html>