<?php

class descuento_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getDescuentos()
    {
        $this->db->select('T.id, T.nombre, '
            . 'T.direccion, T.correo, '
            . 'tbl_ciudad.nombre as nombre_ciudad')
            ->from('tbl_tienda AS T')
            ->join('tbl_ciudad', 'T.id_ciudad = tbl_ciudad.id')
            ->order_by('T.nombre', 'asc');

        $consulta = $this->db->get();

        //echo $this->db->last_query();
        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return FALSE;
        }
    }


    public function getDescuentosAgregados($id_clientes, $id = FALSE)
    {
        $this->db->select('tbl_descuentos.id, tbl_descuentos.id_tienda, '
            . 'tbl_descuentos.cantidad_desc, tbl_descuentos.fecha_inicio, '
            . 'tbl_descuentos.fecha_termino, T.nombre, '
            . 'T.direccion, T.correo, '
            . 'tbl_tarjetas.imagen, tbl_tarjetas.nombre as nombre_tarjeta, '
            . 'tbl_tipo_tarjeta.nombre as tipo_tarjeta, tbl_ciudad.nombre as nombre_ciudad')
            ->from('tbl_descuentos')
            ->join('tbl_tienda AS T', 'T.id = tbl_descuentos.id_tienda')
            ->join('tbl_tarjetas', 'tbl_tarjetas.id = tbl_descuentos.id_tarjeta')
            ->join('tbl_tipo_tarjeta', 'tbl_tarjetas.tipo = tbl_tipo_tarjeta.id')
            ->join('tbl_ciudad', 'T.id_ciudad = tbl_ciudad.id')
            ->where('tbl_tarjetas.id_clientes', $id_clientes);

        if ($id) {
            $this->db->where('tbl_descuentos.id', $id);
        }

        $this->db->order_by('T.nombre asc, tbl_descuentos.cantidad_desc desc');

        $consulta = $this->db->get();

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return FALSE;
        }
    }


    public function getDescuento($id)
    {
        $this->db->select('id')
            ->from('tbl_descuentos')
            ->where('id', $id);

        $consulta = $this->db->get();

        if ($consulta->num_rows() == 1) {
            return $consulta->result();
        } else {
            return FALSE;
        }
    }


    public function getTienda($id)
    {
        $this->db->select('id, nombre')
            ->where('id', $id)
            ->from('tbl_tienda');
        $consulta = $this->db->get();

        if ($consulta->num_rows() == 1) {
            return $consulta->result();
        } else {
            return FALSE;
        }
    }

    public function guardar_descuento($tarjeta, $porcentaje, $tienda, $fecha_ini, $fecha_fin, $tope, $descripcion, $aclaraciones, $dias)
    {
        $data = array(
            'id_tarjeta' => $tarjeta,
            'id_tienda' => $tienda,
            'fecha_inicio' => $fecha_ini,
            'fecha_termino' => $fecha_fin,
            'cantidad_desc' => $porcentaje,
            'tope_descuento' => $tope,
            'descripcion' => $descripcion,
            'aclaraciones' => $aclaraciones,
            'lunes' => $dias[0],
            'martes' => $dias[1],
            'miercoles' => $dias[2],
            'jueves' => $dias[3],
            'viernes' => $dias[4],
            'sabado' => $dias[5],
            'domingo' => $dias[6],

        );

        return $this->db->insert('tbl_descuentos', $data);
    }

    public function modificar_descuento($id, $porcentaje, $fecha_ini, $fecha_fin)
    {
        $data = array(
            'fecha_inicio' => $fecha_ini,
            'fecha_termino' => $fecha_fin,

            'cantidad_desc' => $porcentaje
        );

        $this->db->where('id', $id)
            ->update('tbl_descuentos', $data);

        return TRUE;
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete('tbl_descuentos');
    }

    public function getCountDescuentosAgregados($id_clientes)
    {
        $this->db->from('tbl_descuentos')
            ->join('tbl_tienda', 'tbl_tienda.id = tbl_descuentos.id_tienda')
            ->join('tbl_tarjetas', 'tbl_tarjetas.id = tbl_descuentos.id_tarjeta')
            ->where('tbl_tarjetas.id_clientes', $id_clientes);

        return $this->db->count_all_results();
    }

    public function getMejorDescuento($id_clientes)
    {

        $this->db->select('tbl_descuentos.cantidad_desc, tbl_tarjetas.nombre')
            ->from('tbl_descuentos')
            ->join('tbl_tienda', 'tbl_tienda.id = tbl_descuentos.id_tienda')
            ->join('tbl_tarjetas', 'tbl_tarjetas.id = tbl_descuentos.id_tarjeta')
            ->where('tbl_tarjetas.id_clientes', $id_clientes)
            ->limit(1, 0)
            ->order_by('tbl_descuentos.cantidad_desc', 'desc');

        return $this->db->get()->result();
    }

}
