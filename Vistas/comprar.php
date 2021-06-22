<?php 
require_once("../BD/catalogoBD.php");
$arrayCarrito = json_decode($_POST["arrayCarrito"],true); 
$comuna =$_POST["comuna"];
$ciudad = $_POST["ciudad"];
$region =$_POST["region"];
$departamento = $_POST["departamento"];
$direccion = $_POST["direccion"];
$idDespacho = $_POST["idDespacho"];
$totalProductos=0;
$totalPago=0;

foreach($arrayCarrito as $filas => $value)
{
   if(isset($value['Producto']))
   {
      
      $totalProductos = $totalProductos + (int)$value['Cantidad'];
      $totalPago = ($totalPago + (int)$value['Precio'] * (int)$value['Cantidad'] );
   }
 
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
   <title>Vegishop - Online Grocery Supermarket HTML Template</title>
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

<input id="comIdDespacho" type="text" class="text-info" value="<?php echo $idDespacho; ?>" hidden >
<input id="totalProductosPago" type="text" class="text-info" value="<?php echo $totalProductos; ?>" hidden>


<body class="fixed-bottom-padding">




   <section class="py-4 osahan-main-body">




      <div class="card border-0 osahan-accor rounded shadow-sm overflow-hidden mt-3">
         <div class="accordion" id="accordionExample">
            <!-- cart items -->
            <div class="card border-0 osahan-accor rounded shadow-sm overflow-hidden">
               <!-- cart header -->
               <div class="card-header bg-light border-0 p-0" id="headingOne">
                  <h2 class="mb-0" >
                     <button class="btn d-flex align-items-center bg-light btn-block text-left btn-lg h5 px-3 py-4 m-0"
                        type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                        aria-controls="collapseOne">
                        <span class="c-number">1</span>
                        <div class="form-group">
                        <span>Total Productos</span>
                        <span id="totalProductos"><?php  echo  $totalProductos    ?></span>
                        </div>
                        
                        
                     </button>
                  </h2>
               </div>
               <!-- body cart items -->
               <div id="collapseOne" class="collapse show  total-principal " aria-labelledby="headingOne"
                  data-parent="#accordionExample">
                  <div class="card-body p-0 border-top">

                     <div class="osahan-cart">
                        <?php foreach($arrayCarrito as $filas => $value)
                            { 
                              if(isset($value['Producto']))
                              {
                               ?>
                        <div class="cart-items bg-light position-relative border-bottom comprar">
                           <input id="codigoProducto" type="text" class="text-info codigo-producto"
                              value="<?php echo trim($value['CodigoProducto']); ?>" hidden>

                           <div class="form-inline precio_total">

                              <div class="col-md-5">
                                 <div class="d-flex  align-items-center p-3">
                                    <a href="#"><img src="img/cart/g1.png" class="img-fluid"></a>
                                    <a href="#" class="ml-3 text-dark text-decoration-none w-100 ">
                                       <h6 class="font-weight-light text-dark">
                                          <?php if(isset($value['Producto'])) { echo $value['Producto']; } ?>
                                       </h6>
                                       <div class="d-flex align-items-center   ">
                                          <p class=" m-0 font-weight-light text-primary mostrar-precio ">
                                             <?php if(isset($value['Precio'])) {echo '$ ' .  $value['Precio'] *  $value['Cantidad']; } ?>
                                          </p>

                                       </div>

                                    </a>

                                 </div>
                              </div>
                              <div class="col-md-1 clase-cantidad">
                                 <input type="text" class="precio-total" value="<?php echo $value['Precio'] ; ?>" hidden>
                                 <span class="ml-auto" href="#">
                                    <form id='myform' class="cart-items-number d-flex" method='POST' action='#'>
                                       <input type='button' value='-' class='qtyminus qtyBajar btn btn-success btn-sm '
                                          field='quantity' />
                                       <input type='text' name='quantity ' value=' <?php if(isset($value['Cantidad'])) { echo $value['Cantidad']; } ?>'
                                          class='qty form-control cantidad ' />
                                       <input type='button' value='+' class='qtyplus qtySubir btn btn-success btn-sm '
                                          field='quantity' />
                                    </form>

                                 </span>
                              </div>
                           


                           </div>

                        </div>
                     </div>



                     <?php 

                            }; 
                            }
                           ?>

                     <div>
                        <a href="#" class="text-decoration-none btn btn-block p-3" type="button" data-toggle="collapse"
                           data-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                           <div class="rounded shadow bg-info d-flex align-items-center p-3 text-white">

                              <div class="more">

                                 <div class="form-inline">
                                    <h6 class="text-left"> SUB TOTAL  CLP:    </h6>
                                    <h6 id="subTotal" class="text-left"><?php echo '&nbsp' .    $totalPago   ?>
                                    </h6>

                                 </div>


                                 <h7 class="text-left">Costo por despacho se agrega al finalizar la compra.</h7>

                              </div>

                              <div class="ml-auto"><i class="icofont-simple-right"></i></div>
                           </div>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>

      </div>







      <!-- cart address -->






      <div class="card border-0 osahan-accor rounded shadow-sm overflow-hidden mt-3">
         <!-- address header -->
         <div class="card-header bg-light border-0 p-0" id="headingtwo">

            <button class="btn d-flex align-items-center bg-light btn-block text-left btn-lg  m-0" type="button"
               data-toggle="collapse" data-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
               <span class="c-number">2</span> Medio de Entrega
            </button>
            <div class="p-3 row  bg-light">
               <div class="col-md bg-light">
                  <div class="form-check bg-light  form-check-inline">
                     <input class="form-check-input" id="rdDespacho" type="radio" name="inlineRadioOptions"
                        id="inlineRadio1" value="option1" checked>
                     <label class="form-check-label" for="inlineRadio1">Despacho</label>
                  </div>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" id="rdRetiro" type="radio" name="inlineRadioOptions"
                        id="inlineRadio2" value="option2">
                     <label class="form-check-label" for="inlineRadio2">Retiro</label>
                  </div>

               </div>
            </div>

         </div>


         <!-- body address -->
         <div id="collapsetwo" class="collapse" aria-labelledby="headingtwo" data-parent="#accordionExample">

            <div class="card-body p-0 border-top bg-light">
               <div class="osahan-order_address">
                  <div class="p-3 row">
                     <div class="custom-control col-lg-6 custom-radio mb-3 position-relative border-custom-radio">
                        <input type="radio" id="customRadioInline1" name="customRadioInline1"
                           class="custom-control-input" checked>
                        <label class="custom-control-label w-100" for="customRadioInline1">
                           <div id="classDespacho">
                              <div class="p-3 bg-light rounded shadow-sm w-100">
                                 <div class="d-flex align-items-center mb-2">
                                    <p class="mb-0 h6">Dirección</p>

                                 </div>
                                 <p class="small text-muted m-0"></p>
                                 <p class="small text-muted m-0"></p>
                                 <p class="pt-2 m-0 text-right"><span class="small">
                                       <div class="row form-group">
                                          <div class="col-md-6">
                                             <a href="#" id="btnAgregarDireccion" data-toggle="modal"
                                                data-target="#exampleModal"
                                                class=" text-primary">Agregar/Modificar</a>
                                    </span></p>
                              </div>

                              <div class="col-md-6">
                                 <a href="#" id="btnEliminarDespacho" data-toggle="modal" data-target="#exampleModal"
                                    class="text-primary rounded ">Eliminar</a></span>
                                 </p>
                              </div>
                           </div>
                           <div class="row ">
                              <div class="col-md-12">
                                 <label id="comDireccion" type="text"
                                    class="text-info font-weight-bold"><?php echo $direccion ?> </label>
                              </div>

                           </div>
                           <div class="row ">

                              <div class="col-md-6">
                                 <label id="comComuna" type="text"
                                    class="text-info font-weight-bold"><?php echo $comuna ?> </label>
                              </div>
                              <div class="col-md-6">
                                 <label id="comCiudad" type="text"
                                    class="text-info font-weight-bold"><?php echo $ciudad ?> </label>
                              </div>

                           </div>
                           <div class="row ">

                              <div class="col-md-9">
                                 <label id="comRegion" type="text"
                                    class="text-info font-weight-bold"><?php echo $region ?> </label>
                              </div>

                              <div class="col-md-3">
                                 <label id="comDepartamento" type="text"
                                    class="text-info font-weight-bold"><?php echo $departamento ?> </label>
                              </div>
                           </div>


                     </div>

                  </div>
                  <div hidden id="classRetiro">
                     <div class="p-4 bg-light rounded shadow-sm w-200">
                        <div class="d-flex align-items-center mb-2">
                           <p class="mb-0 h6 font-weight-bold"> Direcciones de Retiro</p>

                        </div>
                        <p class="small text-info m-2 font-weight-bold">Comuna Ñuñoa</p>
                        <p class="small text-info m-2 "> Plaza Egaña/ Metro Linea 4</p>
                        <p class="small text-info m-2 font-weight-bold">Comuna La Florida</p>
                        <p class="small text-info m-2 "> Rojas Magallanes/ Metro Linea 4</p>

                     </div>

                  </div>
                  </label>
               </div>


               <a href="#" id="btnContinuarPago" class="btn btn-primary  btn-block" type="button" data-toggle="collapse"
                  data-target="#collapsethree" aria-expanded="true" aria-controls="collapsethree">Continuar Pago</a>
            </div>
         </div>
      </div>





   </section>
   <!-- Modal -->
   <div class="modal fade" id="modalDireccion" tabindex="-1" role="dialog" aria-labelledby="modalDireccion">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content" id="mContent">


         </div>
      </div>
   </div>





</body>

</html>

<?php include("../includes/footer.php")  ?>