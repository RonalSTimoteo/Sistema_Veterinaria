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

/*PINTA EN GRIS LOS DOMINGOS */
.fc-day-sun {
  background-color: #999999;
}

.fc-day-today {
  background-color: gray !important;
}

.fc-daygrid-day.fc-day.fc-day-fri.fc-day-past .fecha-bloqueada {
  background-color: gray !important;
}
/*ESTO LE DA COLOR GRIS A LAS CELDAS CON FECHAS BLQ DE LA BD */
.fc-event {
  background-color: 'rgb(153, 153, 153)';
}

</style>

</head>
<body>
  <!--RECORDAR QUE ESTE ARCHIVO ES LA VISTA DE CALENDARIO-->
<?php
//TRAE EL HEADER 
headerPrincipal($data); 
?>

<!-- 
  ACA SE DIBUJA EL CALENDARIO(VISTA) EN LA RUTA http://localhost/prueba_veterinaria/calendario-->
  <div id='script-warning'>
    <code>ics/feed.ics</code> must be servable
  </div>

  <div id='loading'>loading...</div>
  <div id='calendar'></div>
 

<!--Boton del modal-->
  <div class="text-center mb-3">
    <button type="button" class="btn btn-primary" id="selected-date-btn">
      Agendar hora
    </button>
  </div>

<script> 

var fechas_bloqueadas = [];

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    locale: 'es',
    displayEventTime: false,
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth'
    },


    events: function (fetchInfo, successCallback, failureCallback) {
      // Hacer la llamada Ajax para obtener las fechas bloqueadas
      $.ajax({
        url: 'http://localhost/prueba_veterinaria/calendario/fechas_bloqueadas',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          // Almacenar fechas bloqueadas en variable
          fechas_bloqueadas = data;
          console.log(data);

      // Crear la lista de eventos del calendario
      var eventos = [
        {
          title: 'Evento 1',
          start: '2023-04-01'
        },
        {
          title: 'Evento 2',
          start: '2023-04-05'
        }
      ];

                // Llamar a la función de callback con los eventos
        successCallback(eventos.concat(fechas_bloqueadas.map(function(fecha_bloqueada) {
            return {
              title: '',
              start: fecha_bloqueada,
              display: 'background',
              editable: false,
              classNames: ['fecha-bloqueada']
            };
          })));
        },

          // Llamar a la función callback con los eventos del calendario
      error: function () {
      // Llamar a la función de callback con un array vacío en caso de error
      successCallback([]);
    }
      });
    },

    eventRender: function(info) {
  if (info.event.className.includes('fecha-bloqueada')) {
    //EL Q LE DA COLOR AL FONDO DE LA CELDA
    info.el.style.backgroundColor = 'rgb(128, 128, 128)';
    info.el.style.pointerEvents = 'none';
  }
},


    loading: function(bool) {
      document.getElementById('loading').style.display =
        bool ? 'block' : 'none';
    },
  }); //cierra FullCalendar


    calendar.render();

});//cierra el DOMContentLoaded





//----------------------------------------
//SELECCIONAR UN DIA DEL LADO DEL USUARIO 
//----------------------------------------
var selectedCell = null;

//TODOS LOS DIAS Q SON DOMINGO NO SE PODRAN HACER CLICK 
$(document).on("click", ".fc-daygrid-day", function() {
  // verificar si la celda seleccionada es un domingo
  if ($(this).hasClass("fc-day-sun")) {
    return; // no hacer nada si el día seleccionado es un domingo
  }




  // despintar la celda anterior / sino se queda marcada la celda se selecciono
  if (selectedCell !== null) {
    selectedCell.css("background-color", "");
  }


  // pintar la nueva celda seleccionada - lo pinta de color verde 
  $(this).css("background-color", "green");
  selectedCell = $(this);


});






//SE REFLEJA EN FORMULARIO LA FECHA SELECCCIONADA
$("#selected-date-btn").click(function() {
  // mostrar una alerta con la fecha seleccionada
  if (selectedCell !== null) {
    var dateStr = selectedCell.attr("data-date"); // obtener la fecha de la celda seleccionada
    var selectedDate = moment(dateStr); // convertir la cadena de fecha a un objeto moment
    var formattedDate = selectedDate.format("DD/MM/YYYY"); // formatear la fecha como "DD/MM/YYYY"
    document.getElementById("fecha_cita").value=formattedDate;
    $('#exampleModal').show();
    //alert("Fecha seleccionada: " + formattedDate); // mostrar una alerta con la fecha seleccionada
  } else {
    $('#exampleModal2').show();
  }
});

//----FIN SELECCION USUARIO----------
$(document).on('click','#cerrar',function(){
  $('#exampleModal').hide();
  $('#exampleModal2').hide();
})

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
<?php
footerPrincipal($data); 
?>
</body>
<script src="<?= media();?>/js/bienvenida.js"></script>
<script src="<?= media(); ?>/js/functions_citas.js"></script>
</html>
