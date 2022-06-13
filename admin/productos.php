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
        $consulta = "DELETE FROM `productos` WHERE `idProducto`=:id";
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
        $talla = $_POST['talla'];
        $imagen = $_POST['imagen'];
        $descripcion = $_POST['descripcion'];
        $proveedor = $_POST['proveedor'];

        ///////// Fin informacion enviada por el formulario /// 

        ////////////// Insertar a la tabla la informacion generada /////////
        $sql = "insert into productos(nombre,marca,categoria,precio,talla,imagen,description,id_proveedor) values(:nombre,:marca,:categoria,:precio,:talla,:imagen,:descripcion,:proveedor)";


        $sql = $conn->prepare($sql);

        $sql->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $sql->bindParam(':marca', $marca, PDO::PARAM_STR);
        $sql->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        $sql->bindParam(':precio', $precio, PDO::PARAM_INT);
        $sql->bindParam(':talla', $talla, PDO::PARAM_STR);
        $sql->bindParam(':imagen', $imagen, PDO::PARAM_STR);
        $sql->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $sql->bindParam(':proveedor', $proveedor, PDO::PARAM_INT);

        if (empty($nombre) || empty($marca) || empty($categoria) || empty($precio) || empty($talla) || empty($descripcion) || empty($proveedor)) {
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
        //echo $id;
        $nombre = trim($_POST['nombre']);
        //echo $nombre;
        $marca = trim($_POST['marca']);
       // echo $marca;
        $categoria = trim($_POST['categoria']);
        //echo $categoria;
        $precio = trim($_POST['precio']);
        //echo $precio;
        $talla = trim($_POST['talla']);
        //echo $talla;
        $imagen = trim($_POST['imagen']);
        $description = trim($_POST['description']);
        //echo $description;
        $proveedor = trim($_POST['proveedor']);
       // echo $proveedor;
        // $id = trim($_POST['id']);
        ///////// Fin informacion enviada por el formulario /// 

        ////////////// Actualizar la tabla /////////
        $consulta = "UPDATE productos
        SET nombre= :nombre, marca = :marca, categoria = :categoria, precio = :precio, talla = :talla,imagen = :imagen, description = :description, id_proveedor = :proveedor
        WHERE idProducto = :id";
        $sql = $conn->prepare($consulta);

        $sql->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $sql->bindParam(':marca', $marca, PDO::PARAM_STR);
        $sql->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        $sql->bindParam(':precio', $precio, PDO::PARAM_INT);
        $sql->bindParam(':talla', $talla, PDO::PARAM_STR);
        $sql->bindParam(':imagen', $imagen, PDO::PARAM_STR);
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
    <h3 class="mt-5">GESTION DE PRODUCTOS</h3>
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
                            <label for="Talla">Talla</label>
                            <input name="talla" type="text" class="form-control" placeholder="Talla" id="talla">

                        </div>
                        <div class="form-group col-md-6">
                            <label for="nombres">Imagen</label>
                            <input name="imagen" type="textarea" class="form-control" placeholder="Imagen del producto" id="imagen">
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombres">Descripcion</label>
                            <input name="descripcion" type="textarea" class="form-control" placeholder="Descripcion del producto" id="descripcion">
                        </div>
                        <?php
                        $sql = "SELECT * FROM proveedores";
                        $query = $conn->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ); ?>

                        <div class="form-group col-md-6">


                            <label for="Estado">Proveedor</label>
                            <select required name="proveedor" class="form-control" id="proveedor">
                                <?php foreach ($results as $proveedor) { ?>
                                    <option value="<?php echo $proveedor->id_proveedor; ?>"><?php echo $proveedor->nombre; ?></option>
                                <?php } ?>



                            </select>
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
            $sql = "SELECT * FROM productos WHERE idProducto= :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $obj = $stmt->fetchObject();

        ?>

            <div class="col-12 col-md-12">

                <form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <input value="<?php echo $obj->idProducto; ?>" name="id" type="hidden">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre del producto</label>
                            <input value="<?php echo $obj->nombre; ?>" name="nombre" type="text" id="nombre" class="form-control" placeholder="Nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="marca">Marca del producto</label>
                            <input value="<?php echo $obj->marca; ?>" name="marca" type="text" class="form-control" id="marca" placeholder="Marca">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="categoria">Categoria</label>
                            <input value="<?php echo $obj->categoria; ?>" name="categoria" type="text" class="form-control" id="categoria" placeholder="Categoria">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="precio">Precio</label>
                            <input value="<?php echo $obj->precio; ?>" name="precio" type="text" class="form-control" id="precio" placeholder="Precio">

                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Talla">Talla</label>
                            <input value="<?php echo $obj->talla; ?>" name="talla" type="text" class="form-control" placeholder="Talla" id="talla">

                        </div>

                        <div class="form-group col-md-6">
                            <label for="Imagen">Imagen</label>
                            <input value="<?php echo $obj->imagen; ?>" name="imagen" type="text" class="form-control" placeholder="Imagen" id="imagen">

                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Descripcion">Descripcion</label>
                            <input value="<?php echo $obj->description; ?>" name="description" type="text" class="form-control" placeholder="Descripcion" id="description">

                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-row">
                                <?php
                                $sql = "SELECT * FROM proveedores";
                                $query = $conn->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ); ?>
                                <div class="form-group col-md-6">
                                    <label for="Estado">Proveedor</label>
                                    <select required name="proveedor" class="form-control" id="proveedor">

                                        <?php foreach ($results as $proveedor) { ?>
                                            <option value="<?php echo $proveedor->id_proveedor; ?>"><?php echo $proveedor->nombre; ?></option>
                                        <?php } ?>

                                    </select>
                                </div>

                            </div>

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
                        <th width="22%">Marca</th>
                        <th width="14%">Categoria</th>
                        <th width="13%">Precio</th>
                        <th width="13%">Talla</th>
                        <th width="13%">Imagen</th>
                        <th width="13%">Descripcion</th>
                        <th width="13%">Proveedor</th>

                        <th width="13%" colspan="2"></th>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM productos";
                        $query = $conn->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {
                                echo "<tr>
<td>" . $result->idProducto . "</td>
<td>" . $result->nombre . "</td>
<td>" . $result->marca . "</td>
<td>" . $result->categoria . "</td>
<td>" . $result->precio . "</td>
<td>" . $result->talla . "</td>
<td>" . $result->imagen . "</td>
<td>" . $result->description . "</td>
<td>" . $result->id_proveedor . "</td>

<td>
<form onsubmit=\"return confirm('Realmente desea editar el registro?');\" method='POST' action='" . $_SERVER['PHP_SELF'] . "'>
<input type='hidden' name='id' value='" . $result->idProducto . "'>
<button name='editar' class='btn btn-primary'>Editar</button>
</form>
</td>

<td>
<form  onsubmit=\"return confirm('Realmente desea eliminar el registro?');\" method='POST' action='" . $_SERVER['PHP_SELF'] . "'>
<input type='hidden' name='id' value='" . $result->idProducto . "'>
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