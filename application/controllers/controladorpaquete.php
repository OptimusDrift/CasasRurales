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
    }

    function index()
    {
        $this->load->view('manejoDeSesion');
        if (!isset($_GET['paquete'])) {
            redirect('paginaInicial');
        }

        $paquetes = $this->paquetes_model->ObtenerPaquete($_GET['paquete']);
        $paquete = $paquetes->result_array();
        $this->db->close();
        $propiedad = $this->propiedades_model->ObtenerPropiedad($paquete[0]['id_dormitorio']);
        $imagenes = $this->propiedades_model->ObtenerImagenesPropiedades($propiedad->id_propiedad);
        $dato['imagen'] = "<img src=\"" . base_url() . "assets/imagenes" . $imagenes[0] . ".jpg\" class=\"product-image\" alt=\"Product Image\"></div><div class=\"col-12 product-image-thumbs\">";
        $dato['servicios'] = "";
        $i = 0;
        $servicios = $this->propiedades_model->ObtenerServiciosPropiedad($propiedad->id_propiedad);
        while ($servicios->num_rows() > $i) {
            $dato['servicios'] .= '<label class="btn btn-default ml-2 ">
            ' . $servicios->row($i)->nombre_servicio . '<br>' . $servicios->row($i)->icon . '
        </label>';
            $i++;
        }

        for ($i = 0; $i < count($imagenes); $i++) {
            $dato['imagen'] .= "<div class=\"product-image-thumb\"><img onclick=\"cambiar(this)\" id=\"img" . $i . "\" name=\"" . $propiedad->id_propiedad . "\" src=\"" . base_url() . "assets/imagenes" . $imagenes[$i] . ".jpg\"class=\"product-image\" alt=\"Product Image\"></div>";
        }
        $infoPropiedad = $this->propiedades_model->ObtenerInfoPropiedad($propiedad->id_propiedad);
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
        $dato['fechasAlquiladas'] = $this->paquetes_model->ObtenerDiasReservados($_GET['paquete']);
        $dato['diaFinalDeReserva'] = $this->paquetes_model->ObtenerDiaFinalDeReserva($_GET['paquete']);
        $this->db->close();
        $prop = $this->usuario_model->PropiedadUsuario($_GET['paquete']);
        //! hacer que cuando intente alquilar en fechas ya alquiladas tire error onClick
        //!!!!!! Input de seleccion de habitacion y si esta disp complenta en las fechas
        if (!($prop > 0)) {
            $dato['formulario'] = '<form action="controlarreserva" method="post">
            <div class="form-inline py-2 mt-2">
                <div class="input-group input-group">
                    <div class="input-group-prepend">
                        <span class="btn btn-dark">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input class="form-control" type="text" id="reservar" name="fechas">
                </div>
                <input class="form-control" size="1" type="telephone" id="area" name="ar" placeholder="Area (011)" hidden="">
                <div class="input-group input-group ml-2">
                    <div class="input-group-prepend">
                        <span class="btn btn-dark">
                            <i class="fas fa-phone"></i>
                        </span>
                    </div>
                    <input class="form-control" size="5" maxlength="4" type="telephone" id="area" name="ar" placeholder="Area (011)">
                </div>
                <div class="input-group input-group">
                    <input class="form-control" type="telephone" id="telefono" name="tel" placeholder="Ingresa tu teléfono sin 15.">
                </div>
            </div>
            <div class="mt-2">
                <button class="btn btn-primary btn-lg" type="submit"><i class="fas fa-cart-plus fa-lg mr-2"></i> Reservar</button>
            </div>
        </form>';
        } else {
            $dato['formulario'] = '<br><h1>Esta es tu propiedad.</h1>';
        }
        $this->load->view('primera');
        $this->load->view('barranav', $_SESSION['alerta']);
        $this->load->view('barraizq', $dato);
        $this->load->view('verpaquete', $dato);
        $this->load->view('footeryscripspaquete');
    }
}
