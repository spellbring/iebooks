<!-- content panel -->
<div class="main-panel">

    <!-- top header -->
    <?php $this->load->view($_NavBar); ?>
    <!-- /top header -->

    <!-- main area -->
    <div class="main-content">
        <div class="panel panel-primary">
            <div class="panel-heading border">
                Agregar Descuento
            </div>
            <div class="panel-body">
                <div class="row no-margin">
                    <div class="col-lg-12">
                        <?php
                        if($objsTarjeta)
                        {
                        ?>
                        <form class="form-horizontal bordered-group frmSearchDisscount" enctype="multipart/form-data" role="form" method="post">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Con la tarjeta</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="cmbCard">
                                        <option value="0">Seleccione el tipo tarjeta</option>
                                        <?php foreach($objsTarjeta as $objCard) {
                                        if($this->session->userdata('sess_flash_id_tarjeta') == $objCard->id)
                                        {
                                        ?>
                                        <option value="<?php echo $objCard->id; ?>" selected><?php echo $objCard->nombre . ' · ' . $objCard->nombre_tarjeta; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $objCard->id; ?>"><?php echo $objCard->nombre . ' · ' . $objCard->nombre_tarjeta; ?></option>
                                        <?php } }?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label class="col-sm-2 control-label">Nombre de la tienda</label>
                                <div class="col-sm-10">
                                    <input type="text" name="txtNombreTienda" class="form-control">
                                </div>
                            </div> -->
                            
                            
                            <div class="pull-right">
                                <button type="button" class="btn btn-primary" id="btnBuscar" onclick="Descuento.prototype.search('frmSearchDisscount', '<?php echo base_url('descuento/buscar'); ?>', 'btnBuscar')">Buscar Tienda</button>
                            </div>

                        </form>
                        <?php
                        }
                        else
                        {
                            echo 'Para agregar un descuento debe tener al menos una de sus tarjetas publicada';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
        if($objsDescuento)
        {
        ?>
        <div class="panel panel-success">
            <div class="panel-heading border">
                Tiendas disponibles para esta tarjeta
            </div>
            <div class="panel-body">
                <div class="row no-margin">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table id="tblTiendasDisponibles"  class="table table-striped table-bordered datatables">
                                <thead>
                                    <tr>
                                        <th>Tienda</th>
                                        <th>Direcci&oacute;n</th>
                                        <th>Ciudad</th>
                                        <th>Correo</th>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($objsDescuento as $objDesc) { ?>
                                    <tr>
                                        <td><?php echo $objDesc->nombre; ?></td>
                                        <td><?php echo $objDesc->direccion; ?></td>
                                        <td><?php echo $objDesc->nombre_ciudad; ?></td>
                                        <td><?php echo $objDesc->correo; ?></td>
                                        <td>
                                            <center>
                                                <button class="btn btn-info btn-sm mr5" data-toggle="modal" data-target=".bs-modal-sm" 
                                                        onclick="Global.prototype.modal_ajax('<?php echo base64_encode($objDesc->id); //base64_encode($this->encrypt->encode($objDesc->id)); ?>', 'modal_agregar_descuento', '<?php echo base_url('descuento/descuento_modal'); ?>');">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </center>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>

    </div>
    <!-- /main area -->
</div>
<!-- /content panel -->


<?php
if($objsTarjeta)
{
?>
<div class="modal bs-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modal_agregar_descuento">
        
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Espere mientras se abre la ventana</h4>
            </div>
            <div class="modal-body">
                <p>Si ve esta ventana por mucho tiempo, cierrela y vuelva a intentar.</p>
            </div>
            <div class="modal-footer no-border">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
            
            
        </div>
    </div>
</div>
<?php
}
?>