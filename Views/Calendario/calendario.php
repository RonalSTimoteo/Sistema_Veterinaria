<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/bootstrap2.min.css">
<script type="text/javascript" src="<?= media();?>/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/calendar.css">
<link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">
<script type="text/javascript" src="<?= media();?>/js/calendar.js"></script>
<script type="text/javascript" src="<?= media();?>/js/locales-all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script src="<?= media();?>/js/jquery.min.js"></script>

<style>

/*PINTA EN GRIS LOS DOMINGOS

.fc-day-sun {
  background-color: #999999;
}
*/
/*
.fc-day.dia-bloqueado {
  background-color: red !important;
}
*/

.dia-bloqueado {
  background-color: #FFC1C1 !important;
  pointer-events: none;
}


/*
#calendar {
  width: 50%;
  height: 620px;
  margin: 0 auto;
}
*/
#calendar {
  width: 100%;
  max-width: 600px;
  height: 500px;
  margin: 0 auto;
}



@media (max-width: 768px) {
  #calendar {
    font-size: 12px;
    height: 400px;
  }
}

@media (max-width: 576px) {
  #calendar {
    font-size: 10px;
    height: 300px;
  }
}

.fc-header-toolbar {
  padding: 5px;
}

.fc-daygrid-button {
  font-size: 14px;
  padding: 5px 10px;
}

#selected-date-btn {
  font-size: 14px;
  padding: 10px 20px;
}

.domingo {
  background-color: yellow;
}

.fc-bgevent {
  background-color: red;
  opacity: 0.5;
}

</style>

</head>
<body>
  <!--RECORDAR QUE ESTE ARCHIVO ES LA VISTA DE CALENDARIO-->
<?php
//TRAE EL HEADER 
headerPrincipal($data); 
?>
<br>
<!-- 
  ACA SE DIBUJA EL CALENDARIO(VISTA) EN LA RUTA http://localhost/prueba_veterinaria/calendario-->
  <div id='script-warning'>
    <code>ics/feed.ics</code> must be servable
  </div>

  <div id='loading'>loading...</div>
  <div id='calendar'></div>
 
<br>
<!--Boton del modal-->
  <div class="text-center mb-3">
    <button type="button" class="btn btn-primary" id="selected-date-btn">
      Agendar hora
    </button>
  </div>

  <script>
  // Variables de fecha de bloqueo
  var diasSemana = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
  var diasBloqueadosNum = [0, 1, 2, 3, 4, 5, 6];
  var fechasBloqueadas = [];
  var selectedDate;

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      // Opciones del calendario
    });

    // Llamada a la primera URL para recuperar el primer array
    $.getJSON('http://localhost/prueba_veterinaria/calendario/dias_bloqueados', function(data) {
      diasBloqueadosNum = data.map(dia => diasSemana.indexOf(dia));
      console.log(diasBloqueadosNum);

      // Renderizar el calendario
      calendar.render();
    });

    // Llamada a la segunda URL para recuperar el segundo array
    $.getJSON('http://localhost/prueba_veterinaria/calendario/fechas_bloqueadas', function(data) {
      fechasBloqueadas = data;
      console.log(fechasBloqueadas);

      // Ejecutar la función para bloquear días
      calendar.setOption('dayCellDidMount', bloquearDias);
    });

    // Función para bloquear días
    function bloquearDias(info) {
      // Crear un nuevo objeto Date con el año, mes y día de la fecha actual
      var fechaActual = new Date(info.date.getFullYear(), info.date.getMonth(), info.date.getDate());

      // Obtener el día de la semana de la nueva fecha
      var diaSemana = fechaActual.getDay();

      // Bloquear los días correspondientes
      if (diasBloqueadosNum.indexOf(diaSemana) !== -1) {
        info.el.style.backgroundColor = '#999999';
      }

      // Bloquear las fechas correspondientes
      var fechaStr = moment(info.date).format('YYYY-MM-DD');
      if (fechasBloqueadas.indexOf(fechaStr) !== -1) {
        info.el.style.backgroundColor = '#999999';
      }
    }

    //----------------------------------------
    //SELECCIONAR UN DIA DEL LADO DEL USUARIO 
    //----------------------------------------
    var selectedCell = null;
    $(document).on("click", ".fc-daygrid-day", function() {
      selectedDate = moment($(this).data('date'));

      if (diasBloqueadosNum.indexOf(selectedDate.day()) !== -1) {
        return; // no hacer nada si el día seleccionado está bloqueado
      }

      // des-pintar la celda anterior
      if (selectedCell !== null) {
        selectedCell.css("background-color", "");
      }

      // pintar la nueva celda seleccionada
      $(this).css("background-color", "green");
      selectedCell = $(this);
    });
  });
</script>
  



<!-- Modal para registrar la cita-->
<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:white; ">
      <div class="modal-header" style="background:#5499C7;">
        <h5 class="modal-title" id="exampleModalLabel" style="color:white; font-size:24px">Registrado con exito</h5>
        
      </div>
      <div class="modal-body" style="color:black; font-size:20px">

 <!-- FORMULARIO -->     
      <form id="generar_cita" name="generar_cita">

        <div class="form-group">
          <label for="text">Fecha de cita :</label>
          <input type="text" class="form-control" id="fecha_cita" readonly>
        </div>

        <div class="form-group">
          <label for="text">Nombre :</label>
          <!-- 
          <input type="text" class="form-control" id="nombre" value="Juanita Balenciaga" readonly>
         -->
        <input  type="text" id="nombre" name="nombre" placeholder="Nombre completo" >
        </div> 

  <!-- ARE DE TRABAJO -->
        <div class="form-group">
          <label for="email">Email :</label>
          <!--
          <input type="email" class="form-control" id="email" value="juanita@gmail.com" readonly>
        -->
        <input  type="email" id="email" name="email" placeholder="email@example.com"  >
        </div>



        <div class="form-group">
          <label for="text">Servicio:</label>
          <input type="text" class="form-control" id="pwd" value="Baño de mascota" readonly>
        </div>

        <div class="form-group">
          <label for="email">Seleccione hora de cita:</label>
          <select class="form-control">
            <option value="">9:00am - 10:00am</option>
            <option value="">10:00am - 11:00am</option>
            <option value="">11:00am - 12:00pm</option>
            <option value="">12:00pm - 1:00pm</option>
            <option value="">1:00pm - 2:00pm</option>
            <option value="">2:00pm - 3:00pm</option>
            <option value="">3:00pm - 4:00pm</option>
            <option value="">4:00pm - 5:00pm</option>
          </select>
        </div>

        <div class="checkbox">
          <label><input type="checkbox"> Aceptar acuerdos y condiciones</label>
        </div>


<!-- ARE DE TRABAJO -->
        <div class="p-t-18">
							<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								Enviar cita
							</button>
						</div>

      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" style="margin:auto" data-bs-dismiss="modal" aria-label="Close" id="cerrar">Ok</button>
      </div>
    </div>
  </div>
</div>

<!--modal alerta de fecha no seleccionada-->
<div class="modal" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:white; ">
      <div class="modal-header" style="background:#E52222;">
        <h5 class="modal-title" id="exampleModalLabel" style="color:white; font-size:24px">Alerta</h5>
        
      </div>
      <div class="modal-body" style="color:black; font-size:20px">
        No ha seleccionado ninguna fecha!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" style="margin:auto" data-bs-dismiss="modal" aria-label="Close" id="cerrar">Ok</button>
      </div>
    </div>
  </div>
</div>
<br>

<?php

footerPrincipal($data); 

?>

</body>
<script src="<?= media();?>/js/bienvenida.js"></script>
<script src="<?= media(); ?>/js/functions_citas.js"></script>
</html>
