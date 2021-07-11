<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/TopuvaWeb/rutas.php');
require_once(BD . "catalogoBD.php");
require_once(COMPARTIDA . "parametros.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">
   <link rel="icon" type="image/png" href="img/logo.png">
   <title>Frutos Secos</title>
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

      <!-- pick today -->
      <div class="d-flex align-items-center mb-3">
         <h5 style="text-align: left;" class="text-kumel-titulo ">Semillas</h5>
      </div>
      <div class="pick_today">

         <div class="row">

            <?php 
           $oCatalogo= new catalogoBD();
           $Listafilas=$oCatalogo->obtienePrecioProductos('SEM');
           foreach($Listafilas as $filas => $value)
           {
               ?>
            <?php 
                           if ($value['stock'] <=0)
                           {     
                           ?>
            <div class="col-sm-12 col-md-6 col-lg-3">
               <div class="list-card bg-light h-100 rounded overflow-hidden position-relative shadow-sm">
                  <div class="list-card-image">

                     <a onclick="oCarrito.LinkProducto( '<?php echo $value['imagen'] ?>','<?php echo $value['descripcion']  ?>','<?php echo $value['precio_venta'] ?>','<?php echo $value['tamano_unidad'] ?>','<?php echo $value['codigo_unidad'] ?>','<?php echo $value['stock'] ?>','<?php echo $value['codigo_precio_producto'] ?>')"
                        href="#" class="text-dark">

                        <div class=" claseTexto col-sm-12 col-md-12 col-lg-12">

                           <input type="text" class="text-info codigo-precio-producto"
                              value="<?php echo $value['codigo_precio_producto']; ?>" hidden>
                           <input type="text" class="text-info stock-producto" value="<?php echo $value['stock']; ?>"
                              hidden>
                           <div class="contenedor-imagen col-sm-12 col-md-12 col-lg-12">
                              <figure>
                                 <img class="imagen-producto" src="<?php echo $value['imagen']; ?>">
                                 </img>

                                 <div class="capa">

                                    <h3 class=""><?php echo $value['titulo']; ?></h3>
                                    <p>
                                       <?php if(isset($value['parrafo1'])){echo $value['parrafo1']; }  ?>
                                       <?php if(isset($value['parrafo2'])){echo $value['parrafo2']; }   ?>
                                       <?php if(isset($value['parrafo3'])){echo $value['parrafo3']; }  ?>
                                       <?php if(isset($value['parrafo4'])){echo $value['parrafo4']; }  ?>
                                    </p>

                                 </div>

                              </figure>

                           </div>



                           <div class="col-sm-12 col-md-12 col-lg-12" style="text-align: center;">
                              <h6 class="textoProducto text-kumel-titulo">
                                 <?php echo $value['descripcion'] . ' ' . $value['tamano_unidad']  .  $value['codigo_unidad']    ?>
                              </h6>

                           </div>

                           <div class="col-lg-6">
                              <div class=" form-inline precio">
                                 <div class="col-lg-3">

                                    <span class="ml-auto" href="#" hidden>
                                       <form id='myform' class="cart-items-number d-flex" method='POST' action='#'>
                                          <input type='button' value='-' class='qtyminus btn btn-success btn-sm '
                                             field='quantity' />
                                          <input type='text' name='quantity ' value='1'
                                             class='qty form-control cantidad' />
                                          <input type='button' value='+' class='qtyplus btn btn-success btn-sm '
                                             field='quantity' />
                                       </form>

                                    </span>

                                 </div>

                                 <div class="col-lg-4" hidden>
                                    <div class="input-group-prepend">
                                       <div class=" btn btn-icon btn-light btn-valor"><i
                                             class="icofont-shopping-cart"></i></div>
                                    </div>
                                 </div>

                                 <div class="col-lg-5" hidden>
                                    <h6 class="text-kumel-texto-1">
                                       <?php echo  'Disponible:'. ' ' . $value['stock']  ?> </h6>
                                 </div>

                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12 " style="text-align: center;">
                                 <h6 class="txtStock font-weight-light text-danger">
                                    <?php echo 'Producto no disponible'    ?> </h6>
                              </div>
                           </div>

                        </div>
                     </a>

                  </div>
               </div>
            </div>



            <?php 

                           }
                           else{
                              ?>
            <div class="col-sm-12 col-md-6 col-lg-3">
               <div class="list-card bg-light h-100 rounded overflow-hidden ">
                  <div class="list-card-image">
                     <a onclick="oCarrito.LinkProducto( '<?php echo $value['imagen'] ?>','<?php echo $value['descripcion']  ?>','<?php echo $value['precio_venta'] ?>','<?php echo $value['tamano_unidad'] ?>','<?php echo $value['codigo_unidad'] ?>','<?php echo $value['stock'] ?>','<?php echo $value['codigo_precio_producto'] ?>')"
                        href="#" class="text-dark">

                        <div class="col-sm-12 col-md-12 col-lg-12 claseTexto">
                           <input type="text" class="text-info codigo-precio-producto"
                              value="<?php echo $value['codigo_precio_producto']; ?>" hidden>
                           <input type="text" class="text-info stock-producto" value="<?php echo $value['stock']; ?>"
                              hidden>


                           <div class="contenedor-imagen">
                              <figure>
                                 <img style="" src="<?php echo $value['imagen']; ?>">

                                 <div class="capa">

                                    <h3 class="text-kumel-texto_bold"><?php echo $value['titulo']; ?></h3>
                                    <p class="text-kumel-texto">
                                       <?php if(isset($value['parrafo1'])){echo $value['parrafo1']; }  ?>
                                       <?php if(isset($value['parrafo2'])){echo $value['parrafo2']; }   ?>
                                       <?php if(isset($value['parrafo3'])){echo $value['parrafo3']; }  ?>
                                       <?php if(isset($value['parrafo4'])){echo $value['parrafo4']; }  ?>
                                    </p>

                                 </div>

                              </figure>


                           </div>



                           <div class="col-sm-12 col-md-12 col-lg-12" style="text-align: center;">
                              <h6 class="textoProducto text-kumel-titulo">
                                 <?php echo $value['descripcion'] . ' ' . $value['tamano_unidad']  .  $value['codigo_unidad']    ?>
                              </h6>

                           </div>




                           <div class=" col-sm-12 col-md-12 col-lg-12 price" style="text-align: center;">
                              <h6 class=" text-kumel-bold" style="margin-bottom: 4%;">
                                 <?php echo  ' CLP '  . number_format($value['precio_venta'],0,',','.')    ?>
                              </h6>
                           </div>



                           
                              <div class="col-lg-12 col-sm-12 col-md-12" style="margin-left: 8%;">
                              <div class="form-inline">
                                 <div class="col-lg-4 col-sm-4 col-md-4">

                                    <span class="" href="#">
                                       <form id='myform' class="cart-items-number d-flex" method='POST' action='#'>
                                          <input type='button' value='-' class='qtyminus btn btn-success btn-sm '
                                             field='quantity' />
                                          <input type='text' name='quantity ' value='1'
                                             class='qty form-control cantidad' />
                                          <input type='button' value='+' class='qtyplus btn btn-success btn-sm '
                                             field='quantity' />
                                       </form>

                                    </span>
                                 </div>
                                 <div class="col-lg-4 col-sm-4 col-md-4">
                                    <div class="input-group-prepend">
                                       <div class=" btn btn-icon btn-light btn-valor"><i
                                             class="icofont-shopping-cart"></i>
                                       </div>
                                    </div>
                                 </div>
                                
                                 <div class="col-sm-4 col-lg-4 col-md-5 ">
                                    <h7 class="text-kumel-texto-1">
                                       <?php echo  'Stock:'. ' ' . $value['stock']  ?> </h6>
                                 </div>
                              </div>



                           </div>




                           <br>


                        </div>
                     </a>

                  </div>






               </div>
            </div>

            <?php
                   }     
               }
                  ?>
         </div>
      </div>
   </section>
</body>
</html>
<?php include("../includes/footer.php")  ?>