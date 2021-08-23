<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ingresar nuevo usario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="estilos_login.css">
<link rel="icon" href="static/img/logo.ico">
</head>
<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
<h1>Ingresar datos</h1>
    <form action="login_usuario.php" method="POST">
    <input type="number" required name="cedula" placeholder="Ingresar numero de documeto">
    <input type="text" name="nom" required placeholder="Nombres ">
    <input type="text" name="ape" required placeholder="Apellidos">
    <input type="number" name="edad" required placeholder="Edad">
    <input type="number" name="tel" required placeholder="Numero de Telefono">
    <input type="text" name="dire" required placeholder="Direccion de recidencia">
    <input type="text" name="correo" required placeholder="Correo electrónico">
    <input type="password" name="contraseña" required placeholder="Ingresar contraseña">
    <input type="submit" value="Guardar datos" name="guardar"> <br><br>
    </form>
    </div>
    </div>
<?php 
if($_POST){
    require_once ("crud.php"); // require lo mismo que el include
    $obj = new Usuario(); // creo objeto
    $obj->conectar(); //  funcion que esta en la clase

if (isset($_POST["guardar"])) {
     $obj->cargardatos_usuarios($_POST["cedula"], $_POST["nom"], $_POST["ape"], $_POST["edad"], $_POST["tel"], $_POST["dire"], $_POST["correo"], $_POST["contraseña"]);
      $obj->guardar_usuario();  
}
if (isset($_POST["consultar"])){
	echo "<br><table border='1'>
           <thead> <tr> 
            <th> 
            código </th>
            <th> Nombre </th>
            <th colspan='2'> Acciones </th>
           </tr> 
           </thead>";
	foreach ($obj->consultar() as $r) {	
        echo "<tbody>
        <tr>  
         <td>$r->codigo</td>
        <td>$r->nombre</td>
        <td>   
        <form action = 'vista.php' method = 'POST'>
          <button type = 'submit' name='mostrar' value='$r->codigo'>mostrar información</button>
        </form>     
        
        </td> 
        <td>   
        <form action = 'editar.php' method = 'POST'>
          <button type = 'submit' name='actualizar' value='$r->codigo'>Editar</button>
        </form>     
        
        </td> 
        </tr></tbody>";
	} 	echo"</table>";
}
if (isset(($_POST["mostrar"]))) {
    echo "<br><table border='1'>
           <thead>  <tr>   
               <th>código</th> 
                <th>Nombre</th>
                 <th>Salario</th>
                 <th>Fecha</th>
		   </tr> </thead>";
           foreach ($obj->mostrar($_POST["mostrar"]) as $r) {	
            echo "<tbody> <tr>
            <td>$r->codigo</td>
            <td>$r->nombre</td>
            <td>$r->salario</td>
            <td>$r->fecha</td>
            </tr></tbody>";  
        }
        echo"</table>";
	}	
}
?>
</body>
</html>
