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



/*
// ya funciona  - ESTO SE ESTA REFLEJANDO EN EL NAVEGADOR SI PONEMOS LA URL http://localhost/prueba_veterinaria/calendario/getFechbloqueadas
public function fechas_bloqueadas()
{
    // Obtener todas las fechas bloqueadas
    $fechasBloqueadas = $this->model->obtenerFechasBloqueadas();
    $eventos = array();
    foreach ($fechasBloqueadas as $fecha) {
        $evento = array(

			'title' => 'Bloqueado',
			'start' => $fecha['fecha_bloqueo'],
			'backgroundColor' => '#f44336',
			'borderColor' => '#f44336',
			'editable' => false,
			'startEditable' => false,
			'durationEditable' => false,
			 
		
        );
        $eventos[] = $evento;
    }
    // Devolver el array de eventos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($eventos);
    die();
}
*/

/**
 * esto obtengo en el navegador en formato json
 * [{"title":"Bloqueado","start":"2023-03-28","color":"#f44336","editable":false,"startEditable":false,"durationEditable":false},
 * {"title":"Bloqueado","start":"2023-03-30","color":"#f44336","editable":false,"startEditable":false,"durationEditable":false},
 * {"title":"Bloqueado","start":"2023-03-24","color":"#f44336","editable":false,"startEditable":false,"durationEditable":false}]
 * 
 */


 /*
 public function eventos()
 {
	 // Obtener todas las fechas bloqueadas
	 $fechasBloqueadas = $this->model->obtenerFechasBloqueadas();
	 $eventos = array();
	 foreach ($fechasBloqueadas as $fecha) {
		 $evento = array(
			 'title' => 'Bloqueado',
			 'start' => $fecha['fecha_bloqueo'],
			 'color' => '#f44336',
			 'editable' => false,
			 'startEditable' => false,
			 'durationEditable' => false
		 );
		 $eventos[] = $evento;
	 }
	 // Devolver el array de eventos en formato JSON
	 $this->views->getView($this, "calendario", array("eventos" => $eventos));
	 die();
 
 }
*/


	}
 ?>