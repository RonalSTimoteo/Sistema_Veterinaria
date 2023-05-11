<?php 

	class Cita extends Controllers{
		public function __construct()
		{
//se invoca a la var sesion con session estar y de esa manera el usuario tendra q haber inicido sesion en el login para acceder al dashboard			
			session_start();
			//session_regenerate_id(true);
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			parent::__construct();
		}

		public function cita()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "Dashboard - en proceso..";
			$data['page_title'] = "Dashboard - CITA";
			$data['page_name'] = "dashboard";
			//importante enlazar script en el footer
			$data['page_functions_js'] = "functions_citas.js";
			$this->views->getView($this,"cita",$data);
		}

//DATATABLE		
        public function getCitas()
		{
            $arrData = $this->model->selectCitas();

            for ($i=0; $i < count($arrData); $i++) {
                $btnEdit = '';
                $btnDelete = '';
                if($arrData[$i]['status'] == 1)
                {
                    $arrData[$i]['status'] = '<span class="badge badge-success">Pendiente</span>';
                }else{
                    $arrData[$i]['status'] = '<span class="badge badge-danger">Cancelado</span>';
				}

				$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo('.$arrData[$i]['id_cita'].')" title="Editar usuario"><i class="fas fa-pencil-alt"></i></button>';
				$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['id_cita'].')" title="Eliminar usuario"><i class="far fa-trash-alt"></i></button>';
				$arrData[$i]['options'] = '<div class="text-center">'.$btnEdit.' '.$btnDelete.'</div>';  
			}
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
		}


//PRUEBA DE COMO HARIA DOS INSERT PARA REGISTRAR CITA EN EL ADMIN
 /*
		public function setCliente(){
			error_reporting(0);
			if($_POST){
				if(empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['txtNit']) || empty($_POST['txtNombreFiscal']) || empty($_POST['txtDirFiscal']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$idUsuario = intval($_POST['idUsuario']);
					$strIdentificacion = strClean($_POST['txtIdentificacion']);
					$strNombre = ucwords(strClean($_POST['txtNombre']));
					$strApellido = ucwords(strClean($_POST['txtApellido']));
					$intTelefono = intval(strClean($_POST['txtTelefono']));
					$strEmail = strtolower(strClean($_POST['txtEmail']));
					$strNit = strClean($_POST['txtNit']);
					$strNomFiscal = strClean($_POST['txtNombreFiscal']);
					$strDirFiscal = strClean($_POST['txtDirFiscal']);
					$intTipoId = 7;   // ->suscriptores. 
					$request_user = "";
					$request_cita = "";
					if($idUsuario == 0)
					{
						$option = 1;
						$strPassword =  empty($_POST['txtPassword']) ? passGenerator() : $_POST['txtPassword'];
						$strPasswordEncript = hash("SHA256",$strPassword);
						
							$request_user = $this->model->insertCliente($strIdentificacion,
																				$strNombre, 
																				$strApellido, 
																				$intTelefono, 
																				$strEmail,
																				$strPasswordEncript,
																				$intTipoId, 
																				$strNit,
																				$strNomFiscal,
																				$strDirFiscal );

							$request_cita = $this->model->insertCliente($strIdentificacion,
																				$strNombre, 
																				$strApellido, 
																				$intTelefono, 
																				$strEmail,
																				$strPasswordEncript,
																				$intTipoId, 
																				$strNit,
																				$strNomFiscal,
																				$strDirFiscal );													
						
					}else{
						$option = 2;
						$strPassword =  empty($_POST['txtPassword']) ? "" : hash("SHA256",$_POST['txtPassword']);
						if($_SESSION['permisosMod']['u']){
							$request_user = $this->model->updateCliente($idUsuario,
																		$strIdentificacion, 
																		$strNombre,
																		$strApellido, 
																		$intTelefono, 
																		$strEmail,
																		$strPassword, 
																		$strNit,
																		$strNomFiscal, 
																		$strDirFiscal);
						}
					}
	
					if($request_user > 0 )
					{
	//si inserta correctamente lo que hacemos es armamos el array para enviar el msj porajax 					
						if($option == 1){
							$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
				//creamos esa var nombreUsuario para almacenar el nombre y apellido de los que viene por póst		
							$nombreUsuario = $strNombre.' '.$strApellido;
					//armamos el array donde le pasamos datos que viene por post		
							$dataUsuario = array('nombreUsuario' => $nombreUsuario,
												 'email' => $strEmail,
												 'password' => $strPassword,
												 'asunto' => 'Bienvenido a tu tienda en línea');
				 //enviando esos datos al metodo que corresponde al smpt 										 
							sendEmail($dataUsuario,'email_bienvenida');
						}else{
							$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
						}
					}else if($request_user == 'exist'){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! el email o la identificación ya existe, ingrese otro.');		
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
	*/









	}
 ?>