window.addEventListener('load', function() {
  if (document.querySelector("#FormRegistrarCita")) {
    let FormRegistrarCita = document.querySelector("#FormRegistrarCita");
    FormRegistrarCita.onsubmit = function(e) {
      e.preventDefault();
      // Obtener valor de fecha_cita
      let fechaCita = document.getElementById("fecha_cita").value;
      console.log(fechaCita);

      // Enviar petición AJAX
      let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
      let ajaxUrl = base_url+'/Servicios/setClient/'; 
      let formData = new FormData(FormRegistrarCita);
      formData.append('fecha_cita', fechaCita);
      request.open("POST", ajaxUrl, true);
      request.send(formData);

      request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
          let objData = JSON.parse(request.responseText);
          console.log(request.responseText);
          if(objData.status){
            $('#ModalRegistroCita').hide();
            FormRegistrarCita.reset();
            swal("Usuarios", objData.msg, "success");
          }
        } 
      }

      return false;
    }
  }

  fntMascota();
  fntHoras(); // Llamada a la función fntHoras() dentro del bloque de código del listener de carga
}, false);



//TAREA PARA MANANA LA FUNCION ESTA CORRECTA - 
//SOLO NO ESTA RENDERIZANDO  A LA FUNCION EN EL window.addEventListener('load'

function convertirDia(dia) {
  switch(dia) {
    case 'Monday':
      return 'lunes';
    case 'Tuesday':
      return 'martes';
    case 'Wednesday':
      return 'miercoles';
    case 'Thursday':
      return 'jueves';
    case 'Friday':
      return 'viernes';
    case 'Saturday':
      return 'sabado';
    case 'Sunday':
      return 'domingo';
    default:
      return dia;
  }
}

function fntHoras(diaSeleccionado) {

  // alert("La función fntHoras se está ejecutando correctamente.");
  let diaSeleccionadoEspañol = convertirDia(diaSeleccionado);
  console.log(diaSeleccionadoEspañol);

  if(document.querySelector('#listHoras')){  
    //console.log(listHoras); // -> si encuentra al select
    let ajaxUrl = base_url + '/Servicios/getSelectHoras';
    let request = (window.XMLHttpRequest) ?
      new XMLHttpRequest() :
      new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET", ajaxUrl, true);
    request.send();
  
    request.onreadystatechange = function() {
      if (request.readyState == 4 && request.status == 200) {
        let objData = JSON.parse(request.responseText);
        
        let inicio = '';
        let final = '';
        let tiempo = '';
  
        for (let i = 0; i < objData.length; i+=4) {
          if (objData[i+3] == diaSeleccionadoEspañol) {
            diaData = {
              inicio: objData[i],
              final: objData[i+1],
              tiempo: objData[i+2],
              dias: objData[i+3]
            };
            inicio = objData[i];
            final = objData[i+1];
            tiempo = objData[i+2];
            break;
          }
        }
  //CREO QUE ESA FORMA EL FOR O EWHILE HACE HAYA CONFLICTO  ALRENDERIZADO
        let horaInicio = moment(inicio, 'HH:mm:ss');
        let horaFin = moment(final, 'HH:mm:ss');
        let intervalo = moment.duration(tiempo);
        let horaActual = moment(horaInicio);
        let opciones = '';
  
        while (horaActual.isBefore(horaFin)) {
          let horaTextoInicio = horaActual.format('hh:mma');
          horaActual.add(intervalo);
          let horaTextoFin = horaActual.format('hh:mma');   
          opciones += '<option value="' + horaTextoInicio + ' - ' + horaTextoFin + '">' + horaTextoInicio + ' - ' + horaTextoFin + '</option>';
        }    
        document.querySelector('#listHoras').innerHTML = opciones;
         //$('#listHoras').selectpicker('refresh');// ->no renderiza el selectpicker en el DOMContentLoaded
      }
    }
  }
}
 


  function fntMascota(){
    //verifica si exite el elemento listCategoria(element list )
    if(document.querySelector('#listMascota')){

        //armamos la url a donde vamos a enviar los datos(si vamso a esa url veremos los datos de categoria en un html blanco)
        let ajaxUrl = base_url+'/Servicios/getSelectMascotas';
        let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');

        //enviamos los datos por get en vez de POST
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){

                //si todo es correcto en el elemento list vamos colocar la respuesta (el array de LA )
                document.querySelector('#listMascota').innerHTML = request.responseText;
               // $('#listMascota').selectpicker('render');
            }
        }
    }
}



//le damos evento click al boton reservar cita q va abrir el sgte modal
  $("#btnRervarCita").click(function() {
   // alert("dffsdfgsdfg");
	// mostrar una alerta con la fecha seleccionada
	if (selectedCell !== null) {

        var dateStr = selectedCell.attr("data-date"); // obtener la fecha de la celda seleccionada
        var selectedDate = moment(dateStr); // convertir la cadena de fecha a un objeto moment
        //var formattedDate = selectedDate.format("DD/MM/YYYY"); // formatear la fecha como "DD/MM/YYYY"
        var formattedDate = selectedDate.format("YYYY-MM-DD");

        //selecciona el id fecha_cita y le pasa el valor 
        document.getElementById("fecha_cita").value=formattedDate;

    //ACA ABRE EL MODAL  - si la celda tiene valor 
	  $('#ModalRegistroCita').show();
	  //alert("Fecha seleccionada: " + formattedDate); // mostrar una alerta con la fecha seleccionada
	}
    //si no ha seleccionado nada se abre este modal
    else {
	  $('#ModaFechNoSeleccionada').show();
	}
  });


  //----para cerrar el modal con fecha seleccionada y el fin fecha seleccionada----------
  $(document).on('click','#cerrar',function(){
	//$('#ModalRegistroCita').hide();
	$('#ModaFechNoSeleccionada').hide();
  })
  
  //para cerrar el modal danclick en la X
  $(document).on('click','#close-modal-btn',function(){
	$('#ModalRegistroCita').hide();
  });


