
<!-- Escribo este fragmento de codigo de html para poder ejecutar los mensajes con la libreria sweetalerts -->
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
        swal("Login incorrecto!", "Vuelve a introducir tus datos!", "error");
    }
</script>


<?php
// Inluyo la conexion a la base de datos
include_once('./../modelos/conexion.php');


if ($_POST) {

    $nombre = $_POST['nombre'];
    $pass = $_POST['password'];

    // echo session_id($nombre);
    // session_start();
    


    $sql = "SELECT dniEmpleado, email, nombre, appellidos, pass, tipoUsuario FROM empleados WHERE nombre = :nombre AND pass = MD5(:pass)";
    $st = $conn->prepare($sql);
    $st->bindValue(':nombre', $nombre, PDO::PARAM_STR);
    $st->bindParam(':pass',$pass, PDO::PARAM_STR);
    $st->execute();

    //en el caso de que el login sea correcto redirecciono al usuario a la tienda online
    if ($st->rowCount() > 0) {
        if ($nombre == 'admin') {
            session_start();
            session_name($nombre);
            $_SESSION['admin'] = $nombre;
        } else {
            session_start();
            session_name($nombre);
            $_SESSION['nombre'] = $nombre;
        }
        

        // echo $_SESSION['admin'];
        header("Location: productos.php");
        // en caso contrario le muestro un mensaje de error para que vuelva a introducir los datos
    } else {
        print_r($st->errorInfo());
        echo "<script>";

        echo "MiFuncionJS();";

        echo "</script>";

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>
    <style>
        body {
            background-color: #f6f6f6;
        }

        #admin-login {
            padding-top: 80px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row" id="admin-login">
            <form class="col s12 m4 offset-m4" action="loginAdmin.php" method="post">
                <div class="row">
                    <div class="card">
                        <div class="card-content">
                            <div class="input-field col s12">
                                <i class="mdi-action-account-circle prefix">
                                </i><input class="validate" id="nombre" type="text" placeholder="Nombre usuario" name="nombre"/>
                                <label for="nombre"></label>
                            </div>
                            <div class="input-field col s12">
                                <i class="mdi-action-https prefix">
                                </i><input class="validate" id="password" type="password" placeholder="Contraseña" name="password"/>
                                <label for="password"></label>
                            </div>
                            <button class="btn waves-effect waves-light" type="submit">
                                Iniciar sesion
                                <i class="mdi-action-lock-open right">
                                </i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>