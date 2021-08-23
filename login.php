<?php
	require_once("crud.php");

	$sesion = new sesion(); // iniciando sesion
	
	if( isset($_POST["iniciar"]) ) { // boton de ingreso
		
		$id_usuario = $_POST["usuario"];  // capturar datos
		$password = $_POST["clave"];
		
		if(validarUsuario($id_usuario,$password) == true) {			
			$sesion->set("id_usuario",$id_usuario);
			  header("location: inicio_usuario.php?id=$id_usuario", $id_usuario );
		} elseif (validarTienda($id_usuario,$password) == true){
			$sesion->set("id_usuario",$id_usuario);
			header("location: inicio_tiendas.php?id=$id_usuario", $id_usuario);
		}else{
			echo "<div class='alert alert-primary' role='alert'>
			verfica tu usuario y contraseña
		  </div>";
		}
	}
	
	function validarUsuario($id_usuario, $password)
	{
		$conexion = new mysqli("localhost","root","","proyecto final");
		$consulta = "select clave,correo_electronico from usuario where correo_electronico = '$id_usuario';";
		
		$result = $conexion->query($consulta);
		
		if($result->num_rows > 0)
		{
			$fila = $result->fetch_assoc();
			$sesion = new sesion();
            $sesion->set("correo_electronico",$fila["correo_electronico"]);
			if( strcmp($password,$fila["clave"]) == 0 ){
				return true;
			}
										
			else					
				return false;
		}
		else
				return false;
	}

	function validarTienda($id_usuario, $password)
	{
		$conexion = new mysqli("localhost","root","","proyecto final");
		$consulta = "select contraseña,correo_electronico from tiendas where correo_electronico = '$id_usuario';";
		
		$result = $conexion->query($consulta);
		
		if($result->num_rows > 0)
		{
			$fila = $result->fetch_assoc();
			$sesion = new sesion();
            $sesion->set("correo_electronico",$fila["correo_electronico"]);
			if( strcmp($password,$fila["contraseña"]) == 0 ){
				return true;
			}
										
			else					
				return false;
		}
		else
				return false;
	}

?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Virtual store</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>	
     <link rel="stylesheet" href="estilos_login.css">
	 <link rel="icon" href="static/img/logo.ico">
</head>
<body>

<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="static/img/logo.jfif" id="icon" alt="User Icon" />
    </div>
	<div class="registros">
    <!-- Login Form -->
    <form name="frmLogin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <input type="text" id="login" class="fadeIn second" name="usuario" placeholder="usuario">
      <input type="password" id="password" class="fadeIn third" name="clave" placeholder="password">
      <input type="submit" class="fadeIn fourth" name="iniciar" value="Iniciar Sesión">
	
	  
    </form>
	<div>
	<hr>
	<h3>Crear nueva cuenta como</h3>
	<a href="login_usuario.php"><input type="submit" class="fadeIn fourth" value="cliente"></a>
	<a href="login_tienda.php"><input type="submit" class="fadeIn fourth" value="tienda"></a>
	</div>
	</div>	
	</div>
</div>
</body>