<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Usuario extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('sess_authenticado')) {
            redirect(base_url('login'));
            exit();
        }
         $this->current = 2;
          $this->load->library('form_validation');
    }
    
    public function index(){
        $this->load->library('encrypt');
        $_datos = array();
        $_datos['plantilla']['css'] = array(
            'vendor/sweetalert/lib/sweet-alert',
            'vendor/datatables/media/css/jquery.dataTables',
            );
        
         $_datos['plantilla']['js'] = array(
            'scripts/functions/descuento',
            'scripts/functions/tarjeta',
            'scripts/functions/solicitudes',
            'scripts/pages/alert',
            'scripts/functions/global',
            'vendor/noty/js/noty/packaged/jquery.noty.packaged.min',
            'vendor/sweetalert/lib/sweet-alert.min',
            'vendor/datatables/media/js/jquery.dataTables',
            'vendor/datatables/media/js/dataTables.bootstrap',
            
            
            'vendor/chosen_v1.4.0/chosen.jquery.min',
            'vendor/jquery.tagsinput/jquery.tagsinput.min',
            'vendor/checkbo/src/0.1.4/js/checkBo.min',
            'vendor/intl-tel-input//build/js/intlTelInput.min',
            'vendor/bootstrap-timepicker/js/bootstrap-timepicker.min',
            'vendor/clockpicker/dist/jquery-clockpicker.min',
            'vendor/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min',
            'vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min',
            );
         $_datos['plantilla']['current_menu'] = $this->current;
         $_datos['plantilla']['current_sub_menu'] = $this->current . 2;
        
         $_datos['plantilla']['titulo'] = 'I-Ebooks | Admin';
         
         $_datos['plantilla']['vista'] = 'usuario';
        $this->load->view('plantillas/plantilla_back', $_datos);
    }
    
    public function abre_ingresa_usuario(){
         $this->load->library('encrypt');
        $_datos = array();
        
        if ($this->input->is_ajax_request()) {
            if ($this->input->post('__MA__')) {
                $this->load->view('back_end/modal_popup/agregar_usuario', $_datos);
            } 
            }
       
     }
     
     public function ingresar_usuario(){
          $this->load->library('encrypt');
          $_datos = array();
     }
    
    
}
