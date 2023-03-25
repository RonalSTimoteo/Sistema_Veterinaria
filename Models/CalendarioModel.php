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
            //develve todos los registros
            return $this->select_all($sql);
        }
    



	}
 ?>