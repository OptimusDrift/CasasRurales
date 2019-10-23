<?php if (!defined('BASEPATH')) exit('No existe el directorio');

class reservas_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

  


    public function ObtenerReservasRealizadas($idusr)
    {
        $result = $this->db->query("CALL `VistaReservasRealizadas` (" .$idusr .")");
        return $result;
    }


    public function ObtenerReservasPendientes($idusr)
    {
        $result = $this->db->query("CALL `VistaReservasPendientes` (" .$idusr .")");
        return $result;
    }

    


    public function Alerta($idusr)
    {
        $result = $this->db->query("CALL `AlertarUsuario` (" .$idusr .")");
        return $result;
    }

}
