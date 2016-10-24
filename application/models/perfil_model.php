<?php
class perfil_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getPerfil(){
        $consulta = $this->db->get('perfil');
        return $consulta->result();
    }
    
}
