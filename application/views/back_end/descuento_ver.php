<!-- content panel -->
<div class="main-panel">

    <!-- top header -->
    <?php $this->load->view($_NavBar); ?>
    <!-- /top header -->

    <div id="reload" style="display: none;"></div>
    <!-- main area -->
    <div class="main-content">
        
        <div class="panel panel-success">
            <div class="panel-heading border">
                Aqu&iacute; estan todos los descuentos que tienes agregados.
            </div>
            <div class="panel-body">
                <div class="row no-margin">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table id="tblDescuentos"  class="table table-striped table-bordered datatables">
                                <thead>
                                    <tr>
                                        <th width="30px"></th>
                                        <th>Tienda</th>
                                        <th>Direcci&oacute;n</th>
                                        <th>(%) Descuento</th>
                                        <td width="30px"></td>
                                        <td width="30px"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if($objsDescuento)
                                    {
                                    foreach($objsDescuento as $objDesc) { ?>
                                    <tr>
                                        <td>
                                            <img src="<?php echo base_url('assets/images/cards/' . $objDesc->imagen); ?>" data-toggle="tooltip" data-placement="top" 
                                                 title="<?php echo $objDesc->nombre_tarjeta . ' - ' . $objDesc->tipo_tarjeta; ?>" height="32" >
                                        </td>
                                        <td><?php echo $objDesc->nombre; ?></td>
                                        <td><?php echo $objDesc->direccion; ?></td>
                                        <td sty>
                                            <i class="pull-left">
                                                <?php echo $objDesc->cantidad_desc; ?>%
                                            </i>
                                            <i class="pull-right" style="width:80%; margin-top: 7px;">
                                            <div class="progress progress-striped active" data-toggle="tooltip" data-placement="top" title="<?php echo $objDesc->cantidad_desc; ?>%">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $objDesc->cantidad_desc; ?>" aria-valuemin="0" aria-valuemax="100"
                                                     data-percent="<?php echo $objDesc->cantidad_desc; ?>"></div>
                                            </div>
                                            </i>
                                        </td>
                                        
                                        <td>
                                            <center>
                                                <button class="btn btn-info btn-sm mr5" data-toggle="modal" data-target=".bs-modal-sm" 
                                                        onclick="Global.prototype.modal_ajax('<?php echo base64_encode($objDesc->id); //base64_encode($this->encrypt->encode($objDesc->id)); ?>', 'modal_agregar_descuento', '<?php echo base_url('descuento/editar_descuento'); ?>');">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <button class="btn btn-danger btn-sm mr5 panel-remove" id="<?php echo base64_encode($objDesc->id); //base64_encode($this->encrypt->encode($objDesc->id)); ?>" data-toggle="delete-desc" data-url="<?php echo base_url('descuento/delete'); ?>">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </center>
                                        </td>
                                    </tr>
                                    <?php }
                                    }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /main area -->
</div>
<!-- /content panel -->



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