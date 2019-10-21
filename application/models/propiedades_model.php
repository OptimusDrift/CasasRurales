<?php if (!defined('BASEPATH')) exit('No existe el directorio');

class Propiedades_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
<<<<<<< HEAD
        $this->load->database();
    }

    function obtenerPropiedades() 
    {
        $props = $this->db->query("SELECT nombre_propiedad FROM propiedad");
        if ($props->num_rows > 0) 
        {
            return $props;
        }
        else {return false;}
=======
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
>>>>>>> 47f88fc2cca3907aa727784e0a0c132f027ae80e
    }
}