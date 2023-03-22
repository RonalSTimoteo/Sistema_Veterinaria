<?php 

	class UsuariosModel extends Mysql
	{
		private $id_usu;
		private $nom_usu;
		private $ape_usu;
        private $dni;
		private $telefono;
		private $correo;
		private $pass_usu;
        private $id_rol;
        private $status;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectUsuarios(){
		$sql = "SELECT u.id_usu,
		            u.nom_usu,
					u.ape_usu,
					u.dni,
                    u.telefono,
					u.correo,
					u.pass_usu,
					r.nom_rol as rol,
					u.status
		FROM usuario u    
		INNER JOIN rol r
		ON u.id_rol = r.id_rol
		WHERE u.status = 1";

		$request = $this->select_all($sql);
			return $request;
		}	
    
		public function insertUsuario(string $nom_usu, string $ape_usu, string $dni, string $telefono, string $correo, string $pass_usu, int $id_rol){
			
			$this->nom_usu = $nom_usu;
			$this->ape_usu = $ape_usu;
			$this->dni = $dni;
			$this->telefono = $telefono;
			$this->correo = $correo;
            $this->pass_usu = $pass_usu;
			$this->id_rol = $id_rol;
			$this->status = 1;

			$return = 0;
			$sql = "SELECT * FROM usuario WHERE correo = '{$this->correo}'";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$query_insert  = "INSERT INTO usuario(nom_usu,
													ape_usu,
													dni,
													telefono,
													correo,
                                                    pass_usu,
                                                    id_rol,
													status) 
								  VALUES(?,?,?,?,?,?,?,?)";
	        	$arrData = array(
					$this->nom_usu,
					$this->ape_usu,
					$this->dni,
					$this->telefono,
					$this->correo,
					$this->pass_usu,
                    $this->id_rol,
					$this->status
				);
	
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}
     
		public function updateUsuario(int $id_usu, string $nom_usu, string $ape_usu, string $dni, string $telefono, string $correo, string $pass_usu, int $id_rol){

			$this->id_usu = $id_usu;
			$this->nom_usu = $nom_usu;
			$this->ape_usu = $ape_usu;
			$this->dni = $dni;
			$this->telefono = $telefono;
            $this->correo = $correo;
			$this->pass_usu = $pass_usu;
			$this->id_rol = $id_rol;
			$return = 0;

			$sql = "UPDATE usuario 
			SET nom_usu=?, 
				ape_usu=?, 
				dni=?, 
				telefono=?, 
				correo=?, 
				pass_usu=?, 
				id_rol=? 
			WHERE id_usu = $this->id_usu";
			$arrData = array($this->nom_usu,
        					$this->ape_usu,
        					$this->dni,
							$this->telefono,
                            $this->correo,
        					$this->pass_usu,
        					$this->id_rol); 

	        $request = $this->update($sql,$arrData);
	        $return = $request;
	        return $return;
		}
		
		public function selectUsuario(int $id_usu){
			$this->id_usu = $id_usu;
			$sql = "SELECT u.id_usu,
                         u.nom_usu,
                         u.ape_usu,
                         u.dni,
                         u.telefono,
                         u.correo,
                         u.pass_usu,
                         r.nom_rol 
			FROM usuario u    
	        INNER JOIN rol r
	        ON u.id_rol = r.id_rol
			WHERE u.id_usu = $this->id_usu";
			$request = $this->select($sql);
			return $request;
		}

		public function selectRoles()
		{
			$sql = "SELECT * FROM rol";
			$request = $this->select_all($sql);
			return $request;
		}

		public function deleteUsuario(int $id_usu){
			$this->id_usu = $id_usu;
			$sql = "UPDATE usuario SET status = ? WHERE id_usu = $this->id_usu";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}
}
 ?>