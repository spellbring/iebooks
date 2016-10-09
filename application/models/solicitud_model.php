<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class solicitud_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function getSolicitudes($pendiente, $id_cliente, $cantidad)
    {
       
      
         $this->db->select('tbl_solicitud.*, tbl_tarjetas.nombre as nombretarjeta ', $cantidad)
           ->from('tbl_solicitud')       
         ->join('tbl_solicitud_tarjeta','tbl_solicitud.id = tbl_solicitud_tarjeta.id_solicitud' )
                 ->join('tbl_tarjetas','tbl_tarjetas.id = tbl_solicitud_tarjeta.id_tarjeta')
         ->where('tbl_solicitud_tarjeta.pendiente', $pendiente)
         ->where('tbl_tarjetas.id_clientes', $id_cliente)
         ->order_by('ui_fecha', 'desc');
        
         $consulta = $this->db->get();
        return $consulta->result();
    }
    
     public function getSolicitudesCount($pendiente, $id_cliente)
    {
       
      
         $this->db->select('count(*) as cantidad')
         ->from('tbl_solicitud')
         ->join('tbl_solicitud_tarjeta','tbl_solicitud.id = tbl_solicitud_tarjeta.id_solicitud' )
         ->join('tbl_tarjetas','tbl_tarjetas.id = tbl_solicitud_tarjeta.id_tarjeta')
         ->where('tbl_solicitud_tarjeta.pendiente', $pendiente)
         ->where('tbl_tarjetas.id_clientes', $id_cliente)
         ->order_by('ui_fecha', 'desc');
        
         $consulta = $this->db->get();
        return $consulta->result();
    }

    public function getSolicitudesVoucher($id)
    {
        $this->db->select("tbl_solicitud.*, "
            . "tbl_comuna.nombre as nombrecomuna, "
            . "cm.nombre as nombrecomunadc, "
            . "cmeu.nombre as nombrecomunaeu, "
            . "tbl_ciudad.nombre as nombreciudad, "
            . "tc.nombre as nombreciudadeu "
           )
            ->from("tbl_solicitud")
            ->join("tbl_comuna", "tbl_solicitud.id_comuna = tbl_comuna.id", "left")
            ->join("tbl_ciudad", "tbl_comuna.id_ciudad = tbl_ciudad.id", "left")
            ->join("tbl_comuna cm", "tbl_solicitud.dc_id_comuna = cm.id", "left")
            ->join("tbl_comuna cmeu", "tbl_solicitud.eu_id_comuna = cmeu.id", "left")
            ->join("tbl_ciudad tc", "cmeu.id_ciudad = tc.id", "left")
            ->join("tbl_tarjetas", "tbl_solicitud.id_tarjeta = tbl_tarjetas.id")
            ->join("tbl_clientes", "tbl_tarjetas.id_clientes = tbl_clientes.id")
            ->where("tbl_solicitud.id", $id);

        $consulta = $this->db->get();
        return $consulta->result();
    }

    public function aprobar_solicitud($id_solicitud)
    {
        $data = array(
            'pendiente' => 1,
        );

        $this->db->where('id_solicitud', $id_solicitud)
        ->update('tbl_solicitud_tarjeta', $data);

        return TRUE;
    }

    public function getCountSolicitudes($pendiente, $id_cliente)
    {
        $this->db->from('tbl_solicitud')
            ->join('tbl_solicitud_tarjeta','tbl_solicitud.id = tbl_solicitud_tarjeta.id_solicitud' )
            ->join('tbl_tarjetas', 'tbl_tarjetas.id = tbl_solicitud_tarjeta.id_tarjeta')
            ->where('tbl_tarjetas.id_clientes', $id_cliente)
            ->where('tbl_solicitud_tarjeta.pendiente', $pendiente);
        return $this->db->count_all_results();
    }


    public function getCountTopSolicitudes($id_cliente)
    {
        $this->db->select('DATE_FORMAT(fecha_ingreso,"%m") as Mes ,count(MONTH(fecha_ingreso)) as Cantidad ')
            ->from('tbl_solicitud')
            ->join('tbl_solicitud_tarjeta', 'tbl_solicitud.id = tbl_solicitud_tarjeta.id_solicitud')
            ->join('tbl_tarjetas', 'tbl_solicitud_tarjeta.id_tarjeta = tbl_tarjetas.id')
            ->where('tbl_tarjetas.id_clientes', $id_cliente)
            ->group_by('Mes')
            ->order_by('Mes', 'desc')
            ->limit(1, 0);
        return $this->db->get()->result();
    }

}

