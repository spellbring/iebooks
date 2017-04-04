<?php

class Grafico extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->model('Pais_model', 'PM');
        $this->current = 5;
                 $this->load->model('Solicitud_model');
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
        $_datos['plantilla']['current_menu'] = 1;
        $_datos['plantilla']['current_sub_menu'] = 0;
        $_datos['plantilla']['titulo'] = 'AhoraDescuentos.com | Admin';
     $_datos['plantilla']['countSolicitudesPendientes']  =  $this->Solicitud_model->getSolicitudesCount(0,$this->session->userdata(SESS_ID_CLIENTE));    
       $_datos['plantilla']['objSolicitud'] = $this->Solicitud_model->getSolicitudes(0, $this->session->userdata(SESS_ID_CLIENTE), 3);
//End: Variables
        
        
        $_datos['plantilla']['vista'] = 'index';
        $this->load->view('plantillas/plantilla_back', $_datos);
    }
    
    public function descuento()
    {
        $_datos = array();
        $_datos['plantilla']['css'] = array(
            'styles/climacons-font',
            'vendor/rickshaw/rickshaw.min'
        );
        
        $_datos['plantilla']['js'] = array(
            'vendor/flot/jquery.flot',
            'vendor/flot/jquery.flot.resize',
            'vendor/flot/jquery.flot.categories',
            'vendor/flot/jquery.flot.stack',
            'vendor/flot/jquery.flot.time',
            'vendor/flot/jquery.flot.pie',
            'vendor/flot-spline/js/jquery.flot.spline',
            'vendor/flot.orderbars/js/jquery.flot.orderBars',
            'scripts/pages/flot'
        );
        
        
        //Begin: Variables
        $_datos['plantilla']['current_menu'] = $this->current;
        $_datos['plantilla']['current_sub_menu'] = $this->current . 1;
        $_datos['plantilla']['titulo'] = 'AhoraDescuentos.com | Admin';
         $_datos['plantilla']['countSolicitudesPendientes']  =  $this->Solicitud_model->getSolicitudesCount(0,$this->session->userdata(SESS_ID_CLIENTE));
                  $_datos['plantilla']['objSolicitud'] = $this->Solicitud_model->getSolicitudes(0, $this->session->userdata(SESS_ID_CLIENTE), 3);
//End: Variables
        
        
        $_datos['plantilla']['vista'] = 'grafico_descuento';
        $this->load->view('plantillas/plantilla_back', $_datos);
    }
    
    public function solicitud()
    {
        parent::__construct();
        if (!$this->session->userdata('sess_authenticado')) {
            redirect(base_url('login'));
            exit();
        }
        $_datos = array();
        $_datos['plantilla']['css'] = array();
        
        $_datos['plantilla']['js'] = array(
            'vendor/Chart.js/Chart.min',
            'scripts/pages/chartjs'
        );
        
        
        //Begin: Variables
        $_datos['plantilla']['current_menu'] = $this->current;
        $_datos['plantilla']['current_sub_menu'] = $this->current . 2;
        $_datos['plantilla']['titulo'] = 'AhoraDescuentos.com | Admin';
        $_datos['plantilla']['countSolicitudesPendientes']  =  $this->Solicitud_model->getSolicitudesCount(0,$this->session->userdata(SESS_ID_CLIENTE));
        //End: Variables
        
        
        $_datos['plantilla']['vista'] = 'grafico_solicitud';
        $this->load->view('plantillas/plantilla_back', $_datos);
    }
}
