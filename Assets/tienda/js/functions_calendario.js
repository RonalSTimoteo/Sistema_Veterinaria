//moment.locale('es'); // Añadir aquí la línea de código
/**************************************CALENDAR********************************************************************* */
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
	$.getJSON('http://localhost/Veterinaria/servicios/dias_bloqueados', function(data) {
	  // Asignar el valor obtenido a la variable diasBloqueados
	  diasBloqueados = data;
	  diasBloqueadosNum = diasBloqueados.map(dia => diasSemana.indexOf(dia));
	 // console.log(diasBloqueadosNum);
  
	  // Llamada a la segunda URL para recuperar el segundo array
	  $.getJSON('http://localhost/Veterinaria/servicios/fechas_bloqueadas', function(data) {
		fechasBloqueadas = data;
		//console.log(data);
  
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

		//capturar el dia 
		var dayOfWeek = moment(selectedDate).format('dddd');
		//console.log('El día de la semana es:', dayOfWeek);
	

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

//se confirma que si esta capturando el dia 
		//console.log('Día de la semana seleccionado:', dayOfWeek);
		//enviando el dia a la funcion
		fntHoras(dayOfWeek);

	  });

	});


		
