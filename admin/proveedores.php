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
        $consulta = "DELETE FROM `proveedores` WHERE `id_proveedor`=:id";
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
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
     
        ///////// Fin informacion enviada por el formulario /// 

        ////////////// Insertar a la tabla la informacion generada /////////
        $sql = "insert into proveedores(nombre,telefono,direccion,email) values(:nombre,:telefono,:direccion,:email)";


        $sql = $conn->prepare($sql);

        $sql->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $sql->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $sql->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        

        if (empty($nombre) || empty($telefono) || empty($direccion) || empty($email)) {
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
        $id = trim($_POST['id']);
        echo $id;
        $nombre = trim($_POST['nombre']);
        $telefono = trim($_POST['telefono']);
        $direccion = trim($_POST['direccion']);
        $email = trim($_POST['email']);
        
        ///////// Fin informacion enviada por el formulario /// 

        ////////////// Actualizar la tabla /////////
        $consulta = "UPDATE proveedores
SET `nombre`= :nombre, `telefono` = :telefono, `direccion` = :direccion, `email` = :email
WHERE `id_proveedor` = :id";
        $sql = $conn->prepare($consulta);
        $sql->bindParam(':nombre', $nombre, PDO::PARAM_STR, 25);
        $sql->bindParam(':telefono', $telefono, PDO::PARAM_STR, 25);
        $sql->bindParam(':direccion', $direccion, PDO::PARAM_STR, 25);
        $sql->bindParam(':email', $email, PDO::PARAM_STR, 25);
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
    <h3 class="mt-5">GESTION DE PROVEEDORES</h3>
    <hr>
    <div class="row">

        <!-- Insertar Registros-->
        <?php
        if (isset($_POST['formInsertar'])) { ?>
            <div class="col-12 col-md-12">
                <form action="" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre del proveedor</label>
                            <input name="nombre" type="text" class="form-control" placeholder="Nombre" id="nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="telefono">Telefono del proveedor</label>
                            <input name="telefono" type="text" class="form-control" id="telefono" placeholder="Telefono">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="direccion">Direccion</label>
                            <input name="direccion" type="text" class="form-control" id="direccion" placeholder="Direccion">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input name="email" type="text" class="form-control" id="email" placeholder="Email">
                        </div>


                    </div>

                   

                    <div class="form-group">
                        <button name="insertar" type="submit" class="btn btn-primary  btn-block">Guardar</button>
                    </div>

                </form>
            </div>
        <?php }  ?>
        <!-- Fin Insertar Registros-->


        <?php
        if (isset($_POST['editar'])) {
            $id = $_POST['id'];
            $sql = "SELECT * FROM proveedores WHERE id_proveedor= :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $obj = $stmt->fetchObject();

        ?>

            <div class="col-12 col-md-12">

                <form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <input value="<?php echo $obj->id_proveedor; ?>" name="id" type="hidden" id="id">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre del proveedor</label>
                            <input value="<?php echo $obj->nombre; ?>" name="nombre" type="text" class="form-control" placeholder="Nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="telefono">Telefono del proveedor</label>
                            <input value="<?php echo $obj->telefono; ?>" name="telefono" type="text" class="form-control" id="telefono" placeholder="Marca">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="direccion">Direccion del proveedor</label>
                            <input value="<?php echo $obj->direccion; ?>" name="direccion" type="text" class="form-control" id="direccion" placeholder="Direccion">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Email">Email del proveedor</label>
                            <input value="<?php echo $obj->email; ?>" name="email" type="text" class="form-control" id="email" placeholder="Precio">

                        </div>

                    </div>

              
                    <div class="form-group">
                        <button name="actualizar" type="submit" class="btn btn-primary  btn-block">Actualizar Registro</button>
                    </div>
                </form>
            </div>
        <?php } ?>
        <div class="col-12 col-md-12">
            <!-- Contenido -->


            <div style="float:right; margin-bottom:5px;">

                <form action="" method="post"><button class="btn btn-primary" name="formInsertar">Nuevo registro</button> <a href="index.php"><button type="button" class="btn btn-primary">Cancelar</button></a></form>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-dark table-striped table-bordered table-responsive">
                    <thead class="thead-dark">
                        <th width="18%">ID</th>
                        <th width="22%">Nombre</th>
                        <th width="22%">Telefono</th>
                        <th width="14%">Direccion</th>
                        <th width="13%">Email</th>
                        

                        <th width="13%" colspan="2"></th>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM proveedores";
                        $query = $conn->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {
                                echo "<tr>
<td>" . $result->id_proveedor . "</td>
<td>" . $result->nombre . "</td>
<td>" . $result->telefono . "</td>
<td>" . $result->direccion . "</td>
<td>" . $result->email . "</td>


<td>
<form method='POST' action='" . $_SERVER['PHP_SELF'] . "'>
<input type='hidden' name='id' value='" . $result->id_proveedor . "'>
<button name='editar' class='btn btn-primary'>Editar</button>
</form>
</td>

<td>
<form  onsubmit=\"return confirm('Realmente desea eliminar el registro?');\" method='POST' action='" . $_SERVER['PHP_SELF'] . "'>
<input type='hidden' name='id' value='" . $result->id_proveedor . "'>
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