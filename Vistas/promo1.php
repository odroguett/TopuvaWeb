<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/TopuvaWeb/rutas.php');
require_once(BD . "catalogoBD.php");
require_once(COMPARTIDA . "parametros.php");
$oCatalogo= new catalogoBD();
$sDescripcion = $_POST['descripcion']; 
$vPrecioVenta =$_POST["precioVenta"];
$tamanoUnidad =$_POST["tamanoUnidad"];
$sCodigoUnidad =$_POST["codigoUnidad"];
$cantidad =$_POST["cantidad"];
$stock=$_POST["stock"];


$Listafilas=$oCatalogo->obtieneDisponibleProductos($sDescripcion);
$sDiponible= ' ';

foreach($Listafilas as $filas => $value)
           {

            $sDiponible = $sDiponible .  $value['tamano'] . ' ' . $value['codigo_unidad'] . ', ';

         //   $stock = $value['stock'];
            

           }


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">
   <link rel="icon" type="image/png" href="img/logo.png">
   <title>TOPUVA</title>
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
</head>

<body class="fixed-bottom-padding">

   <!-- body -->
   <section class="py-4 osahan-main-body">
      <div class="container">
         <div class="row">
            <div class="col-lg-6">

               <div class="osahan-slider-item">
                  <img src="img/recommend/r1.jpg" class="img-fluid mx-auto shadow-sm rounded" alt="Responsive image">
               </div>
               </br>
               <div class="row">

               </div>
            </div>
            <div class="col-lg-6 claseTexto">

               <div class="p-4 bg-light rounded shadow-sm ">


                  <h5 tyle="text-align: left;" class="text-dark textoProducto">
                     <?php echo $sDescripcion . ' ' . $tamanoUnidad .$sCodigoUnidad ?></h5>
                  <?php 
               if($stock==0)
               {
               ?>
                  <div class="row">
                     <div class="col-md-12 ">
                        <h6 class="txtStock font-weight-light text-danger">
                           <?php echo 'Producto no disponible'    ?> </h5>
                     </div>
                  </div>
                  <?php 
               } ?>

                  <p class=" h6 font-weight-light text-dark m-0 d-flex align-items-center">
                     Precio Unidad (CLP) : <b
                        class="h6 m-0 font-weight-light text-info price"><?php echo ' ' .  number_format($vPrecioVenta,0,',','.')   ?></b>
                  </p>
                  </br>
                  <?php 
               if($stock==0)
               {
               ?>
                  <div class="row justify-content-start ">
                     <div class="col-3">
                        <form id="myform" class="cart-items-number d-flex" method="POST" action="#">
                           <input type="button" value="-" class="qtyminus btn btn-success btn-sm" field="quantity"
                              disabled>
                           <input type="text" name="quantity" value='<?php echo $cantidad  ?>'
                              class="qty form-control cantidad">
                           <input type="button" value="+" class="qtyplus btn btn-success btn-sm" field="quantity"
                              disabled>
                        </form>
                     </div>
                     <?php 
               }
               else
               {
?>
                     <div class="row justify-content-start ">
                        <div class="col-3">
                           <form id="myform" class="cart-items-number d-flex" method="POST" action="#">
                              <input type="button" value="-" class="qtyminus btn btn-success btn-sm" field="quantity">
                              <input type="text" name="quantity" value='<?php echo $cantidad  ?>'
                                 class="qty form-control cantidad">
                              <input type="button" value="+" class="qtyplus btn btn-success btn-sm" field="quantity">
                           </form>
                        </div>
                        <?php 
               }
                     
               if($stock==0)
               {
               ?>
                        <div class="col-9  align-items-right">
                           <button type="button" id="btnAgregarCarro" class="btn btn-info rounded  btn-block  "
                              disabled> Agregar al
                              Carro</button>
                        </div>
                        <?php 
               }
               else
               {
                     ?>
                        <div class="col-9  align-items-right">
                           <button type="button" id="btnAgregarCarro" class="btn btn-info rounded  btn-block  "
                              > Agregar al
                              Carro</button>
                        </div>
                        <?php 
               }
                     ?>


                     </div>
                     </br>
                     <div class="row divider">
                        <div class="col-3">
                           <p class="h6 font-weight-light text-dark">Disponible en:</p>

                        </div>
                     </div>
                     <div class="row">
                        <div class="col-9">
                           <p class="text-info m-0"><?php echo $sDiponible ?></p>
                        </div>
                     </div>
                  </div>


                  <div class="details">
                     <div class="pt-3 bg-light">
                        <p class="font-weight-light text-dark">Finas almendras naturales.........</p>
                     </div>

                  </div>



               </div>




            </div>
         </div>
      </div>
      <h5 style="text-align: left;" class="text-secondary font-weight-bold ">Productos Similares</h5>
      <div class="pick_today">

         <div class="row">

            <?php 
           $oCatalogo= new catalogoBD();
           $Listafilas=$oCatalogo->obtieneProductosRelacionados($sDescripcion);
           foreach($Listafilas as $filas => $value)
           {
        ?>

            <div class="col-6 col-md-3 mb-3">
               <div class="list-card bg-light h-100 rounded overflow-hidden position-relative shadow-sm">
                  <?php 
               if($value['stock']==0)
               {
               ?>
                  <div class="list-card-image">


                     <div class="p-3 claseTexto">
                        <img src="img/listing/v2.jpg" class="img-fluid item-img w-100 mb-3">
                        <h6 class="textoProducto font-weight-light text-dark">
                           <?php echo $value['descripcion'] . ' ' . $value['tamano_unidad']  .  $value['codigo_unidad']    ?>
                        </h6>
                        <div class="d-flex align-items-center precio">
                           <h6 class="price m-0 font-weight-light text-info">
                              <?php echo  ' $'  . number_format($value['precio_venta'],0,',','.')      ?></h6>
                           <a data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false"
                              aria-controls="collapseExample2" class="btn btn-success btn-sm ml-auto">+</a>

                           <div class="collapse qty_show" id="collapseExample2">
                              <div>
                                 <span class="ml-auto" href="#">
                                    <form id='myform' class="cart-items-number d-flex" method='POST' action='#'>
                                       <input type='button' value='-' class='qtyminus btn btn-success btn-sm '
                                          field='quantity' disabled />
                                       <input type='text' name='quantity ' value='1' class='qty form-control cantidad '
                                          disabled />
                                       <input type='button' value='+' class='qtyplus btn btn-success btn-sm '
                                          field='quantity' disabled />
                                    </form>

                                 </span>
                              </div>

                           </div>
                        </div>
                        <div class="input-group-prepend" hidden>
                           <div class=" btn btn-icon btn-light btn-valor" hidden><i class="icofont-shopping-cart"></i>
                           </div>
                        </div>
                     </div>




                  </div>
                  <?php 
               }
               else
               {
                ?>
                  <div class="list-card-image">


                     <div class="p-3 claseTexto">
                        <img src="img/listing/v2.jpg" class="img-fluid item-img w-100 mb-3">
                        <h6 class="textoProducto font-weight-light text-dark">
                           <?php echo $value['descripcion'] . ' ' . $value['tamano_unidad']  .  $value['codigo_unidad']    ?>
                        </h6>
                        <div class="d-flex align-items-center precio">
                           <h6 class="price m-0 font-weight-light text-info">
                              <?php echo  ' $'  . number_format($value['precio_venta'],0,',','.')   ?></h6>
                           <a data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false"
                              aria-controls="collapseExample2" class="btn btn-success btn-sm ml-auto">+</a>

                           <div class="collapse qty_show" id="collapseExample2">
                              <div>
                                 <span class="ml-auto" href="#">
                                    <form id='myform' class="cart-items-number d-flex" method='POST' action='#'>
                                       <input type='button' value='-' class='qtyminus btn btn-success btn-sm '
                                          field='quantity' />
                                       <input type='text' name='quantity ' value='1'
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
                     </div>




                  </div>
                  <?php 
                
               }
                ?>

               </div>
            </div>
            <?php 
               }
   
      ?>
         </div>
      </div>
      </div>
   </section>

   <!-- footer -->


   <?php include("../includes/footer.php")  ?>

</body>

</html>