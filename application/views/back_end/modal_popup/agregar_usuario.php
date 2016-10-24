<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Agregar un nuevo usuario</h4>
</div>
<div class="modal-body">
    <form class="frmAddDiscount" role="form" method="post">
        <div class="row mb25">
            <div class="col-xs-12">
                <label><i class="fa fa-user"></i> Perfil</label>
                 <?php 
                 if($objPerfil){
                 ?>
                    <select class="form-control" name="ajaxPerfil">
                        <option value="0">Seleccione el perfil de usuario</option>
                        <?php foreach($objPerfil as $obj ) {?>
                        <option value = "<?php echo $obj->idperfil ?>"><?php echo $obj->descripcion ?></option>
                        <?php }?>
                    </select>
                 <?php 
                 }
                 ?>
                
            </div>
         </div>
        <div class="row mb25">
            <div class="col-xs-6">
                <label><i class="fa fa-user"></i> Primer Nombre</label>
                <input type="text" class="form-control" value="" id="txt_first_name" name="txt_first_name">
            </div>
             <div class="col-xs-6">
                <label><i class="fa fa-user"></i> Segundo Nombre</label>
                <input type="text" class="form-control" value="" id="txt_second_name" name="txt_second_name">
            </div>
        </div>
        <div class="row mb25">
            <div class="col-xs-6">
                <label><i class="fa fa-user"></i> Apellido Paterno</label>
                <input type="text" class="form-control" value="" id="txt_first_s_name" name="txt_first_s_name">
            </div>
             <div class="col-xs-6">
                <label><i class="fa fa-user"></i> Apellido Materno</label>
                <input type="text" class="form-control" value="" id="txt_second_s_name" name="txt_second_s_name">
            </div>
        </div>
         <div class="row mb25">
            <div class="col-xs-6">
                <label><i class="fa fa-user"></i> Usuario</label>
                <input type="text" class="form-control" value="" id="txt_user" name="txt_user">
            </div>
             <div class="col-xs-6">
                <label><i class="fa fa-user"></i> Contraseña</label>
                <input type="password" class="form-control" value="" id="txt_pass" name="txt_pass">
            </div>
        </div>
        <div class="row mb25">
            <div class="col-xs-12">
                <label><i class="fa fa-inbox"></i> Correo</label>
                <input type="text" class="form-control" value="" id="txt_correo" name="txt_correo">
            </div>
        </div>
        
    </form>
</div>
<div class="modal-footer no-border">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="ajaxBtnEdit" 
            onclick="Global.prototype.send_ajax('frmAddDiscount'
                , '<?php echo base_url('usuario/ingresar_usuario'); ?>'
                , 'ajaxBtnEdit', 'agregar_usuario')">Guardar</button>
</div>




