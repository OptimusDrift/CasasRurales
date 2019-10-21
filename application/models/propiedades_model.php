<?php if (!defined('BASEPATH')) exit('No existe el directorio');

class Propiedades_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
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
    }
}