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
        $result = $this->db->query("SELECT link FROM imagen_propiedad WHERE id_propiedad = " . $idPropiedad);

        if ($result->num_rows() > 0) {
            for ($i = 0; $i < $result->num_rows(); $i++) {
                $adress[$i] = $result->row($i)->link;
            }
        }
        return $adress;
    }
}
