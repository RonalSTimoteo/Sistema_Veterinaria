<?php 
require_once("Libraries/Core/Mysql.php");
trait TServicio{
	private $intServicio;
	private $strRuta;

	private $intNombre;
	private $strEmail;
	private $strFecha;
	private $strHoras;
	private $intMascota;
	private $Especificacion;



	public function getServiciost(){
		$this->con = new Mysql();
		$sql = "SELECT id_servicio, nom_servicio, descripcion, precio, foto, ruta
				FROM servicio
				WHERE (status != 0)";
	
		//EXTRAE LOS DATOS		
		$request = $this->con->select_all($sql);
	
		//VALIDAMOS SI SE EXTRAJO LOS DATOS
		if(count($request) > 0){
			for ($c=0; $c < count($request) ; $c++) { 
				//ruta y url de la imagen segun lo q tenga la columna foto
				$request[$c]['url_imagen'] = media().'/images/uploads/'.$request[$c]['foto'];
			}
		}
		return $request;
	}
	

//ESTE METODO NO DEVOLVIA EL ID SOLO APARTIR DEL NOMBRE  - AHRA DELVUELE EL ID LO HICE PARA EL 
//IMPUT OCULTO EN EL FORMULARIO DEL LADO CLIENTE PARA CAPTURA EL ID E INSERTAR POR QUE CON EL NOMBRE DEL SERVICIO NO SE PODRIA
//SOLO ACA MODFIQUE, SI HAY UN ERROR QUITAR DEL SELECT EL id_servicio	
public function selectServicio($id_servicio)
	{
		$this->con = new Mysql();
		$this->intServicio = $id_servicio;
		//$this->strRuta = $ruta;
	 
		//EXTRAYENDO LA INFORMACIÓN DETALLADA DEL SERVICIO
		$sql = "SELECT id_servicio, nom_servicio, foto, descripcion, precio,ruta FROM servicio WHERE id_servicio = '{$this->intServicio}'";
	
	//EXTRAE LOS DATOS		
    $request = $this->con->select_all($sql);

	//VALIDAMOS SI SE EXTRAJO LOS DATOS
    if(count($request) > 0){

        for ($c=0; $c < count($request) ; $c++) { 
			//recorremos los datos extraeidos en usamos el campo foto para armar la ruta 
           $request[$c]['url_imagen'] = media().'/images/uploads/'.$request[$c]['foto'];
		   // ^^^ Aquí agregamos la ruta base de la imagen
		}
    }
    return $request;
	}

	public function selectMascotas()
	{
		$this->con = new Mysql();
		$sql = "SELECT * FROM mascota";
		$request = $this->con->select_all($sql);
		return $request;
	}

/*	
	public function selectHoras()
	{
		$this->con = new Mysql();
		$sql = "SELECT * FROM disponibilidad";
		$request = $this->con->select_all($sql);
		return $request;
	}
	*/
	public function selectHorasDisponibles() {
		$this->con = new Mysql();
		$sql = "SELECT * FROM disponibilidad";
		$request = $this->con->select_all($sql);

		return $request;
			//dep($request);
}

public function insertCita(int $idUsuario, string $email, string $fecha, string $hora, int $idMascota, int $idServicio, string $especificacion){
	//$fecha_dt = DateTime::createFromFormat('d/m/Y', $fecha);
    //$fecha_formateada = $fecha_dt->format('Y-m-d');  
	$this->con = new Mysql();	
    $this->intNombre = $idUsuario;
    $this->strEmail = $email;
   // $this->strFecha = $ $fecha_formateada;
   $this->strFecha =  $fecha;
    $this->strHoras = $hora;
    $this->intMascota = $idMascota;
    $this->intServicio = $idServicio;
    $this->Especificacion = $especificacion;
    $this->status = 1;
	$return = 0;
//no voy qa validar el correo por que siempre va existir en  la BD 
//$sql = "SELECT * FROM usuario WHERE correo = '{$email}'";
//$request = $this->con->select_all($sql);

//if (!empty($request)) {
//se precede a insertar		
        $query_insert  = "INSERT INTO cita(id_usu, fecha, hora, id_mas, id_servicio, especificacion, status) 
                          VALUES(?,?,?,?,?,?,?)";
        $arrData = array(
                    $this->intNombre,
                    $this->strFecha,
                    $this->strHoras,
                    $this->intMascota,
                    $this->intServicio,
                    $this->Especificacion,
                    $this->status);
	
        $request_insert = $this->con->insert($query_insert,$arrData);
     //	dep($request_insert);
	     $return = $request_insert;
	//} else {
		// El correo no existe, no se puede insertar
	//	$return = "no exist";
	//}
	return $return;
	//De esta manera, si el correo existe, se procederá a insertar los datos en la tabla cita. Si el correo no existe, se retornará false y no se realizará la inserción.
}	
	
	

}

?>