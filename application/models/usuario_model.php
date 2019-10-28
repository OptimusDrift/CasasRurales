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

    public function GetPropiedadesUsuario($idUsuario)
    {
        $result = $this->db->query("select * From propiedad where id_propietario =" . $idUsuario);
        if ($result->num_rows() > 0) {
            return $result;
        } else {
            return null;
        }
    }

    public function BuscarPaquetes($ubicacion, $fechas)
    {
        $result = $this->db->query("select * from paquete_dormitorio INNER JOIN dormitorio ON paquete_dormitorio.id_dormitorio = dormitorio.id_dormitorio INNER JOIN propiedad ON dormitorio.id_propiedad = propiedad.id_propiedad INNER JOIN poblacion ON propiedad.id_poblacion = poblacion.id_poblacion INNER JOIN rango_dias ON rango_dias.id_paquete = paquete_dormitorio.id_paquete INNER JOIN paquete ON paquete_dormitorio.id_paquete = paquete.id_paquete where poblacion.nombre_poblacion like \"%" . $ubicacion . "%\" and paquete.id_estado = 5");
        $i = 0;
        $j = 0;
        $fechaDeInicio = strtotime(substr($fechas, 0, 10));
        $fechaDeFin = strtotime(substr($fechas, 13, 23));
        $ant = null;
        $guardar = true;
        $casas = null;
        //? Revisa si es del mismo paquete
        while ($result->num_rows() > $i) {
            if ($ant != null) {
                if ($ant == $result->row($i)->id_paquete) {
                    $guardar = false;
                } else {
                    $guardar = true;
                }
            }
            //? Guarda todos los paquetes que esten dentro de las fechas ingresadas
            if ($guardar) {
                if (strtotime(date($result->row($i)->fecha_inicial)) <= $fechaDeInicio) {
                    if (strtotime(date($result->row($i)->fecha_final)) >= $fechaDeFin) {
                        $casas[$j] = $result->row($i);
                        $j++;
                    }
                }
            }
            //? Para consistir el paquete
            $ant = $result->row($i)->id_paquete;
            $i++;
        }
        return $casas;
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
