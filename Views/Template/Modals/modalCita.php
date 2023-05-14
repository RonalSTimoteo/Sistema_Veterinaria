
<!-- Modal para registrar la cita-->
<div class="modal" id="ModalRegistroCita" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
         <select class="form-control"  id="listMascota" name="listMascota"  required=""></select>
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




<!-- EL ERROR ES Q EL BOTON NO ESTASBA DENTRO DE L FORM-->


<!--modal alerta de fecha no seleccionada-->
<div class="modal" id="ModaFechNoSeleccionada" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:white; ">
      <div class="modal-header" style="background:#E52222;">
        <h5 class="modal-title" id="exampleModalLabel" style="color:white; font-size:24px">Alerta</h5>
        
      </div>
      <div class="modal-body" style="color:black; font-size:20px">
        No ha seleccionado ninguna fecha!
      </div>
  <!--para cerrar el modal cuando no se ha seleccionado ninguna fecha -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" style="margin:auto" data-bs-dismiss="modal" aria-label="Close" id="cerrar">Ok</button>
      </div>
    </div>
  </div>
</div>

