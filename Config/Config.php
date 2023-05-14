<?php 
	
	//define("BASE_URL", "http://localhost/tienda_virtual/");

	const BASE_URL = "http://localhost/Veterinaria";

	//Zona horaria
	date_default_timezone_set('America/Lima');

	//Datos de conexión a Base de Datos
	const DB_HOST = "localhost";
	const DB_NAME = "proyecto_veterinaria";
	//const DB_NAME = "tgestiona";
	const DB_USER = "root";
	const DB_PASSWORD = "";
	const DB_CHARSET = "charset=utf8";

	//Deliminadores decimal y millar Ej. 24,1989.00
	const SPD = ".";
	const SPM = ",";

	//Simbolo de moneda
	const SMONEY = "Q";

	//Para envío de correo
	const ENVIRONMENT = 1; // Local: 0, Produccón: 1;
	//Datos envio de correo
	//Datos envio de correo
	const NOMBRE_REMITENTE = "Clinica Veterinaria";
	const EMAIL_REMITENTE = "134620@senati.pe";
	const NOMBRE_EMPESA = "Clinica Veterinaria";
	const WEB_EMPRESA = "www.ClinicaVeterinaria.com";

	
		//Módulos
		const MDASHBOARD = 1;
		const MUSUARIOS = 2;
		const MCALENDARIO = 3;
		const MSERVICIOS = 4;
		const MREPORTES = 6;




 ?>