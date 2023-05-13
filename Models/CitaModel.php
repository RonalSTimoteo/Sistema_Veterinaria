<?php 

	class CitaModel extends Mysql
	{
		private $intCita;

		public function __construct()
		{
			parent::__construct();
		}	

	

  public function selectCitas()
  {
	//$sql = "SELECT * FROM cita WHERE status != 0";
	$sql = "SELECT c.id_cita, u.nom_usu as usuario, 
	c.fecha, c.hora, m.nom_mas as mascota, s.nom_servicio 
	as servicio, c.especificacion, c.status 
    FROM cita c 
    INNER JOIN usuario u ON c.id_usu = u.id_usu 
    INNER JOIN mascota m ON c.id_mas = m.id_mas 
    INNER JOIN servicio s ON c.id_servicio = s.id_servicio
    WHERE c.status != 0";

	$request = $this->select_all($sql);
	return $request;
  }	

  public function selectCita(int $idCita)
  {
	$this->intCita = $idCita;

	$sql = "SELECT c.id_cita, u.nom_usu as usuario, 
	c.fecha, c.hora, m.nom_mas as mascota, s.nom_servicio 
	as servicio, c.especificacion, c.status 
    FROM cita c 
    INNER JOIN usuario u ON c.id_usu = u.id_usu 
    INNER JOIN mascota m ON c.id_mas = m.id_mas 
    INNER JOIN servicio s ON c.id_servicio = s.id_servicio
     WHERE c.id_cita = $this->intCita";

	  $request = $this->select($sql);
	  return $request;
  }	




	}
 ?>