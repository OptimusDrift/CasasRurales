<?php if (!defined('BASEPATH')) exit('No existe el directorio');

class reservas_model extends CI_Model
{
    public function __construct()
    {
        $this->load->model('dormitorio_model');
        $this->load->model('paquetes_model');
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

        $result['result'] = "";
        $dormitorio = $this->dormitorio_model->obtenerDormitorio($res['id_dormitorio']);
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
        $fInicio = $res['fecha_inicial_reserva'];
        $fFin = $res['fecha_final_reserva'];
        $result['result'] .= "Entre " . date("d-m-Y", strtotime($fInicio)) . " y " . date("d-m-Y", strtotime($fFin))  . "<br>";
        $dif = strtotime($fFin) - strtotime($fInicio);
        $dias = $dif / (60 * 60 * 24);
        $this->db->close();
        $paquete = $this->paquetes_model->ObtenerPaquete($res['id_paquete']);
        $precio = $paquete->row(0)->precio * $dias;
        $result['result'] .= "Pesos arg: $" . $precio  . "<br>";
        return $result['result'];
    }

    public function cancelarReserva($idRes)
    {
        $this->db->query("CALL `CancelarReserva` (" . $idRes . ")");
        return true;
    }

    public function ObtenerImagenesComprobante($idReserva)
    {
        $result = $this->db->query("CALL `ObtenerImagenesReserva` (\"" . $idReserva . "\")");
        return $result;
    }

    public function SubirImagenReserva($idReserva, $link)
    {
        if ($this->ObtenerImagenesComprobante($idReserva)->num_rows() > 0) {
            $this->db->close();
            return false;
        }
        $this->db->close();
        $this->db->query("CALL `AltaImagenReserva` (\"" . $idReserva . "\",\"" . $link . "\")");
        return true;
    }

    public function PagarReserva($idReserva)
    {
        $this->db->query("CALL `PagarReserva` (\"" . $idReserva . "\")");
    }
    public function ReservaPagada($idReserva)
    {
        $result = $this->db->query("CALL `ReservaPagada` (\"" . $idReserva . "\")");
        if ($result->num_rows() > 0) {
            if ($result->row(0)->estado_pago  == 0) {
                $this->db->close();
                return true;
            }
        }
        $this->db->close();
        return false;
    }
    public function ReservaCancelada($idReserva)
    {
        $result = $this->db->query("CALL `ReservaCancelada` (\"" . $idReserva . "\")");
        if ($result->num_rows() > 0) {
            if ($result->row(0)->estado_reserva  == 0) {
                $this->db->close();
                return true;
            }
        }
        $this->db->close();
        return false;
    }
}
