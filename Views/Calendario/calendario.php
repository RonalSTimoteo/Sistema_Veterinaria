
<?php
//TRAE EL HEADER 
headerPrincipal($data); 
?>

<style>
/*Reducir dimension del calendario sin perder lo respondive*/
#calendar {
  width: 100%;
  max-width: 700px;
  height: 530px;
  margin: 0 auto;
}

</style>

<body>
  <!--RECORDAR QUE ESTE ARCHIVO ES LA VISTA DE CALENDARIO-->
<br>
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
      Reservar cita
    </button>
  </div>

  

  <script>
  // Variables de fecha de bloqueo

var diasSemana = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
var diasBloqueados = [0,1,2,3,4,5,6];
var fechasBloqueadas = [];
var selectedDate;
var selectedCell = null;

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    locale: 'es',
    
  });

  // Llamada a la primera URL para recuperar el primer array
  $.getJSON('http://localhost/Microempresas/calendario/dias_bloqueados', function(data) {
    // Asignar el valor obtenido a la variable diasBloqueados
    diasBloqueados = data;
    diasBloqueadosNum = diasBloqueados.map(dia => diasSemana.indexOf(dia));
    console.log(diasBloqueadosNum);

    // Llamada a la segunda URL para recuperar el segundo array
    $.getJSON('http://localhost/Microempresas/calendario/fechas_bloqueadas', function(data) {
      fechasBloqueadas = data;
      console.log(data);

    // Ejecutar la función para bloquear días
     bloquearDias({
      date: new Date(),
      el: document.createElement('div')
      });
  
      // Renderizar el calendario después de haber obtenido ambos arrays
      calendar.render();
    });
  });

  function bloquearDias(info) {
    // Crear un nuevo objeto Date con el año, mes y día de la fecha actual
    var fechaActual = new Date(info.date.getFullYear(), info.date.getMonth(), info.date.getDate());

    // Obtener el día de la semana de la nueva fecha
    var diaSemana = fechaActual.getDay();

    // Bloquear los días correspondientes
    if (diasBloqueadosNum.indexOf(diaSemana) !== -1 || fechasBloqueadas.indexOf(moment(info.date).format('YYYY-MM-DD')) !== -1) {
      info.el.style.backgroundColor = '#999999';
    }
  }

  calendar.setOption('dayCellDidMount', bloquearDias);
  
    //----------------------------------------
    //SELECCIONAR UN DIA DEL LADO DEL USUARIO 
    //----------------------------------------
 
    $(document).on("click", ".fc-daygrid-day", function() {
      selectedDate = moment($(this).data('date'));

      if (diasBloqueadosNum.indexOf(selectedDate.day()) !== -1) {
        return; // no hacer nada si el día seleccionado está bloqueado
      }

        // Validar si la fecha está bloqueada
  if (diasBloqueadosNum.indexOf(selectedDate.day()) !== -1 || fechasBloqueadas.indexOf(selectedDate.format('YYYY-MM-DD')) !== -1) {
    return; // No hacer nada si la fecha está bloqueada
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

$(document).on('click','#close-modal-btn',function(){
  $('#exampleModal').hide();
});


</script>
  



<!-- Modal para registrar la cita-->
<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:white; ">
      <div class="modal-header" style="background:#5499C7;">

      <div class="text-center w-100">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white; font-size:24px">Registrado con éxito</h5>
        </div>
        <!-- Botón de cerrar -->
        <button type="button" class="close mr-3" id="close-modal-btn" data-dismiss="modal" aria-label="Close">
          X
        </button>
    
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
<!--
        <div class="checkbox">
          <label><input type="checkbox"> Aceptar acuerdos y condiciones</label>
        </div>
-->

      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" style="margin:auto" data-bs-dismiss="modal" aria-label="Close" id="cerrar">Registrar cita</button>
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
<br>
<br>
<br>
<br>
<br>


<?php
footerPrincipal($data); 

?>

</body>
<script src="<?= media();?>/js/bienvenida.js"></script>
<script src="<?= media(); ?>/js/functions_citas.js"></script>
</html>
