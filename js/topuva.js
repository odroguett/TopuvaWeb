var contenido = null;



function Carrito_class() {


  this.Comprar = function()
  {
    var modalContent = document.createElement('div');
    modalContent.innerHTML = localStorage.contenido;

    var precio = modalContent.querySelectorAll('.price_modal');
    //var cantidad =document.getElementsByClassName("cantidadProducto");

    for(i=0;i<precio.length;++i)
    {
    alert(precio[i].innerHTML);

    }
    $("#ContenedorPaginas").load('/TopuvaWeb/comprar.php');
    $('#myModal2').modal('hide');

  }

  this.AgregarSeleccion = function (precio, cantidad, texto) {

  
     debugger;
    var total = 0;
    var modalContent = document.createElement('div');
    var modalContentAux = document.createElement('div');
    modalContent.innerHTML = localStorage.contenido;

    


    var recorre = modalContent.querySelectorAll('.container_modal');

    contenido = '<div class="container container_modal"> ' +
      ' <div class="col-12 "> ' +
      ' <div class="row"> ' +
      ' <div class="col-6"> ' +
      ' <div class="row"> ' +
      ' <h6 class="textoProducto">  ' + texto + ' </h6> ' +
      ' </div> ' +
      ' <div class="row"> ' +
      ' <h6 class="price_modal m-0 text-success"> Precio: ' + precio + '</h6> ' +
      ' </div> ' +
      ' <div class="row"> ' +
      ' <h6 class=" cantidadProducto m-0 text-success"> Cantidad: ' + cantidad + ' </h6> ' +
      ' </div> ' +
      ' <div class="row"> ' +
      ' <h6 class=" cantidadProducto m-0 text-success">  SubTotal: ' + (Number(oCarrito.quitarCaractererNoNumericos(precio)) * Number(oCarrito.quitarCaractererNoNumericos(cantidad))) + ' </h6> ' +
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



      if (textoProducto.innerHTML.trim() === texto) {

      } else {
        modalContentAux.innerHTML = modalContentAux.innerHTML + '<div class="container container_modal"> ' + item.innerHTML;
        total = total + (Number(oCarrito.quitarCaractererNoNumericos(precioTotal.innerHTML)) * Number(oCarrito.quitarCaractererNoNumericos(cantidadTotal.innerHTML)));
      }


    });

    if (total == 0) {
      total = (Number(oCarrito.quitarCaractererNoNumericos(precio)) * cantidad);
    } else {
      total = total + (Number(oCarrito.quitarCaractererNoNumericos(precio)) * cantidad);

    }
    modalContentAux.innerHTML = modalContentAux.innerHTML + contenido;

    localStorage.contenido = modalContentAux.innerHTML;
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
    modalContent.innerHTML = localStorage.contenido;
    var recorre = modalContent.querySelectorAll('.container_modal')
    recorre.forEach(item => {
      var textoProducto = item.querySelector('.textoProducto');
      if (textoProducto.innerHTML.trim() === texto.innerHTML.trim()) {

      } else {

        modalContentAux.innerHTML = modalContentAux.innerHTML + '<div class="container container_modal"> ' + item.innerHTML;

      }

    });

    localStorage.contenido = modalContentAux.innerHTML;

    total = total - (Number(oCarrito.quitarCaractererNoNumericos(precio.innerHTML)) * Number(oCarrito.quitarCaractererNoNumericos(cantidadProducto.innerHTML)));
    $('.totalizador').text(total);


    event.closest('.container_modal').remove();


  }




  this.quitarCaractererNoNumericos = function (string) {
    return string.replace(/[^0-9]/g, '');
  }

this.CargaCarrito = function()
{
  var total = 0;
  var precioTotal = 0;
  var cantidadTotal = 0;
  debugger;
  var modalContentAux = document.createElement('div');
  modalContentAux.innerHTML =modalContentAux.innerHTML + localStorage.contenido;
  var recorre = modalContentAux.querySelectorAll('.container_modal');
  recorre.forEach(item => {
     precioTotal = precioTotal + Number(oCarrito.quitarCaractererNoNumericos(item.querySelector('.price_modal').innerHTML)) * Number(oCarrito.quitarCaractererNoNumericos(item.querySelector('.cantidadProducto').innerHTML));
     
  });


  $('.totalizador').text(precioTotal);
  $('.modal-body').html(modalContentAux);
  $('#myModal2').modal('show');

}



}
oCarrito = new Carrito_class();

$(document).ready(function () {


  


  $(".btn-valor").click(function () {
    debugger;  var preVar = $(this).closest('.claseTexto').find('.price').text()
    var cantidad = $('.cantidad').val();
    var texto = $(this).closest('.claseTexto').find('.textoProducto').text()
    oCarrito.AgregarSeleccion(preVar, cantidad, texto);

  });


  $("#btnLimpiarCompra").click(function () {

    localStorage.clear();
    $('#totalCompra').text("0");
    $('#myModal2').modal('hide');

  });

  $("#carrito").click(function () {
   
    oCarrito.CargaCarrito();
  });


  $("#ddlFrutosSecos").click(function () {

    $("#ContenedorPaginas").load('/TopuvaWeb/frutosSecos.php');

  });

  $("#ddlSnackMix").click(function () {

    $("#ContenedorPaginas").load('/TopuvaWeb/snackMix.php');

  });

  $("#ddlFrutasDeshidratadas").click(function () {

    $("#ContenedorPaginas").load('/TopuvaWeb/frutasDeshidratadas.php');

  });

  $("#ddlChocolates").click(function () {

    $("#ContenedorPaginas").load('/TopuvaWeb/chocolates.php');

  });
  $("#ddlEspecias").click(function () {

    $("#ContenedorPaginas").load('/TopuvaWeb/especias.php');

  });
  $("#ddlNovedades").click(function () {

    $("#ContenedorPaginas").load('/TopuvaWeb/novedades.php');

  });

  $("#ddlSemillas").click(function () {

    $("#ContenedorPaginas").load('/TopuvaWeb/semillas.php');
    

  });

  $("#btnContacto").click(function () {

    $("#ContenedorPaginas").load('/TopuvaWeb/contacto.php');

  });

  $("#verMas").click(function () {

    $("#ContenedorPaginas").load('/TopuvaWeb/verMas.php');

  });

  $("#btnComprar").click(function () {

    oCarrito.Comprar();

  });

  

});