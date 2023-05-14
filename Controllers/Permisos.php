<?php 

	class Permisos extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function getPermisosRol(int $idrol)
		{
			$rolid = intval($idrol);
			if($rolid > 0)
			{
                //obtenemos todos los modulos
				$arrModulos = $this->model->selectModulos();

                //obtenemos todos los permisos de ese rol
				$arrPermisosRol = $this->model->selectPermisosRol($rolid);
                //
				//$arrRol = $this->model->getRol($rolid);

                //array que va tener las 4 operaciones leer-escr-actua-elimi
				$arrPermisos = array('r' => 0, 'w' => 0, 'u' => 0, 'd' => 0);

				$arrPermisoRol = array('id_rol' => $rolid);

                //si esta vacio 
				if(empty($arrPermisosRol))
				{
      //recorremos todos los registros y cada uno de los  registro le colocamos el item permisos
          //y todo eso ca ser igual al arry q tiene las 4 operaciones basicas
					for ($i=0; $i < count($arrModulos) ; $i++) { 

						$arrModulos[$i]['permisos'] = $arrPermisos;
					}
            //si el rol tiene permisos 
				}else{

          //le asiganams a los elementos el valor que va tener arrPermisosRol en su posicion r y asi sucevamenete
				//finalmente de arrModulos en su posicion i le colocamos el item permiso =  a $arrPermisos de esa maner seteamos
                    for ($i=0; $i < count($arrModulos); $i++) {
						$arrPermisos = array('r' => 0, 'w' => 0, 'u' => 0, 'd' => 0);
						if(isset($arrPermisosRol[$i])){
							$arrPermisos = array('r' => $arrPermisosRol[$i]['r'], 
												 'w' => $arrPermisosRol[$i]['w'], 
												 'u' => $arrPermisosRol[$i]['u'], 
												 'd' => $arrPermisosRol[$i]['d'] 
												);
						}
						$arrModulos[$i]['permisos'] = $arrPermisos;
					}
				}
                //a arrPermisoRol le asiganams un posicion modulos y q vase igual array arrModulos q ya tiene todo seteado
				$arrPermisoRol['modulos'] = $arrModulos;
            //para enviar  todo la info al modal permisos    
				$html = getModal("modalPermisos",$arrPermisoRol);
			}
			die();
		}

		public function setPermisos()
		{
            //dep($_POST);
          //  die();
            
			if($_POST)
			{
				$intIdrol = intval($_POST['idrol']);
				$modulos = $_POST['modulos'];

				$this->model->deletePermisos($intIdrol);
				foreach ($modulos as $modulo) {
					$idModulo = $modulo['id_modulo'];
					$r = empty($modulo['r']) ? 0 : 1;
					$w = empty($modulo['w']) ? 0 : 1;
					$u = empty($modulo['u']) ? 0 : 1;
					$d = empty($modulo['d']) ? 0 : 1;
					$requestPermiso = $this->model->insertPermisos($intIdrol, $idModulo, $r, $w, $u, $d);
				}
				if($requestPermiso > 0)
				{
					$arrResponse = array('status' => true, 'msg' => 'Permisos asignados correctamente.');
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible asignar los permisos.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
            
		}
	}
 ?>