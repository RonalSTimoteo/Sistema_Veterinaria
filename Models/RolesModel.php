<?php 

	class RolesModel extends Mysql
	{
		private $id_rol;
		private $nom_rol;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectRoles(){
		$sql = "SELECT id_rol,
					nom_rol
		FROM rol";
		
		
		$request = $this->select_all($sql);
			return $request;
		}	

		public function insertRol(string $nom_rol){
			
			$this->nom_rol = $nom_rol;
			$return = 0;
			
			$sql = "SELECT * FROM rol WHERE nom_rol = '{$this->nom_rol}'";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$query_insert  = "INSERT INTO rol(nom_rol) 
								  VALUES(?)";
	        	$arrData = array(
					$this->nom_rol
				);
	
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}
     
		public function updateRol(int $id_rol, string $nom_rol){

			$this->id_rol = $id_rol;
			$this->nom_rol = $nom_rol;
			$return = 0;

				$sql = "UPDATE rol 
						SET nom_rol=?
						WHERE id_rol = $this->id_rol ";
				$arrData = array($this->nom_rol); 
	        	$request = $this->update($sql,$arrData);
	        	$return = $request;

	        return $return;
		}
		
		public function selectRol(int $id_rol){
			$this->id_rol = $id_rol;
			$sql = "SELECT id_rol, 
						nom_rol
						from rol
					WHERE id_rol = $this->id_rol";
			$request = $this->select($sql);
			return $request;
		}

		public function deleteRol(int $id_rol){
			$this->id_rol = $id_rol;
			$sql = "DELETE from rol WHERE id_rol = $this->id_rol ";
			$request = $this->delete($sql);
			return $request;
		}
		

}
 ?>