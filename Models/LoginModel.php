<?php 

	class LoginModel extends Mysql
	{
	
		private $strUsuario;
		private $strPassword;
		private $intIdUsuario;
	

		public function __construct()
		{
			parent::__construct();
		}

		
		public function loginUser(string $usuario, string $password)
		{
			$this->strUsuario = $usuario;
			$this->strPassword = $password;
	//esos dep estaban casuandop error en la respuesta del js	
		//	dep($this->strUsuario);
			//dep($this->strPassword);
		
			//validams si existe el registro
			$sql = "SELECT id_usu,status FROM usuario WHERE 
			correo = '$this->strUsuario' and 
			pass_usu = '$this->strPassword' and 
			status != 0 ";
		
		//	dep($sql);
			$request = $this->select($sql);
		//	dep($request);
		
			return $request;
		}
		


        //recibe el id del usuareio
        public function sessionLogin(int $iduser){
			$this->intIdUsuario = $iduser;
			//BUSCAR ROLE 

			$sql = "SELECT u.id_usu, u.nom_usu, u.ape_usu, u.dni, u.telefono, u.correo, u.pass_usu,
            r.id_rol, r.nom_rol, u.status
            FROM usuario u INNER JOIN rol r ON u.id_rol = r.id_rol
            WHERE u.id_usu = $this->intIdUsuario";
        //trae la respuesta de esa consulta como vemos de paso trae el nombre del rol
			$request = $this->select($sql);

            //almacena el rol en la variable sesion user data 
			$_SESSION['userData'] = $request;
			
			return $request;
		}
  
        

	}
 ?>