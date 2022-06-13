<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Header</title>

    <!-- Bootstrap core CSS -->
    <link href="./dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./assets/sticky-footer-navbar.css" rel="stylesheet">
    <script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $(".content").fadeOut(1500);
            }, 3000);

        });
    </script>
</head>

<body>
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark"> <a class="navbar-brand" href="#">PANEL DE ADMINISTRACION</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active"> <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a> </li>
                    <li class="nav-item active"> <a class="nav-link" href="/proyectotienda/admin/productos.php">Productos <span class="sr-only">(current)</span></a> </li>
                    <li class="nav-item active"> <a class="nav-link" href="/proyectotienda/admin/clientes.php">Clientes <span class="sr-only">(current)</span></a> </li>
                    <li class="nav-item active"> <a class="nav-link" href="/proyectotienda/admin/proveedores.php">Proveedores <span class="sr-only">(current)</span></a> </li>
                    <li class="nav-item active"> <a class="nav-link" href="/proyectotienda/admin/ventas.php">Ventas <span class="sr-only">(current)</span></a> </li>
                </ul>

            </div>
            <div>
                <a href="./cerrarsesion.php">Cerrar sesion</a>
            </div>
        </nav>
    </header>
    <script src="dist/js/bootstrap.min.js"></script>