<?php 

include("../BD/catalogoBD.php");
include("../Negocio/EnvioMail.php");


$arrayPago = $_POST["arrayPago"]; 
$idDespacho = json_decode($_POST["idDespacho"],true); 
$totalProductosPago = json_decode($_POST["totalProductosPago"],true); 
$totalPago = json_decode($_POST["totalPago"],true); 
$idTipoPago =1;
$oCatalogo= new catalogoBD();
$oRespuesta = new RespuestaOtd();
$oMail = new envioMail();
$totalConDespacho =0;
$sNombreProducto;
if(ValidaPago($arrayPago,$sNombreProducto))
{
    $parametros =$oCatalogo->obtieneParametros();
    foreach($parametros as $filas => $value)
    { 
        $costoEnvio =   $value['COSTO_ENVIO'];
        $topeCostoEnvio =   $value['TOPE_COSTO_ENVIO'];
      
    }
    if($totalPago < $topeCostoEnvio)
    {
        $totalConDespacho = $totalPago + $costoEnvio;
    
    }
    else
    {
        $totalConDespacho = $totalPago; 
    
    }
    $idDetalle= $oCatalogo->InsertarCabeceraPago($idDespacho,$totalProductosPago,$idTipoPago,$totalConDespacho);
    $totalConDespacho =0;
    
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
    $oMail->EnviarCorreo($idDespacho);
    $oRespuesta->bEsValido=true;
    $oRespuesta->sMensaje= " Pedido procesado con exito, nos pondremos en contacto con usted, gracias por confiar en nosotros. " ;

}
else
{
    $oRespuesta->bEsValido=false;
    $oRespuesta->sMensaje= "Stock no disponible para producto: " .  $sNombreProducto ;

}

$mensaje= array('bEsValido' =>$oRespuesta->bEsValido, 'sMensaje'=>$oRespuesta->sMensaje);
          echo json_encode($mensaje,JSON_FORCE_OBJECT);
exit();





function ValidaPago($arrayPago,&$sNombreProducto)
{
$bOK = true;
$oCatalogo= new catalogoBD();
foreach($arrayPago as $filas => $value)
{ 
    $codigoProducto=  $value['CodigoProducto'];
    $datosVentaProducto=  $oCatalogo->obtieneDatosVentaProducto($codigoProducto);
    foreach($datosVentaProducto as $filasProducto => $valueProducto)
    {
        $stock = $valueProducto['STOCK'];
        $sNombreProducto = $valueProducto['descripcion'] . ' ' . $valueProducto['tamano'] . $valueProducto['codigo_unidad'] ;

        if($stock ==0)
        {

            $bOK =false;
        }
    }
    
}

return $bOK ;
}

?>