<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarjeta extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('sess_authenticado')) {
            redirect(base_url('login'));
            exit();
        }
        $this->load->library('form_validation');
        $this->load->model('Tarjeta_model');
        $this->current = 2;
                 $this->load->model('Solicitud_model');
    }
    
    public function index()
    {
        $this->load->library('encrypt');
        $_datos = array();
        $_datos['plantilla']['css'] = array(
            'vendor/sweetalert/lib/sweet-alert'
        );
        
        $_datos['plantilla']['js'] = array(
            'scripts/functions/tarjeta',
            'scripts/pages/alert',
            'scripts/functions/global',
            'vendor/noty/js/noty/packaged/jquery.noty.packaged.min',
            'vendor/sweetalert/lib/sweet-alert.min'
            );
        
        
        
        //Begin: Variables
        $_datos['plantilla']['current_menu'] = $this->current;
        $_datos['plantilla']['current_sub_menu'] = $this->current . 1;
        $_datos['plantilla']['titulo'] = 'AhoraDescuentos.com | Admin';
        $_datos['plantilla']['objsTarjeta'] = $this->Tarjeta_model->getCards($this->session->userdata(SESS_ID_CLIENTE));
         $_datos['plantilla']['countSolicitudesPendientes']  =  $this->Solicitud_model->getSolicitudesCount(0,$this->session->userdata(SESS_ID_CLIENTE));
           $_datos['plantilla']['objSolicitud'] = $this->Solicitud_model->getSolicitudes(0, $this->session->userdata(SESS_ID_CLIENTE), 3);
//End: Variables
        
        
        $_datos['plantilla']['vista'] = 'tarjeta_ver';
        $this->load->view('plantillas/plantilla_back', $_datos);
    }
    
    public function crear()
    {
        $_datos = array();
        $_datos['plantilla']['css'] = array(
            'vendor/sweetalert/lib/sweet-alert'
            );
        
        $_datos['plantilla']['js'] = array(
            'scripts/functions/tarjeta',
            'scripts/pages/alert',
            'scripts/functions/global',
            'vendor/noty/js/noty/packaged/jquery.noty.packaged.min',
            'vendor/sweetalert/lib/sweet-alert.min'
            );
        
        
        //Begin: Variables
        $_datos['plantilla']['current_menu'] = $this->current;
        $_datos['plantilla']['current_sub_menu'] = $this->current . 2;
        $_datos['plantilla']['titulo'] = 'AhoraDescuentos.com | Admin';
        $_datos['plantilla']['objsTipoTarjeta'] = $this->Tarjeta_model->getTipoTarjeta();
          $_datos['plantilla']['countSolicitudesPendientes']  =  $this->Solicitud_model->getSolicitudesCount(0,$this->session->userdata(SESS_ID_CLIENTE));
            $_datos['plantilla']['objSolicitud'] = $this->Solicitud_model->getSolicitudes(0, $this->session->userdata(SESS_ID_CLIENTE), 3);
//End: Variables
        
        
        $_datos['plantilla']['vista'] = 'tarjeta_crear';
        $this->load->view('plantillas/plantilla_back', $_datos);
    }
    
    
    public function createCard()
    {
        if($this->input->is_ajax_request())
        {
            if(!$this->input->post('cmbTipo'))
            {
                echo 'Debe seleccionar un tipo de tarjeta.'; exit();
            }


            $this->form_validation->set_rules('txtNombre', 'Nombre', 'trim|required|min_length[2]|max_length[50]'); //|strip_tags|xss_clean
            if($this->form_validation->run() === FALSE)
            {
                echo str_replace('<p>', '', str_replace('<p>', '', validation_errors())); exit();
            }

            //echo print_r($_FILES); exit();
            $imagen = sha1($this->session->userdata('sess_user_admin').uniqid()) . '_' .md5(rand(1,999).uniqid()).'.jpg';
            $config['max_size'] = 5000;
            $config['quality'] = '100%';
            $config['upload_path'] = './assets/images/cards/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['file_name'] = $imagen; //length = 77
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload('flImage'))
            {
                echo $this->upload->display_errors(); exit();
            }

            $config2['source_image'] = './assets/images/cards/'.$imagen;
            $config2['width'] = 300;
            $config2['quality'] = '100%';
            $config2['new_image'] = './assets/images/cards/thumbs/'.$imagen;
            //$config2['height'] = 50;
            //$config2['maintain_ratio'] = FALSE;
            //$config2['master_dim'] = 'width';
            //$config2['create_thumb'] = TRUE;
            $this->load->library('image_lib', $config2);
            if(!$this->image_lib->resize())
            {
                echo $this->image_lib->display_errors(); exit();
            }

            
            //echo 'OK'; exit();
            $this->load->model('Tarjeta_model');
            $tarjeta = $this->Tarjeta_model->guardar($this->session->userdata(SESS_ID_CLIENTE), strtoupper($this->input->post('txtNombre')), $this->input->post('cmbTipo'), $imagen);
            if($tarjeta)
            {
                echo 'OK';
            }
            else
            {
                echo 'Error al intentar crear la tarjeta.';
            }
        }
        else
        {
            echo 'Error inesperado, si el error persiste comuniquese con nosotros.';
        }
    }
    
    
    public function deleteCard()
    {
        if($this->input->is_ajax_request())
        {
            $id_card = $this->input->post('__46dec76d54__');
            if(!$id_card)
            {
                echo 'Error inesperado, si el error persiste comuniquese con nosotros. [cod: DC-02]'; exit();
            } 
            
            $this->load->library('encrypt');  
            $id_card = $this->encrypt->decode(str_replace(' ', '+', $id_card));
            if(!$id_card)
            {
                echo 'Error inesperado, si el error persiste comuniquese con nosotros. [cod: DC-03]'; exit();
            }

            
            $this->load->model('Tarjeta_model');
            $tarjeta = $this->Tarjeta_model->getCard($id_card);
            if($tarjeta)
            {
                $descuento = $this->Tarjeta_model->getCardDescuento($id_card);
                if(!$descuento)
                {
                    foreach($tarjeta as $objTarjeta)
                    {
                        if(!$objTarjeta->publicada)
                        {
                            $this->Tarjeta_model->deleteCard($id_card);
                            $cardExist = $this->Tarjeta_model->getCard($id_card);
                            if(!$cardExist)
                            {
                                @unlink('./assets/images/cards/'.$objTarjeta->imagen);
                                @unlink('./assets/images/cards/thumbs/'.$objTarjeta->imagen);
                                echo 'OK';
                            }
                            else
                            {
                                echo 'Error al intentar eliminar la tarjeta. [cod: DC-07]';
                            }
                        }
                        else
                        {
                            echo 'Error al intentar eliminar la tarjeta. [cod: DC-06]';
                        }
                    }
                }
                else
                {
                    echo 'Para poder eliminar esta tarjeta, debe eliminar los descuentos que tiene asociados a esta. [cod: DC-06]';
                }    
            }
            else
            {
                echo 'Para eliminar una tarjeta publicada debe contactarse con nosotros. [cod: DC-05]';
            }
        }
        else
        {
            echo 'Error inesperado, si el error persiste comuniquese con nosotros. [cod: DC-01]';
        }
    }
    
    
    
    public function up_card()
    {
        if($this->input->is_ajax_request())
        {
            $id_card = $this->input->post('__46dec76liqE32d54__');
            if(!$id_card)
            {
                echo 'Error inesperado, si el error persiste comuniquese con nosotros. [cod: DC-02]'; exit();
            } 
            
            $this->load->library('encrypt');  
            $id_card = $this->encrypt->decode(str_replace(' ', '+', $id_card));
            if(!$id_card)
            {
                echo 'Error inesperado, si el error persiste comuniquese con nosotros. [cod: DC-03]'; exit();
            }

            
            $this->load->model('Tarjeta_model');
            $tarjeta = $this->Tarjeta_model->getCard($id_card);
            if($tarjeta)
            {
                foreach($tarjeta as $objTarjeta)
                {
                    if(!$objTarjeta->publicada)
                    {
                        $this->Tarjeta_model->public_card($id_card);
                        echo 'OK';
                    }
                    else
                    {
                        echo 'Error al intentar eliminar la tarjeta. [cod: DC-06]';
                    }
                }
            }
            else
            {
                echo 'Para eliminar una tarjeta publicada debe contactarse con nosotros. [cod: DC-05]';
            }
        }
        else
        {
            echo 'Error inesperado, si el error persiste comuniquese con nosotros. [cod: DC-01]';
        }
    }
    
    public function down_card()
    {
        if($this->input->is_ajax_request())
        {
            $id_card = $this->input->post('__qE32d54@46dec76li__');
            if(!$id_card)
            {
                echo 'Error inesperado, si el error persiste comuniquese con nosotros. [cod: DC-02]'; exit();
            } 
            
            $this->load->library('encrypt');  
            $id_card = $this->encrypt->decode(str_replace(' ', '+', $id_card));
            if(!$id_card)
            {
                echo 'Error inesperado, si el error persiste comuniquese con nosotros. [cod: DC-03]'; exit();
            }

            
            $this->load->model('Tarjeta_model');
            $tarjeta = $this->Tarjeta_model->getCard($id_card, 1);
            if($tarjeta)
            {
                foreach($tarjeta as $objTarjeta)
                {
                    if($objTarjeta->publicada)
                    {
                        $this->Tarjeta_model->public_card($id_card, 0);
                        echo 'OK';
                    }
                    else
                    {
                        echo 'Error al intentar eliminar la tarjeta. [cod: DC-06]';
                    }
                }
            }
            else
            {
                echo 'Para eliminar una tarjeta publicada debe contactarse con nosotros. [cod: DC-05]';
            }
        }
        else
        {
            echo 'Error inesperado, si el error persiste comuniquese con nosotros. [cod: DC-01]';
        }
    }
}
