<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dormitorios extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("paquetes_model");
        $this->load->model("dormitorio_model");
    }

    function index()
    {
        if ($_POST['seleccion'] != 1) {
            $formulario = '<form action="controlarreserva" id="enviar" method="post">
                <div class="form-inline py-2 mt-2">
                    <div class="input-group input-group">
                        <div class="input-group-prepend">
                            <span class="btn btn-dark">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input name="fechas" class="form-control" type="text" id="reservar" >
                    </div>
                </div>
                <div class="form-inline py-2">
                <input hidden="">
                    <div class="input-group input-group">
                        <div class="input-group-prepend">
                            <span class="btn btn-dark">
                                <i class="fas fa-phone"></i>
                            </span>
                        </div>
                        <input class="form-control" size="5" maxlength="4" type="telephone" id="area" name="ar" placeholder="Area (011)">
                    </div>
                    <div class="input-group input-group">
                        <input class="form-control" type="telephone" id="telefono" maxlength="7" name="tel" placeholder="Ingresa tu teléfono sin 15.">
                    </div>
                    </div>
                <div class="mt-2">
                    <button class="btn btn-primary btn-lg" onclick="ConsisitirForm()" type="button"><i class="fas fa-cart-plus fa-lg mr-2"></i> Reservar</button>
                </div>
            </form>';
            $precioDormitorio = $this->paquetes_model->PrecioPaquete($_POST['idPaquete']);
            $mensaje = "<ul class='py-2'>";
            if ($_POST['idDormitorio'][0] != '' && $_POST['idDormitorio'][0] == 0) {
                $fechas = $this->paquetes_model->ObtenerDiasReservados($_POST['idPaquete']);
                $mensaje .= '<li>';
                $cant = 0;
                foreach ($_POST['lista'] as $lista) {
                    $cant += intval($lista);
                }
                $mensaje .= 'Cantidad de personas: ' . $cant . '
            </li>
            <li>
            Precio por noche: $' . ($precioDormitorio * floatval($_POST['cantDormitorios'])) . '
            </li>';
            } else {
                $precioStr = '<li>
            Precio por noche: $';
                $precio = 0;
                if (isset($_POST['activas'])) {
                    $cantidad = "Cantidad de personas: ";
                    $total = 0;
                    $j = 0;
                    for ($i = 0; $i < count($_POST['activas']); $i++) {
                        if ($_POST['activas'][$i] != (-1)) {
                            $total += intval($_POST['lista'][$_POST['activas'][$i]]);
                            $precio += $precioDormitorio;
                        }
                    }
                    $precioStr .= $precio . '
                </li>';
                    $cantidad .= $total;
                    $fechas = '';
                    $result = $this->dormitorio_model->ObtenerDormitorios($_POST['idProp'])->result_array();
                    $this->db->close();
                    for ($i = 0; $i < count($_POST['idDormitorio']); $i++) {
                        if ($_POST['idDormitorio'][$i] != '') {
                            $fechas .= $this->paquetes_model->ObtenerDiasReservadosDormitorio($result[$i]['id_dormitorio']);
                        }
                    }
                } else {
                    $cantidad = "Seleccione lo que quiere alquilar.";
                    $precioStr = '';
                    $formulario = '';
                    $fechas = $this->paquetes_model->ObtenerDiasReservados($_POST['idPaquete']);
                }
                $mensaje .= '<li> 
                ' . $cantidad . $precioStr . '
                </li>
                ';
            }
            $mensaje .= '</ul>';
            $mensaje .= $formulario;
        } else {
            $mensaje = "Seleccione lo que quiere alquilar.";
            $fechas = '';
        }
        echo $mensaje . "~" . $fechas;
    }
}
