<?php 
require_once("../BD/catalogoBD.php");
require_once("../log/log.php");
$oCatalogo= new catalogoBD();
$oRespuesta = new RespuestaOtd();
$oLog = new Log();
$idDespacho = $_POST['idDespacho']; 


try //Si es Excepcion, se utiliza este Try
{
    try //Si es Excepcion, se utiliza este Try
    {
       
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

    }
    catch(Error $e)
    {
        $oRespuesta->bEsValido = false;
        $oRespuesta->sMensaje =" No es posible ingresar datos para despacho!!!";
         $mensaje= array('bEsValido' =>$oRespuesta->bEsValido, 'respuesta' => $oRespuesta->sMensaje);
            echo json_encode($mensaje,JSON_FORCE_OBJECT);
        $oLog->EscribeLog("ERROR",$e->getMessage(),$e->getCode(),$e->getLine());

        exit();
        
    }
}
catch(Exception $e)
{
    $oRespuesta->bEsValido = false;
    $oRespuesta->sMensaje =" No es posible ingresar datos para despacho!!!";
     $mensaje= array('bEsValido' =>$oRespuesta->bEsValido, 'respuesta' => $oRespuesta->sMensaje);
        echo json_encode($mensaje,JSON_FORCE_OBJECT);
    $oLog->EscribeLog("ERROR",$e->getMessage(),$e->getCode(),$e->getLine());

    exit();

}

?>