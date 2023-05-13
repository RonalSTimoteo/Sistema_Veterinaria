let tableCitas; 
let rowTable = "";
//let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){

    tableCitas = $('#tableCitas').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/cita/getCitas",
            "dataSrc":""
        },
        "columns":[
            {"data":"id_cita"},
            {"data":"usuario"},
            {"data":"fecha"},
            {"data":"hora"},
            {"data":"mascota"},
            {"data":"servicio"},
            {"data":"especificacion"},
            {"data":"status"},
            {"data":"options"}
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-secondary"
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Esportar a Excel",
                "className": "btn btn-success"
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Esportar a PDF",
                "className": "btn btn-danger"
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Esportar a CSV",
                "className": "btn btn-info"
            }
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

//para insertar
	if(document.querySelector("#ModalFormCitaAdmin")){
        let formCitaAdmin = document.querySelector("#FormRegistroCitasAdmin");
        formCitaAdmin.onsubmit = function(e) {
            e.preventDefault();
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Cita/setCitaAdmin'; 
            let formData = new FormData(formCitaAdmin);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        $('#ModalFormCitaAdmin').modal("hide");
                        formCitaAdmin.reset();
                        swal("Usuarios", objData.msg ,"success");
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
    fntMascota();
}, false); //fin DOMContentLoaded





//EDITAR CITA 
//ESTA ENVIANDO EL ID AL HACER CLICK EN EL BOTON
function fntEditInfo(idCita){
    //$('#ModalFormCitaAdmin').modal('show');
 
   // rowTable = element.parentNode.parentNode.parentNode;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Cita/getCita/'+idCita;
    request.open("GET",ajaxUrl,true);
    //TRAER TODOS LOS DATOS DEL CLIENTE 
    request.send();
    
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            console.log(request.responseText);
            if(objData.status)
            {
                if(objData.status)
                {
             
                    document.querySelector("#txtid_cita").value = objData.data.id_cita;
                    document.querySelector("#txtfecha").value = objData.data.fecha;
                    document.querySelector("#txthora").value = objData.data.hora;
                    document.querySelector("#txtnombre").value = objData.data.usuario;
                    document.querySelector("#txtlistMascota").value = objData.data.mascota;
                    document.querySelector("#txtEspecificacion").value = objData.data.especificacion;
                    document.querySelector("#txtservicio").value = objData.data.servicio;
                    fntMascota();
                }
              // $('#txtlistMascota').selectpicker('render');
                
            }
        }
        $('#ModalFormCitaAdmin').modal('show');
    }

}

function fntMascota(){
    //verifica si exite el elemento listCategoria(element list )
    if(document.querySelector('#txtlistMascota')){

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

                console.log();
                //si todo es correcto en el elemento list vamos colocar la respuesta (el array de LA )
                document.querySelector('#txtlistMascota').innerHTML = request.responseText;
               // $('#listMascota').selectpicker('render');
            }
        }
    }
}



//ELIMANR CITA 
function fntDelInfo(idpersona){
    swal({
        title: "Eliminar Cliente",
        text: "¿Realmente quiere eliminar al cliente?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Clientes/delCliente';
            let strData = "idUsuario="+idpersona;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableClientes.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}

//CONFIGURAR EL MODAL SI ES QUIE HAY EL DE INSERTAR 
function openModal()
{
    /*
    rowTable = "";
    document.querySelector('#idUsuario').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Cliente";
    document.querySelector("#formCliente").reset();
   */
    $('#ModalFormRegistCitaAdmin').modal('show');
}