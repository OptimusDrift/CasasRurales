<?php if (!defined('BASEPATH')) exit('No existe el directorio');

class Paquetes_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    private function EliminarPaquetesRepetidos($paquetes, $nroPersonas = null)
    {
        $p = 0;
        $ant = null;
        $result = null;
        //? Revisa si es del mismo paquete
        for ($i = 0; $i < count($paquetes); $i++) {
            if ($ant != null) {
                if ($ant != $paquetes[$i]['id_paquete']) {
                    $result[$p] = $paquetes[$i];
                    if ($nroPersonas != null) {
                        $numeroPersonas[$p] = $nroPersonas[$i];
                    }
                    $p++;
                }
            } else {
                $result[$p] = $paquetes[$i];
                if ($nroPersonas != null) {
                    $numeroPersonas[$p] = $nroPersonas[$i];
                }
                $p++;
            }
            //? Guarda el anterior
            $ant = $paquetes[$i]['id_paquete'];
        }
        if (isset($numeroPersonas)) {
            $result['nroPersonas'] = $numeroPersonas;
        }
        return $result;
    }
    private function CalcularCantidadpersonas($paquete)
    {
        $numeroPersonas = null;
        $nropaquete = 0;
        $ant = null;
        for ($i = 0; $i < count($paquete); $i++) {
            $resultCama = $this->db->query("CALL `ContadorDePersonasPorCama` (" . $paquete[$i]['id_cama'] . ")");
            if ($ant == $paquete[$i]['id_paquete']) {
                $numeroPersonas[$nropaquete] += ($resultCama->row(0)->num_plazas * $paquete[$i]['cant_camas']);
            } else {
                if ($ant != null) {
                    $nropaquete++;
                }
                $numeroPersonas[$nropaquete] = ($resultCama->row(0)->num_plazas * $paquete[$i]['cant_camas']);
            }
            //? Guarda el anterior
            $ant = $paquete[$i]['id_paquete'];
            $this->db->close();
        }
        return $numeroPersonas;
    }
    private function ConsisitirFechas($paquete, $fechaDeInicio, $fechaDeFin, $numeroPersonas)
    {
        $fila = 0;
        $result = null;
        $dateIn = new DateTime($fechaDeInicio);
        $dateFn = new DateTime($fechaDeFin);
        $diff = $dateIn->diff($dateFn);
        $dateIn = strtotime($fechaDeInicio);
        $dateFn = strtotime($fechaDeFin);
        for ($i = 0; $i < count($paquete); $i++) {
            //? Guarda todos los paquetes que esten dentro de las fechas ingresadas
            if ($diff->days >= $paquete[$i]['minNoches']) {
                if (strtotime(date($paquete[$i]['fecha_inicial'])) <= $dateIn) {
                    if (strtotime(date($paquete[$i]['fecha_final'])) >= $dateFn) {
                        $resultFechas = $this->FechasReserva($paquete[$i]['id_paquete']);
                        if ($resultFechas->num_rows() > 0) {
                            for ($j = 0; $j < $resultFechas->num_rows(); $j++) {
                                if (strtotime(date($resultFechas->row($j)->fecha_final_reserva)) < $dateIn) {
                                    $result[$fila] = $paquete[$i];
                                    $nroPe[$fila] = $numeroPersonas[$i];
                                    $fila++;
                                }
                            }
                        } else {
                            $this->db->close();
                            $estado = $this->db->query("CALL `EstadoReserva` (" . $paquete[$i]['id_paquete'] . ")");
                            if (!($estado->num_rows > 0)) {
                                $result[$fila] = $paquete[$i];
                                $nroPe[$fila] = $numeroPersonas[$i];
                                $fila++;
                            }
                        }
                    }
                    $this->db->close();
                }
            }
        }
        if (isset($nroPe)) {
            $result['nroPersonas'] = $nroPe;
        }
        return $result;
    }
    private function ConsisitirPersonas($paquete, $nroPersonas, $cantidadPersonasIngresadas)
    {
        $j = 0;
        $result = null;
        for ($i = 0; $i < count($nroPersonas); $i++) {
            if ($nroPersonas[$i] >= $cantidadPersonasIngresadas) {
                $result[$j] = $paquete[$i];
                $p[$j] = $nroPersonas[$i];
                $j++;
            }
        }
        if (isset($p)) {
            $result['nroPersonas'] = $p;
        } else {
            return null;
        }

        return $result;
    }
    public function FormatearFecha($fechaAModificar, $sim = '/')
    {
        $dia = preg_split('[/]', $fechaAModificar)[0];
        $mes = preg_split('[/]', $fechaAModificar)[1];
        $anno = preg_split('[/]', $fechaAModificar)[2];
        $fechaAModificar = $mes . $sim . $dia . $sim . $anno;
        return str_replace(" ", "", $fechaAModificar);
    }
    public function FormatearFechaBDD($fechaAModificar, $sim = '-')
    {
        $dia = preg_split('[/]', $fechaAModificar)[0];
        $mes = preg_split('[/]', $fechaAModificar)[1];
        $anno = preg_split('[/]', $fechaAModificar)[2];
        $fechaAModificar = $anno . $sim . $mes . $sim . $dia;
        return str_replace(" ", "", $fechaAModificar);
    }
    public function BuscarPaquetes($ubicacion, $fechas, $cantidadPersonasIngresadas = 1)
    {
        //? Busco todos los paquetes
        $result = $this->db->query("CALL `BuscarPaquetes` (\"" . $ubicacion . "\")");
        //? Los paso a arreglo
        $paquete = $result->result_array();
        $this->db->close();
        //? Pido la cantidad de personas
        $numeroPersonas = $this->CalcularCantidadpersonas($paquete);
        //? Elimino las filas que no se usan
        $paquete = $this->EliminarPaquetesRepetidos($paquete);
        if ($paquete == null) return null;
        //? Consisto la cantidad de personas
        $paquete = $this->ConsisitirPersonas($paquete, $numeroPersonas, $cantidadPersonasIngresadas);
        if ($paquete == null) return null;
        $res['numeroPersonas'] = $paquete['nroPersonas'];
        unset($paquete['nroPersonas']);
        //?Fechas ingresadas por el usuario
        $fechaDeInicio = $this->FormatearFecha($fechaDeInicio = preg_split('[-]', $fechas)[0]);
        $fechaDeFin = $this->FormatearFecha($fechaDeFin = preg_split('[-]', $fechas)[1]);
        //? Consisto las fechas
        $paquete = $this->ConsisitirFechas($paquete, $fechaDeInicio, $fechaDeFin, $res['numeroPersonas']);
        $res['numeroPersonas'] = $paquete['nroPersonas'];
        unset($paquete['nroPersonas']);
        if ($paquete == null) return null;
        //? Elimino las filas que no se usan
        $paquete = $this->EliminarPaquetesRepetidos($paquete, $res['numeroPersonas']);
        $res['numeroPersonas'] = $paquete['nroPersonas'];
        unset($paquete['nroPersonas']);
        $res['paquete'] = $paquete;
        return $res;
    }

    public function BuscarTodosLosPaquetes()
    {
        $i = 0;
        $j = 0;
        $guardar = true;
        $ant = null;
        $result = $this->db->query("CALL `ObtenerTodosLosPaquetes` ()");
        while ($result->num_rows() > $i) {
            if ($ant != null) {
                if ($ant == $result->row($i)->id_paquete) {
                    $guardar = false;
                } else {
                    $guardar = true;
                }
            }
            if ($guardar) {
                if (strtotime(date($result->row($i)->fecha_inicial)) <= strtotime(date("Y/m/d"))) {
                    $casas[$j] = $result->row($i);
                    $j++;
                }
            }
            $ant = $result->row($i)->id_paquete;
            $i++;
        }
        return $casas;
    }

    public function ObtenerIdPaquetePropiedad($propiedad)
    {
        $result = $this->db->query("CALL `ObtenerIdPaquetePropiedad` (" . $propiedad . ")");
        return $result;
    }

    public function ObtenerPaquete($paquete)
    {
        $result = $this->db->query("CALL `ObtenerPaquete` (" . $paquete . ")");
        return $result;
    }

    public function ObtenerPaquetesDePropietario($idusr)
    {
        $result = $this->db->query("CALL `VistaPaquetesDeUsuario` (" . $idusr . ")");
        return $result;
    }

    public function DescripcionPaquete($res, $prop)
    {

        $result['result'] = "";
        $dormitorio = $this->dormitorio_model->obtenerDormitorio($res['id_dormitorio']);
        $result['result'] = "";
        $result['result'] .= "Ubicado en " . $prop['nombre_poblacion'] . "<br>";
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

        $precio = $res['precio'];
        $result['result'] .= "Pesos arg: $" . $precio . ' por Noche' . "<br>";
        return $result['result'];
    }

    private function FechasReserva($idPaquete)
    {
        $resultFechas = $this->db->query("CALL `FechasDeReserva` (" . $idPaquete . ")");
        return $resultFechas;
    }

    public function ObtenerDiasReservados($idPaquete)
    {
        $result = $this->FechasReserva($idPaquete);
        $i = 0;
        $j = 0;
        $dias = '';
        while ($result->num_rows() > $i) {
            $dateIn = new DateTime($result->row($i)->fecha_inicial_reserva);
            $dateFn = new DateTime($result->row($i)->fecha_final_reserva);
            $diff = $dateIn->diff($dateFn);
            $diff->days;
            $k = 0;
            while ($diff->days >= $k) {
                $dias .= "" . $dateIn->format('Y-m-d') . ",";
                $dateIn->modify('+1 day');
                $j++;
                $k++;
            }
            $i++;
        }
        $dias .= "";
        $this->db->close();
        return $dias;
    }
    public function CalcularPrecioFechas($fechas, $precio)
    {
        $FI = $this->FormatearFecha(preg_split('[-]', $fechas)[0]);
        $FF = $this->FormatearFecha(preg_split('[-]', $fechas)[1]);
        $FI = new DateTime($FI);
        $FF = new DateTime($FF);
        $diff = $FI->diff($FF);
        return ($diff->days * ($precio));
    }
    public function ObtenerDiasReservadosDormitorio($idDormitorio)
    {
        $result = $this->db->query("CALL `FechasDeReservaDormitorio` (" . $idDormitorio . ")");
        $i = 0;
        $j = 0;
        $dias = '';
        while ($result->num_rows() > $i) {
            $dateIn = new DateTime($result->row($i)->fecha_inicial_reserva);
            $dateFn = new DateTime($result->row($i)->fecha_final_reserva);
            $diff = $dateIn->diff($dateFn);
            $diff->days;
            $k = 0;
            while ($diff->days >= $k) {
                $dias .= "" . $dateIn->format('Y-m-d') . ",";
                $dateIn->modify('+1 day');
                $j++;
                $k++;
            }
            $i++;
        }
        $dias .= "";
        $this->db->close();
        return $dias;
    }

    public function ObtenerDiaFinalDeReserva($idPaquete)
    {
        $fecha = new DateTime($this->db->query("CALL `FechaFinalDeReservaPaquete` (" . $idPaquete . ")")->row(0)->fecha_final);
        return $fecha->format('d/m/Y');
    }
    public function PrecioPaquete($idPaquete)
    {
        $precio = $this->db->query("CALL `PrecioPaquete` (" . $idPaquete . ")")->result_array();
        $this->db->close();
        return floatval($precio[0]['precio']);
    }
}
