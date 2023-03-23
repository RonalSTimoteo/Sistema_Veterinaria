<?php 

//Se agrega este archivo TCliente

	require_once("Models/TCliente.php");

	class Calendario extends Controllers{
		use TCliente;

		public function __construct()
		{
			parent::__construct();
		}

		public function calendario()
		{
            $this->views->getView($this,"calendario");
		}


    //RECIBE DATOS DEL FORMULARIO 
	public function suscripcion(){
		if($_POST){

		//dep($_POST);
		//die();



			//confirmado q si esta llegando datos 

			$nombre = ucwords(strtolower(strClean($_POST['nombre'])));
			$email  = strtolower(strClean($_POST['email']));

			//devuelve la respuesta si ha insertado o no(sino es por q existe) 
//ACA LO Q PODRIA HACER ES MANDAR TDAS LOS DATOS Q SE VAN A INSERTAR 

				$suscripcion = $this->setCita($nombre,$email);
				
			//si trae un numero mayor a 0 es por q inserto
			if($suscripcion > 0){
				//armamos la respuesta - ESTO ENVIA AL JS 
				$arrResponse = array('status' => true, 'msg' => "Gracias por tu Agendar tu cita.");

				//Enviar correo
//envia mi correo de empresa q se va enviar el msj  tmb envia el correo del usuario		
				$dataUsuario = array('asunto' => "Nueva suscripción",
									'email' => "1346203@senati.pe",
									'nombreSuscriptor' => $nombre,
									'emailSuscriptor' => $email );
									sendMailLocal($dataUsuario,"email_suscripcion");
			}else{
				//ENVIA AL JS
				$arrResponse = array('status' => false, 'msg' => "El email todavia no fue registrado.");
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

		}
		die();
	}


	}
 ?>