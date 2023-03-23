<?php 
require_once("Libraries/Core/Mysql.php");
trait TCliente{

	private $strNombre;
	private $strEmail;



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

}

 ?>