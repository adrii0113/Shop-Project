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
include_once('./modelos/conexion.php');


if ($_POST) {

    $email = $_POST['email'];
    $pass = $_POST['password'];


    $sql = "SELECT * FROM clientes WHERE email = :email AND pass = MD5(:pass)";

    $st = $conn->prepare($sql);
    $st->bindValue(':email', $email, PDO::PARAM_STR);
    $st->bindValue(':pass',$pass, PDO::PARAM_STR);
    $st->execute();
    $nombreCliente ='';
    
    // echo $dniCliente;
    // print_r( $st->fetchAll());
    //en el caso de que el login sea correcto redirecciono al usuario a la tienda online
    if ($st->rowCount() > 0) {

        foreach ($st as $cliente) {
        $nombreCliente = ($cliente['nombre']);
        }



        // session_name($email);
        //extraigo la parte del correo que esta antes del caracter @ para utilizarla como valor de la session de cada usuario
        // $idSesion = strtok($email, '@');
        $idSesion = $nombreCliente;
        session_id($idSesion);
        session_start();
       
        $_SESSION['nombre'] = session_id();
        // echo $_SESSION['nombre'];
        echo $_SESSION['nombre'];
        // echo session_name();
        header("Location: plantilla.php");
        // en caso contrario le muestro un mensaje de error para que vuelva a introducir los datos
    } else {
        echo "<script>";

        echo "MiFuncionJS();";

        echo "</script>";
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

            <h5 class="indigo-text">Iniciar sesion en la web</h5>
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
                                <input class='validate' type='email' name='email' id='email' />
                                <label for='email'>Introduce tu correo</label>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' type='password' name='password' id='password' />
                                <label for='password'>Introduce tu contraseña</label>
                            </div>
                            <label style='float: right;'>
                                <a class='pink-text' href='registro.php'><b>Registro </b></a>
                            </label>
                        </div>

                        <br />
                        <center>
                            <div class='row'>
                                <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect indigo'>Iniciar sesion</button>
                            </div>
                        </center>
                    </form>
                </div>
            </div>
            <a href="./registro.php">Registrarse</a>
        </center>

        <div class="section"></div>
        <div class="section"></div>
    </main>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
</body>

</html>