<?php 
headerTienda($data);
$arrServicio = $data['servicio']; 
getModal('modalCita',$data);

?>
<script type="text/javascript" src="<?= media();?>/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/calendar.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

<script type="text/javascript" src="<?= media();?>/js/calendar.js"></script>
<script type="text/javascript" src="<?= media();?>/js/locales-all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script src="<?= media();?>/js/jquery.min.js"></script>
<br><br><br>
<hr>

<body>

<style>
/*Reducir dimension del calendario sin perder lo respondive*/
#calendar {
  width: 100%;
  max-width: 700px;
  height: 530px;
  margin: 0 auto;
}
</style>


<?php 
		if(isset($_SESSION['login'])){
?>
  <!--RECORDAR QUE ESTE ARCHIVO ES LA VISTA DE CALENDARIO-->
<!-- 
  ACA SE DIBUJA EL CALENDARIO(VISTA) EN LA RUTA http://localhost/prueba_veterinaria/calendario-->
  <div id='script-warning'>
    <code>ics/feed.ics</code> must be servable
  </div>

  <div id='loading'>loading...</div>
  <div id='calendar'></div>
 
<br>
<!--Boton del modal de registro de cita-->
  <div class="text-center mb-3">
    <button type="button" class="btn btn-primary" id="btnRervarCita">
      Reservar cita
    </button>
<!--	
	<button class="btn btn-primary" type="button" onclick="openModal();" ><i class="fas fa-plus-circle"></i> Nuevo</button>
-->
</div>

  <?php }else{ ?>
        <!-- De lo contrario envialo a logearse o registrarse--> 
<div class="container">
		<div class="row">
			<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">  
				<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-l-25 m-r--38 m-lr-0-xl">
					<div>
        <!-- De lo contrario envialo a logearse o registrarse--> 
						<ul class="nav nav-tabs" id="myTab" role="tablist">
						  <li class="nav-item">
						    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#login" role="tab" aria-controls="home" aria-selected="true">Iniciar Sesión</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#registro" role="tab" aria-controls="profile" aria-selected="false">Crear cuenta</a>
						  </li>
						</ul>
						<div class="tab-content" id="myTabContent">
						  <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="home-tab">
						  	<br>
						  	<form id="formLogin">
							  <div class="form-group">
							    <label for="txtEmail">Usuario</label>
							    <input type="email" class="form-control" id="txtEmail" name="txtEmail">
							  </div>
							  <div class="form-group">
							    <label for="txtPassword">Contraseña</label>
							    <input type="password" class="form-control" id="txtPassword" name="txtPassword">
							  </div>
							  <button type="submit" class="btn btn-primary">Iniciar sesión</button>
							</form>

						  </div>
						 <!-- formulario registrarse--> 
						 <div class="tab-pane fade" id="registro" role="tabpanel" aria-labelledby="profile-tab">
						  	<br>
						  	<form id="formRegister"> 
						 		<div class="row">
									<div class="col col-md-6 form-group">
										<label for="txtNombreCliente">Nombres</label>
										<input type="text" class="form-control" id="txtNombreCliente" name="txtNombreCliente" required="">
									</div>
									<div class="col col-md-6 form-group">
										<label for="txtApellidoCliente">Apellidos</label>
										<input type="text"  class="form-control" id="txtApellidoCliente" name="txtApellidoCliente" required="">
									</div>
						 		</div>
						 		<div class="row">
									<div class="col col-md-6 form-group">
										<label for="txtTelefonoCliente">Teléfono</label>
										<input type="text" class="form-control" id="txtTelefonoCliente" name="txtTelefonoCliente" required="" >
									</div>
									<div class="col col-md-6 form-group">
										<label for="txtEmailCliente">Email</label>
										<input type="email" class="form-control" id="txtEmailCliente" name="txtEmailCliente" required="">
									</div>
						 		</div>
								<button type="submit" class="btn btn-primary">Regístrate</button>
						 	</form>
						  </div>
						</div>
					<?php } ?>
					</div>
				</div>
			</div>
    </div>  
 </div>     
<!-- con esto podemos ver todos los datos q contiene esa var userData
 <php dep($_SESSION['userData']); ?>
  -->
<?php 
	footerTienda($data);
?>







