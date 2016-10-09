<!-- content panel -->
<div class="main-panel">

    <!-- top header -->
    <?php $this->load->view($_NavBar); ?>
    <!-- /top header -->

    <div id="reload" style="display: none;"></div>
    <!-- main area -->
    <div class="main-content">
        
        <div class="panel panel-warning">
            <div class="panel-heading border">
                 <i class="fa fa-user"></i> Mantenedor de Usuarios
            </div>
            
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-sm mr5 panel-remove" data-toggle="modal" data-target=".bs-modal-sm" 
                                onclick="Global.prototype.modal_ajax('<?php echo base64_encode(1); //base64_encode($this->encrypt->encode($objDesc->id)); ?>', 'agregar_usuario', '<?php echo base_url('usuario/abre_ingresa_usuario'); ?>');"> 
                            <i class="fa fa-plus-circle"></i>
                            Ingrese un nuevo usuario
                        </button>
                    </div> 
                 </div>
                <br>
                  <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table id="tblDescuentos"  class="table table-striped table-bordered datatables">
                                <thead>
                                    <tr>
                                        <th width="30px"></th>
                                        <th>Nombre</th>
                                        <th>Cargo</th>
                                        <td width="30px"></td>
                                        <td width="30px"></td>
                                        <td width="30px"></td>
                                    </tr>
                                </thead>
                                <tbody>
                          
                                    <tr>
                                        <td>
                                            <img src="" data-toggle="tooltip" data-placement="top" title="" height="32" >
                                        </td>
                                        <td>Jaime Reyes</td>
                                        <td>Profesor</td>
                                        <td>
                                            <center>
                                                <button class="btn btn-info btn-sm mr5" data-toggle="modal" data-target=".bs-modal-sm">   
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <button class="btn btn-danger btn-sm mr5 panel-remove" data-toggle="modal" data-target=".bs-modal-sm" >
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </center>
                                        </td>
                                         <td>
                                            <center>
                                                <button class="btn btn-primary btn-sm mr5 panel-remove" data-toggle="modal" data-target=".bs-modal-sm" >
                                                    <i class="fa fa-info"></i>
                                                </button>
                                            </center>
                                        </td>
                                    </tr>
                                   
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
        <div class="modal-content" id="agregar_usuario">
        
            
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
