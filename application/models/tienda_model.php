<?php

class tienda_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function getTiendas()
    {
        $this->db->select('T.id, T.nombre, '
                . 'T.direccion, T.correo, '
                . 'C.nombre as nombre_ciudad')
        ->from('tbl_tienda AS T')
        ->join('tbl_ciudad AS C', 'T.id_ciudad = C.id')
        ->order_by('T.nombre', 'asc');
        
        $consulta = $this->db->get();
        
        if($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return FALSE;
        }
    }
    
    
    public function getTiendasDisponibles($card = 0)
    {   
        $this->db->select('T.id, T.nombre, '
                . 'T.direccion, T.correo, '
                . 'C.nombre as nombre_ciudad')
        ->from('tbl_tienda AS T')
        ->join('tbl_ciudad AS C', 'T.id_ciudad = C.id')
        ->where('T.id NOT IN (SELECT distinct id_tienda 
            FROM tbl_descuentos 
            WHERE id_tarjeta = ' . $card . ')')
        ->order_by('T.nombre', 'asc');
        
        $consulta = $this->db->get();
        
        //echo $this->db->last_query();
        
        if($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return FALSE;
        }
    }
    
    
    public function getTienda($id)
    {
        $this->db->select('id, nombre');
        $this->db->where('id', $id);
        $this->db->from('tbl_tienda');
        $consulta = $this->db->get();
        
        if($consulta->num_rows() == 1) {
            return $consulta->result();
        } else {
            return FALSE;
        }
    }
    
    public function delete($id) 
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_descuento'); 
    }
}
