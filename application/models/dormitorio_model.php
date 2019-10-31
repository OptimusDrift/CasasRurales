<?php if (!defined('BASEPATH')) exit('No existe el directorio');

class dormitorio_model extends CI_Model
{


    public function __construct()
    {
       
        parent::__construct();
 
    }

    public function obtenerCamas($idor)
    {
        $this->db->reconnect();
        $result = $this->db->query("CALL `VistaCamasDormitorio` (" .$idor .")");
        return $result;
    }

    public function obtenerDormitorio($idor)
    {
        $this->db->reconnect();
        $result = $this->db->query("CALL `VistaDormitorio` (" .$idor .")");
        return $result->row(0);
    }


}
