<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Agregar descuento a tienda</h4>
</div>
<div class="modal-body">
    <form class="frmAddDiscount" role="form" method="post">
        <div class="row mb25">
            <div class="col-xs-6">
                <label><i class="fa fa-credit-card"></i> Tarjeta</label>
               <select class="form-control" name="ajaxCmbTipo">
                    <option value="0">Seleccione el tipo tarjeta</option>
                    <?php foreach($objsTarjeta as $objCard) { 
                    if($this->session->userdata('sess_flash_id_tarjeta') == $objCard->id)
                    {
                    ?>
                    <option value="<?php echo base64_encode($objCard->id); ?>" selected><?php echo $objCard->nombre . ' · ' . $objCard->nombre_tarjeta; ?></option>
                    <?php } } ?>
                </select>
            </div>
            <div class="col-xs-6">
                <label><i class="fa fa-building-o"></i> Tienda</label>
                <input type="text" class="form-control" readonly="" value="<?php echo $tienda; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <label>Porcentaje de descuento (&percnt;)</label>
                <div class="input-group mb25">
                    <input type="text" name="ajaxPercentDiss" value="" readonly="" class="form-control bl0 br0 spinner2">
                </div>
            </div>
            <div class="col-xs-6">
                <label><i class="fa fa-tags"></i> Tope Descuento</label>
                <input type="text"  name="ajaxTopeDescuento" class="form-control" placeholder="Ej: 20.000">
            </div>
        </div>
        
        <div class="row mb25">
            <div class="col-xs-6">
                
                <label>Fecha inicio del descuento</label>
                <div class="input-prepend input-group">
                    <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="ajaxTxtDesde" name="ajaxTxtDesde" class="form-control" readonly="" style="background: #FFF;" value="<?php echo date('d/m/Y'); ?>">
                </div>
            </div>
            <div class="col-xs-6">
                <label>Fecha termino del descuento</label>
                <div class="input-prepend input-group">
                    <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="ajaxTxtHasta" name="ajaxTxtHasta" data-provide="datepicker" class="form-control" readonly="" style="background: #FFF;" value="<?php echo date_add_esp(date('Y-m-d'), 0, 1); ?>">
                </div>
            </div>
        </div>
        <div class="row checkbo" >
            <div class="col-xs-6">
                <p>Que días estara activo</p>
                <label class="cb-radio" data-hide="#divSelectDias">
                    <input name="ajaxTodosLosDias" value="true" type="radio" >
                    Todos los días
                </label>
                <br>
                <label class="cb-radio" data-show="#divSelectDias">
                    <input name="ajaxTodosLosDias" value="false" type="radio" >
                    Seleccionar días
                </label>
            </div>

            <div class="col-xs-6"   id="divSelectDias">
                <p>Seleccione los días</p>
                <select data-placeholder="Días en que el descuento estara activo." multiple id="ajaxSeleccionDias" class="col-xs-12" name="ajaxSeleccionDias[]">
                    <option>Lunes</option>
                    <option>Martes</option>
                    <option>Miércoles</option>
                    <option>Jueves</option>
                    <option>Viernes</option>
                    <option>Sábado</option>
                    <option>Domingo</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <label><i class="fa fa-info-circle"></i> Descripción</label>
                <textarea class="form-control" rows="3" name="ajaxDescripcion"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <label><i class="fa fa-info-circle"></i> Aclaraciones</label>
                <textarea class="form-control" rows="3" name="ajaxAclaraciones"></textarea>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer no-border">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="ajaxBtnAgregar" onclick="Global.prototype.send_ajax('frmAddDiscount', '<?php echo base_url('descuento/agregar_descuento'); ?>', 'ajaxBtnAgregar', 'modal_agregar_descuento')">Guardar</button>
</div>


<script>
$('.spinner2').TouchSpin({
    initval: 0,
    buttondown_class: 'btn btn-success',
    buttonup_class: 'btn btn-success'
  });
  
$('#ajaxTxtDesde').datepicker({
    format: 'dd/mm/yyyy'
}).on('changeDate', function(e){
    $(this).datepicker('hide');
});

$('#ajaxTxtHasta').datepicker({
    format: 'dd/mm/yyyy'
}).on('changeDate', function(e){
    $(this).datepicker('hide');
});

$('#ajaxSeleccionDias').chosen();
$('#ajaxSeleccionDias-select').chosen({
    disable_search_threshold: 7
});

$('.checkbo').checkBo();



</script>
