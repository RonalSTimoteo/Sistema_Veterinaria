<?php 
require_once("Libraries/Core/Mysql.php");
trait TCalendario{

	private $strNombre;
	private $strEmail;
/*
//busca si existen y luego lo inserta 
	public function setCita(string $nombre, string $email){
		$this->con = new Mysql();
		//HACEMOS LA CONSULTA SI EXITE EL NOMBRE Y CORREO
		$sql = 	"SELECT * FROM usuario WHERE correo = '{$email}'";
		$request = $this->con->select_all($sql);

//Y SI EXISTEN(diferente a vacio)		
		if(!empty($request)){

			$return = 1;
		}else{
			$return = false;
		}
		return $return;
	}

*/
  //BLOQUEO DE FECHAS   
  public function obtenerFechasBloqueadas()
  {
      $this->con = new Mysql();
      $sql = "SELECT fecha_bloqueo FROM bloquearfecha";
      //develve todos ls registros
      $request = $this->con->select_all($sql);
      return $request;
  }

    public function obtenerColumnasBloqueadas()
    {
        $this->con = new Mysql();
        //extrayendo los dias donde el status es 1 
        $sql = "SELECT Nomb_dia FROM bloquearcolumna WHERE status = 1";
        //develve todos los registros
        return $this->con->select_all($sql);
    }


}

 ?>