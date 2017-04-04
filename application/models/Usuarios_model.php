<?php

class usuarios_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function check_user($user) {
        $this->db->select('usuario, password, nombre_p, nombre_s, apellido_p, apellido_m, institucion_idinstitucion, perfil_idperfil')
                ->where('usuario', $user);
        $this->db->from('usuario');
        $consulta = $this->db->get();
        
        if($consulta->num_rows() == 1) {
            return $consulta->result();
        } else {
            return FALSE;
        }
            
    }
   
    public function insert($usuario, $password, $nombre_p, $nombre_s, 
            $apellido_p, $apellido_s, $correo, $perfil_idperfil, $institucion_idinstitucion){
        $data = array(
            'usuario' => $usuario,
            'password' => $password,
            'nombre_p' => $nombre_p,
            'nombre_s' => $nombre_s,
            'apellido_p' => $apellido_p,
            'apellido_m' => $apellido_s,
            'correo' => $correo,
            'perfil_idperfil' => $perfil_idperfil,
            'institucion_idinstitucion' => $institucion_idinstitucion,
            'estado' => 1
        );

        return $this->db->insert('usuario', $data);
    }
    
    public function getUserIns($id_inst){
         $this->db->select('idusuario, usuario, password, nombre_p, nombre_s, apellido_p, apellido_m, institucion_idinstitucion, perfil_idperfil, correo, descripcion')
                  ->join('perfil', 'perfil.idperfil = usuario.perfil_idperfil') 
                  ->where('institucion_idinstitucion', $id_inst)
                  ->where('estado', 1);
         $this->db->from('usuario');
         return $this->db->get()->result();
    }
    
     public function getUserId($id){
         $this->db->select('usuario, password, nombre_p, nombre_s, apellido_p, apellido_m, institucion_idinstitucion, perfil_idperfil, correo')
                  ->where('idusuario', $id);
         $this->db->from('usuario');
         return $this->db->get()->result();
    }
    
    public function update($id, $usuario
            , $password, $nombre_p
            , $nombre_s, $apellido_p, $apellido_s, $correo, $perfil_idperfil){
         $data = array(
            'usuario' => $usuario,
            'password' => $password,
            'nombre_p' => $nombre_p,
            'nombre_s' => $nombre_s,
            'apellido_p' => $apellido_p,
            'apellido_m' => $apellido_s,
            'correo' => $correo,
            'perfil_idperfil' => $perfil_idperfil
        );
        
        $this->db->where('idusuario', $id);
        $this->db->update('usuario', $data);

        return TRUE;
    }
     public function update_down($id)
    {
        $data = array(
            'estado' => 0,
        );

        $this->db->where('idusuario', $id);
        $this->db->update('usuario', $data);

        return TRUE;
    }
    
}