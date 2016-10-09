function Solicitud(){
    
}
Solicitud.prototype.update = function (url, unique)
{
    formData="&__76d5446dec__=" + unique;
    contentType = 'application/x-www-form-urlencoded';
    processData = true;
    
    //hacemos la petición ajax     
    $.ajax({
        url: url,
        type: 'POST',
        //Form data
        //datos del formulario
        data: formData,
        //necesario para subir archivos via ajax
        cache: false,
        contentType: contentType,
        processData: processData,
        //mientras enviamos el archivo
        beforeSend: function () {
        },
        //una vez finalizado correctamente
        success: function (data)
        {
            if (data === 'OK')
            {
                swal('Aprobado!', 'La solicitud ha sido aprobada!', 'success');
                $("#reload").delay(300).queue(function (n)
                {
                    Global.prototype.setReloadPage(0);
                    n();
                });
            }
            else
            {
                swal('Error', data, 'error');
            }
        },
        //si ha ocurrido un error
        error: function ()
        {
            //endLoad();
            swal('Error', 'Por favor intente nuevamente. Si el error persiste comuniquese con nosotros.', 'error');
        }
    });
};
$('[data-toggle=update-sol]').on('click', function () {
    
    Global.prototype.setReloadPage(1);
    var __unique__ = $(this).attr('id');
    var __url__ = $(this).attr('data-url');
    var __nSolicitud__ =  $(this).attr('data-solicitud');
   
    swal({
        title: 'Solicitud N° '+__nSolicitud__,
        text: 'Desea aprobar esta solicitud?',
        type: 'success',
        showCancelButton: true,
        confirmButtonColor: '#008000',
        confirmButtonText: 'Aprobar',
        cancelButtonText: 'Cancelar',
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            Solicitud.prototype.update(__url__, __unique__);
        } else {
            swal('Cancelado', 'La solicitud no se ha modificado :)', 'error');
        }
    });
});

