<?php 

include("../BD/catalogoBD.php");
$arrayPago = $_POST["arrayPago"]; 
$idDespacho = json_decode($_POST["idDespacho"],true); 
$totalProductosPago = json_decode($_POST["totalProductosPago"],true); 
$totalPago = json_decode($_POST["totalPago"],true); 
$idTipoPago =1;
$oCatalogo= new catalogoBD();

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
$idDetalle= $oCatalogo->InsertarCabeceraPago($idDespacho,$totalProductosPago,$idTipoPago,$totalConDespacho);
$totalConDespacho =0;
$costoEnvio = 4000;
foreach($arrayPago as $filas => $value)
{ 
      
    $cantidadProducto=  $value['Cantidad'] ;
    $codigoProducto=  $value['CodigoProducto'];
    $datosVentaProducto=  $oCatalogo->obtieneDatosVentaProducto($codigoProducto);
    foreach($datosVentaProducto as $filasProducto => $valueProducto)
    {
        $precioVenta= $valueProducto['PRECIO_VENTA'];
    }
    $oCatalogo->InsertarDetallePago($idDetalle,$cantidadProducto,$precioVenta,$codigoProducto);
}

?>