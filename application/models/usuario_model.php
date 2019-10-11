<?php if (!defined('BASEPATH')) exit('No existe el directorio');

class Usuario_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Login($correo, $contrasenna)
    {
        $this->db->where('correo', (string) $correo);
        $this->db->where('contrasenna',(string) $contrasenna);
        if ($this->db->get('usuario')->num_rows()>0) {
            return true;
        }else {
            return false;
        }
    }
}
