<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Asignar Material Interactivo.</h4>
</div>
<div class="modal-body">
    <form class="frmAddClass" role="form" method="post">
        <?php
        if ($obj_material) {
          
            ?>
            <div class="row">
                  <div class="col-sm-12 portfolio-item">
                      <select class="form-control" name="cmb_material">
                          <option value="0">Seleccione un material interactivo</option>
                          <?php foreach ($obj_material as $obj) {?>
                          <option value="<?php echo $obj->idmaterial_interactivo ?>"> 
                              <?php echo $obj->nombre_material ?> 
                          </option>
                          <?php } ?>
                      </select>
                  </div>
               
         <?php } ?>
        </div>
        <?php if($obj_clase_material){ ?>
        <div class="row">
            <?php foreach($obj_clase_material as $objm){ ?>
                  <div class="col-sm-4 portfolio-item">
                    <a href="assets/resources/media/animaciones/<?php echo $objm->material_interactivo_idmaterial_interactivo ?>.html" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                          <?php echo $objm->nombre_material ?>
                        </div>
                        <img src="assets/template/img/portfolio/<?php echo $objm->material_interactivo_idmaterial_interactivo ?>.png" class="img-responsive" alt="">
                    </a>
                  </div>
            <?php } ?>
        <?php } ?>
        </div>
       
    </form>
</div>
<div class="modal-footer no-border">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    <button type="button" id="ajaxBtnAdd" class="btn btn-primary" 
            onclick="Global.prototype.send_ajax('frmAddClass'
                             , '<?php echo base_url('clases/asignar_material'); ?>'
                             , 'ajaxBtnAdd', 'agregar_clases')">Agregar</button>
</div>
