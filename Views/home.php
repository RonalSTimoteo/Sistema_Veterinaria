<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portafolio</title>
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/bootstrap2.min.css">
  <script type="text/javascript" src="<?= media();?>/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color:#C9C9C9">
<?php
headerPrincipal($data); 
?>

<div id="demo" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
  </div>
  
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?= media(); ?>/images/imgs1.jpg" alt="Imagen Futurista 1" class="ratio ratio-21x9">
    </div>
    <div class="carousel-item">
      <img src="<?= media(); ?>/images/imgs2.jpg" alt="Imagen Futurista 2" class="ratio ratio-21x9">
    </div>
    <div class="carousel-item">
      <img src="<?= media(); ?>/images/imgs3.jpg" alt="Imagen Futurista 3" class="ratio ratio-21x9">
    </div>
    <div class="carousel-item">
      <img src="<?= media(); ?>/images/imgs4.jpg" alt="Imagen Futurista 4" class="ratio ratio-21x9">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>
<main>
  <div id="contenedor">
  </div>
</main>
<?php
footerPrincipal($data); 
?>
<script src="<?= media();?>/js/jquery.min.js"></script>
<script src="<?= media();?>/js/bienvenida.js"></script>
</body>
</html>