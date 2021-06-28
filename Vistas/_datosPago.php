<?php 

include_once($_SERVER['DOCUMENT_ROOT'].'/TopuvaWeb/rutas.php');
require_once(BD . "catalogoBD.php");
require_once(COMPARTIDA . "parametros.php");
$arrayPago = $_POST["arrayPago"]; 
$idDespacho = json_decode($_POST["idDespacho"],true); 
$idTipoDespacho = json_decode($_POST["tipoDespacho"],true); 
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



<div class="modal-header bg-kumel">
    <h5 class="modal-title text-kumel-texto" id="exampleModalLabel">Finalizar Pedido</h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">

    <div class="">

        <!-- address header -->
        <div class="row ">



            <div class="col-md-12 text-right">
                <a href="#" id="btnBorrarCarrito" data-toggle="modal" data-target="#exampleModal"
                    class="text-right text-primary ">Borrar Carrito</a>
            </div>


            <hr />
            <div class="col-lg-12">
                <div id="classDespacho">
                    <div class="p-3 bg-light rounded shadow-sm w-100">
                        <div class="d-flex align-items-center mb-2">
                            <div class="row">
                                <p class="mb-0 h6  font-weight-bold ">Detalle Compra</p>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group">
                                <h7 class=" font-weight-light">Total Productos : </h7>
                                <h7 class=" font-weight-light"><?php echo  ' ' . $totalProductosPago  ?>
                                </h7>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <h7 class=" font-weight-light">Subtotal : </h7>
                                <h7 class=" font-weight-light">
                                    <?php echo ' ' . number_format($totalPago,0,',','.')  . " (CLP)" ?>
                                </h7>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <h7 class=" font-weight-light">Cargo Despacho : </h7>
                                <h7 class=" font-weight-light">
                                    <?php  echo  ' ' .  number_format($costoEnvio,0,',','.')   . " (CLP)"   ?>
                                </h7>

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <h7 class=" font-weight-light">Total a Pago : </h7>
                                <h7 class=" font-weight-light">
                                    <?php echo ' ' .  number_format($totalConDespacho,0,',','.') . " (CLP)"   ?> </h7>
                            </div>
                        </div>


                    </div>
                </div>


            </div>

        </div>
        <hr />


        <!-- body address -->
        <div class="row ">
            <div class=" col-lg-12   ">
                <div id="classDespacho">
                    <div class="p-3  rounded bg-light shadow-sm w-100">
                        <div class="d-flex align-items-center mb-2">
                            <div class="row">
                                <p class="mb-0 h6  font-weight-bold">Seleccionar Medio de Pago</p>
                            </div>
                            <br>
                        </div>

                        <div class="row">


                            <div class="form-check form-check-inlinev class-transferencia">
                                <input class="form-check-input" id="rdTransferencia" type="radio" name="rdTransferencia"
                                    value="option1" checked>
                                <label class="form-check-label h7  font-weight-light"
                                    for="inlineRadio1">Transferencia</label>
                            </div>


                            <div class="form-check form-check-inline class-transferencia ">
                                <input class="form-check-input" id="rdEntrega" type="radio" name="rdEntrega"
                                    value="option2">
                                <label class="form-check-label h7  font-weight-light text-right"
                                    for="inlineRadio2"> Pago a momento de entrega</label>
                            </div>




                        </div>
                        <br>
                        <div class="">
                            <div id="idTransferencia">
                                <div class="row">
                                    <div class="form-group">
                                        <h7 class=" font-weight-light">Telefono : </h7>
                                        <h7 class=" font-weight-light"> 999999999
                                        </h7>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <h7 class=" font-weight-light">Banco : </h7>
                                        <h7 class=" font-weight-light"> Santander
                                        </h7>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <h7 class=" font-weight-light">RUT : </h7>
                                        <h7 class=" font-weight-light"> 99999999-9
                                        </h7>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <h7 class=" font-weight-light">Nombre : </h7>
                                        <h7 class=" font-weight-light"> Pepito paga doble
                                        </h7>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <h7 class=" font-weight-light">Correo : </h7>
                                        <h7 class=" font-weight-light"> Pepito@gmail.com
                                        </h7>
                                    </div>
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
            <button type="button" id="btnFinalizarPago" class="btn btn-kumel-1 btn-block"
                onclick='oCarrito.FinalizarPago(  <?php  echo $arrayPago  ?>  , <?php echo $idDespacho ?> ,  <?php echo $totalProductosPago ?> , <?php echo $totalPago ?>,<?php echo $idTipoDespacho ?>   )'>Solicitar
                Pedido</button>
        </div>
    </div>


</div>



<div id="loader" style="display:none">
    <button class="btn" disabled id="set-btn" style="padding-top:20%">
        <i class="psi-gear fa-spin" style="font-size:50px;color:#000000"></i>
    </button>
</div>


</html>

<?php include("../includes/footer.php")  ?>