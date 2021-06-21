<?php 

include("../BD/catalogoBD.php");
$arrayPago = $_POST["arrayPago"]; 
$idDespacho = json_decode($_POST["idDespacho"],true); 
$totalProductosPago = json_decode($_POST["totalProductosPago"],true); 
$totalPago = json_decode($_POST["totalPago"],true); 
$idTipoPago =1;
$totalConDespacho =0;
$costoEnvio = 4000;
if($totalPago < 40000)
{
    $totalConDespacho = $totalPago + $costoEnvio;

}
else
{
    $totalConDespacho = $totalPago; 

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
    <title>Agregar Dirección</title>
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



<div class="modal-header">
    <h5 class="modal-title text-secondary" id="exampleModalLabel">Finalizar Pedido</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">

    <div class="">

        <!-- address header -->
        <div class="row form-inline">
            <div class="col-lg-12 ">
                <p class="pt-2 m-0 text-right"><span class="small">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <a href="#" id="btnBorrarCarrito" data-toggle="modal" data-target="#exampleModal"
                                    class=" text-primary ">Borrar Carrito</a>
                    </span></p>
            </div>
            <hr />
            <div class="col-lg-12">
                <div id="classDespacho">
                    <div class="p-3 bg-white rounded shadow-sm w-100">
                        <div class="d-flex align-items-center mb-2">
                            <div class="row">
                                <p class="mb-0 h5 text-secondary ">Detalle Compra</p>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group">
                                <h6 class="text-dark">Total Productos </h6>
                                <h6 class="text-dark"><?php echo " : " .  $totalProductosPago  ?> </h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <h6 class="text-dark">Subtotal </h6>
                                <h6 class="text-dark"><?php echo ' : ' . $totalPago . " (CLP)" ?> </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <h6 class="text-dark"> Cargo Despacho </h6>
                                <h6 class="text-dark"><?php  echo ": " .  $costoEnvio . " (CLP)"   ?> </h6>

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <h6 class="text-dark">Total a Pago </h6>
                                <h6 class="text-dark"><?php echo " : " . $totalConDespacho . " (CLP)"   ?> </h6>
                            </div>
                        </div>


                    </div>
                </div>


            </div>

        </div>
        <hr />


        <!-- body address -->
        <div class="row">
            <div class=" col-lg-12  ">
                <div id="classDespacho">
                    <div class="p-3 bg-white rounded shadow-sm w-100">
                        <div class="d-flex align-items-center mb-2">
                            <div class="row">
                                <p class="mb-0 h5 text-secondary">Seleccionar Medio de Pago</p>
                            </div>
                            <br>
                        </div>

                        <div class="row">

                            <div class="form-check form-check-inlinev class-transferencia">
                                <input class="form-check-input" id="rdTransferencia" type="radio"
                                    name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
                                <label class="form-check-label h6" for="inlineRadio1">Transferencia</label>
                            </div>


                            <div class="form-check form-check-inline class-entrega ">
                                <input class="form-check-input" id="rdEntrega" type="radio" name="inlineRadioOptions"
                                    id="inlineRadio2" value="option2">
                                <label class="form-check-label h6" for="inlineRadio2">Pago a momento de
                                    entrega</label>
                            </div>




                        </div>
                        <br>
                        <div class="">
                            <div id="idTransferencia">
                                <div class="row">
                                    <div class="form-group">
                                        <h6 class="text-dark">Telefono: 999999999 </h6>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <h6 class="text-dark">Banco: Santander </h6>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <h6 class="text-dark">Rut: 99999999-9 </h6>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <h6 class="text-dark">Nombre: Pepito paga doble </h6>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <h6 class="text-dark">Correo: Pepito@gmail.com </h6>

                                    </div>

                                </div>


                            </div>
                        
                        <div id="idPagoDomicilio" hidden>
                            <div class="row">
                                <div class="col-lg-12">

                                    <p class="">El cobro se efectuará </p>
                                    <p class="">Al momento de la entrega</p>
                                    <p class="">del producto</p>
                                    <p class=""> </p>
                                    <p class=""></p>
                                </div>
                            </div>
                        </div>

                    </div>



                </div>
                <br>
            </div>

        </div>

    </div>
    <div class="row float-right">
        <div class="col-md-12">
            <button type="button" id="btnFinalizarPago" class="btn btn-primary btn-block"
                onclick='oCarrito.FinalizarPago(  <?php  echo $arrayPago  ?>  , <?php echo $idDespacho ?> ,  <?php echo $totalProductosPago ?> , <?php echo $totalPago ?>   )'>Solicitar
                Pedido</button>
        </div>
    </div>


</div>





</html>

<?php include("../includes/footer.php")  ?>