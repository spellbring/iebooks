
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
              Solicitudes Aprobadas
            </div>
            <div class="panel-body">
                <div class="row no-margin">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table id="tblSolicitudes"  class="table table-striped table-bordered datatables">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Fecha</th>
                                        <td width="30px"></td>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                 if($objSolicituds){ 
                                foreach($objSolicituds as $obj){
                                ?>
                                    <tr>
                                        <td><?php echo $obj->nombres.' '.$obj->apellidos ?></td>
                                        <td><?php echo $obj->ui_fecha; ?></td>
                                        <td>
                                             <button class="btn btn-primary btn-sm mr5 panel-remove" data-toggle="modal" data-target=".bs-modal-sm"  id="<?php echo base64_encode($obj->id);?> " onclick="Global.prototype.modal_ajax('<?php echo base64_encode($obj->id); //base64_encode($this->encrypt->encode($objDesc->id)); ?>', 'modal_ver_solicitud', '<?php echo base_url('solicitud/ver_pdf'); ?>');" >
                                                <i class="fa fa-file-o"></i>
                                             </button>
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
        <div class="modal-content" id="modal_ver_solicitud">
        
            
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
<!-- content panel -->
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

