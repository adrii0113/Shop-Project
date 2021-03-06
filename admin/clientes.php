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
        $consulta = "DELETE FROM `clientes` WHERE `dniCliente`=:id";
        $sql = $conn->prepare($consulta);
        $sql->bindParam(':id', $id, PDO::PARAM_STR);
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
        $dniCliente = $_POST['dniCliente'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];

        ///////// Fin informacion enviada por el formulario /// 

        ////////////// Insertar a la tabla la informacion generada /////////
        $sql = "insert into clientes(dniCliente,nombre,apellidos,email,pass,direccion,telefono) values(:dniCliente,:nombre,:apellidos,:email,MD5(:pass),:direccion,:telefono)";


        $sql = $conn->prepare($sql);

        $sql->bindParam(':dniCliente', $dniCliente, PDO::PARAM_STR);
        $sql->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $sql->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->bindParam(':pass', $pass, PDO::PARAM_STR);
        $sql->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $sql->bindParam(':telefono', $telefono, PDO::PARAM_STR);

        $sql->execute();
        if (!$sql) {
            echo "<div class='content alert alert-danger'> No se pueden agregar datos, comun??quese con el administrador  </div>";
        } else {
            echo "<div class='content alert alert-primary' > Acabas de insertar el siguiente cliente : $nombre  </div>";
        }
        // $lastInsertId = $conn->lastInsertId();
        // if ($lastInsertId > 0) {

        //     echo "<div class='content alert alert-primary' > Acabas de insertar el siguiente cliente : $nombre  </div>";
        // } else {
        //     echo "<div class='content alert alert-danger'> No se pueden agregar datos, comun??quese con el administrador  </div>";

        //     print_r($sql->errorInfo());
        // }
    } // Cierra envio de guardado
    ?>

    <?php

    if (isset($_POST['actualizar'])) {
        ///////////// Informacion enviada por el formulario /////////////
        $id = trim($_POST['id']);
        $nombre = trim($_POST['nombre']);
        $apellidos = trim($_POST['apellidos']);
        $email = trim($_POST['email']);
        $direccion = trim($_POST['direccion']);
        $telefono = trim($_POST['telefono']);
        
        ///////// Fin informacion enviada por el formulario /// 

        ////////////// Actualizar la tabla /////////
        $consulta = "UPDATE clientes
SET `nombre`= :nombre, `apellidos` = :apellidos, `email` = :email, `direccion` = :direccion, `telefono` = :telefono
WHERE `dniCliente` = :id";
        $sql = $conn->prepare($consulta);
        $sql->bindParam(':nombre', $nombre, PDO::PARAM_STR, 25);
        $sql->bindParam(':apellidos', $apellidos, PDO::PARAM_STR, 25);
        $sql->bindParam(':email', $email, PDO::PARAM_STR, 25);
        $sql->bindParam(':direccion', $direccion, PDO::PARAM_STR, 25);
        $sql->bindParam(':telefono', $telefono, PDO::PARAM_STR);
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
    <h3 class="mt-5">GESTION DE CLIENTES</h3>
    <hr>
    <div class="row">

        <!-- Insertar Registros-->
        <?php
        if (isset($_POST['formInsertar'])) { ?>
            <div class="col-12 col-md-12">
                <form action="" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="dniCliente">DNI del cliente</label>
                            <input name="dniCliente" type="text" class="form-control" placeholder="Dni">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre del cliente</label>
                            <input name="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="apellidos">Apellidos</label>
                            <input name="apellidos" type="text" class="form-control" id="apellidos" placeholder="Apellidos">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input name="email" type="text" class="form-control" id="email" placeholder="Correo electronico">
                        </div>


                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="pass">Contrase??a</label>
                            <input name="pass" type="password" class="form-control" placeholder="*****">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="direccion">Direccion</label>
                            <input name="direccion" type="text" class="form-control" placeholder="Direccion" id="Direccion">

                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="telefono">Telefono</label>
                            <input name="telefono" type="text" class="form-control" placeholder="Telefono del cliente" id="telefono">
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
            $sql = "SELECT * FROM clientes WHERE dniCliente= :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $obj = $stmt->fetchObject();

        ?>

            <div class="col-12 col-md-12">

                <form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <input value="<?php echo $obj->dniCliente; ?>" name="id" type="hidden" id="id">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombres">Nombre del cliente</label>
                            <input value="<?php echo $obj->nombre; ?>" name="nombre" type="text" class="form-control" placeholder="Nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edad">Apellidos del cliente</label>
                            <input value="<?php echo $obj->apellidos; ?>" name="apellidos" type="text" class="form-control" id="apellidos" placeholder="Apellidos">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="pass">Email</label>
                            <input value="<?php echo $obj->email; ?>" name="email" type="text" class="form-control" id="email" placeholder="Email">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Estado">Direccion</label>
                            <input value="<?php echo $obj->direccion; ?>" name="direccion" type="text" class="form-control" id="direccion" placeholder="Direccion">

                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="pass">Telefono</label>
                            <input value="<?php echo $obj->telefono; ?>" name="telefono" type="text" class="form-control" id="telefono" placeholder="Telefono">
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
                        <th width="18%">DNI</th>
                        <th width="22%">Nombre</th>
                        <th width="22%">Apellidos</th>
                        <th width="14%">Email</th>
                        <th width="13%">Direccion</th>
                        <th width="13%">Telefono</th>


                        <th width="13%" colspan="2"></th>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM clientes";
                        $query = $conn->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {
                                echo "<tr>
<td>" . $result->dniCliente . "</td>
<td>" . $result->nombre . "</td>
<td>" . $result->apellidos . "</td>
<td>" . $result->email . "</td>
<td>" . $result->direccion . "</td>
<td>" . $result->telefono . "</td>


<td>
<form method='POST' action='" . $_SERVER['PHP_SELF'] . "'>
<input type='hidden' name='id' value='" . $result->dniCliente . "'>
<button name='editar' class='btn btn-primary'>Editar</button>
</form>
</td>

<td>
<form  onsubmit=\"return confirm('Realmente desea eliminar el registro?');\" method='POST' action='" . $_SERVER['PHP_SELF'] . "'>
<input type='hidden' name='id' value='" . $result->dniCliente . "'>


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