<!-- Modal FORMULARIO REGISTRAR
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
 -->





	<!-- Modal -->
	<div class="modal fade" id="ModalFormCitaAdmin">
		<div class="modal-dialog">
			<div class="modal-content">
			
				<!-- Encabezado del Modal -->
        <div class="modal-header headerUpdate">
					<h4 class="modal-title">Actualizar cita</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				
				<!-- Cuerpo del Modal -->
				<div class="modal-body">
					<form id="FormRegistroCitasAdmin">
            <input type="hidden" id="txtid_cita" name="txtid_cita" value=""> 
						<div class="form-group">
							<label for="fecha">Fecha:</label>
							<input type="date" class="form-control" id="txtfecha" name="txtfecha" required>
						</div>
            <div class="form-group">
          <label for="txthora">Seleccione hora de cita:</label>
           <select class="form-control"  id="txthora" name="txthora"> </select>
           </div>
						<div class="form-group">
							<label for="txtnombre">Nombre:</label>
							<input type="text" class="form-control" id="txtnombre" name="txtnombre" required>
						</div>
            <div class="form-group">
             <label for="txtlistMascota">Tipo mascota:</label>
          
             <select class="form-control"  id="txtlistMascota" name="txtlistMascota"  required=""></select>

            </div>
            <div class="form-group">
							<label for="txtEspecificacion">Especificacion:</label>
							<input type="text" class="form-control" id="txtEspecificacion" name="txtEspecificacion" required>
						</div>
            <div class="form-group">
							<label for="txtservicio">Servicio:</label>
							<input type="text" class="form-control" id="txtservicio" name="txtservicio" required>
						</div>
						<button type="submit" class="btn btn-primary">Enviar</button>
					</form>
				</div>
				
			</div>
		</div>
	</div>




