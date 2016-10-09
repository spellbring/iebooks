function Descuento() {
    this.B_nombre = '';
}

Descuento.prototype.getNombre = function () {
    return this.B_nombre;
};
Descuento.prototype.setNombre = function (nombre) {
    this.B_nombre = nombre;
};




Descuento.prototype.delete = function (url, unique)
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
                swal('Eliminado!', 'Su tarjeta ha sido eliminada con exito!', 'success');
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



$('[data-toggle=delete-desc]').on('click', function () {
    
    Global.prototype.setReloadPage(1);
    var __unique__ = $(this).attr('id');
    var __url__ = $(this).attr('data-url');
    swal({
        title: 'Seguro de eliminar este descuento?',
        text: 'El descuento asignado a esta tienda no se podra recuperar.',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar',
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            Descuento.prototype.delete(__url__, __unique__);
        } else {
            swal('Cancelado', 'Su descuento sigue ahi. :)', 'error');
        }
    });
});




Descuento.prototype.search = function (classFrm, url, btn)
{
    initLoad();
    $("#" + btn).attr('disabled', 'disabled');
    
    var contentType = false;
    var processData = false;

    if (typeof FormData === "undefined") {
        //IE
        var formData = [];
        formData = formularioIE($("." + classFrm)[0]);
        contentType = 'application/x-www-form-urlencoded';
        processData = true;
    } else {
        var formData = new FormData($("." + classFrm)[0]);
    }




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
                location.reload();
            }
            else
            {
                alertError(data, btn);
            }
        },
        //si ha ocurrido un error
        error: function ()
        {
            //endLoad();
            alertError('Por favor intente nuevamente. Si el error persiste comuniquese con nosotros.', btn);
        }
    });
};






  
$("[data-toggle=tooltip]").tooltip();

$("[data-toggle=popover]")
  .popover()
  .click(function (e) {
    e.preventDefault();
  });
  