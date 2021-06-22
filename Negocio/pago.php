<?php 

require_once("../BD/catalogoBD.php");
require_once("../Negocio/EnvioMail.php");
require_once("../Negocio/comprobantePagoMail.php");

ob_start();

$arrayPago = $_POST["arrayPago"]; 
$idDespacho = json_decode($_POST["idDespacho"],true); 
$totalProductosPago = json_decode($_POST["totalProductosPago"],true); 
$totalPago = json_decode($_POST["totalPago"],true); 
$idTipoPago =1;
$oCatalogo= new catalogoBD();
$oRespuesta = new RespuestaOtd();

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
  
    if(EnviarCorreoPago($idDespacho))
    {
        
        $oRespuesta->bEsValido=true;
        $oRespuesta->sMensaje= " Pedido procesado con exito, nos pondremos en contacto con usted, gracias por confiar en nosotros. " ;
    }
    else
    {
        $oRespuesta->bEsValido=false;
        $oRespuesta->sMensaje= " Problemas al procesar pedido. Nos contactaremos a la brevedad con usted. " ;

    }

    

}
else
{
    
    $oRespuesta->bEsValido=false;
    $oRespuesta->sMensaje= "Stock no disponible para producto: " .  $sNombreProducto ;

}

ob_end_clean();

$mensaje= array('bEsValido' => $oRespuesta->bEsValido, 'respuesta' => $oRespuesta->sMensaje);

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

//function GenerarPDF($idDespacho)
//{
 //   $oComprobante = new GeneraComprobante();
  //  $oComprobante->generaComprobantePago($idDespacho);

//}

function EnviarCorreoPago($idDespacho)
{
try{
    $oMail = new envioMail();
    $oCatalogo= new catalogoBD();
    $sNombre="";
    $sDestinarioEmail="";
    $sAsunto="";
    
    
    if($idDespacho !="")
{
    $Listafilas=$oCatalogo->obtieneDatosDespacho($idDespacho);
    foreach($Listafilas as $filas => $value)
{
   $sNombre = $value['NOMBRE'];
   $sDestinarioEmail = $value['EMAIL'];   


}
$oComprobantePago = new ComprobantePagoMail();
$comprobantePDF = $oComprobantePago->GeneraComprobantePago($idDespacho);
$sAsunto = " Su pedido con codigo " . $idDespacho . " recepcionado";
$sCuerpo = "Estimado: $sNombre \n";
$sCuerpo .=" Hemos recibido su pedido \n ";
$sCuerpo .=" Nos podremos en contacto con usted \n ";
$oMail->EnviarCorreo($sAsunto,$sCuerpo,$sDestinarioEmail,$comprobantePDF);
    return true;
}
}
catch(Exception $e)
  {
    return false;
  }


}

?>