<?php

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('sess_authenticado')) {
            redirect(base_url('login'));
            exit();
        }
        $this->load->model('clases_model');
        $this->load->library('calendar');
    }

    public function index()
    {
        $_datos = array();
        $_datos['plantilla']['css'] = array(
            'styles/climacons-font',
            'vendor/rickshaw/rickshaw.min'
        );
        
        $_datos['plantilla']['js'] = array(
            'vendor/d3/d3.min',
            'vendor/rickshaw/rickshaw.min',
            'vendor/flot/jquery.flot',
            'vendor/flot/jquery.flot.resize',
            'vendor/flot/jquery.flot.categories',
            'vendor/flot/jquery.flot.pie',
            'scripts/pages/dashboard'
        );
        
        
        //Begin: Variables
        $_datos['plantilla']['current_menu'] = MENU_INICIO;
        $_datos['plantilla']['current_sub_menu'] = SUBMENU_NULL;
        $_datos['plantilla']['titulo'] = 'I-EBOOKS | Home';
        //End: Variables


        //Begin: Objetos
        //$_datos['plantilla']['countDescuentos'] = $this->descuento_model->getCountDescuentosAgregados($this->session->userdata(SESS_ID_CLIENTE));
        //$_datos['plantilla']['countTarjetas']   = $this->tarjeta_model->getCountCards($this->session->userdata(SESS_ID_CLIENTE));
        //$_datos['plantilla']['countSolicitudes']   = $this->solicitud_model->getCountSolicitudes(SOLICITUD_PENDIENTE,$this->session->userdata(SESS_ID_CLIENTE));
       //$_datos['plantilla']['countTopSolicitudes']   = $this->solicitud_model->getCountTopSolicitudes($this->session->userdata(SESS_ID_CLIENTE));
        //$_datos['plantilla']['mejorDescuento']   = $this->descuento_model->getMejorDescuento($this->session->userdata(SESS_ID_CLIENTE));
        //$_datos['plantilla']['countSolicitudesPendientes']  =  $this->solicitud_model->getSolicitudesCount(0,$this->session->userdata(SESS_ID_CLIENTE));
        // $_datos['plantilla']['objSolicitud'] = $this->solicitud_model->getSolicitudes(0, $this->session->userdata(SESS_ID_CLIENTE), 3);
        //End: Objetos
        $_datos['obj_material'] = $this->clases_model->getMaterial();
        $_datos['plantilla']['vista'] = 'index';
        $this->load->view('plantillas/plantilla_back', $_datos);
    }

}
