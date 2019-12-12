<script>
    function CambiarColor(campo, color, mensaje = "") {
        document.getElementById("errorCampos").innerHTML = mensaje;
        $("#" + campo).css({
            "border": "1px solid " + color
        });
    }

    function ConsisitirTexto(campo, mensaje) {
        if ($("#" + campo).val().length < 3) {
            CambiarColor(campo, 'red', mensaje);
            return false;
        }
        CambiarColor(campo, 'green');
        return true;
    }

    function ConsisitirNumero(campo, longitud, mensaje) {
        if ($("#" + campo).val().length != longitud) {
            CambiarColor(campo, 'red', mensaje);
            return false;
        }
        CambiarColor(campo, 'green');
        return true;
    }

    function ConsisitirCorreo(campoPrincipal, campo, mensaje) {
        var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
        if ($("#" + campoPrincipal).val().length < 3 || $("#" + campoPrincipal).val() != $("#" + campo).val() || !regex.test($("#" + campoPrincipal).val())) {
            CambiarColor(campoPrincipal, 'red');
            CambiarColor(campo, 'red', mensaje);
            return false;
        }
        CambiarColor(campoPrincipal, 'green');
        CambiarColor(campo, 'green');
        return true;
    }

    function ConsisitirContrasenna(campoPrincipal, campo, mensaje) {
        if ($("#" + campoPrincipal).val().length < 3 || $("#" + campoPrincipal).val() != $("#" + campo).val()) {
            CambiarColor(campoPrincipal, 'red');
            CambiarColor(campo, 'red', mensaje);
            return false;
        }
        CambiarColor(campoPrincipal, 'green');
        CambiarColor(campo, 'green');
        return true;
    }

    function Consistir() {
        document.getElementById("errorCampos").innerHTML = "mensaje";
        if (ConsisitirTexto('Nombre', 'Debe tener al menos 3 caracteres.') && ConsisitirTexto('Apellido', 'Debe tener al menos 3 caracteres.') && ConsisitirNumero('CBU', 22, 'Deben tener 22 números.') && ConsisitirNumero('CUIL', 11, 'Deben tener 11 números sin -.') && ConsisitirNumero('Tel', 10, 'Deben tener 10 números sin 0 ni 15.') && ConsisitirCorreo('Correo', 'Confirmar', 'Los correos deben ser iguales.') && ConsisitirContrasenna('Cont', 'Vuelva', 'Las contraseñas deben ser iguales y debe tener almenos 3 caracteres.')) {
            document.getElementById("regi").submit();
        }
    }
</script>