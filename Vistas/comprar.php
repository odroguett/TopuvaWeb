<?php 
include("../BD/catalogoBD.php");
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
      
      $totalProductos = $totalProductos + (int)$value['Cantidad'];;
      $totalPago = $totalPago + (int)$value['Precio'];
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

<input id="comIdDespacho" type="text" class="text-info" value="<?php echo $idDespacho; ?>"   hidden >

<body class="fixed-bottom-padding">




   <section class="py-4 osahan-main-body">
      <div class="container">
         <div class="row">
            <div class="col-lg-8">
               <div class="accordion" id="accordionExample">
                  <!-- cart items -->
                  <div class="card border-0 osahan-accor rounded shadow-sm overflow-hidden">
                     <!-- cart header -->
                     <div class="card-header bg-white border-0 p-0" id="headingOne">
                        <h2 class="mb-0">
                           <button
                              class="btn d-flex align-items-center bg-white btn-block text-left btn-lg h5 px-3 py-4 m-0"
                              type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                              aria-controls="collapseOne">
                              <span class="c-number">1</span> <?php  echo "Total Productos: " .  $totalProductos    ?>
                           </button>
                        </h2>
                     </div>
                     <!-- body cart items -->
                     <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                        data-parent="#accordionExample">
                        <div class="card-body p-0 border-top">

                           <div class="osahan-cart">
                              <?php foreach($arrayCarrito as $filas => $value)
                            { 
                              if(isset($value['Producto']))
                              {
                               ?>
                              <div class="cart-items bg-white position-relative border-bottom">

                                 <div class="d-flex  align-items-center p-3">
                                    <a href="#"><img src="img/cart/g1.png" class="img-fluid"></a>
                                    <a href="#" class="ml-3 text-dark text-decoration-none w-100">
                                       <h6 class="font-weight-light text-dark">
                                          <?php if(isset($value['Producto'])) { echo $value['Producto']; } ?></h5>
                                          <div class="d-flex align-items-center">
                                             <p class="total_price m-0 font-weight-light text-danger">
                                                <?php if(isset($value['Precio'])) {echo '$ ' .  $value['Precio']; } ?>
                                             </p>
                                             <form id='myform' class="cart-items-number d-flex ml-auto" method='POST'
                                                action='#'>
                                                <input type='button' value='-' class='qtyminus btn btn-success btn-sm'
                                                   field='quantity' disabled />
                                                <input type='text' name='quantity'
                                                   value=' <?php if(isset($value['Cantidad'])) {  echo $value['Cantidad']; } ?> '
                                                   class='qty form-control' readonly />
                                                <input type='button' value='+' class='qtyplus btn btn-success btn-sm'
                                                   field='quantity' disabled />
                                             </form>
                                          </div>
                                    </a>
                                 </div>
                              </div>

                              <?php 

                            }; 
                            }
                           ?>

                              <div>
                                 <a href="#" class="text-decoration-none btn btn-block p-3" type="button"
                                    data-toggle="collapse" data-target="#collapsetwo" aria-expanded="true"
                                    aria-controls="collapsetwo">
                                    <div class="rounded shadow bg-info d-flex align-items-center p-3 text-white">
                                       <div class="more">
                                          <h6 class="m-0"><?php echo 'SUB TOTAL $ CLP ' . $totalPago?> </h6>
                                          <p class="small m-0">Selecciona Medio de envio</p>
                                       </div>
                                       <div class="ml-auto"><i class="icofont-simple-right"></i></div>
                                    </div>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- cart address -->
                  <div class="card border-0 osahan-accor rounded shadow-sm overflow-hidden mt-3">
                     <!-- address header -->
                     <div class="card-header bg-white border-0 p-0" id="headingtwo">
                        <h2>
                           <button class="btn d-flex align-items-center bg-white btn-block text-left btn-lg  m-0"
                              type="button" data-toggle="collapse" data-target="#collapsetwo" aria-expanded="true"
                              aria-controls="collapsetwo">
                              <span class="c-number">2</span> Medio de Entrega
                           </button>
                           <div class="p-3 row">
                              <div class="col-md">
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="rdDespacho" type="radio"
                                       name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
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
                     </h2>

                     <!-- body address -->
                     <div id="collapsetwo" class="collapse" aria-labelledby="headingtwo"
                        data-parent="#accordionExample">

                        <div class="card-body p-0 border-top">
                           <div class="osahan-order_address">
                              <div class="p-3 row">
                                 <div
                                    class="custom-control col-lg-6 custom-radio mb-3 position-relative border-custom-radio">
                                    <input type="radio" id="customRadioInline1" name="customRadioInline1"
                                       class="custom-control-input" checked>
                                    <label class="custom-control-label w-100" for="customRadioInline1">
                                       <div id="classDespacho">
                                          <div class="p-3 bg-white rounded shadow-sm w-100">
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
                                                            class=" text-primary   ">Agregar/Modificar</a>
                                                </span></p>
                                          </div>
                                          
                                          <div class="col-md-6">
                                             <a href="#" id="btnEliminarDespacho" data-toggle="modal"
                                                data-target="#exampleModal"
                                                class="text-primary rounded ">Eliminar</a></span></p>
                                          </div>
                                       </div>
                                       <div class="row ">
                                          <div class="col-md-12">
                                             <label id="comDireccion" type="text" class="text-info font-weight-bold"><?php echo $direccion ?> </label>
                                          </div>

                                       </div>
                                       <div class="row ">

                                          <div class="col-md-6">
                                             <label id="comComuna" type="text" class="text-info font-weight-bold"><?php echo $comuna ?> </label>
                                          </div>
                                          <div class="col-md-6">
                                             <label id="comCiudad" type="text" class="text-info font-weight-bold"><?php echo $ciudad ?>  </label>
                                          </div>

                                       </div>
                                       <div class="row ">

                                          <div class="col-md-9">
                                             <label id="comRegion" type="text" class="text-info font-weight-bold"><?php echo $region ?>  </label>
                                          </div>

                                          <div class="col-md-3">
                                             <label id="comDepartamento" type="text" class="text-info font-weight-bold"><?php echo $departamento ?> </label>
                                          </div>
                                       </div>


                                 </div>

                              </div>
                              <div hidden id="classRetiro">
                                 <div class="p-4 bg-white rounded shadow-sm w-200">
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


                           <a href="#" id="btnContinuarPago" class="btn btn-primary  btn-block" type="button"
                              data-toggle="collapse" data-target="#collapsethree" aria-expanded="true"
                              aria-controls="collapsethree">Continuar Pago</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="sticky_sidebar">
            <div class="bg-white rounded overflow-hidden shadow-sm mb-3 checkout-sidebar">
               <div class="d-flex align-items-center osahan-cart-item-profile border-bottom bg-white p-3">
                  <img alt="osahan" src="img/starter1.jpg" class="mr-3 rounded-circle img-fluid">
                  <div class="d-flex flex-column">
                     <h6 class="mb-1 font-weight-bold">TOPUVA</h6>
                     <p class="mb-0 small text-muted"><i class="feather-map-pin"></i> Andres Bello 514, Puerto
                        Varas</p>
                  </div>
               </div>
               <div>
                  <div class="bg-white p-3 clearfix">
                     <p class="mb-1">Total Productos <span
                           class="small text-muted"><?php  echo '(' . $totalProductos . ')' ?> </span> </p>
                     <p class="mb-3 text-info">Importante: Costo Envio corresponde a 4.000 CLP, por compras menores a 40.000. <span data-toggle="tooltip" data-placement="top"
                           class="text-info ml-1"><i class="icofont-info-circle"></i></span></p>

                  </div>
                  <div class="p-3 border-top">
                     <h6 class="mb-0">PAGO <span class="float-right text-info"><?php echo $totalPago  ?> </span>
                     </h5>
                  </div>
               </div>
            </div>

         </div>
      </div>
      </div>
      </div>
   </section>
   <!-- Modal -->
   <div class="modal fade" id="modalDireccion" tabindex="-1" role="dialog" aria-labelledby="modalDireccion" >
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content" id="mContent">


         </div>
      </div>
   </div>





</body>

</html>

<?php include("../includes/footer.php")  ?>