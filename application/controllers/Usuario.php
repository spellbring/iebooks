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
          $this->load->model('Perfil_model');
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
            'scripts/functions/usuarios',
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
         
         $_datos['obj_user'] = $this->Usuarios_model->getUserIns( $this->session->userdata('sess_perfil_inst'));
         
        $this->load->view('plantillas/plantilla_back', $_datos);
    }
    
    
    
    public function abre_ingresa_usuario(){
        $this->load->library('encrypt');
        $_datos = array();
        
        if ($this->input->is_ajax_request()) {
              $_datos['objPerfil'] = $this->Perfil_model->getPerfil();              
              $this->load->view('back_end/modal_popup/agregar_usuario', $_datos);
            
        }
       
     }
     public function ingresar_usuario(){
        $this->load->library('encrypt');
     
        if($this->input->is_ajax_request())
         {
         $this->form_validation->set_rules('ajaxPerfil', 'Perfil', 'trim|required|strip_tags');
         if($this->input->post('ajaxPerfil') == 0){
             echo "Debe seleccionar un perfil";
             exit();
         }
         $this->form_validation->set_rules('txt_first_name', 'Primer Nombre', 'trim|required|strip_tags');
         $this->form_validation->set_rules('txt_second_name', 'Segundo Nombre', 'trim|required|strip_tags');
         $this->form_validation->set_rules('txt_first_s_name', 'Fecha Desde', 'trim|required|strip_tags');
         $this->form_validation->set_rules('txt_second_s_name', 'Fecha Hasta', 'trim|required|strip_tags');
         $this->form_validation->set_rules('txt_user', 'Usuario', 'trim|required|strip_tags');
         $this->form_validation->set_rules('txt_pass', 'Contraseña', 'trim|required|strip_tags');
         $this->form_validation->set_rules('txt_correo', 'Correo', 'trim|required|valid_email');
            if ($this->form_validation->run() === FALSE) {
               echo str_replace('<p>', '', validation_errors());
               exit();
            }
         $objUser = $this->Usuarios_model->check_user($this->input->post('txt_user'));
         if($objUser){
           $usuario_checked = $objUser[0]->usuario;
            
            if(null != $usuario_checked){
                echo "El usuario ya existe en la base de datos de iebooks";
                exit();
            }  
         }
         
            $pass =  $this->input->post('txt_pass');
            $hash_pass = sha1($pass);       
            $this->Usuarios_model->insert(
                $this->input->post('txt_user'),
                $hash_pass,
                $this->input->post('txt_first_name'),
                $this->input->post('txt_second_name'),
                $this->input->post('txt_first_s_name'),
                $this->input->post('txt_second_s_name'),
                $this->input->post('txt_correo'),
                $this->input->post('ajaxPerfil'),
                $this->session->userdata('sess_perfil_inst')
              );
            $view = $this->load->view('back_end/modal_popup/modal_exito', '', true);
            echo 'OK&' . $view;
            
         } 
         else {
            echo 'Error al intentar cargar la vista';
        }
        exit();
     }
     
     
     public function editar_usuario(){
         $this->load->library('encrypt');
         $_datos = array();
        
        if ($this->input->is_ajax_request()) {
             if ($this->input->post('__MA__')) {
               $_datos['objPerfil'] = $this->Perfil_model->getPerfil(); 
               $id = base64_decode($this->security->xss_clean(strip_tags($this->input->post('__MA__'))));
               $obj_user = $this->Usuarios_model->getUserId($id);
                $this->session->set_userdata('sess_user_id_edit',$id);
               $_datos['obj_id'] = $id;
               $_datos['obj_usuario'] = $obj_user[0]->usuario;
               $_datos['obj_pass'] = $obj_user[0]->password;
               $_datos['obj_nombre_p'] = $obj_user[0]->nombre_p;
               $_datos['obj_nombre_s'] = $obj_user[0]->nombre_s;
               $_datos['obj_apellido_p'] = $obj_user[0]->apellido_p;
               $_datos['obj_apellido_m'] = $obj_user[0]->apellido_m;
               $_datos['obj_correo'] = $obj_user[0]->correo;
               $_datos['obj_perfil'] = $obj_user[0]->perfil_idperfil;
               $_datos['obj_institucion'] = $obj_user[0]->institucion_idinstitucion;
               
               $this->load->view('back_end/modal_popup/editar_usuario', $_datos);
             
             }
               
        }
     }
  
     public function modificar_usuario(){
        $this->load->library('encrypt');
        if($this->input->is_ajax_request())
         {
            //Validaciones
            $this->form_validation->set_rules('ajaxPerfil', 'Perfil', 'trim|required|strip_tags');
            if($this->input->post('ajaxPerfil') == 0){
                echo "Debe seleccionar un perfil";
                exit();
            }
            $this->form_validation->set_rules('txt_first_name', 'Primer Nombre', 'trim|required|strip_tags');
            $this->form_validation->set_rules('txt_second_name', 'Segundo Nombre', 'trim|required|strip_tags');
            $this->form_validation->set_rules('txt_first_s_name', 'Fecha Desde', 'trim|required|strip_tags');
            $this->form_validation->set_rules('txt_second_s_name', 'Fecha Hasta', 'trim|required|strip_tags');
            $this->form_validation->set_rules('txt_user', 'Usuario', 'trim|required|strip_tags');
            $objUser = $this->Usuarios_model->check_user($this->input->post('txt_user'));
            if($objUser){
              $usuario_checked = $objUser[0]->usuario;
               if($usuario_checked != $this->input->post('txt_user'))
               if(null != $usuario_checked){
                   echo "El usuario ya existe en la base de datos de iebooks";
                   exit();
               }  
            }
            $this->form_validation->set_rules('txt_pass', 'Contraseña', 'trim|required|strip_tags');
            $this->form_validation->set_rules('txt_correo', 'Correo', 'trim|required|valid_email');
            if ($this->form_validation->run() === FALSE) {
               echo str_replace('<p>', '', validation_errors());
               exit();
            }
            $pass =  $this->input->post('txt_pass');
            $obj_user = $this->Usuarios_model->getUserId($this->session->userdata('sess_user_id_edit'));
            $beforePass = $obj_user[0]->password;
            if($beforePass != $pass ){
                $hash_pass = sha1($pass); 
            }
            else{
                $hash_pass = $pass;
            }
        
            
            //Update
           $update =  $this->Usuarios_model->update(
                $this->session->userdata('sess_user_id_edit'),
                $this->input->post('txt_user'),
                $hash_pass,
                $this->input->post('txt_first_name'),
                $this->input->post('txt_second_name'),
                $this->input->post('txt_first_s_name'),
                $this->input->post('txt_second_s_name'),
                $this->input->post('txt_correo'),
                $this->input->post('ajaxPerfil')
              );
                if($update){
                $view = $this->load->view('back_end/modal_popup/modal_exito', '', true);
                echo 'OK&' . $view;
                }
              
         } 
         else {
            echo 'Error al intentar cargar la vista';
        }
        exit();

     }
     
     public function eliminar(){
         if (!$this->input->post('__76d5446dec__')) {
                echo 'Error inesperado, si el error persiste comuniquese con nosotros. [cod: DC-D-02]';
                exit();
            }

            //$this->load->library('encrypt');  
            //$id_descuento = $this->encrypt->decode(base64_decode(str_replace(' ', '+', $this->input->post('__76d5446dec__'))));
            $id = base64_decode(str_replace(' ', '+', $this->input->post('__76d5446dec__')));
            if (!$id) {
                echo 'Error inesperado, si el error persiste comuniquese con nosotros. [cod: DC-D-03]';
                exit();
            }
         $this->load->library('encrypt');
        
        
        if ($this->input->is_ajax_request()) {
            
             $update =  $this->Usuarios_model->update_down($id);
             if($update){
                 echo "OK"; 
             }
            
            
        }
     }
    
    
}
