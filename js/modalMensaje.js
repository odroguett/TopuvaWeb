const Titulo_alerta = "01";
const Titulo_error = "02";
const Titulo_exito = "03";
const Titulo_informacion = "04";
const Constante_alerta = "warning";
const Constante_error = "danger";
const Constante_exito = "success";
const Constante_info = "info";
const Constante_informacion = "info";
const Constante_icono_alerta = "fa fa-warning";
const Constante_icono_info = "fa fa-info";
const Constante_icono_error = "fa fa-remove";
const Constante_icono_exito = "fa fa-check";

function Modal_class() {

    this.MensajePersonalizado = function (titulo, mensaje, TipoAlert) {
        var icono = "";
        var vUsuario = null;
        try {
            vUsuario = nombreUsuario;
        } catch (e) {
            vUsuario = "";
        }
      
        switch (TipoAlert) {
            case Constante_alerta:
                icono = Constante_icono_alerta;
                break;
            case Constante_error:
                icono = Constante_icono_error;
                break;
            case Constante_exito:
                icono = Constante_icono_exito;
                break;
            case Constante_informacion:
                icono = Constante_icono_info;
                break;
        }
        switch (titulo) {
            case Titulo_alerta:
                titulo = "Alerta";
                break;
            case Titulo_error:
                titulo = "Error";
                break;
            case Titulo_exito:
                titulo = "Éxito";
                break;
            case Titulo_informacion:
                titulo = "Información";
                break;
            default:
                titulo = titulo;
                break;
        }
        $('#TituloModal').html("<button class='btn btn-" + TipoAlert + " btn-circle' disabled style='pointer-events: none;'><i class='" + icono + " icon-3x'></i></button> " + titulo);
        $('#CuerpoModal').html("<p>Estimad@ " + vUsuario + "</p><p class='text-center'>" + mensaje + "</p>");
        $("#MensajePersonalizado").modal("show");
      };

      this.confirmacion = function (titulo, mensaje, callback) {
       

        callback = oModal.onlyAllowOneCall(callback);
        $("#tituloConfirmacion").html("<h6 class=text-info'>" + titulo + "</h6>");
        $("#mensajeConfirmacion").html("<p class='text-semibold text-center'>" + mensaje + "</p>");
        $("#btnConfirmacionOK").on("click", function () {
            $("#modalConfirmacion").modal('hide');
            callback(true);
        });
        $("#btnConfirmacionCANCEL").on("click", function () {
            $("#modalConfirmacion").modal('hide');
            callback(false);
        });
        $("#modalConfirmacion").modal('show');
    };

      this.onlyAllowOneCall = function (fn) {
        var hasBeenCalled = false;
        return function () {
            if (hasBeenCalled) {
                return null;
            }
            hasBeenCalled = true;
            return fn.apply(this, arguments);
        };
    };
}
var oModal = new Modal_class();
