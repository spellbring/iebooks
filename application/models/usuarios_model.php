<?php

class usuarios_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function check_user($user) {
        $this->db->select('usuario, password, nombre_p, nombre_s, apellido_p, apellido_m')->where('usuario', $user);
        $this->db->from('usuario');
        $consulta = $this->db->get();
        
        if($consulta->num_rows() == 1) {
            return $consulta->result();
        } else {
            return FALSE;
        }
            
    }
}