<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Exito</h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-success">
                <li class="fa fa-check fa-2x"></li> Su proceso fue realizado con exito!
            </div>
        </div>
    </div>
</div>
<div class="modal-footer no-border">
    <button id="close" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>
<script>
    if(Global.prototype.getReloadPage() === 1)
    {
        $("#close").delay(1500).queue(function (m)
        {
            location.reload();
            m();
        });
        
    }
</script>