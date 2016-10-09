<?php
defined('BASEPATH') OR exit('Ups, esto no se puede hacer.');

class Descuento extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('sess_authenticado')) {
            redirect(base_url('login'));
            exit();
        }
        $this->load->library('form_validation');
        $this->load->model('tarjeta_model');
        $this->load->model('descuento_model');
        $this->load->helper('security');
        $this->load->helper('date');
        $this->load->model('solicitud_model');
    }

    public function index()
    {
        $_datos = array();
        $_datos['plantilla']['css'] = array(
            'vendor/sweetalert/lib/sweet-alert',
            'vendor/datatables/media/css/jquery.dataTables',
        );

        $_datos['plantilla']['js'] = array(
            'scripts/functions/descuento',
            'scripts/functions/tarjeta',
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

            'vendor/bootstrap-datepicker/js/bootstrap-datepicker',

            'vendor/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min',
            'vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min',
        );


        //Begin: Variables
        $_datos['plantilla']['current_menu'] = MENU_MIS_DESCUENTOS;
        $_datos['plantilla']['current_sub_menu'] = SUBMENU_MISDESCUENTOS_VER;
        $_datos['plantilla']['titulo'] = 'AhoraDescuentos.com | Admin';
        //End: Variables

        //Begin: Objetos
        $_datos['plantilla']['objsDescuento'] = $this->descuento_model->getDescuentosAgregados($this->session->userdata(SESS_ID_CLIENTE));
         $_datos['plantilla']['countSolicitudesPendientes']  =  $this->solicitud_model->getSolicitudesCount(0,$this->session->userdata(SESS_ID_CLIENTE));
           $_datos['plantilla']['objSolicitud'] = $this->solicitud_model->getSolicitudes(0, $this->session->userdata(SESS_ID_CLIENTE), 3);
//End: Objetos


        $_datos['plantilla']['vista'] = 'descuento_ver';
        $this->load->view('plantillas/plantilla_back', $_datos);
    }

    public function agregar()
    {
        $this->load->model('tienda_model');
        //$this->load->library('encrypt');
        $_datos = array();
        $_datos['plantilla']['css'] = array(
            'vendor/sweetalert/lib/sweet-alert',
            'vendor/datatables/media/css/jquery.dataTables',
            'vendor/checkbo/src/0.1.4/css/checkBo.min',
            'vendor/chosen_v1.4.0/chosen.min'
        );

        $_datos['plantilla']['js'] = array(
            'scripts/functions/tarjeta',
            'scripts/functions/descuento',
            'scripts/pages/alert',
            'scripts/functions/global',


            'vendor/noty/js/noty/packaged/jquery.noty.packaged.min',
            'vendor/checkbo/src/0.1.4/js/checkBo.min',
            'vendor/sweetalert/lib/sweet-alert.min',
            'vendor/datatables/media/js/jquery.dataTables',
            'vendor/datatables/media/js/dataTables.bootstrap',


            'vendor/chosen_v1.4.0/chosen.jquery.min',
            'vendor/jquery.tagsinput/jquery.tagsinput.min',
            'vendor/checkbo/src/0.1.4/js/checkBo.min',
            'vendor/intl-tel-input//build/js/intlTelInput.min',
            'vendor/bootstrap-timepicker/js/bootstrap-timepicker.min',
            'vendor/clockpicker/dist/jquery-clockpicker.min',

            'vendor/bootstrap-datepicker/js/bootstrap-datepicker',

            'vendor/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min',
            'vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min',
        );


        //Begin: Variables
        $_datos['plantilla']['current_menu'] = MENU_MIS_DESCUENTOS;
        $_datos['plantilla']['current_sub_menu'] = SUBMENU_MISDESCUENTOS_AGREGAR;
        $_datos['plantilla']['titulo'] = 'AhoraDescuentos.com | Admin';
        //End: Variables

        //Begin: Objetos
        $_datos['plantilla']['objsTarjeta'] = $this->tarjeta_model->getCards($this->session->userdata(SESS_ID_CLIENTE), TRUE);
          $_datos['plantilla']['countSolicitudesPendientes']  =  $this->solicitud_model->getSolicitudesCount(0,$this->session->userdata(SESS_ID_CLIENTE));
        if ($this->session->userdata('sess_flash_id_tarjeta')) {
            $_datos['plantilla']['objsDescuento'] = $this->tienda_model->getTiendasDisponibles($this->session->userdata('sess_flash_id_tarjeta'));
        } else {
            $_datos['plantilla']['objsDescuento'] = FALSE;
        }
          $_datos['plantilla']['objSolicitud'] = $this->solicitud_model->getSolicitudes(0, $this->session->userdata(SESS_ID_CLIENTE), 3);
        //End: Objetos


        $_datos['plantilla']['vista'] = 'descuento_agregar';
        $this->load->view('plantillas/plantilla_back', $_datos);
    }


    /****************************
     * MODALS
     * **************************/
    public function descuento_modal()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post('__MA__')) {
                //$this->load->library('encrypt');
                //$id = $this->encrypt->decode(base64_decode($this->security->xss_clean(strip_tags($this->input->post('__MA__')))));

                $id = base64_decode($this->security->xss_clean(strip_tags($this->input->post('__MA__'))));

                $this->session->set_userdata('sess_flash_id_tienda', $id);
                $objTienda = $this->descuento_model->getTienda($id);
                $_datos['tienda'] = $objTienda[0]->nombre;
                $_datos['objsTarjeta'] = $this->tarjeta_model->getCards($this->session->userdata(SESS_ID_CLIENTE), TRUE);
                $this->load->view('back_end/modal_popup/modal_descuento_add', $_datos);
            } else {
                echo 'Error al intentar cargar la vista';
                exit;
            }
        } else {
            echo 'Error al intentar cargar la vista';
            exit;
        }
    }


    public function editar_descuento()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post('__MA__')) {
                //$this->load->library('encrypt');
                //$id = $this->encrypt->decode(base64_decode($this->security->xss_clean(strip_tags($this->input->post('__MA__')))));

                $id_descuento = base64_decode($this->security->xss_clean(strip_tags($this->input->post('__MA__'))));
                $objDescuento = $this->descuento_model->getDescuentosAgregados($this->session->userdata(SESS_ID_CLIENTE), $id_descuento);

                if ($objDescuento) {
                    foreach ($objDescuento as $objDesc) {
                        $id_tienda = $objDesc->id_tienda;
                        $objTienda = $this->descuento_model->getTienda($id_tienda);

                        $_datos['tienda'] = $objTienda[0]->nombre;
                        $_datos['tarjeta'] = $objDesc->nombre_tarjeta . ' - ' . $objDesc->tipo_tarjeta;
                        $_datos['porcentaje'] = $objDesc->cantidad_desc;
                        $_datos['fecha_desde'] = date_reverse($objDesc->fecha_inicio, '-', '/');
                        $_datos['fecha_hasta'] = date_reverse($objDesc->fecha_termino, '-', '/');

                        $this->session->set_userdata('sess_flash_id_descuento_edit', $objDesc->id);
                    }

                    $this->load->view('back_end/modal_popup/modal_descuento_edit', $_datos);
                } else {
                    echo 'Error al intentar editar el descuento';
                    exit;
                }
            } else {
                echo 'Error al intentar editar el descuento';
                exit;
            }
        } else {
            echo 'Error al intentar editar el descuento';
            exit;
        }
    }


    /****************************
     * PROCESS
     * **************************/
    public function agregar_descuento()
    {
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules('ajaxCmbTipo', 'Tarjeta', 'trim|required|xss_clean|strip_tags');
            $this->form_validation->set_rules('ajaxPercentDiss', 'Porcentaje', 'trim|required|min_length[1]|max_length[2]|integer');
            $this->form_validation->set_rules('ajaxTopeDescuento', 'Tope Descuento', 'trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('ajaxTxtDesde', 'Fecha Desde', 'trim|required|xss_clean|strip_tags');
            $this->form_validation->set_rules('ajaxTxtHasta', 'Fecha Hasta', 'trim|required|xss_clean|strip_tags');
            $this->form_validation->set_rules('ajaxTodosLosDias', 'Selección Días', 'trim|required|xss_clean|strip_tags');
            $this->form_validation->set_rules('ajaxDescripcion', 'Descripción', 'trim|required|max_length[2000]|strip_tags|xss_clean');
            $this->form_validation->set_rules('ajaxAclaraciones', 'Aclaraciones', 'trim|max_length[2000]|strip_tags|xss_clean');

            if ($this->input->post('ajaxTodosLosDias') == "false" && count($this->input->post('ajaxSeleccionDias')) == 0) {
                echo 'Seleccione que días estara el descuento activo.';
                exit;
            }

            if ($this->form_validation->run() === FALSE) {
                echo str_replace('<p>', '', validation_errors());
                exit();
            }

            if ($this->input->post('ajaxPercentDiss') * 1 == 0) {
                echo 'El porcentaje a agregar debe ser mayor al 0%';
                exit;
            }

            if (!$this->input->post('ajaxTodosLosDias')) {
                echo 'Debe seleccionar los días que el descuento estara activo';
                exit;
            }

            if (!$this->input->post('ajaxTxtDesde') || !date_valid($this->input->post('ajaxTxtDesde'))) {
                echo 'Debe ingresar una fecha de inicio valida';
                exit;
            }

            if (!$this->input->post('ajaxTxtHasta') || !date_valid($this->input->post('ajaxTxtHasta'))) {
                echo 'Debe ingresar una fecha de termino valida';
                exit;
            }


            /* fecha desde es mayor a fecha hasta */
            if (date_diff_(date_reverse($this->input->post('ajaxTxtDesde'), '/', '-'),
                    date_reverse($this->input->post('ajaxTxtHasta'), '/', '-'), 'd') < 0
            ) {
                echo 'La fecha inicio del descuento no puede ser mayor que la fecha termino.';
                exit;
            }


            if($this->input->post('ajaxTodosLosDias') == "true"){
                $dias = array('1', '1', '1', '1', '1', '1', '1');
            }else {
                $dias = array('0', '0', '0', '0', '0', '0', '0');
                foreach ($this->input->post('ajaxSeleccionDias') as $dia) {
                    switch ($dia) {
                        case 'Lunes':
                            $dias[0] = '1';
                            break;
                        case 'Martes':
                            $dias[1] = '1';
                            break;
                        case 'Miércoles':
                            $dias[2] = '1';
                            break;
                        case 'Jueves':
                            $dias[3] = '1';
                            break;
                        case 'Viernes':
                            $dias[4] = '1';
                            break;
                        case 'Sábado':
                            $dias[5] = '1';
                            break;
                        case 'Domingo':
                            $dias[6] = '1';
                            break;
                    }
                }
            }


            $tarjeta = base64_decode($this->input->post('ajaxCmbTipo'));
            $fecha_inicio = date_reverse($this->input->post('ajaxTxtDesde'), '/', '-');
            $fecha_termino = date_reverse($this->input->post('ajaxTxtHasta'), '/', '-');


            $this->descuento_model->guardar_descuento($tarjeta,
                $this->input->post('ajaxPercentDiss'),
                $this->session->userdata('sess_flash_id_tienda'),
                $fecha_inicio,
                $fecha_termino,
                $this->input->post('ajaxTopeDescuento'),
                $this->input->post('ajaxDescripcion'),
                $this->input->post('ajaxAclaraciones'),
                $dias
            );

            $this->session->unset_userdata('sess_flash_id_tienda');
            $view = $this->load->view('back_end/modal_popup/modal_exito', '', true);
            echo 'OK&' . $view;
        } else {
            echo 'Error al intentar cargar la vista';
        }
        exit();
    }


    public function modificar_descuento()
    {
        if ($this->input->is_ajax_request()) {
            if (!$this->session->userdata('sess_flash_id_descuento_edit')) {
                echo 'Error inesperado, si el error persiste comuniquese con nosotros. [cod: DC-MD-01]';
                exit();
            }


            if ($this->input->post('ajaxPercentDiss') * 1 == 0) {
                echo 'El porcentaje a agregar debe ser mayor al 0%';
                exit;
            }

            if ($this->input->post('ajaxPercentDiss') * 1 > 100) {
                echo 'El porcentaje a agregar debe ser maximo un 100%';
                exit;
            }

            $this->form_validation->set_rules('ajaxPercentDiss', 'Porcentaje', 'trim|required|min_length[1]|max_length[3]|integer');
            if ($this->form_validation->run() === FALSE) {
                echo str_replace('<p>', '', str_replace('<p>', '', validation_errors()));
                exit();
            }

            /* Validando fechas */
            if (!$this->input->post('ajaxTxtDesde') || !date_valid($this->input->post('ajaxTxtDesde'))) {
                echo 'Debe ingresar una fecha de inicio valida';
                exit;
            }

            if (!$this->input->post('ajaxTxtHasta') || !date_valid($this->input->post('ajaxTxtHasta'))) {
                echo 'Debe ingresar una fecha de termino valida';
                exit;
            }


            /* fecha desde es mayor a fecha hasta */
            if (date_diff_(date_reverse($this->input->post('ajaxTxtDesde'), '/', '-'),
                    date_reverse($this->input->post('ajaxTxtHasta'), '/', '-'), 'd') < 0
            ) {
                echo 'La fecha inicio del descuento no puede ser mayor que la fecha termino.';
                exit;
            }


            $porcentaje = $this->security->xss_clean(strip_tags($this->input->post('ajaxPercentDiss')));
            $fecha_inicio = date_reverse($this->security->xss_clean(strip_tags($this->input->post('ajaxTxtDesde'))), '/', '-');
            $fecha_termino = date_reverse($this->security->xss_clean(strip_tags($this->input->post('ajaxTxtHasta'))), '/', '-');


            $this->descuento_model->modificar_descuento($this->session->userdata('sess_flash_id_descuento_edit'), $porcentaje, $fecha_inicio, $fecha_termino);
            $this->session->unset_userdata('sess_flash_id_descuento_edit');
            $view = $this->load->view('back_end/modal_popup/modal_exito', '', true);
            echo 'OK&' . '<script>Global.prototype.setReloadPage(1);</script>' . $view;
        } else {
            echo 'Error al intentar cargar la vista';
        }
        exit();
    }


    public function delete()
    {
        if ($this->input->is_ajax_request()) {
            if (!$this->input->post('__76d5446dec__')) {
                echo 'Error inesperado, si el error persiste comuniquese con nosotros. [cod: DC-D-02]';
                exit();
            }

            //$this->load->library('encrypt');  
            //$id_descuento = $this->encrypt->decode(base64_decode(str_replace(' ', '+', $this->input->post('__76d5446dec__'))));
            $id_descuento = base64_decode(str_replace(' ', '+', $this->input->post('__76d5446dec__')));
            if (!$id_descuento) {
                echo 'Error inesperado, si el error persiste comuniquese con nosotros. [cod: DC-D-03]';
                exit();
            }


            //echo $id_descuento; exit;

            $this->load->model('descuento_model');
            $descuento = $this->descuento_model->getDescuento($id_descuento);

            if ($descuento) {
                foreach ($descuento as $objDescuento) {
                    if ($objDescuento->id == $id_descuento) {
                        $this->descuento_model->delete($id_descuento);
                        $disscount = $this->descuento_model->getDescuento($id_descuento);
                        if (!$disscount) {
                            echo 'OK';
                        } else {
                            echo 'Error al intentar eliminar el descuento, si el error persiste comuniquese con nostros. [cod: DC-D-06]';
                        }
                    } else {
                        echo 'Error al intentar eliminar el descuento, si el error persiste comuniquese con nostros. [cod: DC-D-05]';
                    }
                }
            } else {
                echo 'Error al intentar eliminar el descuento, si el error persiste comuniquese con nostros. [cod: DC-D-04]';
            }

        } else {
            echo 'Error al intentar cargar la vista';
        }
    }


    public function buscar()
    {
        if ($this->input->is_ajax_request()) {
            if (!$this->input->post('cmbCard')) {
                echo 'Debe seleccionar un tipo de tarjeta.';
                exit();
            }

            $this->form_validation->set_rules('cmbCard', 'Tarjeta', 'trim|required|min_length[1]|max_length[5]|integer');
            if ($this->form_validation->run() === FALSE) {
                echo str_replace('<p>', '', str_replace('<p>', '', validation_errors()));
                exit();
            }


            /*if(!$this->input->post('txtNombreTienda'))
            {
                echo 'Debe escribir el nombre de alguna tienda a la que quiere agregar un descuento.'; exit();
            }
            
            $this->form_validation->set_rules('txtNombreTienda', 'Nombre Tienda', 'trim|required|min_length[1]|max_length[30]'); 
            if($this->form_validation->run() === FALSE)
            {
                echo str_replace('<p>', '', str_replace('<p>', '', validation_errors())); exit();
            } */

            $this->session->set_userdata('sess_flash_id_tarjeta', $this->security->xss_clean(strip_tags($this->input->post('cmbCard'))));
            echo 'OK';

        } else {
            echo 'Error al intentar cargar la vista';
        }
    }
}