function Global() {
    this.reload_page = 0;
}

Global.prototype.getReloadPage = function () {
    return this.reload_page;
};
Global.prototype.setReloadPage = function (st) {
    this.reload_page = st;
};


Global.prototype.modal_ajax = function (value, element, url)
{
    if (value)
    {
        $("#" + element).html('');
        $.post(url,
        {
            __MA__: value
        }, function (data)
        {
            $("#" + element).html(data);
        });
    }
};


Global.prototype.send_ajax = function (classFrm, url, btn, element)
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
            var arrayData = data.split('&');
            if ($.trim(arrayData[0]) === 'OK')
            {
                $("#" + element).html(arrayData[1]);
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



Global.prototype.sendFormIE = function (form, action_url, div_id) {
    //Enviar formulario Internet Explorer

    // Create the iframe...
    var iframe = document.createElement("iframe");
    iframe.setAttribute("id", "upload_iframe");
    iframe.setAttribute("name", "upload_iframe");
    iframe.setAttribute("width", "0");
    iframe.setAttribute("height", "0");
    iframe.setAttribute("border", "0");
    iframe.setAttribute("style", "width: 0; height: 0; border: none;");

    // Add to document...
    form.parentNode.appendChild(iframe);
    window.frames['upload_iframe'].name = "upload_iframe";

    iframeId = document.getElementById("upload_iframe");


    // Add event...
    var eventHandler = function () {

        if (iframeId.detachEvent)
            iframeId.detachEvent("onload", eventHandler);
        else
            iframeId.removeEventListener("load", eventHandler, false);

        // Message from server...
        if (iframeId.contentDocument) {
            content = iframeId.contentDocument.body.innerHTML;
        } else if (iframeId.contentWindow) {
            content = iframeId.contentWindow.document.body.innerHTML;
        } else if (iframeId.document) {
            content = iframeId.document.body.innerHTML;
        }


        endLoad();
        if (content === 'OK') {
            //alert('Todo ok');
            $("#" + div_id).delay(1500).queue(function (n)
            {
                $("#" + div_id).html('<div class="alert alert-dismissable alert-success"><strong>Terminado</strong><br/><img src="' + RUTA_IMG_JS + 'ok.png" width="32" border="0" /> Proceso realizado con &eacute;xito.</div>');
                n();
            });
        } else {
            $('#mensajeWar').html(content);
            $('#divAlertWar').delay(1000).fadeIn(500);
            $('#divAlertWar').animate({
                'display': 'block'
            });

            $('#divAlertWar').delay(5000).fadeOut(500);
            $('#divAlertWar').animate({
                'display': 'none'
            });
        }
        //document.getElementById(div_id).innerHTML = content;

        // Del the iframe...
        setTimeout('iframeId.parentNode.removeChild(iframeId)', 250);
    };



    if (iframeId.addEventListener) {
        iframeId.addEventListener("load", eventHandler, true);
    } else if (iframeId.attachEvent) {
        iframeId.attachEvent("onload", eventHandler);
    }

    // Set properties of form...
    form.setAttribute("target", "upload_iframe");
    form.setAttribute("action", action_url);
    form.setAttribute("method", "post");

    //form.setAttribute("enctype", "multipart/form-data");
    //form.setAttribute("encoding", "multipart/form-data");

    // Submit the form...
    form.submit();
    initLoad();
}