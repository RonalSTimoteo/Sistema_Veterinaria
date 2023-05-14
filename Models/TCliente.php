<?php 
require_once("Libraries/Core/Mysql.php");
trait TCliente{

	private $nom_usu;
	private $ape_usu;
	private $telefono;
	private $correo;
	private $pass_usu;
	private $intTipoId;
	private $status;

//LOGIN 
//busca si existen y luego lo inserta 
	public function setCita(string $nombre, string $email){
	//traemos la conexion 
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

//REGISTRO - ÑLOGIN
//aca ira para inserta cliente desde la vista   -> ya esta insertando 
public function insertCliente(string $nom_usu, string $ape_usu, string $telefono, string $correo, string $pass_usu, int $tipoid ){
	$this->con = new Mysql();		
	$this->nom_usu = $nom_usu;
	$this->ape_usu = $ape_usu;
	$this->telefono = $telefono;
	$this->correo = $correo;
	$this->pass_usu = $pass_usu;
	$this->intTipoId = $tipoid;
	$this->status = 1;


	$return = 0;
	$sql = "SELECT * FROM usuario WHERE correo = '{$this->correo}'";
	$request = $this->con->select_all($sql);

	if(empty($request))
	{
		$query_insert  = "INSERT INTO usuario(nom_usu,
											ape_usu,
											telefono,
											correo,
											pass_usu,
											id_rol,
											status) 
						  VALUES(?,?,?,?,?,?,?)";
		$arrData = array(
			$this->nom_usu,
			$this->ape_usu,
			$this->telefono,
			$this->correo,
			$this->pass_usu,	
			$this->intTipoId,				
			$this->status
		);

		$request_insert = $this->con->insert($query_insert,$arrData);
		$return = $request_insert;
    	
	}else{
		$return = "exist";
	}
	return $return;
}

//REGISTRO DE CITA 




}

 ?>