<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Agregar un nuevo usuario</h4>
</div>
<div class="modal-body">
    <form class="frmAddDiscount" role="form" method="post">
        <div class="row mb25">
            <div class="col-xs-12">
                <label><i class="fa fa-user"></i> Perfil</label>
               <select class="form-control" name="ajaxCmbTipo">
                    <option value="0">Seleccione el perfil de usuario</option>
                </select>
            </div>
         </div>
        <div class="row mb25">
            <div class="col-xs-6">
                <label><i class="fa fa-user"></i> Primer Nombre</label>
                <input type="text" class="form-control" value="">
            </div>
             <div class="col-xs-6">
                <label><i class="fa fa-user"></i> Segundo Nombre</label>
                <input type="text" class="form-control" value="">
            </div>
        </div>
        <div class="row mb25">
            <div class="col-xs-6">
                <label><i class="fa fa-user"></i> Apellido Paterno</label>
                <input type="text" class="form-control" value="">
            </div>
             <div class="col-xs-6">
                <label><i class="fa fa-user"></i> Apellido Materno</label>
                <input type="text" class="form-control" value="">
            </div>
        </div>
         <div class="row mb25">
            <div class="col-xs-6">
                <label><i class="fa fa-user"></i> Usuario</label>
                <input type="text" class="form-control" value="">
            </div>
             <div class="col-xs-6">
                <label><i class="fa fa-user"></i> Contraseña</label>
                <input type="password" class="form-control" value="">
            </div>
        </div>
        <div class="row mb25">
            <div class="col-xs-12">
                <label><i class="fa fa-inbox"></i> Correo</label>
                <input type="text" class="form-control" value="">
            </div>
            
        </div>
        
    </form>
</div>
<div class="modal-footer no-border">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="ajaxBtnAgregar" >Guardar</button>
</div>




