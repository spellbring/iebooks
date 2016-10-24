<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Asignar Material Interactivo.</h4>
</div>
<div class="modal-body">
    <form class="frmAddClass" role="form" method="post">
       <div class="row">
                <div class="col-sm-4 portfolio-item">
                    <a>
                        <div class="caption">
                            <label for="check_1">La casa en el bosque</label>
                            <input type="checkbox" id="check_1">
                        </div>
                        <img src="assets/template/img/portfolio/cabin.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a >
                        <div class="caption">
                           <label for="check_2">Pastelitos</label>
                           <input type="checkbox" id="check_2">
                        </div>
                        <img src="assets/template/img/portfolio/cake.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a>
                        <div class="caption">
                           <label for="check_3">El circo divertido</label>
                           <input type="checkbox" id="check_3">
                        </div>
                        <img src="assets/template/img/portfolio/circus.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a>
                        <div class="caption">
                            <label for="check_4">Las consolas</label>
                            <input type="checkbox" id="check_4">
                        </div>
                        <img src="assets/template/img/portfolio/game.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a>
                        <div class="caption">
                            <label for="check_5">La caja fuerte</label>
                            <input type="checkbox" id="check_5">
                        </div>
                        <img src="assets/template/img/portfolio/safe.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a>
                        <div class="caption">
                            <label for="check_6">El submarino amarillo</label>
                            <input type="checkbox" id="check_6">
                        </div>
                        <img src="assets/template/img/portfolio/submarine.png" class="img-responsive" alt="">
                    </a>
                </div>
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
