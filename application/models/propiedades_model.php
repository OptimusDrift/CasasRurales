<?php if (!defined('BASEPATH')) exit('No existe el directorio');

class Propiedades_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function obtenerPropiedades($idUsuario)
    {
        $result = $this->db->query("select * from propiedad where id_propietario = " . $idUsuario);
        if ($result->num_rows() > 0) 
        {
            return $result;
        }
        else {return false;
        }
    }
}