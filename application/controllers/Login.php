<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
         $this->load->model('Solicitud_model');
    }
    
    public function index()
    {
        $_datos = array();
        $_datos['plantilla']['css'] = array(
            'vendor/chosen_v1.4.0/chosen.min',
            'vendor/checkbo/src/0.1.4/css/checkBo.min');
        
        $_datos['plantilla']['js'] = array(
            'vendor/chosen_v1.4.0/chosen.jquery.min', 
            'vendor/checkbo/src/0.1.4/js/checkBo.min', 
            'vendor/noty/js/noty/packaged/jquery.noty.packaged.min', 
            'scripts/extentions/noty-defaults');
        
        //Begin: Variables
        $_datos['plantilla']['titulo'] = 'I-EBOOKS | Admin';
        //End: Variables
        
        //Vista
        $_datos['plantilla']['vista'] = 'login';
        $this->load->view('plantillas/plantilla_front', $_datos);
        $this->session->sess_destroy();
    }
    
    public function ingresar()
    {
        $this->form_validation->set_rules('txtUser', 'Usuario', 'trim|required|min_length[6]|max_length[20]'); //|strip_tags|xss_clean
        if($this->form_validation->run() === FALSE)
        {
            $this->_alert('1', str_replace("\n", "", validation_errors()));
        }
        else
        {
            $user = $this->input->post('txtUser');
            $pass = $this->input->post('txtPass');
            $this->session->set_userdata('sess_user_admin', $user);
            
            $this->form_validation->set_rules('txtPass', 'Contrase&ntilde;a', 'required|min_length[4]');
            if($this->form_validation->run() === FALSE)
            {
                $this->_alert('1', str_replace("\n", "", validation_errors()));
                redirect(base_url('login'));
            }
            
            
            $objUser = $this->check_user($user);
            if(!$objUser)
            {
               $this->_alert('1', 'El usuario ingresado no existe.');
                redirect(base_url('login'));
            }
            
            
            $hash_pass = sha1($pass);
            foreach($objUser as $objUser)
            {
                if($objUser->usuario == $user && $objUser->password == $hash_pass)
                {
                    $data = array(
                        'sess_authenticado' => TRUE, 
                        'sess_nombre_admin' => $objUser->nombre_p, 
                        'sess_apellido_admin' => $objUser->apellido_p,
                        'sess_perfil_user' => $objUser->perfil_idperfil,
                        'sess_perfil_inst' => $objUser->institucion_idinstitucion
                    );
                    $this->session->set_userdata($data);
                    
                    redirect(base_url('home'));
                   
                }
                else
                {
                    $this->_alert('1', 'Usuario o password son incorrectos.');
                    redirect(base_url('login'));
                }
            }
            
            
            redirect(base_url('login'));
            
        }
        
        
        redirect(base_url('login'));
    }
    
    public function check_user($user)
    {
        $this->load->model('usuarios_model');
        $usuario = $this->usuarios_model->check_user($user);
        if($usuario)
        {
            foreach($usuario as $objUser)
            {
                if($objUser->usuario == $user)
                {
                    return $usuario;
                }
            }
        }
        
        return FALSE;
    }
    
    
    
    
    
    
    
    private function _alert($type, $msg)
    {
        $this->session->set_userdata('sess_error_type', $type);
        $this->session->set_userdata('sess_error_msg', $msg);
    }

    public function salir()
    {
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }
}
