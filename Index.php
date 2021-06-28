<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/TopuvaWeb/rutas.php');
require_once(BD . "catalogoBD.php");
require_once(COMPARTIDA . "parametros.php");
$parametros = Parametros::getInstance();

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">
   <!--<link rel="icon" type="image/png" href="img/logo.png"> -->
   <title>TOPUVA - Tostaduria Puerto Varas</title>
   <!-- Slick Slider -->



   <link rel="stylesheet" type="text/css" href="vendor/slick/slick.min.css" />
   <link rel="stylesheet" type="text/css" href="vendor/slick/slick-theme.min.css" />
   <!-- Icofont Icon-->
   <link href="vendor/icons/icofont.min.css" rel="stylesheet" type="text/css">
   <!-- Bootstrap core CSS -->
   <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <!-- Custom styles for this template -->
   <link href="css/style.css" rel="stylesheet">
   <!-- Sidebar CSS -->
   <link href="vendor/sidebar/demo.css" rel="stylesheet">
   <style type="text/css">
      .modal.left .modal-dialog {
         position: fixed;
         right: 0;
         margin: auto;
         width: 320px;
         height: 100%;
         -webkit-transform: translate3d(0%, 0, 0);
         -ms-transform: translate3d(0%, 0, 0);
         -o-transform: translate3d(0%, 0, 0);
         transform: translate3d(0%, 0, 0);
      }

      .modal.left .modal-content {
         height: 100%;
         overflow-y: auto;
      }

      .modal.right .modal-body {
         padding: 15px 15px 80px;
      }

      .modal.right.fade .modal-dialog {
         left: -320px;
         -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
         -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
         -o-transition: opacity 0.3s linear, left 0.3s ease-out;
         transition: opacity 0.3s linear, left 0.3s ease-out;
      }

      .modal.right.fade.show .modal-dialog {
         right: 0;
      }
   </style>
</head>

<body class="fixed-bottom-padding bg-light">
   <br>
   <div class="row">
      <div class=" col-lg-12 ">
         <div class="form-inline ">

            <div class="col-md-6 bg-ligth">
               <div class="bg-ligth form-inline">
                  <img class="img-fluid logo-img  " src="img/logo.png">
                  <div class="col-md-4 bg-ligth ">
                     <div class="bg-ligth">
                        <h5 class="text-kumel-titulo text-kumel-titulo-fuente ">Productos naturales</h5>
                     </div>
                  </div>
               </div>
            </div>



            <div class="col-md-4">
               <div class="form-inline ">
                  <div class=" border-right ">
                     <a href="#" class="btn btn-icon btn-light"> <i class="icofont-facebook"></i></a>
                     <a href="#" class="btn btn-icon btn-light "><i class="icofont-instagram"></i></a>
                  </div>
                  <input type="text" class="form-control idPatronBusqueda" id="idPatronBusqueda"
                     placeholder="Buscar Productos">
                  <div class="input-group-prepend border-right ">
                     <div id="btnBuscarProductos" class="btn btn-light rounded-right"><i class="icofont-search"></i>
                     </div>
                  </div>

                  <a href="#" id="carrito"
                     class="ml-2 text-dark bg-light rounded-pill p-2 icofont-size border shadow-sm">
                     <i class="icofont-shopping-cart"></i>
                  </a>
               </div>

            </div>
         </div>
      </div>
   </div>

   <div class="col-lg-12">
      <hr></span>

   </div>
   <!-- Nav bar -->
   <div class="form-inline  ">


      <div class="col-md-2 offset-md-2"></div>
      <div class="col-md-5">
         <div class="">
            <div class="container menu-bar d-flex align-items-center">
               <ul class="list-unstyled form-inline mb-0">
                  <li class="nav-item active">
                     <a class="nav-link font-weight-light text-kumel-titulo h5 " href="/TopuvaWeb/index.php">Home <span
                           class="sr-only border border-dark">(current)</span></a>
                  </li>


                  <li class="nav-item dropdown">
                     <a class="nav-link text-kumel-titulo h5 font-weight-light dropdown-toggle" href="#"
                        id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        Tienda
                     </a>
                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-kumel-titulo " id="ddlSemillas">Semillas</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-kumel-titulo" id="ddlSnackMix">Snack y Mix</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-kumel-titulo" id="ddlFrutosSecos">Frutos Secos</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-kumel-titulo" id="ddlFrutasDeshidratadas">Frutas Deshidratadas</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-kumel-titulo" id="ddlChocolates">Chocolates</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-kumel-titulo" id="ddlEspecias">Especias y Condimentos</a>
                        <div class="dropdown-divider"></div>
                     </div>
                  </li>

                  </li>
                  <a href="/TopuvaWeb/Vistas/contacto.php" class=" btn  btn-sm">
                     <p class=" text-kumel-titulo font-weight-light h5 ">Contacto</p>
                  </a>
               </ul>
            </div>
         </div>
      </div>
   </div>



   <div class="container" style="max-width: 100%;">
      <div class="row">
         <div class="col-lg-12">

            <div class="py-3 osahan-promos">



               <div class="promo-slider pb-0 mb-0">
                  <?php 
                        $oCatalogo= new catalogoBD();
                        $Listafilas=$oCatalogo->obtieneProductosDestacados();
                         foreach($Listafilas as $filas => $value)
                          {
   ?>
                  <div class="osahan-slider-item bg-Kumel">
                     <a onclick="oCarrito.LinkProducto('<?php echo $value['descripcion']  ?>
                     ','<?php echo $value['precio_venta'] ?>','<?php echo $value['tamano_unidad'] ?>','<?php echo $value['codigo_unidad'] ?>')"
                        class="text-dark bg-Kumel"><img src=" <?php echo $value['imagen']?>  "
                           class="img-destacado  bg-Kumel" alt="Responsive image"></a>
                  </div>

                  <?php 
    }
   ?>

               </div>
            </div>
         </div>
      </div>
      
      <div class="col-lg-12">
         <hr></span>
         <div class="container" style="max-width: 70%;">

            <div class="row">
               <div class="col-lg-12">
                  <!-- home page -->
                  <div class="osahan-home-page">
                     <!-- body -->
                     <div class="osahan-body" id="ContenedorPaginas">
                        <!-- categories -->
                     </div>


                  </div>
                  <!-- <section class="footer-top py-4">
                  <div class="container">
                     <section class="footer-top py-4">
                        <div class="row">
                           <div class=" col-lg-12 p-4 bg-light rounded shadow-sm">
                              <div class="row">
                                 <div class=" col-lg-6">
                                    <div class="input-group">
                                       <input type="text" placeholder="Email" class="form-control" name="">
                                       <span class="input-group-append">
                                          <button type="submit" class="btn  btn-info"> Suscribete</button>
                                       </span>
                                    </div>
                                 </div>


                              </div>
                           </div>
                     </section>-->



                  </section>

               </div>
            </div>
         </div>
      </div>
   </div>
  


   <!-- footer -->
   <footer class="section-footer border bg-kumel">
      <br />
      <div class="form-inline">

         <div class="col-md-1 offset-md-1"></div>
         <div class="row  " style="height: 200px">


            <div class=" col-lg-6">
               <h5 style="text-align: left;" class="text-kumel-texto">Contactanos</h5>
               <ul>
                  <li class="text-kumel-texto ">topuva@gmail.com</li>
                  <li class="text-kumel-texto">+569999999</li>
               </ul>
            </div>
         </div>
      </div>






   </footer>




   <div class="modal left fade" id="myModal2" tabindex="" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 style="text-align: center;" class="text-kumel-bold">TU CARRITO</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
               <h4 style="text-align: left;" class=" text-kumel-titulo"> Total: </h4>
               <h4 style="text-align: left;" class="totalizador text-kumel-bold"> </h4>
               <button type="button" onclick="oCarrito.Comprar()" class="btn btn-kumel  btn-block">Comprar</button>

            </div>
         </div>
      </div>
   </div>

   <!-- Modal -->
   <div class="modal fade" id="modalConfirmacion" tabindex="" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header bg-light">
               <h6 class="" id="tituloConfirmacion"></h6>
            </div>
            <div id="mensajeConfirmacion" class="modal-body bg-light">
            </div>
            <div class="modal-footer bg-light">
               <div class="row">
                  <div class="col-lg-6">
                     <button id="btnConfirmacionOK" class="btn-primary" type="button">Aceptar </button>


                  </div>
                  <div class="col-lg-6">
                     <button id="btnConfirmacionCANCEL" class="btn-primary" type="button">Cancelar</button>


                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>








</body>
<div class="modal fade" id="MensajePersonalizado" tabindex="" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true" data-backdrop="false">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header bg-light">
            <h4 class="modal-title" id="TituloModal"></h4>
         </div>
         <div class="modal-body bg-light" id="CuerpoModal">
         </div>
         <div class="modal-footer bg-light">
            <div class="row">
               <div class="col-lg-6">
                  <button data-dismiss="modal" class="btn-primary" type="button" id="btn-cerrarMensaje">Cancelar
                  </button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modalBusqueda" tabindex="-1" role="dialog" aria-labelledby="modalBusqueda">

   <div class="modal-dialog modal-dialog-centered">

      <div class="modal-content" id="mContent">
      </div>
   </div>

</div>

<div id="loader" style="display:none">
   <button class="btn" disabled id="set-btn" style="padding-top:20%">
      <i class="psi-gear fa-spin" style="font-size:50px;color:#000000"></i>
   </button>
</div>


</html>

<?php include("includes/footer.php")  ?>
<script src="js/modalMensaje.js"></script>
<script>
   $(document).ready(function () {
      $("#ContenedorPaginas").load('/TopuvaWeb/Vistas/home.php');
   });
</script>