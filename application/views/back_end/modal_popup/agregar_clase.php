<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Agregar nueva clase</h4>
</div>
<div class="modal-body">
    <form class="frmAddDiscount" role="form" method="post">
        <div class="row mb25">
            <div class="col-xs-12">
                <label><i class="fa fa-inbox"></i>Usuario</label>
                <select class="form-control" name="ajaxCmbTipo">
                    <option value="0">Seleccione el usuario para la clase.</option>
                </select>
            </div>
            
        </div>
        <div class="row mb25">
            <div class="col-xs-12">
                <label>M&aacute;xima cantidad de alumnos</label>
                 <input type="text" class="form-control"  value="">
            </div>    
        </div>
        
    </form>
</div>
<div class="modal-footer no-border">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="ajaxBtnAgregar" >Guardar</button>
</div>




