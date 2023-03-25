
if(document.querySelector("#generar_cita")){
	let frmSuscripcion = document.querySelector("#generar_cita");
	frmSuscripcion.addEventListener('submit',function(e) { 
		e.preventDefault();

		
		let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
	//let ajaxUrl = base_url+'/Productos/setProducto'; 
	let ajaxUrl = 'http://localhost/prueba_veterinaria/calendario/Cita';
		let formData = new FormData(frmSuscripcion);

	   	request.open("POST",ajaxUrl,true);
		
 //SI ENVIA AL PHP
	    request.send(formData);

	    request.onreadystatechange = function(){
	    	if(request.readyState != 4) return;
	    	if(request.status == 200){

				//ACA SE TRABA ... 
	    		let objData = JSON.parse(request.responseText);
				   //console.log(request.responseText);

//DICE Q EL TIEMPO DE RESPUESTA ES LENTO CON RESPECTO AL ENVIO DEL CORREO ...
//Y AHI SE QUE DA POR ESO NO SE EJEUTA LO DE ABJO DONDE FINALMENTE EMITE LA ALERTE DE TODO CORRECTO

		//SI EL STATUS ES TRUE ES POR Q INSERTÓ EN BD SE ENVIA EL CORREO DE PASO Y SE ABRE LA ALERTA DE TODO CORRECTO
	    		if(objData.status){
			//SIN EMBARGO EL DATO SE INSERTA PERO NO EMITE EL MENSAJE DE CORREO.
	    			swal("", objData.msg , "success");

                	//document.querySelector("#frmSuscripcion").reset();

			//SI ES FALSE SE ABRE LA ALERTA DE ERROR - SI YA SE REGISTRO TAMPOCO SE ABRE LA ALERTA DE ERROR...
	    		}else{
	    			swal("", objData.msg , "error");
	    		}
	    	}
	    	
        	return false;
	    
		}

	},false);
}





