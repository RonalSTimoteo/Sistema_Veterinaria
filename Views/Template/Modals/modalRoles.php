<!-- Modal -->
<div class="modal fade" id="modalFormRoles" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formRoles" name="formRoles" class="">
              <input type="hidden" id="id_rol" name="id_rol" value="">
              <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>

              <div class="">
                            <label for="nombre">Rol:</label>
                            <input type="text" class="form-control" name="nom_rol" id="nom_rol" placeholder="Nombre del rol">
                        </div>
                      <div class="mt-1">
                          <button id="btnActionForm" class="btn btn-primary btn-lg btn-block" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>
                        </div>
              
            </form>
      </div>
    </div>
  </div>
</div>
