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
        if ($result->num_rows() > 0) {
            return $result;
        } else {
            return false;
        }
    }

    function obtenerImagenesPropiedades($idPropiedad)
    {
        $this->db->reconnect();
        $result = $this->db->query("SELECT link FROM imagen_propiedad WHERE id_propiedad = " . $idPropiedad);
        $adress = null;
        if ($result->num_rows() > 0) {
            for ($i = 0; $i < $result->num_rows(); $i++) {
                $adress[$i] = $result->row($i)->link;
            }
        }
        return $adress;
    }

    public function ObtenerPaquete($paquete)
    {
        $result = $this->db->query("SELECT * FROM paquete inner join paquete_dormitorio on paquete.id_paquete = paquete_dormitorio.id_paquete WHERE paquete.id_paquete = " . $paquete);
        return $result->row(0);
    }
    public function ObtenerPropiedad($dormitorio)
    {
        $result = $this->db->query("SELECT * FROM dormitorio WHERE id_dormitorio =  " . $dormitorio);
        return $result->row(0);
    }
    public function ObtenerInfoPropiedad($propiedad)
    {
        $this->db->reconnect();
        $result = $this->db->query("CALL `VistaPropiedad` (" .$propiedad .")");
        return $result->row(0);
    }
}
