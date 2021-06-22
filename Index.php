<?php 
require_once("BD/catalogoBD.php");

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

<body class="fixed-bottom-padding">

   <div class="border-bottom p-3 d-none mobile-nav">
      <div class="title d-flex align-items-center">
         <a href="home.html" class="text-decoration-none text-dark d-flex align-items-center">
            <!-- <img class="osahan-logo mr-2" src="img/logo.png"> -->
            <h4 class="font-weight-bold text-success m-0">TOPUVA</h4>
         </a>
         <p class="ml-auto m-0">
            <a href="listing.html"
               class="text-decoration-none bg-light p-1 rounded shadow-sm d-flex align-items-center">
               <i class="text-dark icofont-sale-discount"></i>
               <span class="badge badge-danger p-1 ml-1 small">50%</span>
            </a>
         </p>
         <a class="toggle ml-3" href="#"><i class="icofont-navigation-menu"></i></a>
      </div>

   </div>


   <!-- Nav bar -->
   <div class="bg-light shadow-sm osahan-main-nav">
      <nav class="navbar navbar-expand-lg navbar-light bg-light osahan-header py-0 container">
         <a class="navbar-brand mr-0" href="home.html"><img class="img-fluid logo-img " src="img/logo.png"></a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="ml-3 d-flex align-items-center">
            <div class="dropdown mr-3">

               <div class="dropdown-menu osahan-select-loaction p-3" aria-labelledby="navbarDropdown">
                  <span>Select your city to start shopping</span>
                  <form class="form-inline my-2">
                     <!-- <input class="form-control form-control-lg mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                           <button class="btn btn-outline-success btn-block" type="submit">Search</button> -->
                     <div class="input-group p-0 col-lg-12">
                        <input type="text" class="form-control form-control-sm" id="inlineFormInputGroupUsername2"
                           placeholder="Search Location">
                        <div class="input-group-prepend">
                           <div class="btn btn-success rounded-right btn-sm"><i class="icofont-location-arrow"></i>
                              Detect</div>
                        </div>
                     </div>
                  </form>

               </div>
            </div>
            <!-- search  -->
            <div class="input-group mr-sm-2 col-lg-12">
               <input type="text" class="form-control" id="idPatronBusqueda" placeholder="Buscar Productos">
               <div class="input-group-prepend">
                  <div id="btnBuscarProductos" class="btn btn-primary rounded-right"><i class="icofont-search"></i>
                  </div>
               </div>
            </div>
         </div>

         <div class="ml-auto d-flex align-items-center">
            <!-- Dark mode -->

            <!-- End Dark mode -->

            <!-- cart -->
            <a href="#" id="carrito" class="ml-2 text-dark bg-light rounded-pill p-2 icofont-size border shadow-sm">
               <i class="icofont-shopping-cart"></i>
            </a>
         </div>

      </nav>
      <!-- Menu bar -->
      <div class="bg-info">
         <div class="container menu-bar d-flex align-items-center">
            <ul class="list-unstyled form-inline mb-0">
               <li class="nav-item active">
                  <a class="nav-link text-white pl-0" href="/TopuvaWeb/index.php">Home <span
                        class="sr-only">(current)</span></a>
               </li>
               <li class="nav-item dropdown">
                  <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button"
                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Tienda
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                     <a class="dropdown-item" id="ddlSemillas">Semillas</a>
                     <a class="dropdown-item" id="ddlSnackMix">Snack y Mix</a>
                     <a class="dropdown-item" id="ddlFrutosSecos">Frutos Secos</a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item" id="ddlFrutasDeshidratadas">Frutas Deshidratadas</a>
                     <a class="dropdown-item" id="ddlChocolates">Chocolates</a>
                     <a class="dropdown-item" id="ddlEspecias">Especias y Condimentos</a>
                  </div>
               </li>
               <!--  <li class="nav-item dropdown">
                  <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button"
                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Regalos
                  </a>
                   <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                     <a class="dropdown-item" id="ddlNovedades">Novedades</a>
                  </div> -->
               </li>
               <a href="/TopuvaWeb/Vistas/contacto.php" class="text-white  btn  btn-sm">Contacto</a>


            </ul>

         </div>
      </div>
      <!-- Promos -->

   </div>
  


   </div>
   <div class="row">

   </div>
   <div class="container">
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
                  <div class="osahan-slider-item mx-2">
                     <a onclick="oCarrito.LinkProducto('<?php echo $value['descripcion']  ?>
                     ','<?php echo $value['precio_venta'] ?>','<?php echo $value['tamano_unidad'] ?>','<?php echo $value['codigo_unidad'] ?>')"
                        class="text-dark"><img src=" <?php echo $value['imagen']?>  " class="img-fluid mx-auto rounded"
                           alt="Responsive image"></a>
                  </div>

                  <?php 
    }
   ?>

               </div>
            </div>
         </div>
      </div>

      <div class="container">

         <div class="row">
            <div class="col-lg-12">
               <!-- home page -->
               <div class="osahan-home-page">
                  <!-- body -->
                  <div class="osahan-body" id="ContenedorPaginas">
                     <!-- categories -->
                  </div>


               </div>
               <section class="footer-top py-4">
                  <div class="container">
                     <section class="footer-top py-4">
                        <div class="row">
                           <div class=" col-lg-12 p-4 bg-light rounded shadow-sm">
                              <div class="row">
                                 <div class=" col-lg-6">
                                    <div class="input-group">
                                       <input type="text" placeholder="Email" class="form-control" name="">
                                       <span class="input-group-append">
                                          <button type="submit" class="btn  btn-primary"> Suscribete</button>
                                       </span>
                                    </div>
                                 </div>
                                 <div class=" col-lg-6">
                                    <p class="text-sm-left text-info">Siguenos en: </p>
                                    <a href="#" class="btn btn-icon btn-light"><i class="icofont-facebook"></i></a>
                                    <a href="#" class="btn btn-icon btn-light"><i class="icofont-instagram"></i></a>
                                 </div>

                              </div>
                           </div>
                     </section>


                     <div class="row">
                        <div class=" col-lg-12 p-4 bg-light rounded shadow-sm">
                           <div class="row">
                              <div class=" col-lg-6">
                                 <h5 style="text-align: left;" class="text-secondary">Contactanos</h5>
                                 <ul>
                                    <li class=" text-info">topuva@gmail.com</li>
                                    <li class="text-info">+569999999</li>
                                 </ul>
                              </div>



                           </div>
                        </div>
                     </div>
               </section>

            </div>
         </div>
      </div>
   </div>
   </div>



  
   <!-- footer -->
   <footer class="section-footer border-top bg-light">
      <section class="footer-top py-4">
         <div class="container">


         </div>
         <!-- //container -->
      </section>
      <!-- footer-top.// -->
      
   </footer>
   



   <div class="modal left fade" id="myModal2" tabindex="" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 style="text-align: center;" class="text-secondary">TU CARRITO</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
               <h4 style="text-align: left;" class=" text-secondary"> Total: </h4>
               <h4 style="text-align: left;" class="totalizador text-secondary"> </h4>
               <button type="button" onclick="oCarrito.Comprar()" class="btn btn-primary  btn-block">Comprar</button>

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
         <div class="modal-footer">
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




</html>

<?php include("includes/footer.php")  ?>
<script src="js/modalMensaje.js"></script>
<script>
   $(document).ready(function () {
      $("#ContenedorPaginas").load('/TopuvaWeb/Vistas/home.php');
   });
</script>

