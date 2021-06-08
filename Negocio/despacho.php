<?php 

include("../BD/catalogoBD.php");

$oCatalogo= new catalogoBD();
$oRespuesta = new RespuestaOtd();
$sModificar= $_POST['modificar']; 
$idDespacho= $_POST['idDespacho']; 
$sNombre = $_POST['nombre']; 
$sApellidos = $_POST['apellido']; 
$sDireccion = $_POST['direccion']; 
$sDepartamento = $_POST['departamento']; 
$sCiudad = $_POST['ciudad']; 
$sComuna = $_POST['comuna']; 
$sRegion = $_POST['region']; 
$sTelefono = $_POST['telefono']; 
$sEmail = $_POST['email']; 

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
                    'ciudad'=>$oRespuesta->sCiudad,'region'=>$oRespuesta->sRegion,'telefono'=>$oRespuesta->sTelefono, 'idDespacho'=>$oRespuesta->idDespacho);
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
