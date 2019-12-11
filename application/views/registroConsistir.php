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
</script>