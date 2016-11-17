<!-- content panel -->
<div class="main-panel">

    <?php $this->load->view($_NavBar); ?>

    <!-- main area -->
    <div class="main-content">
        <div class="row">
            <section id="portfolio">
        <div class="container">
            <?php if($obj_material) {?>
                <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Cuentos Disponibles</h2>
                 
                    <hr class="star-primary">
                </div>
            </div>
            
            <div class="row">
                <?php foreach($obj_material as $obj_m){ ?>
                    <div class="col-sm-4 portfolio-item">
                        <a href="assets/resources/media/animaciones/<?php echo $obj_m->idmaterial_interactivo ?>.html" class="portfolio-link" data-toggle="modal">
                            <div class="caption">

                            </div>
                            <img src="assets/template/img/portfolio/<?php echo $obj_m->idmaterial_interactivo ?>.png" class="img-responsive" alt="">
                        </a>
                    </div>
                <?php }?>
                
            </div>
            <?php }else{ ?>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>No existen cuentos disponibles</h2>
                 
                    <hr class="star-primary">
                </div>
            </div>
            <?php }?>
          
            
        </div>
    </section>

    </div>
</div>
<!-- /content panel -->