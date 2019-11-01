<?php if (!defined('BASEPATH')) exit('No existe el directorio');

class notificacion_alerta extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function Alerta()
    {
        //$this->load->view('manejoDeSesion');
        $this->load->model('reservas_model');
        $alerta = $this->reservas_model->Alerta($_SESSION['id']);
        $fila = $alerta->row(0);
        //$hoy = 28/10/19 ;
        $hoy = strtotime(substr(date("Y-m-d"), 0, 10));


        //reserva = 20/10/19  ;
        $reserva = $fila->fecha_reserva;
        //vencimiento 3 dias depues de reserva
        $vencimiento = date("d-m-Y", strtotime($reserva . "+3 day"));
        $vencimiento = strtotime(substr($vencimiento, 0, 10));

        $reserva = strtotime(substr($reserva, 0, 10));


        if ($hoy >= $vencimiento) {
            $datosAlerta['numAlertas'] = $alerta->num_rows();
            $datosAlerta['tipoAlerta'] = "alertas de falta de pago";
        } else {
            $datosAlerta['numAlertas'] = '';
            $datosAlerta['tipoAlerta'] = '';;
        }
        return $datosAlerta;
    }
}
