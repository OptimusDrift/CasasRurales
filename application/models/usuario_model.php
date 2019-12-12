<?php if (!defined('BASEPATH')) exit('No existe el directorio');

class Usuario_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    private function VerificarRows($result)
    {
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return null;
        }
    }

    public function Login($correo, $contrasenna)
    {
        $result = $this->db->query("select * From usuario where correo = \"" . $correo . "\" and contrasenna = \"" . $contrasenna . "\" LIMIT 1");
        return $this->VerificarRows($result);
    }

    public function GetPropiedadesUsuario($idUsuario)
    {
        $result = $this->db->query("select * From propiedad where id_propietario =" . $idUsuario);
        return $this->VerificarRows($result);
    }
    public function PropiedadUsuario($idUsuario)
    {
        $result = $this->db->query("select * From propiedad where id_propietario =" . $idUsuario);
        return $result->num_rows();
    }

    public function ObtenerReservasRealizadas($idusr)
    {
        $result = $this->db->query("CALL `VistaReservasRealizadas` (" . $idusr . ")");
        return $result;
    }

    function ClearStoredResults()
    {
        global $mysqli;

        do {
            if ($res = $mysqli->store_result()) {
                $res->free();
            }
        } while ($mysqli->more_results() && $mysqli->next_result());
    }

    public function ObtenerUsuario($idusr)
    {
        $result = $this->db->query("select * From usuario where id_usuario = " . $idusr);
        return $result->row(0);
    }

    public function NuevoUsuario($correo, $cuil, $nombre, $apellido, $cbu, $contrasenna, $telefono, $codigo_registro)
    {
        try {
            $this->db->query("CALL AgregarUsuario('" . $correo . "', '" . $cuil . "', '" . $nombre . "', '" . $apellido . "', '" . $cbu . "', '" . $contrasenna . "', '" . $telefono . "', '" . $codigo_registro . "');");
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function ActivarUsuario($codigo)
    {
        $result = $this->db->query(" CALL `BuscarCodigo`('" . $codigo . "');");
        if ($result->num_rows() > 0) {
            $this->db->close();
            $this->db->query(" CALL `ActivarUsuario`('" . $codigo . "');");
            return true;
        }
        return false;
    }

    public function ActualizarCodigo($codigo, $correo)
    {
        $this->db->query(" CALL `ActualizarCodigo`('" . $codigo . "', '" . $correo . "');");
    }
}
