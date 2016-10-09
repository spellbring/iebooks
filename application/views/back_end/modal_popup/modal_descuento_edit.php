<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Editar descuento</h4>
</div>
<div class="modal-body">
    <form class="frmEditDiscount" role="form" method="post">
        <div class="row mb25">
            <div class="col-xs-6">
                <label><i class="fa fa-credit-card"></i> Tarjeta</label>
                <input type="text" class="form-control" readonly="" value="<?php echo $tarjeta; ?>">
            </div>
            <div class="col-xs-6">
                <label><i class="fa fa-building-o"></i> Tienda</label>
                <input type="text" class="form-control" readonly="" value="<?php echo $tienda; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <label>Porcentaje de descuento (&percnt;)</label>
                <div class="input-group mb25">
                    <input type="text" name="ajaxPercentDiss" value="<?php echo $porcentaje; ?>" readonly="" class="form-control bl0 br0 spinner2">
                </div>
            </div>
        </div>
        
        <div class="row mb25">
            <div class="col-xs-6">
                
                <label>Fecha inicio del descuento</label>
                <div class="input-prepend input-group">
                    <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="ajaxTxtDesde" name="ajaxTxtDesde" class="form-control" readonly="" style="background: #FFF;" value="<?php echo $fecha_desde; ?>">
                </div>
            </div>
            <div class="col-xs-6">
                <label>Fecha termino del descuento</label>
                <div class="input-prepend input-group">
                    <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="ajaxTxtHasta" name="ajaxTxtHasta" data-provide="datepicker" class="form-control" readonly="" style="background: #FFF;" value="<?php echo $fecha_hasta; ?>">
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer no-border">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="ajaxBtnEdit" onclick="Global.prototype.send_ajax('frmEditDiscount', '<?php echo base_url('descuento/modificar_descuento'); ?>', 'ajaxBtnEdit', 'modal_agregar_descuento')">Modificar</button>
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
</script>
