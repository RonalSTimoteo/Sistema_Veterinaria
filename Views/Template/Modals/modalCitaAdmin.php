<!-- Modal FORMULARIO REGISTRAR -->
<div class="modal fade" id="ModalFormRegistCitaAdmin" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formUsuario" name="formUsuario" class="form-horizontal">
              <input type="hidden" id="idUsuario" name="idUsuario" value="">
              <p class="text-primary">Todos los campos son obligatorios.</p>

         
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtNombre">Nombre</label>
                  <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" required="">
                </div>
                <div class="form-group col-md-6">
                  <label for="txtApellido">Fecha</label>
                  <input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido" required="">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtApellido">Apellidos</label>
                  <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" required="" onkeypress="return controlTag(event);">
                </div>
                <div class="form-group col-md-6">
                  <label for="txtEmail">Hora disponible</label>
                  <input type="email" class="form-control valid validEmail" id="txtEmail" name="txtEmail" required="">
                </div>


                <div class="form-group col-md-6">
                <label for="txtTelefono">DNI</label>
                  <input type="email" class="form-control valid validEmail" id="txtEmail" name="txtEmail" required="">
                </div>
                <div class="form-group col-md-6">
                  <label for="txtEmail">Tipo mascota</label>
                  <input type="email" class="form-control valid validEmail" id="txtEmail" name="txtEmail" required="">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                <label for="txtTelefono">Email</label>
                    <select class="form-control" data-live-search="true" id="listRolid" name="listRolid" required >
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="listStatus">Servicio</label>
                    <select class="form-control selectpicker" id="listStatus" name="listStatus" required >
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                    </select>
                </div>
             </div>

             <div class="form-row">
                <div class="form-group col-md-6">
                <label for="txtEmail">Telefono</label>
                    <select class="form-control" data-live-search="true" id="listRolid" name="listRolid" required >
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="listStatus">Especificacion</label>
                    <select class="form-control selectpicker" id="listStatus" name="listStatus" required >
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                    </select>
                </div>
             </div>
         

              <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
            </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal FORMULARIO  EDITAR-->
<!-- Modal para registrar la cita-->
<div class="modal" id="ModalFormEditCitaAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:white; ">
      <div class="modal-header" style="background:#5499C7;">

  
  <!-- Botón de cerrar -->
      <div class="text-center w-100">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white; font-size:24px">Registrado con éxito</h5>
        </div>
        <button type="button" class="close mr-3" id="close-modal-btn" data-dismiss="modal" aria-label="Close">
          X
        </button>
      </div>


      <div class="modal-body" style="color:black; font-size:20px">
 <!-- FORMULARIO -->     
      <form id="FormRegistrarCita" name="FormRegistrarCita">
      <input type="hidden" id="id_cita" name="id_cita" value=""> 

     <!-- 
      <input type="hidden" id="id_usu" name="id_usu" value="<php echo $_SESSION['idUser']; ?>">
-->
      <div class="form-group">
          <label for="text">Fecha de cita :</label>
          <input type="text" class="form-control" id="fecha_cita" readonly>
        </div>

<!-- alternativa si no renderiza
        <div class="form-group">
          <label for="hora">Seleccione hora de cita:</label>
          <select title="Horas disponibles" class="form-control"  id="listHoras" name="listHoras"> </select>
        </div>
-->
        <div class="form-group">
          <label for="hora">Seleccione hora de cita:</label>
          <select class="form-control"  id="listHoras" name="listHoras"> </select>
        </div>

        <div class="form-group">
          <label for="text">Nombre :</label>
          <input type="hidden" id="nombre_id" name="nombre_id" value="<?php echo $_SESSION['userData']['id_usu']; ?>">
          <input type="text" id="nombre" name="nombre" class="form-control"  placeholder="Nombre completo"  value="<?php echo $_SESSION['userData']['nom_usu']; ?>" readonly>      
        </div> 

        <div class="form-group">
          <label for="email">Email :</label>
          <input type="email" id="email" name="email" class="form-control" value="<?php echo $_SESSION['userData']['correo']; ?>" readonly>
        </div>

        <div class="form-group">
         <label for="listMascota">Tipo mascota:</label>
         <select class="form-control" data-live-search="true" id="listMascota" name="listMascota"  required=""></select>
       </div>

        <div class="form-group">
          <label for="text">Especificacion(opcional) :</label>
          <input type="text" id="mascota" name="mascota" class="form-control"  placeholder="Nombre de la mascota"  value="" >
        </div> 

        <?php 
    $arrServicio = $data['servicio']; 
?>
<?php if (!empty($arrServicio)) { ?>
  <div class="form-group">
    <?php foreach ($arrServicio as $servicio) { ?>
      <input type="hidden" id="servicio_id" name="servicio_id" value="<?= $servicio['id_servicio']; ?>">
      <label for="text">Servicio:</label>
      <input type="text" id="servicio" name="servicio" class="form-control" value="<?= $servicio['nom_servicio']; ?>" readonly>
    <?php } ?>
  </div>
<?php } ?>


      <div class="modal-footer">
             <button id="btnActionForm" class="btn btn-primary btn-lg btn-block" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>
      </div>

      </form>
      </div>

    </div>
  </div>
</div>


