<!-- content panel -->
<div class="main-panel">

    <!-- top header -->
    <?php $this->load->view($_NavBar); ?>
    <!-- /top header -->

    <div id="reload" style="display: none;"></div>
    <!-- main area -->
    <div class="main-content">
        <div class="row mb25">
            
            <?php
            if($objsTarjeta) {
                foreach($objsTarjeta as $objTarjeta) { 
            ?>
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="pull-left"><?php echo $objTarjeta->nombre . ' · ' . $objTarjeta->nombre_tarjeta; ?></div>
                        <div class="panel-controls">
                            
                            <?php
                            if($objTarjeta->publicada)
                            {
                            ?>
                                <a href="#" data-url="<?php echo base_url('tarjeta/down_card'); ?>" id="<?php echo $this->encrypt->encode($objTarjeta->id); ?>" class="panel-refresh" data-toggle="down-card"><i class="fa fa-check-square-o"></i></a>
                            <?php
                            }
                            else
                            {
                            ?>
                                <a href="#" data-url="<?php echo base_url('tarjeta/up_card'); ?>" id="<?php echo $this->encrypt->encode($objTarjeta->id); ?>" class="panel-refresh" data-toggle="up-card"><i class="fa fa-square-o"></i></a>
                            <?php
                            }
                            ?>
                            
                            <a href="#" data-url="<?php echo base_url('tarjeta/deleteCard'); ?>" id="<?php echo $this->encrypt->encode($objTarjeta->id); ?>" class="panel-remove" data-toggle="delete-card">
                                <i class="panel-icon-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <center><img src="<?php echo base_url('assets/images/cards/' . $objTarjeta->imagen); ?>" height="192" ></center>
                    </div>
                </div>
            </div>
            <?php }
            } else { ?>
                <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        No existen tarjetas
                    </div>
                    <div class="panel-body">
                        Para ver sus tarjetas disponibles debe haber creado al menos una tarjeta en la opci&oacute;n <b><a href="<?php echo base_url('tarjeta/crear'); ?>">crear tarjeta</a></b>
                    </div>
                </div>
            </div>
            <?php } ?>
            
        </div>


    </div>
    <!-- /main area -->
</div>
<!-- /content panel -->