<?php if (!defined('BASEPATH')) exit('No existe el directorio');

class reservas_model extends CI_Model
{
    public function __construct()
    {
        $this->load->model('dormitorio_model');
        $this->load->model('paquetes_model');
        $this->load->model('usuario_model');
        //require_once('dormitorio_model.php');
        parent::__construct();
    }

    public function ObtenerReservasRealizadas($idusr)
    {
        $result = $this->db->query("CALL `VistaReservasRealizadas` (" . $idusr . ")");
        return $result;
    }

    public function SubirReserva($idusuario, $fechaDeInicio, $fechaFinal, $precio, $codigo, $telefono)
    {
        $this->db->query("CALL `SubirReserva` (" . $idusuario . ", '" . $fechaDeInicio . "', '" . $fechaFinal . "', " . $precio . ")");
        $idReserva = $this->db->query("CALL `ObtenerIdReserva` (" . $idusuario . ")")->result_array();
        $this->db->close();
        $this->db->query("CALL `SubirTelefonoReserva` (" . $idReserva[count($idReserva) - 1]['id_reserva'] . ", " . $idusuario . ", " . $codigo . ", " . $telefono . ")");
        $this->db->close();
        return $idReserva[count($idReserva) - 1]['id_reserva'];
    }
    public function SubirResPaqDorm($idReserva, $idPaquete, $idDormitorio)
    {
        $this->db->query("CALL `SubirResPaqDorm` (" . $idReserva . ", " . $idPaquete . ", " . $idDormitorio . ")");
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

    public function DescripcionReserva($res, $prop,$usr)
    {

        $result['result'] = "";
        $dormitorio = $this->dormitorio_model->obtenerDormitorio($res['id_dormitorio']);
        $result['result'] = "";
        $result['result'] .= "Reservado en " . $prop['nombre_poblacion'] . "<br>";
        $result['result'] .= "Habitacion de " . $dormitorio->mtsCuadrado . "mts. Cuadrados" . "<br>";
        $camas = $this->dormitorio_model->obtenerCamas($dormitorio->id_dormitorio);
        $cantCamas =  $camas->num_rows();
        if ($cantCamas <= 1) {
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
        $fReserva = $res['fecha_reserva'];
        $hoy = strtotime(substr(date("Y-m-d"), 0, 10));
        $vencimiento = date("d-m-Y", strtotime($fReserva . "+3 day"));
        $vencimiento = strtotime(substr($vencimiento, 0, 10));
        $result['result'] .= "Entre " . date("d-m-Y", strtotime($fInicio)) . " y " . date("d-m-Y", strtotime($fFin))  . "<br>";
        
        if($hoy >= $vencimiento)
        {$result['result'] .= "<span style='color: #ff0000;'><b>Reservado el dia: " . date("d-m-Y", strtotime($fReserva))  . " !!!</b></span><br>"; }
        else
        {$result['result'] .= "Reservado el dia: " . date("d-m-Y", strtotime($fReserva))  . "<br>"; }
        
        
        $dif = strtotime($fFin) - strtotime($fInicio);
        $dias = $dif / (60 * 60 * 24);
        $this->db->close();
        $paquete = $this->paquetes_model->ObtenerPaquete($res['id_paquete']);

        $precio = $paquete->row(0)->precio * $dias;
        $result['result'] .= "Pesos arg: $" . $precio  . "<br>";

        $result['result'] .= $usr;
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


    public function ObtenerHistorialReservas($idusr)
    {
        $result = $this->db->query("CALL `VistaHistorialReservas` (" . $idusr . ")");
        return $result;
    }

    public function DescripcionPropietario($idUsr)
    {  
        $this->db->reconnect();
        $result['result'] = "<br>" ."Datos del Propietario : " . "<br>";
        $prop = $this->usuario_model->ObtenerUsuario($idUsr);

        $result['result'] .= "• Nombre: " .$prop->nombre   . "<br>";
        $result['result'] .= "• Apellido : " .$prop->apellido   . "<br>";
        $result['result'] .= "• Cuil : " .$prop->cuil   . "<br>";
        $result['result'] .= "• CBU : " .$prop->cbu   . "<br>";
        $result['result'] .= "• Telefono : " .$prop->telefono   . "<br>";
        return $result['result'];
    }

    public function DescripcionCliente($idUsr, $idres)
    {  
        $this->db->reconnect();
        $result['result'] = "<br>" ."Datos del Cliente : " . "<br>";
        $prop = $this->usuario_model->ObtenerUsuario($idUsr);
        $numero = $this->db->query('select * from reserva_usuario_telefono where id_reserva =' .$idres .' and id_usuario= ' .$idUsr);
        $numero = $numero->row(0);
        $result['result'] .= "• Nombre: " .$prop->nombre   . "<br>";
        $result['result'] .= "• Apellido : " .$prop->apellido   . "<br>";
        $result['result'] .= "• Cod. Area - Telefono : " .$numero->codigo_area ." - " .$numero->telefono  . "<br>";
        return $result['result'];
    }
}
