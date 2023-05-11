<?php 

	class Login extends Controllers{

		public function __construct()
		{
	//
			session_start(); //->al tener session star podemos enviar a la vista las sesiones de un usuario
			//session_regenerate_id(true);
	//si existe esa var session lo direccionamos al dashboard -> de esa manera el usuario q este logeado nunca podra volver al login siempre estara en el dashbaord
			if(isset($_SESSION['login']))
			{
				header('Location: '.base_url().'/dashboard');
				die();
			}
			parent::__construct();
		}

		public function login()
		{

			$data['page_tag'] = "Login - Veterinaria";
			$data['page_title'] = "Veterinaria";
			$data['page_name'] = "login";
			$data['page_functions_js'] = "functions_login.js";
			$this->views->getView($this,"login",$data);
		}


		public function loginUser(){
			//dep($_POST);
			if($_POST){
				if(empty($_POST['txtEmail']) || empty($_POST['txtPassword'])){
					$arrResponse = array('status' => false, 'msg' => 'Error de datos' );
				}else{
					$strUsuario  =  strtolower(strClean($_POST['txtEmail']));
	//AL PARECER EL ERROR ESTA CUANDO LE PONGO LA ENCRIPTACION - LO QUITE POR  ELMOMENTO Y EL ESTATUS ES TRUE 
					//$strPassword = $_POST['txtPassword'];
					$strPassword = hash("SHA256",$_POST['txtPassword']);
					$requestUser = $this->model->loginUser($strUsuario, $strPassword);
					//dep($requestUser);

					if(empty($requestUser)){
						$arrResponse = array('status' => false, 'msg' => 'El usuario o la contraseña es incorrecto.' ); 
					}else{
						$arrData = $requestUser;
						if($arrData['status'] == 1){
							$_SESSION['idUser'] = $arrData['id_usu'];
							$_SESSION['login'] = true;

	//si en nuestro usuario vamos a actulaizar algun dato y para no cerrar sesion y volver a iniciar sesion y cargar los datos nuevamente 
	    //entonces ese metodo hace q se carguen automaticamente los datos sin cerrar session
		$arrData = $this->model->sessionLogin($_SESSION['idUser']);
		//sirve para mandar a la vista los datos del usuario y colocar en cualquier parte de diseño cualquier dato del usario sea su nombre o rol etc
	                	$_SESSION['userData'] = $arrData;
  
							$arrResponse = array('status' => true, 'msg' => 'ok');
						}else{
							$arrResponse = array('status' => false, 'msg' => 'Usuario inactivo.');
						}
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}





	}
 ?>