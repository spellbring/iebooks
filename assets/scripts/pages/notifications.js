function notifications(message) {
    'use strict';

    $('.chosen-select').chosen({
        disable_search_threshold: 10
    });

    var $layout = 'topRight';
    var msg = message, type = 'error';

    noty({
        theme: 'urban-noty',
        text: msg,
        type: type,
        timeout: 5000,
        layout: $layout,
        closeWith: ['button', 'click'],
        animation: {
            open: 'in',
            close: 'out',
            easing: 'swing'
        }
    });
}



function initLoad() {
    'use strict';

    var $layout = 'topRight';
    var msg = '<i class="fa fa-spinner fa-spin"></i>   Espere un momento...', type = 'information';

    noty({
      theme: 'urban-noty',
      text: msg,
      type: type,
      timeout: 5000,
      layout: $layout,
      closeWith: ['button', 'click'],
      animation: {
        open: 'in',
        close: 'out',
        easing: 'swing'
      }
    });
}



function endLoad() {
    $.noty.closeAll();
}



function alertError(message, btn) {
    'use strict';

    var $layout = 'topRight';
    var msg = message, type = 'error';

    noty({
        theme: 'urban-noty',
        text: msg,
        type: type,
        timeout: 5000,
        layout: $layout,
        closeWith: ['button', 'click'],
        animation: {
            open: 'in',
            close: 'out',
            easing: 'swing'
        }
    });
    
    $("#" + btn).delay(2500).queue(function (m)
    {
        $("#" + btn).removeAttr("disabled");
        m();
    });
}

function afterCloseModal(){
    if(Global.prototype.getReloadPage() === 1){
        //hacer
    } else {
        location.reload();
    }
}