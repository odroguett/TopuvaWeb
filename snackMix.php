<?php 
include("includes/BD/catalogoBD.php");
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
      <link rel="stylesheet" type="text/css" href="vendor/slick/slick.min.css"/>
      <link rel="stylesheet" type="text/css" href="vendor/slick/slick-theme.min.css"/>
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
      <div class="title d-flex align-items-center py-3">
   
</div>
<!-- pick today -->
<div class="d-flex align-items-center mb-3">
      <h4>Snack y Mix</h4>
</div>
<div class="pick_today">

   <div class="row">

   <?php 
           $oCatalogo= new catalogoBD();
           $Listafilas=$oCatalogo->obtienePrecioProductos('3');
           if(isset($Listafilas))
           {

            echo 'Productos no disponibles';
           }
           foreach($Listafilas as $filas => $value)
           {
        ?>

      <div class="col-6 col-md-3 mb-3">
         <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
            <div class="list-card-image">
               <a href="promo1.php" class="text-dark">
                  
                  <div class="p-3 claseTexto" >
                     <img src="img/listing/v2.jpg" class="img-fluid item-img w-100 mb-3">
                     <h6 class="textoProducto"><?php echo $value['DESCRIPCION']    ?></h6>
                     <div class="d-flex align-items-center precio">
                        <h6 class="price m-0 text-success"><?php echo  ' $'  . $value['precio_venta'] . ' ' . $value['tamano_unidad']  . '/' .  $value['codigo_unidad']   ?></h6>
                        <a data-toggle="collapse" href="#collapseExample2" role="button"
                           aria-expanded="false" aria-controls="collapseExample2"
                           class="btn btn-success btn-sm ml-auto">+</a>
                           
                        <div class="collapse qty_show" id="collapseExample2">
                           <div>
                              <span class="ml-auto" href="#">
                                 <form id='myform' class="cart-items-number d-flex" method='POST'
                                    action='#'>
                                    <input type='button' value='-'
                                       class='qtyminus btn btn-success btn-sm ' field='quantity' />
                                    <input type='text' name='quantity' value='1'
                                       class='qty form-control cantidad' />
                                    <input type='button' value='+'
                                       class='qtyplus btn btn-success btn-sm ' field='quantity' />
                                 </form>
                                
                              </span>
                           </div>
                           
                        </div>
                     </div>
                     <div class="input-group-prepend">
                        <div class="btn btn-success rounded-right btn-valor"><i class="icofont-shopping-cart"></i></div>
                        </div>
                  </div>
                  
               </a>
               
               
            </div>
         </div>
      </div>
      <?php 
               }
   
      ?>
      </div>

   
	
</div>


      </section>
  
     
    
 
   </body>
</html>

