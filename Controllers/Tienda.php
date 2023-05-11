<?php 
require_once("Models/TServicio.php");
//require_once("Models/LoginModel.php");


class Tienda extends Controllers{
    use TServicio;
    //public $login;
    public function __construct()
    {
        parent::__construct();
    }


//ENVIA A LA VISTA DE LA TIENDA PRODUCTOS (CATALOGO DE PRODUCTOS)		
public function servicio(){


    			//envia el id del producti y la ruta - trae los productos de la BD
				$infoProducto = $this->getServiciost();

				//almacenamos el arrat de productos en la var data q es un array en su elemento ['producto']
				$data['servicio'] = $infoProducto;
			
       
//enviamos a la vista a traves de data  los prodcutos sacado de la BD 
        $this->views->getView($this,"servicio",$data);

    }


/*
    public function detalleServicio($id_servicio) {
        // Obtener información detallada del servicio desde la base de datos
        $servicio = $this->getServicioById($id_servicio);
    
        // Enviar la información a la vista correspondiente
        $this->views->getView($this, "detalle_servicio", $servicio);
    }

*/

}
?>