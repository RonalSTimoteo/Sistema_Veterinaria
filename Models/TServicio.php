<?php 
require_once("Libraries/Core/Mysql.php");
trait TServicio{


//EXTRAE LOS DATOS DE LA BD PARA EL CATALOGO DE PRODUCTOS INCLUSO LA URL PARA LA IMAGEN 
 public function getServiciost(){
    $this->con = new Mysql();
    $sql = "SELECT id_servicio, nom_servicio, descripcion, precio, foto
            FROM servicio
            WHERE (status != 0)";

	//EXTRAE LOS DATOS		
    $request = $this->con->select_all($sql);
	//VALIDAMOS SI SE EXTRAJO LOS DATOS
    if(count($request) > 0){

        for ($c=0; $c < count($request) ; $c++) { 

           // $request[$c]['url_imagen'] = media().'/images/uploads/'.$request[$c]['foto'];
		                                   //ruta y url de la imagen segun lo q tenga la columna foto
			$request[$c]['url_imagen'] = media().'/images/uploads/'.$request[$c]['foto'];

		}
    }
    return $request;
 }

}   

?>