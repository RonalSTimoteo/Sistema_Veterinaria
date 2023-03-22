<?php 
	class Roles extends Controllers{
		public function __construct()
		{
			parent::__construct();

		}

		public function Roles()
		{

			$data['page_tag'] = "Roles";
			$data['page_title'] = "Roles <small>Tienda Virtual</small>";
			$data['page_name'] = "roles";
			$data['page_functions_js'] = "functions_roles.js";
			$this->views->getView($this,"roles",$data);
		}


		public function getRoles()
		{
		
				$arrData = $this->model->selectRoles();
				
				for ($i=0; $i < count($arrData); $i++) {
					$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo('.$arrData[$i]['id_rol'].')" title="Editar producto"><i class="fas fa-pencil-alt"></i></button>';
					$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['id_rol'].')" title="Eliminar producto"><i class="far fa-trash-alt"></i></button>';
					$arrData[$i]['options'] = '<div class="text-center">'.$btnEdit.' '.$btnDelete.'</div>';  
				}	


				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			
			die();
		}


		public function setRol(){
			if($_POST){
				if(empty($_POST['nom_rol']))
				{
					//$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			
				 }else{
					$id_rol = intval($_POST['id_rol']);
					$nom_rol = strClean($_POST['nom_rol']);
					$request_rol = "";
					


					if($id_rol == 0){

						$option = 1;

						$request_rol = $this->model->insertRol(
							$nom_rol
						);
					}else{

						$option = 2;
						
						$request_rol = $this->model->updateRol(
							$id_rol,
							$nom_rol
						);
					}
					
					if($request_rol > 0 ){

						if($option == 1){

							$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');

						}else if($option == 2){

							$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
						}

					}else if($request_rol == 'exist'){
							
							$arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe el rol.');
						
					}else{
							
							$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
						
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
		
		public function getRol($id_rol){
			
			$id_rol = $id_rol;
			
			if($id_rol > 0){
				
				$arrData = $this->model->selectRol($id_rol);
				
				if(empty($arrData)){

					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');

				}else{

					$arrResponse = array('status' => true, 'data' => $arrData);

				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
		
		
		
		public function delRol(){
			if($_POST){
				
				$id_rol = intval($_POST['id_rol']);
				$requestDelete = $this->model->deleteRol($id_rol);
					
				if($requestDelete){
					
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el rol');
						
				}else{
					
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el rol.');
				
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
	}

?>