

function Modal_class() {

    this.NotificacionAlertify = function (mensaje,tipo)
    {
        alertify.set('notifier','position', 'top-right');
        if(tipo=="warning")
        {
            alertify.warning(mensaje);

        }
        if(tipo=="error")
        {
            alertify.error(mensaje);

        }
        if(tipo=="success")
        {
            alertify.success(mensaje);
            
        }
        

    }

    
    // this.MensajePersonalizado = function (titulo, mensaje, TipoAlert) {
    //     var icono = "";
    //     var vUsuario = null;
       
      
    //     switch (TipoAlert) {
    //         case Constante_alerta:
    //             icono = Constante_icono_alerta;
    //             break;
    //         case Constante_error:
    //             icono = Constante_icono_error;
    //             break;
    //         case Constante_exito:
    //             icono = Constante_icono_exito;
    //             break;
    //         case Constante_informacion:
    //             icono = Constante_icono_info;
    //             break;
    //     }
    //     switch (titulo) {
    //         case Titulo_alerta:
    //             titulo = "Alerta";
    //             break;
    //         case Titulo_error:
    //             titulo = "Error";
    //             break;
    //         case Titulo_exito:
    //             titulo = "Éxito";
    //             break;
    //         case Titulo_informacion:
    //             titulo = "Información";
    //             break;
    //         default:
    //             titulo = titulo;
    //             break;
    //     }
    //     $('#TituloModal').html("<h6 class=text-info'>" + titulo + "</h6>");
    //     $('#CuerpoModal').html("<p class='text-semibold text-center'>" + mensaje + "</p>");
    //     $("#MensajePersonalizado").modal("show");
    //   };

    //   this.MensajePersonalizadoCallBack = function (titulo, mensaje, TipoAlert,callBack) {
    //     var icono = "";
    //     var vUsuario = null;
    //     callBack = oModal.onlyAllowOneCall(callBack)
      
    //     switch (TipoAlert) {
    //         case Constante_alerta:
    //             icono = Constante_icono_alerta;
    //             break;
    //         case Constante_error:
    //             icono = Constante_icono_error;
    //             break;
    //         case Constante_exito:
    //             icono = Constante_icono_exito;
    //             break;
    //         case Constante_informacion:
    //             icono = Constante_icono_info;
    //             break;
    //     }
    //     switch (titulo) {
    //         case Titulo_alerta:
    //             titulo = "Alerta";
    //             break;
    //         case Titulo_error:
    //             titulo = "Error";
    //             break;
    //         case Titulo_exito:
    //             titulo = "Éxito";
    //             break;
    //         case Titulo_informacion:
    //             titulo = "Información";
    //             break;
    //         default:
    //             titulo = titulo;
    //             break;
    //     }
    //     $('#TituloModal').html("<h6 class=text-info'>" + titulo + "</h6>");
    //     $('#CuerpoModal').html("<p class='text-semibold text-center'>" + mensaje + "</p>");
    //     $("#MensajePersonalizado").modal("show");

        
    //     $("#btn-cerrarMensaje").on("click", function () {
    //         $("#modalConfirmacion").modal('hide');
    //         callBack(true);
    //     });
        


    //   };

      this.confirmacion = function (titulo, mensaje, callback) {
       

        //callback = oModal.onlyAllowOneCall(callback);
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
