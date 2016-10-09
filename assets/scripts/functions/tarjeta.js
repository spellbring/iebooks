function Tarjeta() {
    this.B_nombre = '';
}

Tarjeta.prototype.getNombre = function () {
    return this.B_nombre;
};
Tarjeta.prototype.setNombre = function (nombre) {
    this.B_nombre = nombre;
};

Tarjeta.prototype.send = function (classFrm, url, btn)
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
                //endLoad();
                swal('Proceso terminado!', 'El proceso termino de manera exitosa!', 'success');
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












Tarjeta.prototype.delete = function (url, unique)
{
    
    formData="&__46dec76d54__=" + unique;
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


Tarjeta.prototype.up_card = function (url, unique)
{
    
    formData="&__46dec76liqE32d54__=" + unique;
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
                swal('Publicada!', 'Su tarjeta ha sido publicada con exito!', 'success');
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


Tarjeta.prototype.down_card = function (url, unique)
{
    
    formData="&__qE32d54@46dec76li__=" + unique;
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
                swal('Tarjeta Bajada!', 'Su tarjeta ya no es publica!', 'success');
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







$('[data-toggle=delete-card]').on('click', function () {
    
    Global.prototype.setReloadPage(1);
    var __unique__ = $(this).attr('id');
    var __url__ = $(this).attr('data-url');
    swal({
        title: 'Seguro de eliminar esta tarjeta?',
        text: 'Esta tarjeta no se podra recuperar.',
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
            Tarjeta.prototype.delete(__url__, __unique__);
        } else {
            swal('Cancelado', 'Su tarjeta sigue intacta. :)', 'error');
        }
    });
});



$('[data-toggle=up-card]').on('click', function () {
    
    Global.prototype.setReloadPage(1);
    var __unique__ = $(this).attr('id');
    var __url__ = $(this).attr('data-url');
    swal({
        title: 'Seguro que desea publicar esta tarjeta?',
        text: 'Verifique que la tarjeta tenga los datos correctos, ya que una vez publicada, puede que esta tarjeta los usuarios la adopten',
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#2ecc71',
        confirmButtonText: 'Publicar',
        cancelButtonText: 'Cancelar',
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            Tarjeta.prototype.up_card(__url__, __unique__);
        } else {
            swal('Cancelado', 'Su tarjeta no fue publicada', 'error');
        }
    });
});


$('[data-toggle=down-card]').on('click', function () {
    
    Global.prototype.setReloadPage(1);
    var __unique__ = $(this).attr('id');
    var __url__ = $(this).attr('data-url');
    swal({
        title: 'Quiere que esta tarjeta NO siga siendo publica?',
        text: 'Tal vez hay usuarios que ya agregaron esta tarjeta.',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Quitar publicacion',
        cancelButtonText: 'Cancelar',
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function (isConfirm) {
        if (isConfirm) {
            Tarjeta.prototype.down_card(__url__, __unique__);
        } else {
            swal('Cancelado', 'Su tarjeta sigue intacta. :)', 'error');
        }
    });
});
