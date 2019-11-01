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
        for ($i = 0; $i < count($paquete); $i++) {
            //? Guarda todos los paquetes que esten dentro de las fechas ingresadas
            if (strtotime(date($paquete[$i]['fecha_inicial'])) <= $fechaDeInicio) {
                if (strtotime(date($paquete[$i]['fecha_final'])) >= $fechaDeFin) {
                    $resultFechas = $this->db->query("CALL `FechasDeReserva` (" . $paquete[$i]['id_paquete'] . ")");
                    if ($resultFechas->num_rows() > 0) {
                        for ($j = 0; $j < $resultFechas->num_rows(); $j++) {
                            if (strtotime(date($resultFechas->row($j)->fecha_final_reserva)) < $fechaDeInicio) {
                                $result[$fila] = $paquete[$i];
                                $fila++;
                            }
                        }
                    } else {
                        $result[$fila] = $paquete[$i];
                        $fila++;
                    }
                }
                $this->db->close();
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
            }
        }
        return $result;
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
        $fechaDeInicio = strtotime(substr($fechas, 0, 10));
        $fechaDeFin = strtotime(substr($fechas, 13, 23));
        //? Consisto las fechas
        $paquete = $this->ConsisitirFechas($paquete, $fechaDeInicio, $fechaDeFin);
        if ($paquete == null) return null;
        //? Elimino las filas que no se usan
        $paquete = $this->EliminarPaquetesRepetidos($paquete);
        return $paquete;
    }

    public function BuscarTodosLosPaquetes()
    {
        $i = 0;
        $j = 0;
        $guardar = true;
        $ant = null;
        $result = $this->db->query("select * from paquete_dormitorio INNER JOIN dormitorio ON paquete_dormitorio.id_dormitorio = dormitorio.id_dormitorio INNER JOIN propiedad ON dormitorio.id_propiedad = propiedad.id_propiedad INNER JOIN poblacion ON propiedad.id_poblacion = poblacion.id_poblacion INNER JOIN rango_dias ON rango_dias.id_paquete = paquete_dormitorio.id_paquete INNER JOIN paquete ON paquete_dormitorio.id_paquete = paquete.id_paquete where paquete.id_estado = 5");
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

    //? Busca la imagen de portada de la propiedad
    public function ObtenerImagenPortada($idPropiedad)
    {
        $result = $this->db->query("SELECT link FROM imagen_propiedad WHERE id_propiedad = " . $idPropiedad);
        return $result->row(0)->link;
    }


    public function ObtenerReservasRealizadas($idusr)
    {
        $result = $this->db->query("CALL `VistaReservasRealizadas` (" . $idusr . ")");
        return $result;
    }
}
