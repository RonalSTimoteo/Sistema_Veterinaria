/*
document.write(`<script src="${base_url}/Assets/js/plugins/JsBarcode.all.min.js"></script>`);

let rowTable = "";
$(document).on('focusin', function(e) {
    if ($(e.target).closest(".tox-dialog").length) {
        e.stopImmediatePropagation();
    }
});
*/
let tableProductos;
let rowTable = "";
tableProductos = $('#tableProductos').dataTable( {
    "aProcessing":true,
    "aServerSide":true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax":{
        "url": " "+base_url+"/Productos/getProductos",
        "dataSrc":""
    },
    "columns":[
        {"data":"id_producto"},
        {"data":"nom_pro"},
        {"data":"descripcion"},
        {"data":"precio"},
        {"data":"stock"},
        {"data":"categoria"},
       // {"data":"status"},
        {"data":"options"}

    ],
    /*
    "columnDefs": [
                    { 'className': "textcenter", "targets": [ 3 ] },
                    { 'className': "textright", "targets": [ 4 ] },
                    { 'className': "textcenter", "targets": [ 5 ] }
                  ],    */   
    "resonsieve":"true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order":[[0,"desc"]]  
});


window.addEventListener('load', function() {
  
    if(document.querySelector("#formProductos")){
        let formProductos = document.querySelector("#formProductos");
        formProductos.onsubmit = function(e) {
            e.preventDefault();
            let strNombre = document.querySelector('#nom_pro').value;
            let intCodigo = document.querySelector('#descripcion').value;
            let strPrecio = document.querySelector('#precio').value;
        
    
            if(strNombre == '' || intCodigo == '' || strPrecio == '')
            {
                swal("Atención", "Todos los campos son obligatorios." , "error");
                return false;
            }

            let request = (window.XMLHttpRequest) ? 
                            new XMLHttpRequest() : 
                            new ActiveXObject('Microsoft.XMLHTTP');

            let ajaxUrl = base_url+'/Productos/setProducto'; 
           let formData = new FormData(formProductos);
           request.open("POST",ajaxUrl,true);
           request.send(formData);

           request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
              
               let objData = JSON.parse(request.responseText);
                  // console.log(request.responseText); // para ver en consola los datos q se envian por post en un array funciona con dep() en el controllador
             
              if(objData.status){

                tableProductos.api().ajax.reload();

                $('#modalFormProductos').modal("hide");
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
  fntCategorias(); //sin ésto no cargaria los nombres de las categorias en el combobox
}, false);



//funcion para extraert la categorias para el select -MODIFICAR
function fntCategorias(){
    if(document.querySelector('#listCategoria')){
        let ajaxUrl = base_url+'/Productos/getSelectCategorias';
        let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#listCategoria').innerHTML = request.responseText;
                $('#listCategoria').selectpicker('render');
            }
        }
    }
}



function fntEditInfo(idProducto){
    //rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML ="Actualizar Producto";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";
    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
                    //envia el id al metodo getProducto - extraer los productos 
    let ajaxUrl = base_url+'/Productos/getProducto/'+idProducto;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            
            let objData = JSON.parse(request.responseText);
                
            if(objData.status)
            {

                //ponemos en los input los datos q salen de los campos de la BD 
                document.querySelector("#id_producto").value = objData.data.id_producto;
                document.querySelector("#nom_pro").value = objData.data.nom_pro;
                document.querySelector("#descripcion").value = objData.data.descripcion;
                document.querySelector("#precio").value = objData.data.precio;
                document.querySelector("#listCategoria").value = objData.data.id_categoria;

                //para q se muestren los registros - con eso ya depberia mostrar por defecto la categoria al darle editar
                $('#listCategoria').selectpicker('render');
    
            
            }                 
        }
        $('#modalFormProductos').modal('show');    
    }
}


function fntDelInfo(idProducto){
    swal({
        title: "Eliminar Producto",
        text: "¿Realmente quiere eliminar el producto?",
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
            let ajaxUrl = base_url+'/Productos/delProducto';
            //id_producto = al input hide
            let strData = "id_producto="+idProducto;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableProductos.api().ajax.reload();
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
   
    document.querySelector('#id_producto').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Producto";
    document.querySelector("#formProductos").reset();
   // document.querySelector("#divBarCode").classList.add("notblock");
   
  //  document.querySelector("#containerGallery").classList.add("notblock");
   // document.querySelector("#containerImages").innerHTML = "";

    $('#modalFormProductos').modal('show');

}