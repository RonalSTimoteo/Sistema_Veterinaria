<?php 
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


		public function fechas_bloqueadas()
		{
			// Obtener todas las fechas bloqueadas
			$fechasBloqueadas = $this->model->obtenerFechasBloqueadas();
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
			$columnasBloqueadas = $this->model->obtenerColumnasBloqueadas();
			$columnas = array();
			foreach ($columnasBloqueadas as $columna) {
				$columnas[] = $columna['Nomb_dia'];
			}
			// Devolver el array de columnas en formato JSON
			header('Content-Type: application/json');
			echo json_encode($columnas);
			die();
		}
		


	}
 ?>