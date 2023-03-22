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
</head>
<body>
<?php
headerPrincipal($data); 
?>
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
 //variable de fecha de bloqueo   
  var bloqueo = '2023-03-10';
  //propiedades de fullCalendar
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

      dayCellDidMount: function(info) {
        if (info.date.getDay() === 0) { 
                info.el.style.backgroundColor = "#999999";
            }
        },

      events: {
        url: 'ics/feed.ics',
        format: 'ics',
        failure: function() {
          document.getElementById('script-warning').style.display = 'block';
        }
      },

      loading: function(bool) {
        document.getElementById('loading').style.display =
          bool ? 'block' : 'none';
      },
    });

    calendar.setOption('datesSet', function(info) {
      $('.fc-day[data-date="' + bloqueo + '"]').css('background-color', '#999999');
    });

      calendar.render();
    });
//----------------------------------------
//SELECCIONAR UN DIA DEL LADO DEL USUARIO
//----------------------------------------
var selectedCell = null;
$(document).on("click", ".fc-daygrid-day", function() {
  // verificar si la celda seleccionada es un domingo
  if ($(this).hasClass("fc-day-sun")) {
    return; // no hacer nada si el día seleccionado es un domingo
  }
  // verificar si la celda seleccionada es el 25 de marzo
   if ($(this).data("date") === bloqueo) {
    return; // no hacer nada si la fecha seleccionada es el 25 de marzo
  }
  // des-pintar la celda anterior
  if (selectedCell !== null) {
    selectedCell.css("background-color", "");
  }
  // pintar la nueva celda seleccionada
  $(this).css("background-color", "green");
  selectedCell = $(this);
});

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
      <form action="/action_page.php">

        <div class="form-group">
          <label for="text">Fecha de cita :</label>
          <input type="text" class="form-control" id="fecha_cita" readonly>
        </div>

        <div class="form-group">
          <label for="text">Nombre :</label>
          <input type="text" class="form-control" id="nombre" value="Juanita Balenciaga" readonly>
        </div>
  
        <div class="form-group">
          <label for="email">Email :</label>
          <input type="email" class="form-control" id="email" value="juanita@gmail.com" readonly>
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

        <button type="submit" class="btn btn-default">Submit</button>
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
</html>
