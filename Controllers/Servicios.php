<?php 
require_once("Models/TServicio.php");
require_once("Models/TCalendario.php");
require_once("Models/TCliente.php");
require_once("Models/LoginModel.php"); //-> para q funcione las var de sesion


class Servicios extends Controllers{
    use TServicio, TCalendario, TCliente;
    public $login;
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->login = new LoginModel();
   
    }

    public function servicios(){

    //envia el id del producti y la ruta - trae los productos de la BD
			$infoServicio = $this->getServiciost();  //devuelve un select apartir del id 
				//almacenamos el arrat de productos en la var data q es un array en su elemento ['producto']
				$data['servicio'] = $infoServicio;
//enviamos a la vista a traves de data  los prodcutos sacado de la BD 
        $this->views->getView($this,"servicios",$data);
}


//en la vista se captura elid y se le envia aca
//recibe el id para buscar info del pservicio seleccionado y mandar a la vista
   public function info($id_servicio) {
      $servicio = $this->selectServicio($id_servicio); //no trae id devuel un select aparti del nombre
        $data['servicio'] = $servicio;

        $infoServicio = $this->getServiciost();
        $data['servicios'] = $infoServicio;
        // Si no, se muestra la vista servicio.php 
        $this->views->getView($this, "info", $data);
    
   }


   public function fechas_bloqueadas()
   {
       // Obtener todas las fechas bloqueadas
       $fechasBloqueadas = $this->obtenerFechasBloqueadas();
       $fechas = array();
       foreach ($fechasBloqueadas as $fecha) {
           $fechas[] = $fecha['fecha_bloqueo'];
       }
       // Devolver el array de fechas en formato JSON
       header('Content-Type: application/json');
       echo json_encode($fechas);
       die();
   }


   function dias_bloqueados()
   {
       // Obtener todas las columnas bloqueadas
       $columnasBloqueadas = $this->obtenerColumnasBloqueadas();
       $columnas = array();
       foreach ($columnasBloqueadas as $columna) {
           $columnas[] = $columna['Nomb_dia'];
       }
       // Devolver el array de columnas en formato JSON
       header('Content-Type: application/json');
       echo json_encode($columnas);
       die();
   }

   public function citas($id_servicio) {
    //ACA PARA LLEVARL DATOS A LA VISTA EN EL MODAL QUEREMOS LLEVAR LE EL ID DEL USUARIO REGISTRAFO
//aca llevar los datos del servicio a la vista cita para capturar en el form el nombre del servicio
     
     $servicio = $this->selectServicio($id_servicio); 
     $data['servicio'] = $servicio;
      $this->views->getView($this, "citas", $data);
   }

//registro desde la vista - (REGISTRO - LOGIN)
   public function registro(){  
   // error_reporting(0);
    if($_POST){
//si llegan los datos 
//validamos q todos los campos esten llenos 
        if(empty($_POST['txtNombreCliente']) || empty($_POST['txtApellidoCliente']) || empty($_POST['txtTelefonoCliente']) || empty($_POST['txtEmailCliente']))
        {
            $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
        }else{ 
            $strNombreCliente = ucwords(strClean($_POST['txtNombreCliente']));
            $strApellidoCliente = ucwords(strClean($_POST['txtApellidoCliente']));
            $intTelefonoCliente = intval(strClean($_POST['txtTelefonoCliente']));
            $strEmailCliente = strtolower(strClean($_POST['txtEmailCliente']));
            $intTipoId = MUSUARIOS; //al modulo que va ingresar 
         
            $request_user = "";
            
            $strPassword =  passGenerator();

            $strPasswordEncript = hash("SHA256",$strPassword);

            $request_user = $this->insertCliente($strNombreCliente, 
                                                $strApellidoCliente, 
                                                $intTelefonoCliente, 
                                                $strEmailCliente,
                                                $strPasswordEncript,
                                                $intTipoId);
            if($request_user > 0 )
            {
               
         
                $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');

                $_SESSION['idUser'] = $request_user; //validamos si tiene el od de l usuario q sea registrado con la var de inicio sesion
                $_SESSION['login'] = true;
                $this->login->sessionLogin($request_user);
                
            }else if($request_user == 'exist'){
                $arrResponse = array('status' => false, 'msg' => '¡Atención! el email ya existe, ingrese otro.');		
            }else{
                $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
            }
        }
     //   dep($arrResponse);
        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
    }
    die();
}


//combo box PARA EXTREAR EL TIPO DE MASCOTA Y PONER EN EL SELECT
public function getSelectMascotas(){
    $htmlOptions = "";
    //devuelve todas las categorias 
    $arrData = $this->selectMascotas();
    if(count($arrData) > 0 ){
        for ($i=0; $i < count($arrData); $i++) { 
         if($arrData[$i]['status'] == 1 ){
            $htmlOptions .= '<option value="'.$arrData[$i]['id_mas'].'">'.$arrData[$i]['nom_mas'].'</option>';
        }  
        }
    }
    echo $htmlOptions;
    die();	
}

public function getSelectHoras() {
  
    $arrData = $this->selectHorasDisponibles();
    $disponibilidad = array();
    foreach ($arrData as $disponible) {
        $disponibilidad[] = $disponible['inicio'];
        $disponibilidad[] = $disponible['final'];
        $disponibilidad[] = $disponible['tiempo'];
        $disponibilidad[] = $disponible['dias'];
    }
    // Devolver el array de columnas en formato JSON
    header('Content-Type: application/json');
    echo json_encode($disponibilidad,JSON_UNESCAPED_UNICODE);
    die();

}

//********************CLIENTE Q REGISTRA CITA ********************************

    public function setClient(){
        if($_POST){
         // dep($_POST);
         // die();
                                   //convierte en int lo que viene en id rol.
                                   $intCita = intval($_POST['id_cita']);
                                   $strNombre = intval($_POST['nombre_id']);
                                   $strEmail = strtolower(strClean($_POST['email']));
                                   $strFecha = $_POST['fecha_cita']; //date
                                   $strHoras = strClean($_POST['listHoras']); //string
                                   $intMascota = intval($_POST['listMascota']);
                                   $especificacion = strtolower(strClean($_POST['mascota']));
                                   $intServicio = intval($_POST['servicio_id']);
                                   $request_cita = "";
                                   //como al insertar no se envia el id por lo tanto es vacio entra a ésta condicion y se inserta sin porblemas
           
                                                                           //el metodo insert a parte de insertar trae un id

                                         $request_cita = $this->insertCita($strNombre,
                                                                           $strEmail, 
                                                                           $strFecha, 
                                                                           $strHoras,
                                                                           $intMascota,  
                                                                            $intServicio,
                                                                           $especificacion
                                                                           );         
                         //si se ha insertado datos.
                            if($request_cita > 0 )
                            {                                         
                                     $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');                             
                                //CONFIG PARA ENVIAR CORREO A AMBOS EMPRESA-CLIENTE
                                     $dataUsuario = array('asunto' => "Nueva Reserva",
                                     'email' => "1346203@senati.pe",
                                     'nombreSuscriptor' => $strNombre,
                                     'emailSuscriptor' => $strEmail );
                                     sendMailLocal($dataUsuario,"email_suscripcion");
                            }  
         //  dep($arrResponse);
            echo json_encode($arrResponse);
        }//CIERRA EK IF DEL POST		
        die();
    }//cierra la funcion 

}
?>