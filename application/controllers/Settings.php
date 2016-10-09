<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
    
    public function index()
    {
        parent::__construct();
        if (!$this->session->userdata('sess_authenticado')) {
            redirect(base_url('login'));
            exit();
        }
        $_data['vista'] = 'crear_tarjeta';
        $this->load->view('plantillas/plantilla_back', $_data);
    }
}
