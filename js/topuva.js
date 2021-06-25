var contenido = null;



function Carrito_class() {

  this.LimpiaCarrito = function () {
    vCarrito.Precio = null;
    vCarrito.Producto = null;
    vCarrito.Cantidad = null;
  }

  this.LinkProducto = function (descripcion, precioVenta, tamanoUnidad, codigoUnidad, cantidad) {

    cantidad = $('#cantidadProd').val();
    if (cantidad == null) {
      cantidad = 1;

    }

    $.ajax({
      type: "POST",
      url: '../TopuvaWeb/Vistas/promo1.php',
      data: {
        descripcion: descripcion,
        precioVenta: precioVenta,
        tamanoUnidad: tamanoUnidad,
        codigoUnidad: codigoUnidad,
        cantidad: cantidad
      },
      //contentType: "application/json; charset=utf-8",
      //dataType: "json",
      success: function (data) {
        if (data) {

          $("#ContenedorPaginas").html(data);

        }
      }
    });
  }

  this.IncorporaDespacho = function () {

    let modificar = '';
    debugger;
    if ($('#comIdDespacho').val() != "") {

      modificar = 'M';
    } else {
      modificar = 'C';

    }
    let idDespacho = $('#comIdDespacho').val();
    let nombre = $('#nombre').val();
    let apellido = $('#apellido').val();
    let direccion = $('#direccion').val();
    let departamento = $('#departamento').val();
    let ciudad = $('#ciudad').val();
    let comuna = $('#comuna').val();
    let region = $('#region').val();
    let telefono = $('#telefono').val();
    let email = $('#email').val();
    let cliente = $('#email').val();
    let tipoDespacho = $('#tipoDespacho').val();
    $.ajax({
      type: "POST",
      url: '../TopuvaWeb/Negocio/despacho.php',
      dataType: 'json',
      data: {
        modificar: modificar,
        idDespacho: idDespacho,
        nombre: nombre,
        apellido: apellido,
        direccion: direccion,
        departamento: departamento,
        ciudad: ciudad,
        comuna: comuna,
        region: region,
        telefono: telefono,
        email: email
      },
      success: function (data) {
        if (data.bEsValido) {


          oModal.MensajePersonalizado('Exito', data.respuesta, Constante_exito);

          $('#comDireccion').text('Dirección: ' + data.direccion);
          if (data.departamento != null) {
            $('#comDepartamento').text('Depto: ' + data.departamento);
          }
          $('#comComuna').text(data.comuna);
          $('#comCiudad').text(data.ciudad);
          $('#comRegion').text(data.region);
          $('#comIdDespacho').val(data.idDespacho);
          $('#botonCerrarDespacho').click();


          localStorage.setItem('direccion', data.direccion);
          localStorage.setItem('departamento', data.departamento);
          localStorage.setItem('comuna', data.comuna);
          localStorage.setItem('ciudad', data.ciudad);
          localStorage.setItem('region', data.region);
          localStorage.setItem('idDespacho', data.idDespacho);

        } else {
          oModal.MensajePersonalizado('Error', data.respuesta, Constante_exito);
          $('#botonCerrarDespacho').click();
        }
      }
    });

  }

  this.Comprar = function () {
    debugger;
    $('#myModal2').modal('hide');
    var modalContent = document.createElement('div');
    modalContent.innerHTML = localStorage.getItem('Carrito');
    if (modalContent.innerHTML != "") {

      var recorre = modalContent.querySelectorAll('.container_modal');
      var arrayCarrito = new Array();
      var direccion = localStorage.getItem('direccion');
      var departamento = localStorage.getItem('departamento');
      var comuna = localStorage.getItem('comuna');
      var ciudad = localStorage.getItem('ciudad');
      var region = localStorage.getItem('region');
      var idDespacho = localStorage.getItem('idDespacho');
      var iRecorre = 1;

      recorre.forEach(item => {
        var precio = item.querySelector('.price_modal').innerHTML;
        var producto = item.querySelector('.textoProducto').innerHTML;
        var cantidad = item.querySelector('.cantidadProducto').innerHTML;
        var codigoProducto = item.querySelector('.codigoProducto').innerHTML;

        var vCarrito = {
          Precio: Number(oCarrito.quitarCaractererNoNumericos(precio)),
          Producto: producto,
          Cantidad: Number(oCarrito.quitarCaractererNoNumericos(cantidad)),
          CodigoProducto: codigoProducto
        };
        arrayCarrito[iRecorre] = vCarrito;
        arrayCarrito["precio"] = precio;
        arrayCarrito["producto"] = producto;
        arrayCarrito["cantidad"] = cantidad;
        arrayCarrito["codigoProducto"] = codigoProducto;
        vCarrito = null;
        iRecorre = iRecorre + 1;


      });
      console.log(JSON.stringify(arrayCarrito));

      $.ajax({
        type: "POST",
        url: '../TopuvaWeb/Vistas/comprar.php',
        data: {
          arrayCarrito: JSON.stringify(arrayCarrito),
          direccion: direccion,
          comuna: comuna,
          ciudad: ciudad,
          region: region,
          departamento: departamento,
          idDespacho: idDespacho
        },
        //contentType: "application/json; charset=utf-8",
        //dataType: "json",
        success: function (data) {
          if (data) {


            $("#ContenedorPaginas").html(data);


          }
        }
      });


    } else {

      oModal.MensajePersonalizado('Error', "No existen productos en el carrito", Constante_informacion);
      $("#ContenedorPaginas").load('/TopuvaWeb/Vistas/home.php');
    }


  }

  this.AgregarSeleccion = function (precio, cantidad, texto, codigoProducto) {


    // debugger;
    var total = 0;
    var modalContent = document.createElement('div');
    var modalContentAux = document.createElement('div');
    modalContent.innerHTML = localStorage.getItem('Carrito');




    var recorre = modalContent.querySelectorAll('.container_modal');

    contenido = '<div class="container container_modal bg-light"> ' +
      ' <h6 class="codigoProducto font-weight-light text-dark" hidden>  ' + codigoProducto + ' </h6> ' +
      ' <div class="col-12 "> ' +
      ' <div class="row"> ' +
      ' <div class="col-6"> ' +
      ' <div class="row"> ' +
      ' <h6 class="textoProducto font-weight-light text-dark">  ' + texto + ' </h6> ' +
      ' </div> ' +
      ' <div class="row"> ' +
      ' <h6 class="price_modal m-0 font-weight-light text-primary"> Precio: ' + precio + '</h6> ' +
      ' </div> ' +
      ' <div class="row"> ' +
      ' <h6 class=" cantidadProducto m-0 font-weight-light text-primary"> Cantidad: ' + cantidad + ' </h6> ' +
      ' </div> ' +
      ' <div class="row"> ' +
      ' <h6 class=" cantidadProducto m-0 font-weight-light text-primary">  SubTotal: ' + (Number(oCarrito.quitarCaractererNoNumericos(precio)) * Number(oCarrito.quitarCaractererNoNumericos(cantidad))) + ' </h6> ' +
      ' </div> ' +
      ' </div> ' +
      ' <div class="col-6"> ' +
      ' <div class="row"> ' +

      ' <br> ' +
      ' <br> ' +

      '  <button "type="button" class="btn btn-danger btn-eliminar" id="eliminarProducto"  onclick= "oCarrito.EliminarProducto(this)">X</button> ' +
      ' </div> ' +
      ' </div> ' +

      ' </div> ' +
      ' </div> ' +

      ' </div> ';

    recorre.forEach(item => {
      var precioTotal = item.querySelector('.price_modal');
      var textoProducto = item.querySelector('.textoProducto');
      var cantidadTotal = item.querySelector('.cantidadProducto');



      if (textoProducto.innerHTML.trim() === texto.trim()) {

      } else {
        modalContentAux.innerHTML = modalContentAux.innerHTML + '</hr><div class="container container_modal bg-light "> ' + item.innerHTML;
        total = total + (Number(oCarrito.quitarCaractererNoNumericos(precioTotal.innerHTML)) * Number(oCarrito.quitarCaractererNoNumericos(cantidadTotal.innerHTML)));
      }


    });

    if (total == 0) {
      total = (Number(oCarrito.quitarCaractererNoNumericos(precio)) * cantidad);
    } else {
      total = total + (Number(oCarrito.quitarCaractererNoNumericos(precio)) * cantidad);

    }
    modalContentAux.innerHTML = modalContentAux.innerHTML + contenido;

    //localStorage.contenido = modalContentAux.innerHTML;
    localStorage.setItem('Carrito', modalContentAux.innerHTML);

    $('.modal-body').html(modalContentAux);
    $('#myModal2').modal('show');

    $('.totalizador').text(total);


  }

  this.EliminarProducto = function (event) {

    var modalContent = document.createElement('div');
    var total = $('.totalizador').text();
    var valorProducto = document.createElement('div');
    var modalContentAux = document.createElement('div');
    valorProducto.innerHTML = valorProducto + event.closest('.container_modal').innerHTML;
    var precio = valorProducto.querySelector('.price_modal');
    var cantidadProducto = valorProducto.querySelector('.cantidadProducto');
    var texto = valorProducto.querySelector('.textoProducto')
    //modalContent.innerHTML = localStorage.contenido;

    modalContent.innerHTML = localStorage.getItem('Carrito');
    var recorre = modalContent.querySelectorAll('.container_modal')
    recorre.forEach(item => {
      var textoProducto = item.querySelector('.textoProducto');
      if (textoProducto.innerHTML.trim() === texto.innerHTML.trim()) {

      } else {

        modalContentAux.innerHTML = modalContentAux.innerHTML + '<div class="container container_modal"> ' + item.innerHTML;

      }

    });

    //localStorage.contenido = modalContentAux.innerHTML;
    localStorage.setItem('Carrito', modalContentAux.innerHTML);

    total = total - (Number(oCarrito.quitarCaractererNoNumericos(precio.innerHTML)) * Number(oCarrito.quitarCaractererNoNumericos(cantidadProducto.innerHTML)));
    $('.totalizador').text(total);
    event.closest('.container_modal').remove();


  }




  this.quitarCaractererNoNumericos = function (string) {
    return string.replace(/[^0-9]/g, '');
  }

  this.CargaCarrito = function () {
    var total = 0;
    var precioTotal = 0;
    var cantidadTotal = 0;
    debugger;
    var modalContentAux = document.createElement('div');

    modalContentAux.innerHTML = modalContentAux.innerHTML + localStorage.getItem('Carrito');
    if (modalContentAux.innerHTML == "null") {

      modalContentAux.innerHTML = "";
    }
    var recorre = modalContentAux.querySelectorAll('.container_modal');
    recorre.forEach(item => {
      precioTotal = precioTotal + Number(oCarrito.quitarCaractererNoNumericos(item.querySelector('.price_modal').innerHTML)) * Number(oCarrito.quitarCaractererNoNumericos(item.querySelector('.cantidadProducto').innerHTML));

    });


    $('.totalizador').text(precioTotal);
    $('.modal-body').html(modalContentAux);
    $('#myModal2').modal('show');

  }


  this.IngresaDireccion = function () {
    var idDespacho = $('#comIdDespacho').val();

    $.ajax({
      type: "POST",
      url: '../TopuvaWeb/Vistas/_incorporaDireccion.php',
      data: {
        idDespacho: idDespacho
      },
      //dataType: "json",
      success: function (data) {
        if (data) {

          $('#mContent').html(data);
          $('#modalDireccion').modal('show');

        }
      }
    });


  }

  this.ContinuarPago = function () {
    debugger;
    var arrayPago = new Array();
    let idDespacho = $('#comIdDespacho').val();
    let totalProductosPago = $('#totalProductosPago').val();
    let tipoDespacho = 1;
    if ($('#rdDespacho').is(':checked')) {
      tipoDespacho = 2;
    }


    let totalPago = Number(oCarrito.quitarCaractererNoNumericos($('#subTotal').text()));
    //let tipoPago=1;
    if (idDespacho != null && idDespacho != "") {
      var recorre = document.querySelectorAll(".comprar");
      var iRecorre = 0;
      recorre.forEach(item => {
        var cantidad = item.querySelector('.cantidad');
        var codigo = item.querySelector('.codigo-producto');
        var pago = item.querySelector('.codigo-producto');
        var vPAgo = {
          Cantidad: cantidad.value,
          CodigoProducto: codigo.value

        };
        arrayPago[iRecorre] = vPAgo;
        iRecorre = iRecorre + 1;


      });
      $.ajax({
        type: "POST",
        url: '../TopuvaWeb/Vistas/_datosPago.php',
        data: {
          arrayPago: JSON.stringify(arrayPago),
          idDespacho: idDespacho,
          totalProductosPago: totalProductosPago,
          totalPago: totalPago,
          tipoDespacho: tipoDespacho
        },
        //contentType: "application/json; charset=utf-8",
        // dataType: "json",
        success: function (data) {
          if (data) {

            //  localStorage.removeItem('Carrito');
            $('#mContent').html(data);
            $('#modalDireccion').modal('show');


          }
        }
      });

    } else {

      oModal.MensajePersonalizado('Alerta', "Debe ingresar dirección antes de finalizar compra!!", Constante_informacion);

    }






  }
  this.ValidarDespacho = function () {
    var bOk = true;
    var sError;
    $('#idError').text('');
    if ($('#nombre').val() === "") {
      sError = "Falta ingresar nombre.";

      bOk = false;
    }
    if ($('#apellido').val() === "") {
      sError = "Falta ingresar Apellidos.";

      bOk = false;
    }
    if ($('#direccion').val() === "") {
      sError = "Falta ingresar dirección.";

      bOk = false;
    }
    if ($('#ciudad').val() === "") {
      sError = "Falta ingresar Ciudad.";

      bOk = false;
    }
    if ($('#comuna').val() === "") {
      sError = "Falta ingresar Comuna.";

      bOk = false;
    }
    if ($('#region').val() === "") {
      sError = "Falta ingresar Región.";

      bOk = false;
    }

    if ($('#email').val() === "") {
      sError = "Correo es obligatorio para coordinar despacho.";

      bOk = false;
    }


    $('#idError').text(sError);
    $('#idError').removeAttr('hidden');
    return bOk;

  }



  this.EliminarDatosDespacho = function (confirmacion) {

    if (confirmacion) {

      let idDespacho = $('#comIdDespacho').val();
      if (idDespacho !== 0) {
        $.ajax({
          type: "POST",
          url: '../TopuvaWeb/Negocio/eliminarDatosDespacho.php',
          dataType: 'json',
          data: {
            idDespacho: idDespacho
          },
          success: function (data) {
            if (data.bEsValido) {

              $('#comDireccion').text('');
              $('#comDepartamento').text('');
              $('#comComuna').text('');
              $('#comCiudad').text('');
              $('#comRegion').text('');
              $('#comIdDespacho').val('');
              localStorage.removeItem('direccion');
              localStorage.removeItem('departamento');
              localStorage.removeItem('comuna');
              localStorage.removeItem('ciudad');
              localStorage.removeItem('region');
              localStorage.removeItem('idDespacho');
              oModal.MensajePersonalizado('Exito', data.respuesta, Constante_exito);
            } else {
              
              oModal.MensajePersonalizado('Error', data.respuesta, Constante_exito);
            }
          }
        });
      }


    }


  }

  this.FinalizarPago = function (arrayPago, idDespacho, totalProductosPago, totalPago, tipoDespacho) {
    debugger;
    let tipoPago = "";
    if ($('#rdTransferencia').is(':checked')) {

      tipoPago = "1";
    } else {
      tipoPago = "2";

    }

    $.ajax({
      type: "POST",
      url: '../TopuvaWeb/Negocio/pago.php',
      data: {
        arrayPago: arrayPago,
        idDespacho: idDespacho,
        totalProductosPago: totalProductosPago,
        totalPago: totalPago,
        tipoDespacho: tipoDespacho,
        tipoPago: tipoPago
      },
      //contentType: "application/json; charset=utf-8",
      dataType: "json",
      success: function (data) {
        if (data) {
          if (data.bEsValido) {
            $('#modalDireccion').modal('hide');
            localStorage.removeItem('Carrito');
            localStorage.removeItem('direccion');
            localStorage.removeItem('departamento');
            localStorage.removeItem('comuna');
            localStorage.removeItem('ciudad');
            localStorage.removeItem('region');
            localStorage.removeItem('idDespacho');
            oModal.MensajePersonalizado('Información', data.respuesta, Constante_informacion);
            window.location.replace("/TopuvaWeb/Negocio/comprobantePagoPDF.php?idDespacho=" + idDespacho);
            $("#ContenedorPaginas").load('/TopuvaWeb/Vistas/home.php');
          } else {
            $('#modalDireccion').modal('hide');
            oModal.MensajePersonalizadoCallBack('Información', data.respuesta, Constante_informacion, oCarrito.CargaCarrito);


          }

        }


      }
    });


  }

  this.BorrarCarritoCompras = function (confirmacion) {
    if (confirmacion) {
      $('#modalDireccion').modal('hide');
      localStorage.removeItem('Carrito');
      $("#ContenedorPaginas").load('/TopuvaWeb/Vistas/home.php');
    }


  }
  this.MontoTotalCompra = function () {
    debugger
    var recorre = document.querySelectorAll('.mostrar-precio');
    var total = 0;
    cantidad = 0
    recorre.forEach(item => {

      total = total + Number(oCarrito.quitarCaractererNoNumericos(item.innerHTML));
    });


    recorreCantidad = document.querySelectorAll('.cantidad');
    recorreCantidad.forEach(item => {

      cantidad = cantidad + Number(oCarrito.quitarCaractererNoNumericos(item.value));
    });
    $('#subTotal').text(' ' + total);
    $('#totalProductos').text(' ' + cantidad);


  }
  this.BuscarProductos = function () {
    var sPatron = $('#idPatronBusqueda').val();
    if (sPatron != "") {
      $.ajax({
        type: "POST",
        url: '../TopuvaWeb/Vistas/buscar.php',
        data: {
          sPatron: sPatron
        },
        success: function (data) {
          if (data) {
            $('#mContent').html(data);
            $('#modalBusqueda').modal('show');

          }
        }
      });

    }




  }




}
oCarrito = new Carrito_class();

$(document).ready(function () {


  $(".btn-valor").click(function (e) {
    e.preventDefault();
    e.stopPropagation();
    debugger;
    var preVar = $(this).closest('.claseTexto').find('.price').text()
    var cantidad = $(this).closest('.claseTexto').find('.cantidad').val();
    var texto = $(this).closest('.claseTexto').find('.textoProducto').text()
    var codigoProducto = $(this).closest('.claseTexto').find('.codigo-precio-producto').val()
    oCarrito.AgregarSeleccion(preVar, cantidad, texto, codigoProducto);

  });


  $("#btnAgregarCarro").click(function (e) {
    e.preventDefault();
    e.stopPropagation();
    debugger;
    var preVar = $(this).closest('.claseTexto').find('.price').text()
    var cantidad = $('.cantidad').val();
    var texto = $(this).closest('.claseTexto').find('.textoProducto').text()
    var codigoProducto = $(this).closest('.claseTexto').find('.codigo-precio-producto').val()
    oCarrito.AgregarSeleccion(preVar, cantidad, texto, codigoProducto);

  });





  $("#btnLimpiarCompra").click(function (e) {

    localStorage.clear();
    $('#totalCompra').text("0");
    $('#myModal2').modal('hide');

  });

  $("#carrito").click(function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();

    oCarrito.CargaCarrito();
  });


  $("#ddlFrutosSecos").click(function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();

    $("#ContenedorPaginas").load('../TopuvaWeb/Vistas/frutosSecos.php');

  });

  $("#ddlSnackMix").click(function (e) {

    e.preventDefault();
    e.stopImmediatePropagation();
    $("#ContenedorPaginas").load('../TopuvaWeb/Vistas/snackMix.php');

  });

  $("#ddlFrutasDeshidratadas").click(function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();

    $("#ContenedorPaginas").load('../TopuvaWeb/Vistas/frutasDeshidratadas.php');

  });

  $("#ddlChocolates").click(function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();

    $("#ContenedorPaginas").load('../TopuvaWeb/Vistas/chocolates.php');

  });
  $("#ddlEspecias").click(function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();

    $("#ContenedorPaginas").load('../TopuvaWeb/Vistas/especias.php');

  });


  $("#ddlJugos").click(function (e) {

    e.preventDefault();
    e.stopImmediatePropagation();
    $("#ContenedorPaginas").load('../TopuvaWeb/Vistas/jugos.php');

  });
  $("#ddlHarinas").click(function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();

    $("#ContenedorPaginas").load('../TopuvaWeb/Vistas/harinas.php');

  });
  $("#ddlNovedades").click(function (e) {

    e.preventDefault();
    e.stopImmediatePropagation();
    $("#ContenedorPaginas").load('../TopuvaWeb/Vistas/novedades.php');

  });

  $("#ddlSemillas").click(function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    $("#ContenedorPaginas").load('../TopuvaWeb/Vistas/semillas.php');


  });

  $("#btnContacto").click(function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();

    $("#ContenedorPaginas").load('../TopuvaWeb/Vistas/contacto.php');

  });

  $("#verMas").click(function (e) {

    e.preventDefault();
    e.stopImmediatePropagation();
    $("#ContenedorPaginas").load('../TopuvaWeb/Vistas/verMas.php');

  });

  $("#href_Link").click(function (e) {

    e.preventDefault();
    e.stopImmediatePropagation();
    $("#ContenedorPaginas").load('../TopuvaWeb/Vistas/promo1.php');

  });


  $("#btnAgregarDireccion").click(function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    //oModal.MensajePersonalizado('Atención', 'El costo de despacho se incluirá al momento de ingresar el pago', Constante_alerta);
    oCarrito.IngresaDireccion();
  });




  $("#rdDespacho").click(function () {
    $("#rdRetiro").prop("checked", false);
    $('#classDespacho').removeAttr('hidden');
    $('#classRetiro').attr('hidden', true);
    //  $('#collapsetwo').collapse('show');
    // $('#collapseOne').collapse();
  });

  $("#rdRetiro").click(function () {
    // $("#rdDespacho").prop("checked", false);
    $('#classRetiro').removeAttr('hidden');
    // $('#classDespacho').attr('hidden',true);
    //  $('#collapsetwo').collapse('show');
    //  $('#collapseOne').collapse();


  });

  $("#rdTransferencia").click(function () {
    $("#rdEntrega").prop("checked", false);
    $('#idTransferencia').removeAttr('hidden');
    $('#idPagoDomicilio').attr('hidden', true);

  });

  $("#rdEntrega").click(function () {
    $("#rdTransferencia").prop("checked", false);
    $('#idPagoDomicilio').removeAttr('hidden');
    $('#idTransferencia').attr('hidden', true);


  });


  $("#btnContinuarPago").click(function (e) {

    e.preventDefault();
    let subTotal = Number(oCarrito.quitarCaractererNoNumericos($('#subTotal').text()));
    if (subTotal != 0) {
      oCarrito.ContinuarPago();
    } else {
      oModal.MensajePersonalizado('Advertencia', "Total de productos no puede ser cero.", Constante_informacion);

    }

    e.stopImmediatePropagation();

  });


  $("#btnIngresar").click(function (e) {
    e.preventDefault();

    if (oCarrito.ValidarDespacho()) {

      oCarrito.IncorporaDespacho();
    }
    e.stopImmediatePropagation();
  });


  $("#btnEliminarDespacho").click(function (e) {
    debugger;
    e.preventDefault();
    e.stopImmediatePropagation();
    if ($('#comIdDespacho').val() !== "") {

      oModal.confirmacion("Confirmación", "¿Desea Eliminar datos para despacho?", oCarrito.EliminarDatosDespacho);
    } else {
      oModal.MensajePersonalizado('Exito', "No existe información de despacho para eliminar", Constante_informacion);

    }

  });

  $("#btnBorrarCarrito").click(function (e) {
    debugger;
    e.preventDefault();
    e.stopImmediatePropagation();

    oModal.confirmacion("Confirmación", "¿Desea borrar productos en carrito de compras?", oCarrito.BorrarCarritoCompras);



  });

  $(".btn-eliminar-producto").click(function (e) {
    debugger;
    e.preventDefault();
    e.stopImmediatePropagation();
    var precioTotal = $(this).closest('.precio_total').find('.mostrar-precio').text();
    $(this).closest('.precio_total').find('.mostrar-precio').text('');
    $(this).closest('.clase-cantidad').find('.cantidad').val(Number(0));
    oModal.MensajePersonalizado('Alerta', "Se elimino compra de producto.", Constante_informacion);
    oCarrito.MontoTotalCompra();






  });

  $("#btnBuscarProductos").click(function (e) {

    e.preventDefault();
    e.stopImmediatePropagation();
    oCarrito.BuscarProductos();

  });
  $("#idPatronBusqueda").keypress(function (e) {

    var code = (e.keyCode ? e.keyCode : e.which);
    if (code == 13) {
      oCarrito.BuscarProductos();
    }
    e.stopImmediatePropagation();


  });




  $('.qtySubir').click(function (e) {
    debugger
    e.preventDefault();


    fieldName = $(this).attr('field');
    precio = $(this).closest('.clase-cantidad').find('.precio-total').val()
    // Get its current value
    //var currentVal = parseInt($('input[name='+fieldName+']').val());
    var currentVal = $(this).closest('.clase-cantidad').find('.cantidad').val()
    // If is not undefined
    if (!isNaN(currentVal)) {
      // Increment
      $(this).closest('.clase-cantidad').find('.cantidad').val(Number(currentVal) + 1);
      precio = precio * (Number(currentVal) + 1);
      $(this).closest('.precio_total').find('.mostrar-precio').text('$ ' + precio);

    } else {


      $(this).closest('.precio_total').find('.mostrar-precio').text('$ ' + precio);

    }
    oCarrito.MontoTotalCompra();

    e.stopImmediatePropagation();
  });
  $(".qtyBajar").click(function (e) {
    debugger
    e.preventDefault();
    e.stopImmediatePropagation();

    // Get the field name
    fieldName = $(this).attr('field');
    // Get its current value
    var currentVal = $(this).closest('.clase-cantidad').find('.cantidad').val()
    precio = $(this).closest('.clase-cantidad').find('.precio-total').val()
    precioTotal = oCarrito.quitarCaractererNoNumericos($(this).closest('.precio_total').find('.mostrar-precio').text());
    // If is not undefined
    if (!isNaN(currentVal) && currentVal >= 1) {
      // Increment
      // Increment
      $(this).closest('.clase-cantidad').find('.cantidad').val(Number(currentVal) - 1);


      $(this).closest('.precio_total').find('.mostrar-precio').text('$ ' + (precioTotal - precio).toString());
      //  $('.cantidad').val(Number(currentVal) + 1);
    } else if (currentVal == 0) {

      $(this).closest('.precio_total').find('.mostrar-precio').text('$ ');
      //$(this).closest('.precio_total').find('.mostrar-precio').text( '$ ' +  precioTotal);
    }
    oCarrito.MontoTotalCompra();
  });


  // Quantity JS
  $('.qtyplus').click(function (e) {

    e.preventDefault();
    e.stopImmediatePropagation();

    fieldName = $(this).attr('field');
    // Get its current value
    //var currentVal = parseInt($('input[name='+fieldName+']').val());
    var currentVal = $(this).closest('.claseTexto').find('.cantidad').val();
    // If is not undefined
    if (!isNaN(currentVal)) {
      // Increment
      $(this).closest('.claseTexto').find('.cantidad').val(Number(currentVal) + 1);
      //  $('.cantidad').val(Number(currentVal) + 1);
    } else {
      // Otherwise put a 0 there
      $(this).closest('.claseTexto').find('.cantidad').val(1);
    }
  });
  // This button will decrement the value till 0
  $(".qtyminus").click(function (e) {

    e.preventDefault();
    e.stopImmediatePropagation();

    // Get the field name
    fieldName = $(this).attr('field');
    // Get its current value
    var currentVal = $(this).closest('.claseTexto').find('.cantidad').val();
    // If it isn't undefined or its greater than 0
    if (!isNaN(currentVal) && currentVal > 1) {
      // Decrement one
      $(this).closest('.claseTexto').find('.cantidad').val(Number(currentVal) - 1);
    } else {
      // Otherwise put a 0 there
      $(this).closest('.claseTexto').find('.cantidad').val(1);
    }
  });

});
