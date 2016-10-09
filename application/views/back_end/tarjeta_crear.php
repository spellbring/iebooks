<!-- content panel -->
<div class="main-panel">

    <!-- top header -->
    <?php $this->load->view($_NavBar); ?>
    <!-- /top header -->

    <!-- main area -->
    <div class="main-content">
        <div class="panel panel-primary">
            <div class="panel-heading border">
                Crear Tarjeta
            </div>
            <div class="panel-body">
                <div class="row no-margin">
                    <div class="col-lg-12">
                        <form class="form-horizontal bordered-group frmUploadCard" enctype="multipart/form-data" role="form" method="post">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tipo de tarjeta</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="cmbTipo">
                                        <option value="0">Seleccione el tipo tarjeta</option>
                                        <?php foreach($objsTipoTarjeta as $objTipo) { ?>
                                        <option value="<?php echo $objTipo->id; ?>"><?php echo $objTipo->nombre; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input type="text" name="txtNombre" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Imagen Tarjeta</label>
                                <div class="col-sm-10">
                                    <input type="file" name="flImage">
                                    <p class="help-block">Seleccione una imagen para la tarjeta.</p>
                                </div>
                            </div>
                            
                            <div class="pull-right">
                                <button type="button" class="btn btn-default confirm">Volver</button>
                                <button type="button" class="btn btn-primary" id="btnCrear" onclick="Tarjeta.prototype.send('frmUploadCard', '<?php echo base_url('tarjeta/createCard'); ?>', 'btnCrear')">Crear Tarjeta</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /main area -->
</div>
<!-- /content panel -->