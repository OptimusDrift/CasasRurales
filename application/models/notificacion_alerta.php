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
        $numAlertas =0;
        if ($alerta->num_rows() > 0)
        {
            $i = 0;
            
            while ($alerta->num_rows() > $i )
            {
                $fila = $alerta->row($i);
                //$hoy = 28/10/19 ;
                $hoy = strtotime(substr(date("Y-m-d"), 0, 10));


                //reserva = 20/10/19  ;
                $reserva = $fila->fecha_reserva;
                //vencimiento 3 dias depues de reserva
                $vencimiento = date("d-m-Y", strtotime($reserva . "+3 day"));
                $vencimiento = strtotime(substr($vencimiento, 0, 10));

                $reserva = strtotime(substr($reserva, 0, 10));
                if ($hoy >= $vencimiento) 
                {
                    $numAlertas++;
                }
                $i++;
            }


        }

        if ($numAlertas > 0) 
        {
            $datosAlerta['numAlertas'] = $numAlertas;
            $datosAlerta['tipoAlerta'] = "alertas de falta de pago";
            $datosAlerta['notiAlerta'] = '<a href="reservaspendientes" class="dropdown-item">
            <i class="fas fa-file mr-2"></i>' .$numAlertas .' Nuevas alertas de Falta de Pago' 
            .'<span class="float-right text-muted text-sm"></span>
          </a>' ;
        }
         else 
         {
            $datosAlerta['numAlertas'] = '0';
            $datosAlerta['tipoAlerta'] = '';
            $datosAlerta['notiAlerta'] = '';
        }
        return $datosAlerta;
    }

    function eliminarAlerta(){
        $datosAlerta['numAlertas'] = '0';
        $datosAlerta['tipoAlerta'] = '';
        $datosAlerta['notiAlerta'] = '';
    return $datosAlerta;

    }
}
