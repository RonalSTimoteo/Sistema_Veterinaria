<?php 
	class Usuarios extends Controllers{
		public function __construct()
		{
			parent::__construct();

		}

		public function Usuarios()
		{
			$data['page_tag'] = "Usuarios";
			$data['page_title'] = "Usuarios <small>Tienda Virtual</small>";
			$data['page_name'] = "usuarios";
			$data['page_functions_js'] = "functions_usuarios.js";
			$this->views->getView($this,"usuarios",$data);
		}

		public function getUsuarios()
		{
            $arrData = $this->model->selectUsuarios();

            for ($i=0; $i < count($arrData); $i++) {
                $btnEdit = '';
                $btnDelete = '';
                if($arrData[$i]['status'] == 1)
                {
                    $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
                }else{
                    $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
				}

				$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo('.$arrData[$i]['id_usu'].')" title="Editar usuario"><i class="fas fa-pencil-alt"></i></button>';
				$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['id_usu'].')" title="Eliminar usuario"><i class="far fa-trash-alt"></i></button>';
				$arrData[$i]['options'] = '<div class="text-center">'.$btnEdit.' '.$btnDelete.'</div>';  
			}
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
		}

		public function setUsuario(){
			if($_POST){
				if(empty($_POST['nom_usu']) || empty($_POST['ape_usu'])  || empty($_POST['dni']) || empty($_POST['telefono']) || empty($_POST['correo']) || empty($_POST['pass_usu']) || empty($_POST['id_rol']))
				{
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			    }else{
                    $id_usu = intval($_POST['id_usu']);
                    $nom_usu = strClean($_POST['nom_usu']);
                    $ape_usu = strClean($_POST['ape_usu']);
                    $dni = strClean($_POST['dni']);
                    $telefono = strClean($_POST['telefono']);
                    $correo = strClean($_POST['correo']);
                    $pass_usu = strClean($_POST['pass_usu']);
                    $id_rol = intval($_POST['id_rol']);
                    $request_usuario = "";

					if($id_usu == 0){
                        $option = 1;
                        $request_usuario = $this->model->insertUsuario($nom_usu,
                                                                        $ape_usu,
                                                                        $dni,
                                                                        $telefono,
                                                                        $correo,
                                                                        $pass_usu,
                                                                        $id_rol);
                    }else{
                        $option = 2;
                        $request_usuario = $this->model->updateUsuario($id_usu,
                        $nom_usu,
                        $ape_usu,
                        $dni,
                        $telefono,
                        $correo,
                        $pass_usu,
                        $id_rol);
                    }

					if($request_usuario > 0 )
                    {
                        if($option == 1){

                            $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');

                        }else if($option == 2){

                            $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');

                        }

                    }else if($request_usuario == 'exist'){

                        $arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe el usuario.');

                    }else{
                        $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
            die();
        }

		public function getUsuario($id_usu){

            $id_usu = $id_usu;
			if($id_usu > 0)
			{
				$arrData = $this->model->selectUsuario($id_usu);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
            die();
        }

        public function getSelectRoles(){
            $htmlOptions = "";
		    $arrData = $this->model->selectRoles();
		    if(count($arrData) > 0 ){
			    for ($i=0; $i < count($arrData); $i++) { 
                    $htmlOptions .= '<option value="'.$arrData[$i]['id_rol'].'">'.$arrData[$i]['nom_rol'].'</option>';
                }
            }
            echo $htmlOptions;
            die();
        }
    
        public function delUsuario(){
		    if($_POST){
                $id_usu = intval($_POST['id_usu']);
                $requestDelete = $this->model->deleteUsuario($id_usu);
				
                if($requestDelete)
				{
					$arrResponse = array('status' => true, 'msg' => 'Se cambio el estatus del usuario a inactivo');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el usuario.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }

 ?>