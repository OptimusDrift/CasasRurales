<?php if (!defined('BASEPATH')) exit('No existe el directorio');

class reservas_model extends CI_Model
{
    public function __construct()
    {
        $this->load->model('dormitorio_model');
        //require_once('dormitorio_model.php');
        parent::__construct();
    }




    public function ObtenerReservasRealizadas($idusr)
    {
        $result = $this->db->query("CALL `VistaReservasRealizadas` (" . $idusr . ")");
        return $result;
    }


    public function ObtenerReservasPendientes($idusr)
    {
        $result = $this->db->query("CALL `VistaReservasPendientes` (" . $idusr . ")");
        return $result;
    }

    public function ObtenerImagenReserva($idPropiedad)
    {
        $result = $this->db->query("SELECT link FROM imagen_propiedad WHERE id_propiedad = " . $idPropiedad);
        return $result->row(0)->link;
    }


    public function Alerta($idusr)
    {
        $result = $this->db->query("CALL `AletarUsuario` (" . $idusr . ")");
        return $result;
    }

    public function DescripcionReserva($res, $prop)
    {
        $this->db->reconnect();
        $result['result'] = "";

        $dormitorio = $this->dormitorio_model->obtenerDormitorio($res->id_dormitorio);
        $result['result'] = "";

        $result['result'] .= "Reservado en " . $prop->nombre_poblacion . "<br>";

        $result['result'] .= "Habitacion de " . $dormitorio->mtsCuadrado . "mts. Cuadrados" . "<br>";

        $camas = $this->dormitorio_model->obtenerCamas($dormitorio->id_dormitorio);

        $cantCamas =  $camas->num_rows();

        if ($cantCamas < 2) {
            $result['result'] .= "Posee una cama tipo " . $camas->row(0)->tipo_cama  . "<br>";
        } else {

            $result['result'] .= "Posee " . $cantCamas . " camas:"  . "<br>";
            $i = 0;
            while ($camas->num_rows() > $i) {
                $result['result'] .= "• " . $camas->row($i)->cant_camas . " cama tipo " . $camas->row($i)->tipo_cama . "<br>";
                $i++;
            }
        }



        return $result['result'];
    }
}
