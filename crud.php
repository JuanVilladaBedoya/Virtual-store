<?php 
class sesion {
    function __construct() {
       session_start ();
    }
  
    public function set($nombre, $valor) {
       $_SESSION [$nombre] = $valor;
    }
  
    public function get($nombre) {
       if (isset ( $_SESSION [$nombre] )) {
          return $_SESSION [$nombre];
       } else {
           return false;
       }
    }
}
class Usuario {
    public $cedula;
    public $nombre; 
    public $apellido; 
    public $edad;
    public $telefono;
    public $direccion;
    public $correo;

function cargardatos_usuarios($cedula, $nom, $ape, $edad, $tel, $dire, $correo, $contraseña){ // set cargar datos
    $this->cedula = $cedula;
    $this->nombre = $nom;
    $this->apellido = $ape;
    $this->edad = $edad; 
    $this->telefono = $tel; 
    $this->direccion = $dire;
    $this->correo = $correo;
    $this->contraseña = $contraseña;
}

function cargardatos_tienda($nom_tienda, $nom_prop, $documento, $tel, $dire, $correo, $contraseña){ // set cargar datos
    $this->nombre_tienda = $nom_tienda;
    $this->nombre_propietario = $nom_prop;
    $this->documento = $documento;
    $this->telefono = $tel; 
    $this->direccion = $dire;
    $this->correo = $correo;
    $this->contraseña = $contraseña;
}

function cargardatos_articulos($id_tienda, $nombre, $tipo_articulo, $precio, $tallas, $cantidad, $colores, $sexo, $caracteristicas, $imagen, $nom_temp){ // set cargar datos
    $this->id_tienda = $id_tienda;
    $this->nombre_articulo = $nombre;
    $this->tipo_articulo = $tipo_articulo;
    $this->precio = $precio;
    $this->tallas = $tallas; 
    $this->cantidad = $cantidad;
    $this->colores = $colores;
    $this->sexo = $sexo;
    $this->caracteristicas = $caracteristicas;
    $this->imagen = $imagen;
    $this->nom_temp = $nom_temp;
}

function cargar_imagen($imagen, $id_articulo, $nom_temp){
    $this->imagen = $imagen;
    $this->id_articulo = $id_articulo;
    $this->nom_temp = $nom_temp;
    $sql = "UPDATE articulos SET  img_articulo = ? where id_articulo = ?";
        $this->pdo->prepare($sql)->execute([
            $this->imagen,
            $this->id_articulo 
        ]);
    move_uploaded_file($this->nom_temp,'static/img_articulo/'.$this->imagen);
}

function conectar(){
    try { // para errores similar al if
        $this->pdo = new PDO("mysql:host=localhost;dbname=proyecto final;charset=utf8", 
        "root", ""); // super admin
        $this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      }
      catch(PDOException $e) { // si hay error
          echo "Se ha producido un error al intentar conectar al servidor MySQL: ".$e->getMessage();
      }
}
function guardar_usuario(){
    $sql = "INSERT INTO usuario (id_usuario, clave, nombre, apellidos, edad, numero_telefono, direccion, correo_electronico) VALUES (?,?,?,?,?,?,?,?)";
     if($this->pdo->prepare($sql)->execute([
         $this->cedula, 
         $this->contraseña,  
         $this->nombre,
         $this->apellido,
         $this->edad,
         $this->telefono,
         $this->direccion,
         $this->correo
     ]))
     echo'<script type="text/javascript">
     alert("Usuario guardad<br>Su numero de cedula es el usuario");
     window.location.href="login.php";
     </script>';
        //{ echo "Registro insertado correctamente en la base";    }
}

function guardar_tienda(){
    $sql = "INSERT INTO tiendas (nombre_tienda, nombre_propietario, id_propietario, direccion_tienda, correo_electronico, telefono, contraseña) VALUES (?,?,?,?,?,?,?)";
     if($this->pdo->prepare($sql)->execute([
        $this->nombre_tienda,
        $this->nombre_propietario,
        $this->documento,
        $this->direccion,
        $this->correo,
        $this->telefono,
        $this->contraseña
     ]))
     
     echo'<script type="text/javascript">
     alert("Usuario guardado<br>Su numero de cedula es el usuario");
     window.location.href="login.php";
     </script>';
        //{ echo "Registro insertado correctamente en la base";    }
}

function guardar_articulo(){
    $sql = "INSERT INTO articulos (id_tienda, nombre_articulo, tipo, precio, tallas, cantidad_disponible, colores, sexo, caracteristicas, img_articulo) VALUES (?,?,?,?,?,?,?,?,?,?)";
     if($this->pdo->prepare($sql)->execute([
        $this->id_tienda,
        $this->nombre_articulo,
        $this->tipo_articulo,
        $this->precio,
        $this->tallas,
        $this->cantidad,
        $this->colores,
        $this->sexo,
        $this->caracteristicas,
        $this->imagen
     ]))
     move_uploaded_file($this->nom_temp,'static/img_articulo/'.$this->imagen);
}

function datos_tienda($usuario_tienda){
    $this->usuario_tienda = $usuario_tienda;
    $resultado = $this->pdo->prepare('SELECT * FROM tiendas where correo_electronico = ?');
	$resultado->execute([$this->usuario_tienda]);
	return $resultado->fetchAll(PDO::FETCH_OBJ);
}

//function nombre_ususario($usuario){
  //  $this->usuario = $usuario;
    //$resultado = $this->pdo->prepare('SELECT nombre FROM usuario WHERE correo_electronico = ?');
    //$resultado->execute([$this->usuario]);
    //$nombre = $resultado->fetch(PDO::FETCH_OBJ);
    //return  $nombre[0]->nombre;
//}

function mensaje($usuario_tienda){
    //$this->usuario_tienda = $usuario_tienda;
    echo'<script type="text/javascript">
     alert("Se a registrado correctamente el articulo");
     </script>'; 
     //header("location: inicio_tiendas.php?id=$usuario_tienda");
}

function consultar($id_tienda){
    $this->id_tienda = $id_tienda;
    $resultado = $this->pdo->prepare('SELECT * FROM articulos where id_tienda = ?');
	$resultado->execute([$this->id_tienda]);
	return $resultado->fetchAll(PDO::FETCH_OBJ);
}

function mostrar_info_articulo(){
    $resultado = $this->pdo->prepare('SELECT * FROM articulos');
	$resultado->execute();
	return $resultado->fetchAll(PDO::FETCH_OBJ);
}

function mostrar($cod){
    $resultado = $this->pdo->prepare('SELECT * FROM articulos where id_articulo = ?');
	$resultado->execute([
        $cod
        ]);
	return $resultado->fetchAll(PDO::FETCH_OBJ);
}
    
function actualizar($id_articulo){
    $this->id_articulo = $id_articulo;
    $sql = "UPDATE articulos SET nombre_articulo = ?, tipo = ?, precio = ?, tallas = ?, cantidad_disponible = ?, colores = ?, 
    sexo = ?, caracteristicas = ?, img_articulo = ? where id_articulo = ?";
        $this->pdo->prepare($sql)->execute([
            $this->nombre_articulo,
            $this->tipo_articulo,
            $this->precio,
            $this->tallas,
            $this->cantidad,
            $this->colores,
            $this->sexo,
            $this->caracteristicas,
            $this->imagen,
            $this->id_articulo
        ]);
    }
}
?>


