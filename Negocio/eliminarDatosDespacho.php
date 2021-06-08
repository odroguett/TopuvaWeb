<?php 
include("../BD/catalogoBD.php");
$oCatalogo= new catalogoBD();
$oRespuesta = new RespuestaOtd();
$idDespacho = $_POST['idDespacho']; 
$oRespuesta =$oCatalogo->eliminaDespacho($idDespacho);
if($oRespuesta->bEsValido)
{
    $mensaje= array('bEsValido' => $oRespuesta->bEsValido, 'respuesta' => $oRespuesta->sMensaje);
    echo json_encode($mensaje,JSON_FORCE_OBJECT);
    
    exit();

}
else
{
    $oRespuesta->$sMensaje ="Eliminar datos para despacho con errores";
    $mensaje= array('bEsValido' => $oRespuesta->bEsValido, 'respuesta' => $oRespuesta->sMensaje);
    echo json_encode($mensaje,JSON_FORCE_OBJECT);
    exit();


}
?>