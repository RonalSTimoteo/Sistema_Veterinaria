let tableRoles;
let rowTable = "";
tableRoles = $('#tableRoles').dataTable( {
    "aProcessing":true,
    "aServerSide":true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax":{
        "url": " "+base_url+"/Roles/getRoles",
        "dataSrc":""
    },
    "columns":[
        {"data":"id_rol"},
        {"data":"nom_rol"},
        {"data":"options"}

    ], 
    "resonsieve":"true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order":[[0,"asc"]]  
});


window.addEventListener('load', function() {
  
    if(document.querySelector("#formRoles")){
        let formRoles = document.querySelector("#formRoles");
        formRoles.onsubmit = function(e) {
            e.preventDefault();
            let nom_rol = document.querySelector('#nom_rol').value;

            if(nom_rol == '')
            {
                swal("Atención", "Todos los campos son obligatorios." , "error");
                return false;
            }

            let request = (window.XMLHttpRequest) ? 
                            new XMLHttpRequest() : 
                            new ActiveXObject('Microsoft.XMLHTTP');

            let ajaxUrl = base_url+'/Roles/setRol'; 
           let formData = new FormData(formRoles);
           request.open("POST",ajaxUrl,true);
           request.send(formData);

           request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
              
               let objData = JSON.parse(request.responseText);
                //console.log(request.responseText); // para ver en consola los datos q se envian por post en un array funciona con dep() en el controllador
             
              if(objData.status){

                tableRoles.api().ajax.reload();

                $('#modalFormRoles').modal("hide");
                //formUsuario.reset();
                swal("", objData.msg ,"success");
             }else{
                swal("Error", objData.msg , "error");
              }  
            }
        
            return false;
        }
    }
 }
}, false);



function fntEditInfo(id_rol){
    document.querySelector('#titleModal').innerHTML ="Actualizar Rol";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";
    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
                    //envia el id al metodo getProducto - extraer los productos 
    let ajaxUrl = base_url+'/Roles/getRol/'+id_rol;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            //console.log(request.responseText);
            
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
                document.querySelector("#id_rol").value = objData.data.id_rol;
                document.querySelector("#nom_rol").value = objData.data.nom_rol;

            }         
        }
        $('#modalFormRoles').modal('show');    
    }
}


function fntDelInfo(id_rol){
    swal({
        title: "Eliminar Rol",
        text: "¿Realmente quiere eliminar el rol?",
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
            let ajaxUrl = base_url+'/Roles/delRol';
            let strData = "id_rol="+id_rol;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableRoles.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}



function openModal()
{
    rowTable = "";
   
    document.querySelector('#id_rol').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Rol";
    document.querySelector("#formRoles").reset();
    $('#modalFormRoles').modal('show');

}