<?php

class tarjeta_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function guardar($id_cliente, $nombre, $tipo, $imagen)
    {
        $data = array(
            'id_clientes' => $id_cliente,
            'nombre' => $nombre,
            'imagen' => $imagen,
            'tipo' => $tipo
        );

        return $this->db->insert('tbl_tarjetas', $data); 
    }
    
    public function getTipoTarjeta()
    {
        $this->db->order_by('id', 'asc');
        $consulta = $this->db->get('tbl_tipo_tarjeta');
        return $consulta->result();
    }
    
    public function getCards($id_cliente, $publica = FALSE)
    {
        $this->db->select('tbl_tarjetas.id, tbl_tarjetas.nombre, tbl_tarjetas.imagen, '
                . 'tbl_tipo_tarjeta.nombre as nombre_tarjeta, tbl_tarjetas.publicada')
        ->from('tbl_tarjetas')
        ->join('tbl_tipo_tarjeta', 'tbl_tarjetas.tipo = tbl_tipo_tarjeta.id')
        ->where('tbl_tarjetas.id_clientes', $id_cliente);
        
        if($publica)
        {
            $this->db->where('tbl_tarjetas.publicada', 1);
        }
        
        $consulta = $this->db->get();
        
        if($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return FALSE;
        }
    }
    
    public function getCard($id, $publica = 0)
    {
        $this->db->select('id, publicada, imagen');
        $this->db->where('id', $id);
        $this->db->where('publicada', $publica);
        $this->db->from('tbl_tarjetas');
        $consulta = $this->db->get();
        
        if($consulta->num_rows() == 1) {
            return $consulta->result();
        } else {
            return FALSE;
        }
            
    }
    
    
    public function getCardDescuento($id)
    {
        $this->db->select('id_tarjeta');
        $this->db->where('id_tarjeta', $id);
        $this->db->from('tbl_descuentos');
        $consulta = $this->db->get();
        
        if($consulta->num_rows() >= 1) {
            return TRUE;
        } else {
            return FALSE;
        }
            
    }
    
    
    public function deleteCard($id) 
    {
        $this->db->where('id', $id);
        $this->db->where('publicada', 0);
        $this->db->delete('tbl_tarjetas'); 
    }
    
    
    public function public_card($id, $st = 1)
    {
        $data = array(  
            'publicada' => $st,
        );

        $this->db->where('id', $id)
        ->update('tbl_tarjetas', $data); 
        
        return TRUE;
    }


    public function getCountCards($id_cliente, $publica = FALSE)
    {
        $this->db->from('tbl_tarjetas')
            ->join('tbl_tipo_tarjeta', 'tbl_tarjetas.tipo = tbl_tipo_tarjeta.id')
            ->where('tbl_tarjetas.id_clientes', $id_cliente);

        if($publica)
        {
            $this->db->where('tbl_tarjetas.publicada', 1);
        }

        return $this->db->count_all_results();
    }
}
