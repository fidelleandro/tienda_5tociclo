<?php
  require 'server/Db.php';
  $db = new Db();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <link rel="stylesheet" href="public/css/default.css">
    <title></title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="public/images/logo.png" alt="">
          <div class="">
            Tienda
          </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">PRESENTACIÓN</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">INFORMACIÓN</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                PRODUCTOS
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">arroz</a></li>
                <li><a class="dropdown-item" href="#">azucar</a></li>
                <li><hr class="dropdown-divider">aceite</li>
                <li><a class="dropdown-item" href="#">mantequia</a></li>
                <li><a class="dropdown-item" hreh="#">gelatina</a></li>
              </ul>
            </li>
          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Buscar producto" aria-label="Search">
            <button class="btn btn-outline-success" id="boton_buscar" type="submit">BUSCAR</button>
          </form>
        </div>
      </div>
    </nav>
    <div id="carrusel_productos">
      <div class="carrusel">
        <div><img class="img-fluid" src="public/images/carrusel/1.jpg"></div>
        <div><img class="img-fluid" src="public/images/carrusel/4.jpg"></div>
      </div>
    </div>
    <h4>PRODUCTOS</h4>
    <?php
        $productos = $db->listarDatos('SELECT * FROM producto');
        foreach ($productos as $key => $producto) {
          echo $producto->nombre.' ';
        }
    ?>
    <div class="productos">
      <div class="row">
         <div class="col-5">
           <img class="img-fluid" src="public/images/productos/1.jpg" alt="">
         </div>
         <div class="col-3">
           <img class="img-fluid" src="public/images/productos/2.jpg" alt="">
           <img class="img-fluid" src="public/images/productos/1.jpg" alt="">
         </div>
         <div class="col-4">
           <img class="img-fluid" src="public/images/productos/3.jpg" alt="">
         </div>
      </div>
      <div class="row">
        <div class="col-12">
           <img class="img-fluid" src="public/images/productos/3.jpg" alt="">
         </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <script>
      $('.carrusel').bxSlider({
        slideMargin:0,
        mode: 'horizontal',
        captions: true,
        easing : 'swing',
        auto : true,
        pause : 8000,
        infiniteLoop : true,
        speed: 100,
        slideWidth: 0,
        responsive : true
      });
    </script>
  </body>
</html>
