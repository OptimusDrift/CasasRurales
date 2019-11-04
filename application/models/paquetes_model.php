<?php if (!defined('BASEPATH')) exit('No existe el directorio');

class Paquetes_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    private function EliminarPaquetesRepetidos($paquetes)
    {
        $p = 0;
        $ant = null;
        $result = null;
        //? Revisa si es del mismo paquete
        for ($i = 0; $i < count($paquetes); $i++) {
            if ($ant != null) {
                if ($ant != $paquetes[$i]['id_paquete']) {
                    $result[$p] = $paquetes[$i];
                    $p++;
                }
            } else {
                $result[$p] = $paquetes[$i];
                $p++;
            }
            //? Guarda el anterior
            $ant = $paquetes[$i]['id_paquete'];
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
    private function ConsisitirFechas($paquete, $fechaDeInicio, $fechaDeFin)
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
                        $resultFechas = $this->db->query("CALL `FechasDeReserva` (" . $paquete[$i]['id_paquete'] . ")");
                        if ($resultFechas->num_rows() > 0) {
                            for ($j = 0; $j < $resultFechas->num_rows(); $j++) {
                                if (strtotime(date($resultFechas->row($j)->fecha_final_reserva)) < $dateIn) {
                                    $result[$fila] = $paquete[$i];
                                    $fila++;
                                }
                            }
                        } else {
                            $this->db->close();
                            $estado = $this->db->query("CALL `EstadoReserva` (" . $paquete[$i]['id_paquete'] . ")");
                            if (!($estado->num_rows > 0)) {
                                $result[$fila] = $paquete[$i];
                                $fila++;
                            }
                        }
                    }
                    $this->db->close();
                }
            }
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
                $j++;
            } else {
                for ($j = $i; $j < count($nroPersonas) - 1; $j++) {
                    $nroPersonas[$j] = $nroPersonas[$i + 1];
                }
                unset($nroPersonas[count($nroPersonas) - 1]);
            }
        }
        return $result;
    }
    private function FormatearFecha($fechaAModificar)
    {

        $dia = preg_split('[/]', $fechaAModificar)[0];
        $mes = preg_split('[/]', $fechaAModificar)[1];
        $anno = preg_split('[/]', $fechaAModificar)[2];
        $fechaAModificar = $mes . "/" . $dia . "/" . $anno;
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
        //?Fechas ingresadas por el usuario
        $fechaDeInicio = $this->FormatearFecha($fechaDeInicio = preg_split('[-]', $fechas)[0]);
        $fechaDeFin = $this->FormatearFecha($fechaDeFin = preg_split('[-]', $fechas)[1]);
        //? Consisto las fechas
        $paquete = $this->ConsisitirFechas($paquete, $fechaDeInicio, $fechaDeFin);
        if ($paquete == null) return null;
        //? Elimino las filas que no se usan
        $paquete = $this->EliminarPaquetesRepetidos($paquete);
        $res['paquete'] = $paquete;
        $res['numeroPersonas'] = $numeroPersonas;
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
        $result['result'] .= "Ubicado en " . $prop->nombre_poblacion . "<br>";
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
        $result['result'] .= "Pesos arg: $" . $precio .' por Noche' . "<br>";
        return $result['result'];
    }
}
