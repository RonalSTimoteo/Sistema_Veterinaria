<?php 

	class CalendarioModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}	

		public function obtenerFechasBloqueadas()
        {
            $sql = "SELECT fecha_bloqueo FROM bloquearfecha";
            //develve todos ls registros
            return $this->select_all($sql);
        }

		public function obtenerColumnasBloqueadas()
        {
			//extrayendo los dias donde el status es 1 
			$sql = "SELECT Nomb_dia FROM bloquearcolumna WHERE status = 1";
            //develve todos los registros
            return $this->select_all($sql);
        }
    



	}
 ?>