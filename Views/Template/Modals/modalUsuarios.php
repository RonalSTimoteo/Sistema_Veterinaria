<!-- Modal -->
<div class="modal fade" id="modalFormUsuarios" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formUsuarios" name="formUsuarios" class="">
                    <input type="hidden" id="id_usu" name="id_usu" value="">
                    <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>

                    <div class="">
                        <label for="nombres">Nombres:</label>
                        <input type="text" class="form-control" name="nom_usu" id="nom_usu" placeholder="Nombres">
                    </div>

                    <div class="">
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" class="form-control" name="ape_usu" id="ape_usu" placeholder="Apellidos">
                    </div>

                    <div class="">
                        <label for="dni">DNI:</label>
                        <input type="text" class="form-control" name="dni" id="dni" placeholder="DNI">
                    </div>

                    <div class="">
                        <label for="telefono">Télefono:</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Télefono">
                    </div>

                    <div class="">
                        <label for="correo">Correo:</label>
                        <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo">
                    </div>

                    <div class="">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="pass_usu" id="pass_usu" placeholder="Password">
                    </div>
                    
                    <div class="">
                        <label for="rol">Rol </label>
                        <select class="form-control"  id="id_rol" name="id_rol" required=""></select>
                    </div>
                    
                    <div class="">
                        <button id="btnActionForm" class="btn btn-primary btn-lg btn-block" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
