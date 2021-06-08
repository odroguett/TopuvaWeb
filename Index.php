<?php 
include("BD/catalogoBD.php");





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
               class="text-decoration-none bg-white p-1 rounded shadow-sm d-flex align-items-center">
               <i class="text-dark icofont-sale-discount"></i>
               <span class="badge badge-danger p-1 ml-1 small">50%</span>
            </a>
         </p>
         <a class="toggle ml-3" href="#"><i class="icofont-navigation-menu"></i></a>
      </div>
      <a href="search.html" class="text-decoration-none">
         <div class="input-group mt-3 rounded shadow-sm overflow-hidden bg-white">
            <div class="input-group-prepend">
               <button class="border-0 btn btn-outline-secondary text-success bg-white"><i
                     class="icofont-search"></i></button>
            </div>
            <input type="text" class="shadow-none border-0 form-control pl-0" placeholder="Buscar Productos.."
               aria-label="" aria-describedby="basic-addon1">
         </div>
      </a>
   </div>


   <!-- Nav bar -->
   <div class="bg-white shadow-sm osahan-main-nav">
      <nav class="navbar navbar-expand-lg navbar-light bg-white osahan-header py-0 container">
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
               <input type="text" class="form-control" id="inlineFormInputGroupUsername2"
                  placeholder="Buscar Productos">
               <div class="input-group-prepend">
                  <div class="btn btn-primary rounded-right"><i class="icofont-search"></i></div>
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
               <li class="nav-item dropdown">
                  <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button"
                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Regalos
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                     <a class="dropdown-item" id="ddlNovedades">Novedades</a>
                  </div>
               </li>
               <a href="/TopuvaWeb/contacto.php" class="text-white  btn  btn-sm">Contacto</a>


            </ul>

         </div>
      </div>
      <!-- Promos -->

   </div>
   <!-- bread_cum -->
   <nav aria-label="breadcrumb" class="breadcrumb mb-0 d-none">
      <div class="container">
         <ol class="d-flex align-items-center mb-0 p-0">
            <li class="breadcrumb-item"><a href="#" class="text-success">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"></li>
         </ol>
      </div>
   </nav>


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
                           <div class=" col-lg-12 p-4 bg-white rounded shadow-sm">
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
                                    <a href="#" class="btn btn-icon btn-light"><i class="icofont-twitter"></i></a>
                                    <a href="#" class="btn btn-icon btn-light"><i class="icofont-instagram"></i></a>
                                    <a href="#" class="btn btn-icon btn-light"><i class="icofont-youtube"></i></a>


                                 </div>

                              </div>
                           </div>
                     </section>


                     <div class="row">
                        <div class=" col-lg-12 p-4 bg-white rounded shadow-sm">
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



   <nav id="main-nav">
      <ul class="second-nav">
         <li><a href="home.html"><i class="icofont-smart-phone mr-2"></i> Home</a></li>
         <li>
            <a href="#"><i class="icofont-login mr-2"></i> Authentication</a>
            <ul>
               <li><a class="dropdown-item" href="signin.html">Sign In</a></li>
               <li><a class="dropdown-item" href="signup.html">Sign Up</a></li>
               <li><a href="verification.html">Verification</a></li>
            </ul>
         </li>
         <li><a class="dropdown-item" href="listing.html">Listing</a></li>
         <li><a class="dropdown-item" href="product_details.html">Detail</a></li>
         <li><a class="dropdown-item" href="picks_today.html">Trending</a></li>
         <li><a class="dropdown-item" href="recommend.html">Recommended</a></li>
         <li><a class="dropdown-item" href="fresh_vegan.html">Most Popular</a></li>
         <li><a class="dropdown-item" href="cart.html">Cart</a></li>
         <li><a class="dropdown-item" href="checkout.html">Checkout</a></li>
         <li><a class="dropdown-item" href="successful.html">Successful</a></li>
         <li>
            <a href="#"><i class="icofont-sub-listing mr-2"></i> My Order</a>
            <ul>
               <li><a class="dropdown-item" href="my_order.html">My order</a></li>
               <li><a class="dropdown-item" href="status_complete.html">Status Complete</a></li>
               <li><a class="dropdown-item" href="status_onprocess.html">Status on Process</a></li>
               <li><a class="dropdown-item" href="status_canceled.html">Status Canceled</a></li>
               <li><a class="dropdown-item" href="review.html">Review</a></li>
            </ul>
         </li>
         <li>
            <a href="#"><i class="icofont-ui-user mr-2"></i> My Account</a>
            <ul>
               <li><a class="dropdown-item" href="my_account.html">My account</a></li>
               <li><a class="dropdown-item" href="promos.html">Promos</a></li>
               <li><a class="dropdown-item" href="my_address.html">My address</a></li>
               <li><a class="dropdown-item" href="terms_conditions.html">Terms & conditions</a></li>
               <li><a class="dropdown-item" href="help_support.html">Help & support</a></li>
               <li><a class="dropdown-item" href="help_ticket.html">Help ticket</a></li>
               <li><a class="dropdown-item" href="signin.html">Logout</a></li>
            </ul>
         </li>
         <li>
            <a href="#"><i class="icofont-page mr-2"></i> Pages</a>
            <ul>
               <li><a class="dropdown-item" href="verification.html">Verification</a></li>
               <li><a class="dropdown-item" href="promos.html">Promos</a></li>
               <li><a class="dropdown-item" href="promo_details.html">Promo Details</a></li>
               <li><a class="dropdown-item" href="terms_conditions.html">Terms & Conditions</a></li>
               <li><a class="dropdown-item" href="privacy.html">Privacy</a></li>
               <li><a class="dropdown-item" href="terms&conditions.html">Conditions</a></li>
               <li><a class="dropdown-item" href="help_support.html">Help Support</a></li>
               <li><a class="dropdown-item" href="help_ticket.html">Help Ticket</a></li>
               <li><a class="dropdown-item" href="refund_payment.html">Refund Payment</a></li>
               <li><a class="dropdown-item" href="faq.html">FAQ</a></li>
               <li><a class="dropdown-item" href="signin.html">Sign In</a></li>
               <li><a class="dropdown-item" href="signup.html">Sign Up</a></li>
               <li><a class="dropdown-item" href="search.html">Search</a></li>
            </ul>
         </li>
         <li>
            <a href="#"><i class="icofont-link mr-2"></i> Navigation Link Example</a>
            <ul>
               <li>
                  <a href="#">Link Example 1</a>
                  <ul>
                     <li>
                        <a href="#">Link Example 1.1</a>
                        <ul>
                           <li><a href="#">Link</a></li>
                           <li><a href="#">Link</a></li>
                           <li><a href="#">Link</a></li>
                           <li><a href="#">Link</a></li>
                           <li><a href="#">Link</a></li>
                        </ul>
                     </li>
                     <li>
                        <a href="#">Link Example 1.2</a>
                        <ul>
                           <li><a href="#">Link</a></li>
                           <li><a href="#">Link</a></li>
                           <li><a href="#">Link</a></li>
                           <li><a href="#">Link</a></li>
                        </ul>
                     </li>
                  </ul>
               </li>
               <li><a href="#">Link Example 2</a></li>
               <li><a href="#">Link Example 3</a></li>
               <li><a href="#">Link Example 4</a></li>
               <li data-nav-custom-content>
                  <div class="custom-message">
                     You can add any custom content to your navigation items. This text is just an example.
                  </div>
               </li>
            </ul>
         </li>
      </ul>
      <ul class="bottom-nav">
         <li class="email">
            <a class="text-success" href="home.html">
               <p class="h5 m-0"><i class="icofont-home text-success"></i></p>
               Home
            </a>
         </li>
         <li class="github">
            <a href="cart.html">
               <p class="h5 m-0"><i class="icofont-cart"></i></p>
               CART
            </a>
         </li>
         <li class="ko-fi">
            <a href="help_ticket.html">
               <p class="h5 m-0"><i class="icofont-headphone"></i></p>
               Help
            </a>
         </li>
      </ul>
   </nav>
   <!-- footer -->
   <footer class="section-footer border-top bg-white">
      <section class="footer-top py-4">
         <div class="container">

            <!-- row.// -->
         </div>
         <!-- //container -->
      </section>
      <!-- footer-top.// -->

      <!-- footer-top.// -->

      <div class="modal fade right-modal" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-header p-0">
                  <nav class="schedule w-100">
                     <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-link active col-5 py-4" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                           role="tab" aria-controls="nav-home" aria-selected="true">
                           <p class="mb-0 font-weight-bold">Sign in</p>
                        </a>
                        <a class="nav-link col-5 py-4" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                           role="tab" aria-controls="nav-profile" aria-selected="false">
                           <p class="mb-0 font-weight-bold">Sign up</p>
                        </a>
                        <a class="nav-link col-2 p-0 d-flex align-items-center justify-content-center"
                           data-dismiss="modal" aria-label="Close">
                           <h1 class="m-0 h4 text-dark"><i class="icofont-close-line"></i></h1>
                        </a>
                     </div>
                  </nav>
               </div>
               <div class="modal-body p-0">
                  <div class="tab-content" id="nav-tabContent">
                     <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                        aria-labelledby="nav-home-tab">
                        <div class="osahan-signin p-4 rounded">
                           <div class="p-2">
                              <h2 class="my-0">Welcome Back</h2>
                              <p class="small mb-4">Sign in to Continue.</p>
                              <form action="verification.html">
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input placeholder="Enter Email" type="email" class="form-control"
                                       id="exampleInputEmail1" aria-describedby="emailHelp">
                                 </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input placeholder="Enter Password" type="password" class="form-control"
                                       id="exampleInputPassword1">
                                 </div>
                                 <button type="submit" class="btn btn-success btn-lg rounded btn-block">Sign in</button>
                              </form>
                              <p class="text-muted text-center small m-0 py-3">or</p>
                              <a href="verification.html" class="btn btn-dark btn-block rounded btn-lg btn-apple">
                                 <i class="icofont-brand-apple mr-2"></i> Sign up with Apple
                              </a>
                              <a href="verification.html"
                                 class="btn btn-light border btn-block rounded btn-lg btn-google">
                                 <i class="icofont-google-plus text-danger mr-2"></i> Sign up with Google
                              </a>
                              <p class="text-center mt-3 mb-0"><a href="signup.html" class="text-dark">Don't have an
                                    account? Sign up</a></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </div>

      <!-- End Dark mode -->
   </footer>
   <!-- Bootstrap core JavaScript -->
   <div class="modal fade right-modal" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header p-0">
               <nav class="schedule w-100">
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                     <a class="nav-link active col-5 py-4" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                        role="tab" aria-controls="nav-home" aria-selected="true">
                        <p class="mb-0 font-weight-bold">Sign in</p>
                     </a>
                     <a class="nav-link col-5 py-4" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                        role="tab" aria-controls="nav-profile" aria-selected="false">
                        <p class="mb-0 font-weight-bold">Sign up</p>
                     </a>
                     <a class="nav-link col-2 p-0 d-flex align-items-center justify-content-center" data-dismiss="modal"
                        aria-label="Close">
                        <h1 class="m-0 h4 text-dark"><i class="icofont-close-line"></i></h1>
                     </a>
                  </div>
               </nav>
            </div>


         </div>
      </div>
   </div>




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
            <div class="modal-header">
               <h6 class="" id="tituloConfirmacion"></h6>
            </div>
            <div id="mensajeConfirmacion" class="modal-body">
            </div>
            <div class="modal-footer">
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
            <div class="modal-header">
               <h4 class="modal-title" id="TituloModal"></h4>
            </div>
            <div class="modal-body" id="CuerpoModal">
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

</html>

<?php include("includes/footer.php")  ?>
<script src="js/modalMensaje.js"></script>
<script>
   $(document).ready(function () {
      $("#ContenedorPaginas").load('/TopuvaWeb/Vistas/home.php');
   });
</script>