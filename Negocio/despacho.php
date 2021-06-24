<?php 

require_once("../BD/catalogoBD.php");

$oCatalogo= new catalogoBD();
$oRespuesta = new RespuestaOtd();
$sModificar= filter_var($_POST['modificar'], FILTER_SANITIZE_STRING); 
$idDespacho= filter_var($_POST['idDespacho'],FILTER_SANITIZE_NUMBER_INT); 
$sNombre = filter_var($_POST['nombre'],FILTER_SANITIZE_STRING);  
$sApellidos = filter_var($_POST['apellido'],FILTER_SANITIZE_STRING); 
$sDireccion = filter_var($_POST['direccion'],FILTER_SANITIZE_STRING); 
$sDepartamento = filter_var($_POST['departamento'],FILTER_SANITIZE_STRING); 
$sCiudad = filter_var($_POST['ciudad'],FILTER_SANITIZE_STRING); 
$sComuna = filter_var($_POST['comuna'],FILTER_SANITIZE_STRING); 
$sRegion = filter_var($_POST['region'],FILTER_SANITIZE_STRING);
$sTelefono =  filter_var($_POST['telefono'],FILTER_SANITIZE_STRING);
$sEmail = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);

// Acaba vamos a realizar control de limpieza de imput.
if($sModificar=="C")
{

    $oRespuesta =$oCatalogo->InsertaDespacho($sNombre,$sApellidos,$sDireccion,$sDepartamento,$sCiudad,$sComuna,$sRegion,$sTelefono,$sEmail);
}
else
{
    $oRespuesta =$oCatalogo->ActualizaDespacho($sNombre,$sApellidos,$sDireccion,$sDepartamento,$sCiudad,$sComuna,$sRegion,$sTelefono,$sEmail,$idDespacho);

}


if($oRespuesta->bEsValido)
{

    
    $mensaje= array('bEsValido' =>$oRespuesta->bEsValido, 'idcliente' => 0, 'respuesta' =>  $oRespuesta->sMensaje,'direccion' => $oRespuesta->sDireccion,'comuna'=>$oRespuesta->sComuna,
                    'ciudad'=>$oRespuesta->sCiudad,'region'=>$oRespuesta->sRegion,'telefono'=>$oRespuesta->sTelefono, 
                    'idDespacho'=>$oRespuesta->idDespacho,'departamento' => $oRespuesta->sDepartamento,'sEmail' => $oRespuesta->sEmail);
    echo json_encode($mensaje,JSON_FORCE_OBJECT);
    
    exit();

}
else
{
    $oRespuesta->$sMensaje =" Datos del despacho con errores, contacte a soprte";
    $mensaje= array('idCliente' => $oRespuesta->idCliente, 'respuesta' => $oRespuesta->sMensaje);
    echo json_encode($mensaje,JSON_FORCE_OBJECT);
    exit();


}

?>
