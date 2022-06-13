<?php session_start();

if (!isset($_SESSION['nombre'])) {
    header('location: login.php');
}

include_once "./funciones_carrito.php";
$productos = obtenerProductos();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="estilos/images/icons/favicon.png" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/fonts/linearicons-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/vendor/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/vendor/MagnificPopup/magnific-popup.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/vendor/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/css/util.css">
    <link rel="stylesheet" type="text/css" href="estilos/css/main.css">
    <!--===============================================================================================-->
</head>

<body class="animsition">

    <!-- Header -->
    <header>
        <!-- Header desktop -->
        <div class="container-menu-desktop">
            <!-- Topbar -->


            <div class="wrap-menu-desktop">
                <nav class="limiter-menu-desktop container">
                    <style>
                        .logo {
                            font-size: 34px !important;
                            font-weight: bold !important;
                            font-family: bold !important;
                            /* padding-bottom: 0.070rem; */
                            /* color-adjust: bold !important; */
                            color: black;
                        }

                        .logo :hover {
                            color: black !important;
                        }
                    </style>
                    <!-- Logo desktop -->
                    <a href="#" class="logo">
                        <a href="plantilla.php" class="logo">Adrian</a>
                        <!-- <img src="estilos/images/icons/logo-01.png" alt="IMG-LOGO"> -->
                    </a>

                    <!-- Menu desktop -->
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li class="active-menu">
                                <a href="plantilla.php">Inicio</a>

                            </li>

                            <li>
                                <a href="product.php">Tienda</a>
                            </li>

                            <li>
                                <a href="about.php">Sobre nosotros</a>
                            </li>

                            <li>
                                <a href="contact.php">Contacto</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m">


                        <a href="shoping-cart.php">
                            <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="
                        
                        <?php
                        include_once "./funciones_carrito.php";
                        $conteo = count(obtenerIdsDeProductosEnCarrito());
                        if ($conteo > 0) {
                            printf("%d", $conteo);
                        } else {
                            printf("0");
                        }
                        ?>
                        
                        ">

                                <i class="zmdi zmdi-shopping-cart"></i>
                            </div>



                    </div>

                    <a href="logout.php">Cerrar Sesión</a>

            </div>
            </nav>
        </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <!-- <a href="plantilla.php"><img src="estilos/images/icons/logo-01.png" alt="IMG-LOGO"></a> -->
               
                    <a href="plantilla.php" class="logo">Adrian</a>
                    
                
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m m-r-15">


                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="
                <?php
                include_once "./funciones_carrito.php";
                $conteo = count(obtenerIdsDeProductosEnCarrito());
                if ($conteo > 0) {
                    printf("%d", $conteo);
                } else {
                    printf("0");
                }
                ?>">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>


            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>


        <!-- Menu Mobile -->
        <div class="menu-mobile">


            <ul class="main-menu-m">
                <li>
                    <a href="plantilla.php">Home</a>

                </li>

                <li>
                    <a href="product.php">Produtos</a>
                </li>


                <li>
                    <a href="about.html">Sobre nosotros</a>
                </li>

                <li>
                    <a href="contact.html">Contacto</a>
                </li>
            </ul>
        </div>

        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <div class="container-search-header">
                <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                    <img src="estilos/images/icons/icon-close2.png" alt="CLOSE">
                </button>

                <form class="wrap-search-header flex-w p-l-15">
                    <button class="flex-c-m trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>

                </form>
            </div>
        </div>
    </header>