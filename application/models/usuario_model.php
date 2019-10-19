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
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return null;
        }
    }

    public function GetPropiedades($idUsuario)
    {
        $result = $this->db->query("select * From propiedad where id_propietario =" . $idUsuario);
        if ($result->num_rows() > 0) {
            return $result;
        } else {
            return null;
        }
    }
}
