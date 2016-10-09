<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('sess_authenticado')) {
            redirect(base_url('login'));
            exit();
        }
        $this->current = 4;
        $this->load->library('form_validation');
        $this->load->model('solicitud_model');
        
       
    }
    
    public function index()
    {
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
        
        
        
        //Begin: Variables
        $_datos['plantilla']['current_menu'] = $this->current;
        $_datos['plantilla']['current_sub_menu'] = $this->current . 1;
        $_datos['plantilla']['titulo'] = 'AhoraDescuentos.com | Admin';
        //End: Variables
         $_datos['plantilla']['countSolicitudesPendientes']  =  $this->solicitud_model->getSolicitudesCount(0,$this->session->userdata(SESS_ID_CLIENTE));
        //Begin: Objetos
        //$_datos['plantilla']['objsTarjeta'] = $this->tarjeta_model->getCards();
        //$_datos['plantilla']['objsDescuento'] = $this->descuento_model->getDescuentosAgregados();
        $_datos['plantilla']['objSolicituds'] = $this->solicitud_model->getSolicitudes(0, $this->session->userdata(SESS_ID_CLIENTE), 10);
         $_datos['plantilla']['objSolicitud'] = $this->solicitud_model->getSolicitudes(0, $this->session->userdata(SESS_ID_CLIENTE), 3);
        //End: Objetos
        
        
        $_datos['plantilla']['vista'] = 'solicitud_ver';
        $this->load->view('plantillas/plantilla_back', $_datos);
    }
  
    //JRR-23-04-2016Aprueba la solicitud cambiando el estado en la base de datos de la tabla tbl_solicitud
    public function aprobar_solicitud(){
      
         if($this->input->is_ajax_request())
         {
           //$this->load->library('encrypt');
           //echo $this->input->post('__76d5446dec__'); die;
           if(!$this->input->post('__76d5446dec__'))
            {
                echo 'Error inesperado, si el error persiste comuniquese con nosotros. [cod: SC-D-02]'; exit();
            } 
            
            $this->load->library('encrypt');  
            $id = $this->encrypt->decode(base64_decode(str_replace(' ', '+', $this->input->post('__76d5446dec__'))));
            if(!$id)
            {
                echo 'Error inesperado, si el error persiste comuniquese con nosotros. [cod: SC-D-03]'; exit();
            }
            
            $this->load->model('solicitud_model');
            $update = $this->solicitud_model->aprobar_solicitud($id);
             if($update){echo "OK";   }
          
        }
        else
        {
            echo 'Error al intentar cargar la vista'; exit;
        }
        
        
    }
    
    public function ver_pdf()
    {    
       if($this->input->is_ajax_request())
        {
        if($this->input->post('__MA__'))
        {
            $id =  base64_decode($this->security->xss_clean(strip_tags($this->input->post('__MA__'))));
             $datos['id'] = $id;
             $this->load->view('back_end/modal_popup/modal_solicitud_edit', $datos);               
        }
        else
        {
            echo 'Error al intentar cargar la vista'; exit;
        }
        
     }
        else
        {
            echo 'Error al intentar cargar la vista'; exit;
        }
    }
    public function verPdf2($id){
             $objS = $this->solicitud_model->getSolicitudesVoucher($id);
             if($objS){
                   $this->load->library('fpdf');
                            
                            $pdf = new FPDF();
                          
                            $pdf->AddPage();
                            $pdf->SetFont('Arial', '', 9);
                            //Datos personales     Datos Comerciales
                            $pdf->Ln();
                            $pdf->Cell(75,5,"",0); $pdf->Cell(95,5,"SOLICITUD DE TARJETA",0);  $pdf->Cell(45,5,"",0);  
                            
                            $pdf->Ln();
                            $pdf->Cell(95,5,"DATOS PERSONALES",1); $pdf->Cell(95,5,"DATOS COMERCIALES",1); 
                            $pdf->Ln();
                            $pdf->Cell(95,5, utf8_decode("Nombres: ".$objS[0]->nombres),1); $pdf->Cell(95,5,utf8_decode("Nombre Empresa - Empleador: "),1);
                            $pdf->Ln();
                            $pdf->Cell(95,5, utf8_decode("Apellido Paterno: ".$objS[0]->ap_paterno),1); $pdf->Cell(95,5,  utf8_decode($objS[0]->dc_empresa),1);
                            $pdf->Ln();
                            $pdf->Cell(95,5, utf8_decode("Apellido Materno: ".$objS[0]->ap_materno),1); $pdf->Cell(95,5,utf8_decode("Giro: ".$objS[0]->dc_giro),1);
                            $pdf->Ln();
                            $pdf->Cell(95,5, utf8_decode("RUT :".$objS[0]->rut),1); $pdf->Cell(95,5,utf8_decode("Cargo que ocupa :".$objS[0]->dc_cargo),1);
                            $pdf->Ln();
                            $pdf->Cell(95,5, utf8_decode("N° Serie: ".$objS[0]->n_serie),1); $pdf->Cell(95,5,utf8_decode("Dirección Comercial :".$objS[0]->dc_direccion),1);
                            $pdf->Ln();
                            $pdf->Cell(95,5, utf8_decode("Sexo: ".$objS[0]->sexo),1); $pdf->Cell(95,5,utf8_decode("Comuna: ".$objS[0]->nombrecomunadc),1);
                            $pdf->Ln();
                            $pdf->Cell(95,5, utf8_decode("Fecha de nacimiento: ".$objS[0]->fecha_nac),1); $pdf->Cell(95,5,utf8_decode("Ciudad: "),1);
                            $pdf->Ln();
                            $pdf->Cell(95,5, utf8_decode("Estado Civil: ".$objS[0]->estado_civil),1); $pdf->Cell(95,5,utf8_decode("Fono Comercial: ".$objS[0]->dc_fono),1);
                            $pdf->Ln();
                            $pdf->Cell(95,5, utf8_decode("Correo Electrónico :".$objS[0]->correo), 1); $pdf->Cell(95, 5, utf8_decode("Fecha de ingreso: ".$objS[0]->dc_ingreso), 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Nacionalidad :".$objS[0]->nacionalidad), 1); $pdf->Cell(95, 5, utf8_decode("Sueldo bruto: ".$objS[0]->dc_sueldo_b), 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Dirección particular :"), 1); $pdf->Cell(95, 5, "", 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode($objS[0]->direccion), 1); $pdf->Cell(95, 5, "", 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Comuna: ".$objS[0]->nombrecomuna), 1); $pdf->Cell(95, 5, "", 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Ciudad: ".$objS[0]->nombreciudad), 1); $pdf->Cell(95, 5, utf8_decode("Nombre Empleador Anterior(Antiguedad < 2 años"), 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Celular: ".$objS[0]->celular), 1); $pdf->Cell(95, 5, utf8_decode(""), 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Fono: ".$objS[0]->fono_fijo), 1); $pdf->Cell(95, 5, utf8_decode(""), 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Vivienda : ".$objS[0]->vivienda), 1); $pdf->Cell(95, 5, utf8_decode("Banco Cuenta Corriente: ".$objS[0]->dc_banco_cta), 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Antiguedad Domicilio : ".$objS[0]->antiguedad_dom), 1); $pdf->Cell(47.5, 5, utf8_decode("Cupo: ".$objS[0]->dc_cta_cupo), 1);$pdf->Cell(47.5, 5, utf8_decode("Antiguedad :".$objS[0]->dc_cta_antig), 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Estudios : ".$objS[0]->estudios), 1); $pdf->Cell(95, 5, utf8_decode("Tarjeta de Credito: ".$objS[0]->dc_tipo_creditcard), 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Profesión : ".$objS[0]->profesion), 1); $pdf->Cell(47.5, 5, utf8_decode("Cupo: ".$objS[0]->dc_creditcard_cupo), 1);$pdf->Cell(47.5, 5, utf8_decode("Antiguedad :".$objS[0]->dc_creditcard_antig), 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Envío EECC : ".$objS[0]->envio_eecc), 1); $pdf->Cell(95, 5, utf8_decode("Tarjetas Casa Comercial :".$objS[0]->dc_tarjeta_cm), 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Fecha de vencimiento : ".$objS[0]->fecha_pago), 1);  $pdf->Cell(47.5, 5, utf8_decode("Cupo: ".$objS[0]->dc_tarjeta_cm_cupo), 1);$pdf->Cell(47.5, 5, utf8_decode("Antiguedad :".$objS[0]->dc_tarjeta_cm_antig), 1);
                            //Tarjeta adicional
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("TARJETA ADICIONAL"), 1); $pdf->Cell(95, 5, utf8_decode("Espectiva de Cupo : ".$objS[0]->dc_expec_cupo), 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Apellidos :".$objS[0]->ad_ape_pat." ".$objS[0]->ad_ape_mat), 1); $pdf->Cell(95, 5, utf8_decode("Carrera : ".$objS[0]->eu_carrera), 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Nombres :".$objS[0]->ad_nombres), 1); $pdf->Cell(95, 5, utf8_decode("Nombre Universidad : ".$objS[0]->eu_nombre_u), 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Rut Adicional :".$objS[0]->ad_rut), 1); $pdf->Cell(95, 5, utf8_decode("Dirección Universidad : ".$objS[0]->eu_direccion_u), 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Fecha de nacimiento :".$objS[0]->ad_fecha_nac), 1); $pdf->Cell(95, 5, utf8_decode("Comuna : ".$objS[0]->nombrecomunaeu), 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Correo Electrónico :".$objS[0]->ad_correo), 1); $pdf->Cell(95, 5, utf8_decode("Ciudad : ".$objS[0]->nombreciudadeu), 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Parentesco :".$objS[0]->ad_parentesco), 1); $pdf->Cell(47.5, 5, utf8_decode("Año que cursa : ".$objS[0]->eu_ano_curso), 1); $pdf->Cell(47.5, 5, utf8_decode("Año de ingreso : ".$objS[0]->eu_ano_ingreso), 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Celular :".$objS[0]->ad_celular), 1);
                            $pdf->Ln();
                            $pdf->Cell(190, 5, utf8_decode("USO INTERNO"), 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Fecha :".$objS[0]->ui_fecha), 1); $pdf->Cell(95, 5, utf8_decode("Informe : ".$objS[0]->ui_informe), 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("N° de Folio   :"), 1); $pdf->Cell(95, 5, utf8_decode("Tarjeta Cuenta : ".$objS[0]->ui_tarjeta_cuenta), 1);
                            $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Captador :".$objS[0]->ui_captador), 1); $pdf->Cell(95, 5, utf8_decode("Línea de credito : ".$objS[0]->ui_lc), 1);
                             $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Ejecutivo de Captación :".$objS[0]->ui_ej_captador), 1); $pdf->Cell(95, 5, utf8_decode("Autorización : ".$objS[0]->ui_autoriza), 1);
                             $pdf->Ln();
                            $pdf->Cell(95, 5, utf8_decode("Cadena :".$objS[0]->ui_cadena), 1); $pdf->Cell(95, 5, utf8_decode(""), 1);
                            
                            $pdf->Output("asd.pdf",'I', true);  
                            //force_download('coolPDF.pdf',  $pdf->Output("asd.pdf",'D', true));
                            
                         
             $this->load->view('back_end/modal_popup/modal_solicitud_edit', $pdf);
                 
             }
    
                            
        
    }
    /****************************
     * PROCESS
     * **************************/
    
    public function ver_solicitud()
    {
        if($this->input->is_ajax_request())
        {
            if(!$this->input->post('ajaxCmbTipo'))
            {
                echo 'Debe seleccionar una tarjeta'; exit; 
            }
            
            
            if($this->input->post('ajaxPercentDiss')*1 == 0)
            {
                echo 'El porcentaje a agregar debe ser mayor al 0%'; exit; 
            }
            
            if($this->input->post('ajaxPercentDiss')*1 > 100)
            {
                echo 'El porcentaje a agregar debe ser maximo un 100%'; exit; 
            }
            
            $this->form_validation->set_rules('ajaxPercentDiss', 'Porcentaje', 'trim|required|min_length[1]|max_length[3]|integer'); //|strip_tags|xss_clean
            if($this->form_validation->run() === FALSE)
            {
                echo str_replace('<p>', '', str_replace('<p>', '', validation_errors())); exit();
            }
            
            $this->load->helper('date');
            if(!$this->input->post('jaxTxtDesde') || !date_valid($this->input->post('jaxTxtDesde')))
            {
                echo 'Debe ingresar una fecha de inicio valida'; exit; 
            }
            
            if(!$this->input->post('jaxTxtHasta') || !date_valid($this->input->post('jaxTxtHasta')))
            {
                echo 'Debe ingresar una fecha de termino valida'; exit; 
            }
            
            
            
            $tarjeta = base64_decode($this->security->xss_clean(strip_tags($this->input->post('ajaxCmbTipo'))));
            $porcentaje = $this->security->xss_clean(strip_tags($this->input->post('ajaxPercentDiss')));
            $fecha_inicio = date_reverse($this->security->xss_clean(strip_tags($this->input->post('jaxTxtDesde'))), '/', '-');
            $fecha_termino = date_reverse($this->security->xss_clean(strip_tags($this->input->post('jaxTxtHasta'))), '/', '-');
            
            
            
            $this->descuento_model->guardar_descuento($tarjeta, $porcentaje, $this->session->userdata('sess_flash_id_tienda'), $fecha_inicio, $fecha_termino);
            $this->session->unset_userdata('sess_flash_id_tienda');
            $view = $this->load->view('back_end/modal_popup/modal_exito', '', true);
            echo 'OK&' . $view;
        }
        else
        {
            echo 'Error al intentar cargar la vista';
        }
        exit();
    }
    public function procesadas(){
        //$this->load->library('encrypt');
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
        
        
        
        //Begin: Variables
        $_datos['plantilla']['current_menu'] = $this->current;
        $_datos['plantilla']['current_sub_menu'] = $this->current . 1;
        $_datos['plantilla']['titulo'] = 'AhoraDescuentos.com | Admin';
        //End: Variables
        
        //Begin: Objetos
        //$_datos['plantilla']['objsTarjeta'] = $this->tarjeta_model->getCards();
        //$_datos['plantilla']['objsDescuento'] = $this->descuento_model->getDescuentosAgregados();
          $_datos['plantilla']['countSolicitudesPendientes']  =  $this->solicitud_model->getSolicitudesCount(0,$this->session->userdata(SESS_ID_CLIENTE));
          $_datos['plantilla']['objSolicituds'] = $this->solicitud_model->getSolicitudes(1, $this->session->userdata(SESS_ID_CLIENTE), 10);
            $_datos['plantilla']['objSolicitud'] = $this->solicitud_model->getSolicitudes(0, $this->session->userdata(SESS_ID_CLIENTE), 3);
//End: Objetos
        
        
        $_datos['plantilla']['vista'] = 'solicitud_ver_procesadas';
        $this->load->view('plantillas/plantilla_back', $_datos);
        
    }
    
}
