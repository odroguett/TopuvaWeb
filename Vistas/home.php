<?php 
require_once("../BD/catalogoBD.php");
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
</div>

<br />
<div class="container" style="max-width: 100%;">
   <section class="py-4 osahan-main-body">

      <!-- pick today -->
      <div class="d-flex align-items-center mb-3">
         <h5 style="text-align: left;" class="text-kumel-titulo">Mas Vendidos</h5>
      </div>


      <div class="row">

         <?php 
           $oCatalogo= new catalogoBD();
           $Listafilas=$oCatalogo->obtieneTopVentas();
           foreach($Listafilas as $filas => $value)
           {
        ?>
         <?php 
                           if ($value['stock'] ==0)
                           {     
                           ?>

         <div class="list-card bg-light h-100 rounded overflow-hidden position-relative shadow-sm">
            <div class="list-card-image">

               <a onclick="oCarrito.LinkProducto('<?php echo $value['descripcion']  ?>','<?php echo $value['precio_venta'] ?>','<?php echo $value['tamano_unidad'] ?>','<?php echo $value['codigo_unidad'] ?>','<?php echo $value['stock'] ?>')"
                  href="#" class="text-dark">

                  <div class="p-3 claseTexto" disabled>

                     <input type="text" class="text-info codigo-precio-producto"
                        value="<?php echo $value['codigo_precio_producto']; ?>" hidden>
                     <img src="img/listing/v2.jpg" class="img-fluid item-img w-100 mb-3">


                     <h6 class="textoProducto text-kumel-titulo">
                        <?php echo $value['descripcion'] . ' ' . $value['tamano_unidad']  .  $value['codigo_unidad']    ?>
                     </h6>
                     <div class="d-flex align-items-center precio">
                        <h6 class="price m-0 text-kumel-bold">
                           <?php echo  ' $'  . number_format($value['precio_venta'],0,',','.')    ?></h6>


                        <a data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false"
                           aria-controls="collapseExample2" class="btn btn-success btn-sm ml-auto">+</a>

                        <div class="collapse qty_show" id="collapseExample2">
                           <div>
                              <span class="ml-auto" href="#" disabled>
                                 <form id='myform' class="cart-items-number d-flex" method='POST' action='#'>
                                    <input type='button' value='-' class='qtyminus btn btn-success btn-sm '
                                       field='quantity' disabled />
                                    <input type='text' id="cantidadProd" name='quantity ' value='1'
                                       class='qty form-control cantidad ' />
                                    <input type='button' value='+' class='qtyplus btn btn-success btn-sm '
                                       field='quantity' disabled />
                                 </form>

                              </span>
                           </div>

                        </div>
                     </div>
                     <div class="input-group-prepend " hidden>
                        <div class=" btn btn-icon btn-light btn-valor" hidden><i class="icofont-shopping-cart"
                              hidden></i></div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 ">
                           <h6 class="txtStock font-weight-light text-danger">
                              <?php echo 'Producto no disponible'    ?> </h6>
                        </div>
                     </div>
               </a>


               <?php 

                           }
                           else{
                              ?>
               <div class="col-6 col-md-3 mb-3">
                  <div class="list-card bg-light h-100 rounded overflow-hidden position-relative shadow-sm">
                     <div class="list-card-image">
                        <a onclick="oCarrito.LinkProducto('<?php echo $value['descripcion']  ?>','<?php echo $value['precio_venta'] ?>','<?php echo $value['tamano_unidad'] ?>','<?php echo $value['codigo_unidad'] ?>','<?php echo $value['stock'] ?>')"
                           href="#" class="text-dark">

                           <div class="p-3 claseTexto">

                              <input type="text" class="text-info codigo-precio-producto"
                                 value="<?php echo $value['codigo_precio_producto']; ?>" hidden>
                              <img src="img/listing/v2.jpg" class="img-fluid item-img w-100 mb-3">


                              <h6 class="textoProducto text-kumel-titulo">
                                 <?php echo $value['descripcion'] . ' ' . $value['tamano_unidad']  .  $value['codigo_unidad']    ?>
                              </h6>
                              <div class="d-flex align-items-center precio">
                                 <h6 class="price m-0 text-kumel-bold">
                                    <?php echo  ' $'  . number_format($value['precio_venta'],0,',','.')    ?></h6>


                                 <a data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false"
                                    aria-controls="collapseExample2" class="btn btn-success btn-sm ml-auto">+</a>

                                 <div class="collapse qty_show" id="collapseExample2">
                                    <div>
                                       <span class="ml-auto" href="#">
                                          <form id='myform' class="cart-items-number d-flex" method='POST' action='#'>
                                             <input type='button' value='-' class='qtyminus btn btn-success btn-sm '
                                                field='quantity' />
                                             <input type='text' id="cantidadProd" name='quantity ' value='1'
                                                class='qty form-control cantidad ' />
                                             <input type='button' value='+' class='qtyplus btn btn-success btn-sm '
                                                field='quantity' />
                                          </form>

                                       </span>
                                    </div>

                                 </div>
                              </div>
                              <div class="input-group-prepend">
                                 <div class=" btn btn-icon btn-light btn-valor"><i class="icofont-shopping-cart"></i>
                                 </div>
                              </div>
                        </a>
                        <?php 
                           }    
                              ?>
                     </div>




                  </div>
               </div>
            </div>

            <?php 
               }
      ?>







   </section>
</div>


<div class="container" style="max-width: 100%;">

   <h5 style="text-align: left;" class="text-kumel-titulo font-weight-light ">Comunas de despacho</h5>
   <div class="col-lg-12  bg-light">

      <img class="img-despacho" src="img/despacho.jpg">

   </div>
</div>

<div class="col-lg-12">
   <hr></span>

</div>
<div class="container" style="max-width: 100%;">
   <br />
   <br />
   <div class="row">


      <div class="col-lg-12 p-4 bg-light rounded shadow-sm">
         <h5 style="text-align: left;" class="text-kumel-titulo  font-weight-light">Nosotros</h5>
         <div id="terms_conditions">
            <p class="text-muted">
            </p>
         </div>

      </div>
   </div>

</div>
</div>
</body>

</html>
<script src="vendor/jquery/jquery.min.js"></script>
<script type="text/javascript" src="vendor/jquery/dataTables.js"></script>
 <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- slick Slider JS-->
 <script type="text/javascript" src="vendor/slick/slick.min.js"></script>
 <!-- Sidebar JS-->
 <script type="text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>
 <!-- Custom scripts for all pages-->
 <script src="js/osahan.js"></script>
 <script src="js/topuva.js"></script>
