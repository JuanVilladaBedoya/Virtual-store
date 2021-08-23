<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>	
    <link rel="stylesheet" href="estilos_indexUsuarios.css">
    <link rel="icon" href="static/img/logo.ico">
    <script src="https://kit.fontawesome.com/e0faf94ce0.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<?php
    $usuario = $_REQUEST['id'];
    require_once("crud.php");
    $obj = new Usuario(); 
    $obj->conectar(); //  funcion que esta en la clase
    
    ?>
    <div class="body">
    <header>
        <div class="">
            <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Virtual Store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav w-100 justify-content-center ">
        <a class="nav-link active" aria-current="page" href="index.php">Casa</a>
        <a class="nav-link" href="contacto.php">Contacto</a>
        <a class="nav-link" href="tiendas.php">Tiendas</a>
        <a class="nav-link" href="login_tienda.php">Registrate</a>
        
        <a class="nav-link" href="login.php">Ingresar</a>
       
      </div>
    </div>
  </div>
  
</nav>
        </div>
        </div>
    </header>
    <main>
        <div class="linea">
        </div>
        <div class="container-slider">
            <div class="slider" id="slider">
                <div class="slider__section">
                    <img src="img/imagen5.jpg" alt="" class="slider__img">
                </div>
                <div class="slider__section">
                    <img src="img/imagen2.jpg" alt="" class="slider__img">
                </div>
                <div class="slider__section">
                    <img src="img/imagen3.jpg" alt="" class="slider__img">
                </div>
                <div class="slider__section">
                    <img src="img/imagen6.jpg" alt="" class="slider__img">
                </div>
            </div>
            <div class="slider__btn slider__btn--right" id="btn-right">&#62;</div>
            <div class="slider__btn slider__btn--left" id="btn-left">&#60;</div>
        </div>
        <script src="slaider.js"></script>
        <div class="linea">
        </div>
    <?php foreach($obj->mostrar_info_articulo()as $r){
    ?>
    <div class="card" style="width: 18rem;">
        <img src="static/img_articulo/<?php echo $r->img_articulo; ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?php echo $r->nombre_articulo; ?></h5>
            <p>$<?php echo $r->precio; ?></p>
            <p>Tallas disponibles: <?php echo $r->tallas; ?></p>
            <p>Caracteristicias:</p>
            <p class="card-text"><?php echo $r->caracteristicas; ?></p>
            <a href="#" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Añadir a la canasta</a>
        </div>
    </div>
    <?php } ?>
</main>
</div>
<div class="linea"></div>

        <footer>
            <p>Copyrigh</p>
        </footer>
</body>
</html>