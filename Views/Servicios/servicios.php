<?php 
headerPrincipal($data); 
$arrServicio = $data['servicio']; //este trae todo el array(elementos) que va tener la tabla producto en html poedemos sacarlo de apacos (nombre, precio, descropcion)
?>

<style>
    /* Estilos generales */
    * {
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      margin: 0;
    }

    /* Contenedor principal */
    .container {
      width: 90%;
      margin: auto;
    }

    /* Títulos */
    h1 {
      text-align: center;
      margin-top: 50px;
    }

    h2 {
      margin-top: 50px;
    }

    /* Tarjetas de producto */
    .card {
      border: 1px solid #ccc;
      padding: 20px;
      margin: 20px;
      float: left;
      width: 30%;
    }

    .card img {
      max-width: 100%;
      height: auto;
    }

    .card h3 {
      margin-top: 0;
    }

    .card p {
      margin: 10px 0;
    }

    /* Clearfix para solucionar el float */
    .clearfix::after {
      content: "";
      clear: both;
      display: table;
    }

    /* Media queries para hacer el diseño responsive */
    @media only screen and (max-width: 768px) {
      .card {
        width: 48%;
      }
    }

    @media only screen and (max-width: 480px) {
      .card {
        width: 100%;
      }
    }

    .boton {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 8px;
}
#detalle-servicio .row {
  height: calc(100vh - 100px);
  align-items: center;
}

.detalle-servicio {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(255, 255, 255, 0.9);
  z-index: 1;
  text-align: center;
  padding-top: 20px;
}

.detalle-servicio img {
  max-width: 100%;
  max-height: 100%;
}

  </style>



  <div class="container">
  <h1>Seleccionar servicios</h1>

  <?php foreach ($arrServicio as $servicio) { ?>

    <div class="card" onclick="mostrarDetalle(<?php echo $servicio['id_servicio']; ?>)">
      <img src="<?php echo $servicio['url_imagen']; ?>" alt="<?php echo $servicio['nom_servicio']; ?>">
      <br>
      <h3 style="text-align: center;"><?php echo $servicio['nom_servicio']; ?></h3>
   
    <!--
      <a href="<php echo BASE_URL . 'catalogo/servicio/' . urlencode($servicio['nom_servicio']) . '/' . $servicio['id_servicio']; ?>">Info del servicio</a>
  -->

      <a href="<?= base_url() ?>/servicios/info/<?= $servicio['id_servicio'].'/'.$servicio['ruta']; ?>" class="mi-boton">
      
     
      Info del servicio
      </a>


    </div>
  <?php } ?>
  

  <div style="display: none;">
    <div class="row">


    </div>
  </div>
</div>


<script> 


</script>

<br>
<?php
footerPrincipal($data); 
?>

   <script type="text/javascript" src="<?= media();?>/js/prueba.js"></script>



