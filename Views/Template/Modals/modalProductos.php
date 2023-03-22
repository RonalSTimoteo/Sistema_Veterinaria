<!-- Modal -->
<div class="modal fade" id="modalFormProductos" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nueva Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formProductos" name="formProductos" class="">
              <input type="hidden" id="id_producto" name="id_producto" value="">
              <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>

              <div class="">
                            <label for="nombre">Producto:</label>
                            <input type="text" class="form-control" name="nom_pro" id="nom_pro" placeholder="Nombre del producto">
                        </div>


                        <div class="">
                            <label for="dni_admin">Descripción:</label>
                            <textarea class="form-control" rows="6" cols="40" name="descripcion" id="descripcion" placeholder="Descripcion del producto..."></textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="Precio">Precio:</label>
                            <input type="text" class="form-control" name="precio" id="precio" placeholder="00.00" onpaste="return false">
                        </div>

                        <div class="row">
                        <div class="">
                            <label >Categoría </label>
                            <select class="form-control"  id="listCategoria" name="listCategoria" required=""></select>
                        </div>
                        </div>
                            <div class="">
                          <button id="btnActionForm" class="btn btn-primary btn-lg btn-block" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>
                        </div>
              
            </form>
      </div>
    </div>
  </div>
</div>
