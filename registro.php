<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos_indexTiendas.css">
    <script src="https://kit.fontawesome.com/e0faf94ce0.js" crossorigin="anonymous"></script>
    <link rel="icon" href="static/img/logo.ico">
</head>

<body>
    <?php
    $usario_tienda =  $_REQUEST['id'];
    require_once("crud.php"); // require lo mismo que el include
    $obj = new Usuario(); // creo objeto
    $obj->conectar(); //  funcion que esta en la clase
    foreach ($obj->datos_tienda($usario_tienda) as $dato) {
    ?>
        <header>
            <h1>VIRTUAL STORE</h1>
            <h2> Tienda: <?php echo $dato->nombre_tienda ?></h2>
        </header>
        <main>
            <div class="tabla">
                <table>
                    <thead>
                        <tr>
                            <th> código </th>
                            <th> Nombre </th>
                            <th> Precio </th>
                            <th> Imagen </th>
                            <th colspan='3'> Acciones </th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($obj->consultar($dato->id_tienda) as $r) {

                    ?>
                        <tbody>
                            <tr>
                                <td><?php echo $r->id_articulo; ?></td>
                                <td><?php echo $r->nombre_articulo; ?></td>
                                <td><?php echo $r->precio; ?></td>
                                <td><img src="static/img_articulo/<?php echo $r->img_articulo; ?>"></td>
                                <td class="botones">
                                    <form action='javascript:abrir()' method='POST'>
                                        <input type='submit' name='<?php echo $r->id_articulo ?>' value='Editar '>
                                    </form>
                                </td>
                                <td class="botones">
                                    <form action='javascript:abrir_img()' method='POST'>
                                        <input type='submit' name='<?php echo $r->id_articulo; ?>' value='Editar Imagen'>
                                    </form>
                                </td>
                                <td class="botones ">
                                    <form action='javascript:abrir_img()' method='POST'>
                                        <input type='submit' class="eliminar" name='<?php echo $r->id_articulo; ?>' value='Eliminar'>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    <?php
                    }     ?>
                </table>
            </div>
            <hr>


            <div class="editar" id="ventana">
                <div class="header_editar">
                    <h2>Editar articulo</h2>
                    <a href='javascript:cerrar()'><i class="far fa-times-circle"></i></a>
                </div>
                <div class="main_editar">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="text" name="id_articulo" value="<?php echo $r->id_articulo; ?>">
                        <input type="hidden" name="usuario_tienda" value="<?php echo $dato->correo_electronico ?>"><br>

                        <input type="hidden" name="id_tienda" value="<?php echo $r->id_tienda; ?>"><br>

                        <label>Nombre del articulo:</label><input type="text" name="nombre_articulo" value="<?php echo $r->nombre_articulo; ?>"><br>
                        <label>Tipo:</label>
                        <select name="tipo_articulo">
                            <option selected><?php echo $r->tipo; ?></option>
                            <option value="sombrero">Sombrero</option>
                            <option value="camisa-camiseta">Camisa/camiseta</option>
                            <option value="pantalon">Pantalon</option>
                            <option value="zapato">Zapatos</option>
                        </select><br>
                        <label>Precio:</label> <input type="number" name="precio" value="<?php echo $r->precio; ?>"><br>
                        <label>Tallas:</label> <input type="text" name="tallas" value="<?php echo $r->tallas; ?>"><br>
                        <label>Cantidad disponible:</label> <input type="number" name="cantidad" value="<?php echo $r->cantidad_disponible; ?>"><br>
                        <label>Colores:</label> <input type="text" name="colores" value="<?php echo $r->colores; ?>"><br>
                        <label>Sexo</label>
                        <select name="sexo">
                            <option selected><?php echo $r->sexo; ?></option>
                            <option value="mujer">Mujer</option>
                            <option value="hombre">Hombre</option>
                            <option value="ambos">Ambos</option>
                        </select><br>
                        <label>Caracteristicas:</label> <input type="text" name="caracteristicas" value="<?php echo $r->caracteristicas; ?>"><br>

                        <input type="hidden" name="imagen" value="<?php echo $r->img_articulo; ?>"><br>
                        <input type="submit" value="Actualizar" name="actualizar">
                    </form>
                <?php
            }     ?>
                </div>

            </div>
            <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

            <div class="ingreso">
                <form action="" method="POST" enctype="multipart/form-data">
                    <h2>Ingresar nuevo articulo</h2><br>
                    <input type="hidden" name="usuario_tienda" value="<?php echo $dato->correo_electronico ?>">
                    <input type="hidden" name="id_tienda" value="<?php echo $dato->id_tienda ?>">
                    <input placeholder="Nombre del articulo" type="text" name="nombre" required>
                    <select name="tipo_articulo" required>
                        <option selected disabled>Tipo de articulo</option>
                        <option value="sombrero">Sombrero</option>
                        <option value="camisa-camiseta">Camisa/camiseta</option>
                        <option value="pantalon">Pantalon</option>
                        <option value="zapato">Zapatos</option>
                    </select>
                    <input placeholder="Precio" type="number" name="precio" required>
                    <input placeholder="Tallas" type="text" name="tallas" required>
                    <input placeholder="Cantidad disponible" type="number" name="cantidad" required>
                    <input placeholder="Colores" type="text" name="colores" required>
                    <select name="sexo" required>
                        <option selected disabled>Sexo</option>
                        <option value="mujer">Mujer</option>
                        <option value="hombre">Hombre</option>
                        <option value="ambos">Ambos</option>
                    </select>
                    <input placeholder="Caracteristicas del producto" type="text" name="caracteristicas" required>
                    <input type="file" name="imagen" accept="image/*" required><br>
                    <input type="submit" value="Guardar datos" name="guardar"><br>
                </form>
            </div>
            <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

            <div class="editar" id="imagen">
                <div class="header_editar">
                    <h2>Editar articulo</h2>
                    <a href='javascript:cerrarIMG()'><i class="far fa-times-circle"></i></a>
                </div>
                <div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="usuario_tienda" value="<?php echo $dato->correo_electronico ?>"><br>
                        <input type="hidden" name="id_articulo" value="<?php echo $r->id_articulo; ?>">
                        <label>Ingres una nueva imagen del producto</label>
                        <input type="file" name="imagen" accept="image/*"><br>
                        <input type="submit" value="Actualizar" name="actualizar_img">
                    </form>
                </div>
            </div>

            <!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


            <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


            <?php
            if ($_POST) {

                if (isset($_POST["guardar"])) {
                    $imagen = $_FILES['imagen']['name'];
                    $nom_temp = $_FILES['imagen']['tmp_name'];
                    $obj->cargardatos_articulos(
                        $_POST["id_tienda"],
                        $_POST["nombre"],
                        $_POST["tipo_articulo"],
                        $_POST["precio"],
                        $_POST["tallas"],
                        $_POST["cantidad"],
                        $_POST["colores"],
                        $_POST["sexo"],
                        $_POST["caracteristicas"],
                        $imagen,
                        $nom_temp
                    );
                    $obj->guardar_articulo();
                    $usuario = $_POST["usuario_tienda"];
                    echo "<script> 
            alert('se guardaron los datos'); 
            window.location='inicio_tiendas.php?id=$usuario'; 
          </script>";
                }

                if (isset($_POST["actualizar"])) {
                    $imagen = $_FILES['imagen']['name'];

                    $obj->cargardatos_articulos(
                        $_POST["id_tienda"],
                        $_POST["nombre_articulo"],
                        $_POST["tipo_articulo"],
                        $_POST["precio"],
                        $_POST["tallas"],
                        $_POST["cantidad"],
                        $_POST["colores"],
                        $_POST["sexo"],
                        $_POST["caracteristicas"],
                        $_POST["imagen"],
                        $_POST["imagen"]
                    );
                    $obj->actualizar($_POST["id_articulo"]);
                    $usuario = $_POST["usuario_tienda"];
                    echo "<script> 
            alert('se guardaron los datos'); 
            window.location='inicio_tiendas.php?id=$usuario'; 
          </script>";
                }

                if (isset($_POST["actualizar_img"])) {
                    $imagen = $_FILES['imagen']['name'];
                    $nom_temp = $_FILES['imagen']['tmp_name'];
                    $obj->cargar_imagen($imagen, $_POST["id_articulo"], $nom_temp);
                    $usuario = $_POST["usuario_tienda"];
                    echo "<script> 
            alert('Se actualizao la imagen'); 
            window.location='inicio_tiendas.php?id=$usuario'; 
          </script>";
                }
            }
            ?>
        </main>
        <script src="app_tienda.js"></script>
</body>

</html>