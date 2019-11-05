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
        $dato['misPropiedadesOpen'] = '';
        $dato['MisReservasOpen'] = '';
        $dato['minNoches'] = $paquete[0]['minNoches'];
        //$dato['fechasAlquiladas'] = $this->paquetes_model->ObtenerDiasReservados($dato['idPaquete']);
        $dato['diaFinalDeReserva'] = $this->paquetes_model->ObtenerDiaFinalDeReserva($dato['idPaquete']);
        $this->db->close();
        $prop = $this->usuario_model->PropiedadUsuario($dato['idPaquete']);
        //! hacer que cuando intente alquilar en fechas ya alquiladas tire error onClick
        //if (!($prop > 0)) {
        $this->db->close();
        $dato['formulario'] = "";
        if ($this->dormitorio_model->DisponibleCompleta($idPorpiedad)) {
            $dato['formulario'] = "<button class='btn btn-default ml-2' id='habitacion' onclick='ObtenerFechas(this)' name='0'> Propiedad Completa<br><i class='fas fa-home'></i></button>";
        }
        $this->db->close();
        $dormitorios = $this->dormitorio_model->ObtenerDormitorios($idPorpiedad)->result_array();
        $this->db->close();
        $i = 0;
        while (count($dormitorios) > $i) {
            $dato['lista'][$i] = $this->dormitorio_model->CantidadCamas($dormitorios[$i]['id_dormitorio']);
            $dato['formulario'] .=  "<button class='btn btn-default ml-2' id='habitacion' onclick='ObtenerFechas(this," . $i . ")' name='" . $dormitorios[$i]['id_dormitorio'] . "'> Dormitorio " . ($i + 1) . " <br><i class='fas fa-bed'></i></button>";
            $i++;
        }
        $dato['formulario'] .= "<div id='formularioReserva'>
        </div>";
        //} else {
        //    $dato['formulario'] = '<br><h1>Esta es tu propiedad.</h1>';
        //}
        $this->load->view('primera');
        $this->load->view('barranav', $_SESSION['alerta']);
        $this->load->view('barraizq', $dato);
        $this->load->view('verpaquete', $dato);
        $this->load->view('footeryscripspaquete');
    }
}
