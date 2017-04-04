<?php

class Pais_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function listado_paises()
    {
        $this->db->order_by('codigo', 'desc');
        $consulta = $this->db->get('tbl_pais');
        return $consulta->result();
    }
    
    
    public function detalle_pais($cod)
    {
        $this->db->where('codigo', $cod);
        $consulta = $this->db->get('tbl_pais');
        //return $consulta->row();
        return $consulta->result();
    }
    
    
    /*public function detalle_pais($nombre)
    {
        $this->db->order_by('codigo', 'desc');
        $this->db->where('nombre', $nombre);
        $consulta = $this->db->get('tbl_pais');
        //return $consulta->row();
        return $consulta->result();
    }*/
}
