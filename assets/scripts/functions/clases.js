function Clases(){
    
}
Clases.prototype.delete = function (url, unique)
{
    formData="&__76d5336dec__=" + unique;
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
                swal('Eliminado!', 'La clase ha sido eliminada con exito!', 'success');
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
$('[data-toggle=delete-clase]').on('click', function () {
    
    Global.prototype.setReloadPage(1);
    var __unique__ = $(this).attr('id');
    var __url__ = $(this).attr('data-url');
    var __idClase__ =  $(this).attr('data-clase');
   
    swal({
        title: 'Clase N° '+__idClase__,
        text: 'Desea eliminar esta clase?',
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
            Clases.prototype.delete(__url__, __unique__);
        } else {
            swal('Cancelado', 'La clase no se ha eliminado :)', 'error');
        }
    });
});/**
 * 
 */