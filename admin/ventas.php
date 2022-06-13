<?php include './header.php' ?>

<?php session_start();
if (!isset($_SESSION['admin'])) {
    header('location: loginAdmin.php');
}
include './header.php' ?>
<?php include_once('./../modelos/conexion.php') ?>

<div class="container">
    <?php

    if (isset($_POST['eliminar'])) {

        ////////////// Actualizar la tabla /////////
        $consulta = "DELETE FROM ventas WHERE `idVenta`=:id";
        $sql = $conn->prepare($consulta);
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $id = trim($_POST['id']);

        $sql->execute();

        if ($sql->rowCount() > 0) {
            $count = $sql->rowCount();
            echo "<div class='content alert alert-primary' > 
            Gracias: $count registro ha sido eliminado  </div>";
        } else {
            echo "<div class='content alert alert-danger'> No se pudo eliminar el registro  </div>";

            print_r($sql->errorInfo());
        }
    } // Cierra envio de guardado
    ?>

    <?php

    if (isset($_POST['insertar'])) {
        ///////////// Informacion enviada por el formulario /////////////
        $nombre = $_POST['nombre'];
        $marca = $_POST['marca'];
        $categoria = $_POST['categoria'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $proveedor = $_POST['proveedor'];

        ///////// Fin informacion enviada por el formulario /// 

        ////////////// Insertar a la tabla la informacion generada /////////
        $sql = "insert into productos(nombre,marca,categoria,precio,description,id_proveedor) values(:nombre,:marca,:categoria,:precio,:descripcion,:proveedor)";


        $sql = $conn->prepare($sql);

        $sql->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $sql->bindParam(':marca', $marca, PDO::PARAM_STR);
        $sql->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        $sql->bindParam(':precio', $precio, PDO::PARAM_INT);
        $sql->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $sql->bindParam(':proveedor', $proveedor, PDO::PARAM_INT);

        if (empty($nombre) || empty($marca) || empty($categoria) || empty($precio) || empty($descripcion) || empty($proveedor)) {
            echo "<div class='content alert alert-danger'> No has rellenado todos los campos </div>";
        } else {
            $sql->execute();
            echo "<div class='content alert alert-primary' > Acabas de insertar el siguiente producto : $nombre  </div>";
        }



        // $lastInsertId = $conn->lastInsertId();
        // if ($lastInsertId > 0) {

        //     echo "<div class='content alert alert-primary' > Acabas de insertar el siguiente producto : $nombre  </div>";
        // } else {
        //     if (empty($nombre) || empty($marca) || empty($categoria) || empty($precio) || empty($stock) || empty($descripcion) || empty($proveedor) ) {
        //         echo "<div class='content alert alert-danger'> No has rellenado todos los campos </div>";
        //     }
        //     // echo "<div class='content alert alert-danger'> No se pueden agregar datos, comuníquese con el administrador  </div>";


        // }
    } // Cierra envio de guardado
    ?>

    <?php

    if (isset($_POST['actualizar'])) {
        ///////////// Informacion enviada por el formulario /////////////
        $nombre = $_POST['nombre'];
        $marca = $_POST['marca'];
        $categoria = $_POST['categoria'];
        $precio = $_POST['precio'];
        $description = $_POST['description'];
        $proveedor = $_POST['proveedor'];
        ///////// Fin informacion enviada por el formulario /// 

        ////////////// Actualizar la tabla /////////
        $consulta = "UPDATE productos
SET `nombre`= :nombre, `marca` = :marca, `categoria` = :categoria, `precio` = :precio, `description` = :description, `idProveedor` = :proveedor
WHERE `idProducto` = :id";
        $sql = $conn->prepare($consulta);
        $sql->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $sql->bindParam(':marca', $marca, PDO::PARAM_STR);
        $sql->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        $sql->bindParam(':precio', $precio, PDO::PARAM_INT);
        $sql->bindParam(':description', $description, PDO::PARAM_STR);
        $sql->bindParam(':proveedor', $proveedor, PDO::PARAM_STR);
        $sql->bindParam(':id', $id, PDO::PARAM_INT);

        $sql->execute();

        if ($sql->rowCount() > 0) {
            $count = $sql->rowCount();
            echo "<div class='content alert alert-primary' > 

  
Gracias: $count registro ha sido actualizado  </div>";
        } else {
            echo "<div class='content alert alert-danger'> No se pudo actulizar el registro  </div>";

            print_r($sql->errorInfo());
        }
    } // Cierra envio de guardado
    ?>
    <h3 class="mt-5">GESTION DE VENTAS</h3>
    <hr>
    <div class="row">

        <!-- Insertar Registros-->
        <?php
        if (isset($_POST['formInsertar'])) { ?>
            <div class="col-12 col-md-12">
                <form action="" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre del producto</label>
                            <input name="nombre" type="text" class="form-control" placeholder="Nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="marca">Marca del producto</label>
                            <input name="marca" type="text" class="form-control" id="marca" placeholder="Marca">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="pass">Categoria</label>
                            <input name="categoria" type="text" class="form-control" id="categoria" placeholder="Categoria">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pass">Precio</label>
                            <input name="precio" type="text" class="form-control" id="precio" placeholder="Precio">
                        </div>


                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="Estado">Proveedor</label>
                            <input name="proveedor" type="text" class="form-control" placeholder="Proveedor" id="proveedor">

                        </div>
                        <div class="form-group col-md-6">
                            <label for="nombres">Descripcion</label>
                            <input name="descripcion" type="textarea" class="form-control" placeholder="Descripcion del producto" id="descripcion">
                        </div>

                    </div>

                    <div class="form-row">

                    </div>

                    <div class="form-group">
                        <button name="insertar" type="submit" class="btn btn-primary  btn-block">Guardar</button>
                    </div>

                </form>
            </div>
        <?php }  ?>
        <!-- Fin Insertar Registros-->


     
        <div class="col-12 col-md-12">
            <!-- Contenido -->


           
            <div class="table-responsive">
                <table class="table table-hover table-dark table-striped table-bordered table-responsive">
                    <thead class="thead-dark">
                        <th width="18%">ID</th>
                        <th width="22%">Fecha de venta</th>
                        <th width="22%">Importe</th>
                        <th width="14%">Producto</th>
                        <th width="13%">Cliente</th>

                        <th width="13%" colspan="2"></th>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM ventas";
                        $query = $conn->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {
                                echo "<tr>
<td>" . $result->idVenta . "</td>
<td>" . $result->fechaVenta . "</td>
<td>" . $result->importe . "</td>
<td>" . $result->idProducto . "</td>
<td>" . $result->dniCliente . "</td>




<td>
<form  onsubmit=\"return confirm('Realmente desea eliminar el registro?');\" method='POST' action='" . $_SERVER['PHP_SELF'] . "'>
<input type='hidden' name='id' value='" . $result->idVenta . "'>
<button name='eliminar' class='btn btn-danger'>Eliminar</button>
</form>
</td>
</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Fin Contenido -->
</div>
</div>
<!-- Fin row -->

</div>
<!-- Fin container -->
<footer class="footer">
    <div class="container"> <span class="text-muted">
            <p>By <a href="@" target="_blank">Adrian</a></p>
        </span> </div>
</footer>

<!-- Bootstrap core JavaScript
    ================================================== -->
<script src="dist/js/bootstrap.min.js"></script>
<!-- Placed at the end of the document so the pages load faster -->
</body>

</html>

<?php include './footer.php'; ?>

<?php include './footer.php'; ?>