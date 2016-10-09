<?php
$this->load->view('plantillas/back_end/_Header', $plantilla);
$this->load->view('plantillas/back_end/_LeftSidebar');
$datos_plantilla['_NavBar'] = 'plantillas/back_end/_NavBar';
$this->load->view('back_end/' . $plantilla['vista'], $datos_plantilla);
$this->load->view('plantillas/back_end/_Footer');