let tableUsuarios;
let rowTable = "";
tableUsuarios = $('#tableUsuarios').dataTable( {
    "aProcessing":true,
    "aServerSide":true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },

    "ajax":{
        "url": " "+base_url+"/Usuarios/getUsuarios",
        "dataSrc":""
    },
    
    "columns":[
        {"data":"id_usu"},
        {"data":"nom_usu"},
        {"data":"ape_usu"},
        {"data":"dni"},
        {"data":"telefono"},
        {"data":"correo"},
        {"data":"pass_usu"},
        {"data":"rol"},
        {"data":"status"},
        {"data":"options"}
    ],
      
    "resonsieve":"true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order":[[0,"desc"]]  
});

window.addEventListener('load', function() {
  
    if(document.querySelector("#formUsuarios")){
        let formUsuarios = document.querySelector("#formUsuarios");
        formUsuarios.onsubmit = function(e) {
            e.preventDefault();
            let nom_usu = document.querySelector('#nom_usu').value;
            let ape_usu = document.querySelector('#ape_usu').value;
            let dni = document.querySelector('#dni').value;
            let telefono = document.querySelector('#telefono').value;
            let correo = document.querySelector('#correo').value;
            let pass_usu = document.querySelector('#pass_usu').value;
            let id_rol = document.querySelector('#id_rol').value;
        
    
            if(nom_usu == '' || ape_usu == '' || dni == '' || telefono == '' || correo == '' || pass_usu == '' || id_rol == '')
            {
                swal("Atención", "Todos los campos son obligatorios." , "error");
                return false;
            }

            let request = (window.XMLHttpRequest) ? 
                            new XMLHttpRequest() : 
                            new ActiveXObject('Microsoft.XMLHTTP');

            let ajaxUrl = base_url+'/Usuarios/setUsuario'; 
            let formData = new FormData(formUsuarios);
            request.open("POST",ajaxUrl,true);
            request.send(formData);

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    
                    let objData = JSON.parse(request.responseText);
                    if(objData.status){
                        
                        tableUsuarios.api().ajax.reload();
                        $('#modalFormUsuarios').modal("hide");
                        swal("", objData.msg ,"success");
                    }else{
                        swal("Error", objData.msg , "error");
                    }   
                }
                return false;
            }
        }
    }
    fntRoles();
}, false);


function fntRoles(){
    if(document.querySelector('#id_rol')){
        let ajaxUrl = base_url+'/Usuarios/getSelectRoles';
        let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#id_rol').innerHTML = request.responseText;
                $('#id_rol').selectpicker('render');
            }
        }
    }
}

function fntEditInfo(id_usu){
    document.querySelector('#titleModal').innerHTML ="Actualizar Usuario";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";
    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Usuarios/getUsuario/'+id_usu;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            
            let objData = JSON.parse(request.responseText);
                
            if(objData.status)
            {
                
                document.querySelector("#id_usu").value = objData.data.id_usu;
                document.querySelector("#nom_usu").value = objData.data.nom_usu;
                document.querySelector("#ape_usu").value = objData.data.ape_usu;
                document.querySelector("#dni").value = objData.data.dni;
                document.querySelector("#telefono").value = objData.data.telefono;
                document.querySelector("#correo").value = objData.data.correo;
                document.querySelector("#pass_usu").value = objData.data.pass_usu;
                //document.querySelector("#id_rol").value = objData.data.id_rol;
                //document.querySelector("#nom_rol").value = objData.data.nom_rol;
                //$('#id_rol').selectpicker('render');
                
            }                 
        }
        $('#modalFormUsuarios').modal('show');    
    }
}

function fntDelInfo(id_usu){
    swal({
        title: "Eliminar Usuario",
        text: "¿Realmente quiere eliminar al usuario?",
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
            let ajaxUrl = base_url+'/Usuarios/delUsuario';
            let strData = "id_usu="+id_usu;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableUsuarios.api().ajax.reload();
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
    document.querySelector('#id_usu').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
    document.querySelector("#formUsuarios").reset();
    $('#modalFormUsuarios').modal('show');
}