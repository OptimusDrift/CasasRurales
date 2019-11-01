<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controladorpaquete extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("paquetes_model");
        $this->load->model("propiedades_model");
    }

    function index()
    {
        if (!isset($_GET['paquete'])) {
            redirect('paginaInicial');
        }

        $paquete = $this->paquetes_model->ObtenerPaquete($_GET['paquete']);
        $propiedad = $this->propiedades_model->ObtenerPropiedad($paquete->id_dormitorio);
        $imagenes = $this->propiedades_model->ObtenerImagenesPropiedades($propiedad->id_propiedad);
        $dato['imagen'] = "<img src=\"" . base_url() . "assets/imagenes" . $imagenes[0] . ".jpg\" class=\"product-image\" alt=\"Product Image\"></div><div class=\"col-12 product-image-thumbs\">";

        for ($i = 0; $i < count($imagenes); $i++) {
            $dato['imagen'] .= "<div class=\"product-image-thumb active\"><img src=\"" . base_url() . "assets/imagenes" . $imagenes[$i] . ".jpg\"class=\"product-image\" alt=\"Product Image\"></div>";
        }

        $infoPropiedad = $this->propiedades_model->ObtenerInfoPropiedad($propiedad->id_propiedad);
        $dato['nombre'] = $infoPropiedad->nombre_propiedad;
        $dato['descripcion'] = $infoPropiedad->descripcion;
        $dato['precio'] = $paquete->precio;
        $dato['inicioactivo'] = '';
        $dato['misalquileresactivo'] = '';
        $dato['reservapendienteactivo'] = '';
        $dato['propiedadactivo'] = '';
        $dato['paqueteactivo'] = '';
        $dato['misreservaactivo'] = '';
        $dato['reservaactivo'] = '';
        $this->load->view('primera');
        $this->load->view('manejoDeSesion');
        $this->load->view('barranav');
        $this->load->view('barraizq', $dato);
        $this->load->view('verpaquete', $dato);
        $this->load->view('footeryscrips');
    }
}
