<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Agregar nueva clase</h4>
</div>
<div class="modal-body">
    <form class="frmClase" role="form" method="post">
        <div class="row mb25">
            <div class="col-xs-12">
                <label><i class="fa fa-inbox"></i>Usuario</label>
                <select class="form-control" name="ajaxCmbUser">
                     <option value="0">Seleccione el usuario para la clase.</option>
                    <?php if($obj_usuario) { ?>
                        <?php foreach($obj_usuario as $obj_us) {?>
                             <option value="<?php echo $obj_us->idusuario; ?>">
                                 <?php echo $obj_us->nombre_p . ' ' . $obj_us->apellido_p; ?>
                             </option>
                    
                        <?php } ?>
                    <?php } ?>
                   
                </select>
            </div>
            
        </div>
        <div class="row mb25">
            <div class="col-xs-12">
                <label>M&aacute;xima cantidad de alumnos</label>
                 <input type="text" class="form-control"  value="" name="txt_cant_max">
            </div>    
        </div>
        <div class="row mb25">
            <div class="col-xs-12">
                <label>Descripci&oacute;n</label>
                 <input type="text" class="form-control"  value="" name="txt_descripcion">
            </div>    
        </div>
        
    </form>
</div>
<div class="modal-footer no-border">
    <button type="button" id="ajaxBtnAddClass" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="ajaxBtnAgregar"
             onclick="Global.prototype.send_ajax('frmClase'
                , '<?php echo base_url('clases/agregar_clase'); ?>'
                , 'ajaxBtnAddClass', 'agregar_clases')" >Guardar</button>
</div>




