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
        $result = $this->db->query("CALL `VistaCamasDormitorio` (" . $idor . ")");
        return $result;
    }

    public function obtenerDormitorio($idor)
    {
        $this->db->reconnect();
        $result = $this->db->query("CALL `VistaDormitorio` (" . $idor . ")");
        return $result->row(0);
    }

    public function ObtenerDormitorios($idPropiedad)
    {
        $result = $this->db->query("CALL `ObtenerDormitorios` (" . $idPropiedad . ")");
        return $result;
    }
    public function ObtenerDuenno($idDormitorio)
    {
        $result = $this->db->query("CALL `ObtenerDuenno` (" . $idDormitorio . ")")->result_array();
        $this->db->close();
        return $result[0];
    }
    public function DisponibleCompleta($idPropiedad)
    {
        $result = $this->db->query("CALL `DisponibleCompleta` (" . $idPropiedad . ")")->result_array();
        $this->db->close();
        if ($result[0]['disponibleCompleta'] == 1) {
            return true;
        }
        return false;
    }

    private function CalcularCantidadpersonas($camas)
    {
        $numeroPersonas = null;
        for ($i = 0; $i < count($camas); $i++) {
            $resultCama = $this->db->query("CALL `ContadorDePersonasPorCama` (" . $camas[$i]['id_cama'] . ")");
            $numeroPersonas += ($resultCama->row(0)->num_plazas * $camas[$i]['cant_camas']);
            $this->db->close();
        }
        return $numeroPersonas;
    }

    public function CantidadCamas($idDormitorio)
    {
        $camas = $this->db->query("CALL `CantidadCamas` (" . $idDormitorio . ")")->result_array();
        $this->db->close();
        return $this->CalcularCantidadpersonas($camas);
    }
}
