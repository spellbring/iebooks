<?php

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('sess_authenticado')) {
            redirect(base_url('login'));
            exit();
        }
        $this->load->model('Clases_model');
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

        $_datos['obj_material'] = $this->Clases_model->getMaterial();
        $_datos['plantilla']['vista'] = 'index';
        $this->load->view('plantillas/plantilla_back', $_datos);
    }

}
