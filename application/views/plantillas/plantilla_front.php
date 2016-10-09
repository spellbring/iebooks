<?php
$this->load->view('plantillas/front_end/_Header', $plantilla);
$this->load->view('front_end/' . $plantilla['vista']);
$this->load->view('plantillas/front_end/_Footer');