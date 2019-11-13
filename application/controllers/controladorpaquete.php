<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controladorpaquete extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("paquetes_model");
        $this->load->model("propiedades_model");
        $this->load->model("usuario_model");
        $this->load->model("dormitorio_model");
    }

    function index()
    {
        $this->load->view('manejoDeSesion');
        $dato['idPaquete'] = $_GET['paquete'];
        if (!isset($dato['idPaquete'])) {
            redirect('paginaInicial');
        }

        $paquetes = $this->paquetes_model->ObtenerPaquete($dato['idPaquete']);
        $paquete = $paquetes->result_array();
        $this->db->close();
        $propiedad = $this->propiedades_model->ObtenerPropiedad($paquete[0]['id_dormitorio']);
        $idPorpiedad = $propiedad->id_propiedad;
        $imagenes = $this->propiedades_model->ObtenerImagenesPropiedades($idPorpiedad);
        $dato['imagen'] = "<img src=\"" . base_url() . "assets/imagenes" . $imagenes[0] . ".jpg\" class=\"product-image\" alt=\"Product Image\"></div><div class=\"col-12 product-image-thumbs\">";
        $dato['servicios'] = "";
        $i = 0;
        $servicios = $this->propiedades_model->ObtenerServiciosPropiedad($idPorpiedad);
        while ($servicios->num_rows() > $i) {
            $dato['servicios'] .= '<label class="btn btn-default ml-2 ">
            ' . $servicios->row($i)->nombre_servicio . '<br>' . $servicios->row($i)->icon . '
        </label>';
            $i++;
        }

        for ($i = 0; $i < count($imagenes); $i++) {
            $dato['imagen'] .= "<div class=\"product-image-thumb\"><img onclick=\"cambiar(this)\" id=\"img" . $i . "\" name=\"" . $idPorpiedad . "\" src=\"" . base_url() . "assets/imagenes" . $imagenes[$i] . ".jpg\"class=\"product-image\" alt=\"Product Image\"></div>";
        }


        $infoPropiedad = $this->propiedades_model->ObtenerInfoPropiedad($idPorpiedad);
        $dato['nombre'] = $infoPropiedad->nombre_propiedad;
        $dato['descripcion'] = $infoPropiedad->descripcion;
        $this->db->close();
        $dato['precio'] = $paquete[0]['precio'];
        $dato['inicioactivo'] = '';
        $dato['misalquileresactivo'] = '';
        $dato['reservapendienteactivo'] = '';
        $dato['propiedadactivo'] = '';
        $dato['paqueteactivo'] = '';
        $dato['misreservaactivo'] = '';
        $dato['reservaactivo'] = '';
        $dato['historialactivo'] = '';
        $dato['misPropiedadesOpen'] = '';
        $dato['idUsuario'] = $_SESSION['id'];
        $dato['MisReservasOpen'] = '';
        $dato['minNoches'] = $paquete[0]['minNoches'];
        $dato['idPropiedad'] = $idPorpiedad;
        //$dato['fechasAlquiladas'] = $this->paquetes_model->ObtenerDiasReservados($dato['idPaquete']);
        $dato['diaFinalDeReserva'] = $this->paquetes_model->ObtenerDiaFinalDeReserva($dato['idPaquete']);
        $this->db->close();
        $prop = $this->usuario_model->PropiedadUsuario($dato['idPaquete']);
        //! hacer que cuando intente alquilar en fechas ya alquiladas tire error onClick
        if (!($_SESSION['id'] == $infoPropiedad->id_propietario)) {
            $this->db->close();
            $dato['formulario'] = "";
            $dormitorios = $this->dormitorio_model->ObtenerDormitorios($idPorpiedad)->result_array();
            $this->db->close();
            if ($this->dormitorio_model->DisponibleCompleta($idPorpiedad)) {
                $dispCompleta = '';
            } else {
                $dispCompleta = 'hidden=""';
            }
            $dato['formulario'] = "<label " . $dispCompleta . "class='btn btn-secondary ml-2 active'><input type='checkbox' autocomplete='off' class='ml-2' id='completa' onclick='ObtenerFechas(this)' name='0' value='completa," . count($dormitorios) . "'> Propiedad Completa<br><i class='fas fa-home'></i></label>";
            $i = 0;
            while (count($dormitorios) > $i) {
                $dato['lista'][$i] = $this->dormitorio_model->CantidadCamas($dormitorios[$i]['id_dormitorio']);
                $dato['formulario'] .=  "<label class='btn btn-secondary ml-2 active'><input type='checkbox' id='dormitorio" . $i . "' onclick='ObtenerFechas(this," . $i . ")' name='" . $dormitorios[$i]['id_dormitorio'] . "' value='dormitorio," . count($dormitorios) . "' > Dormitorio " . ($i + 1) . " <br><i class='fas fa-bed'></i></label>";
                $i++;
            }
            $dato['formulario'] .= "<div id='formularioReserva'>Seleccione lo que quiere alquilar.
        </div>";
            $foot = 'footeryscripspaquete';
        } else {
            $dato['formulario'] = '<br><h1>Esta es tu propiedad.</h1>';
            $foot = 'footeryscrips';
        }
        $this->load->view('primera');
        $this->load->view('barranav', $_SESSION['alerta']);
        $this->load->view('barraizq', $dato);
        $this->load->view('verpaquete', $dato);
        $this->load->view($foot);
    }
}
