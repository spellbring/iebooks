<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Clases
 *
 * @author Jaime
 */
class Clases extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('sess_authenticado')) {
            redirect(base_url('login'));
            exit();
        }
         $this->current = 3;
          $this->load->library('form_validation');
          $this->load->model('Clases_model');
            $this->load->model('Usuarios_model');
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
         $_datos['plantilla']['current_sub_menu'] = $this->current . 3;
        
         $_datos['plantilla']['titulo'] = 'I-Ebooks | Admin';
         $_datos['plantilla']['vista'] = 'clases';
         
         $_datos['obj_clases_us'] = $this->Clases_model->getClasesIns($this->session->userdata('sess_perfil_inst'));
         
        $this->load->view('plantillas/plantilla_back', $_datos);
    }
    
     public function abre_clase(){
        $this->load->library('encrypt');
        $_datos = array();
        
        if ($this->input->is_ajax_request()) {
            
             $_datos['obj_usuario'] = $this->Usuarios_model->getUserIns($this->session->userdata('sess_perfil_inst'));
             $this->load->view('back_end/modal_popup/agregar_clase', $_datos);
        } 
            
       
     }
     public function agregar_clase(){
         $this->form_validation->set_rules('ajaxCmbUser', 'Usuario', 'trim|required|strip_tags');
            if($this->input->post('ajaxCmbUser') == 0){
                 echo "Debe seleccionar un usuario";
                 exit();
            }
            $this->form_validation->set_rules('txt_cant_max', 'Cantidad', 'trim|required|strip_tags|numeric');
              if($this->input->post('txt_cant_max') < 1){
                 echo "Debe ingresar un numero mayor o igual a 0";
                 exit();
            }
            $this->form_validation->set_rules('txt_descripcion', 'Descripción', 'trim|required|strip_tags');
             if ($this->form_validation->run() === FALSE) {
               echo str_replace('<p>', '', validation_errors());
               exit();
            }
            
            $objInsert = $this->Clases_model->insert(
                    $this->input->post('ajaxCmbUser'),
                    $this->input->post('txt_descripcion'),
                    $this->input->post('txt_cant_max')                    
                    );
            
            if($objInsert){
             $view = $this->load->view('back_end/modal_popup/modal_exito', '', true);
             echo 'OK&' . $view;
            }
     }
     
     public function asignar(){
          $this->load->library('encrypt');
          $_datos = array();
          
          if ($this->input->is_ajax_request()) {
              if ($this->input->post('__MA__')) {
                   $id = base64_decode($this->security->xss_clean(strip_tags($this->input->post('__MA__'))));
                   $this->session->set_userdata('sess_clase_id_edit',$id);
                   $_datos['obj_material'] = $this->Clases_model->getMaterial();
                   $_datos['obj_clase_material'] = $this->Clases_model->get_clase_material($id);
                   $this->load->view('back_end/modal_popup/asignar', $_datos);
                  
                   
              }
                  
          }
 
            
     }
     
     public function asignar_material(){
         $this->load->library('encrypt');
        
         
         if($this->input->is_ajax_request()){
            $this->form_validation->set_rules('cmb_material', 'Material Interactivo', 'trim|required|strip_tags');
              if ($this->form_validation->run() === FALSE) {
                    echo str_replace('<p>', '', validation_errors());
                    exit();
               }
                $obj_cantidad = $this->clases_model->get_cantidad_material($this->input->post('cmb_material') 
                                                                          ,$this->session->userdata('sess_clase_id_edit'));
                if($obj_cantidad[0]->cantidad == 0){
                    $objInsert = $this->clases_model->asign_clase_materal(
                       $this->session->userdata('sess_clase_id_edit'),
                       $this->input->post('cmb_material')                  
                       );
                    if($objInsert){
                         $view = $this->load->view('back_end/modal_popup/modal_exito', '', true);
                         echo 'OK&' . $view;
                    }
                }else{
                    echo "Ya existe un material interactivo en esta clase";
                    exit();
                }
            
               
           
                 
            
         }
     }
     
     
}
