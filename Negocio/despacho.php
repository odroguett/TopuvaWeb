<?php 

include("../BD/catalogoBD.php");
$oCatalogo= new catalogoBD();
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

if($oCatalogo->InsertaDespacho($sNombre,$sApellidos,$sDireccion,$sDepartamento,$sCiudad,$sComuna,$sRegion,$sTelefono,$sEmail))
{


    $mensaje= array('codigo' => 1, 'respuesta' => "Datos para despacho ingresado con exito");
    echo json_encode($mensaje,JSON_FORCE_OBJECT);
    exit();

}
else
{
    $mensaje= array('codigo' => 2, 'respuesta' => "Datos para  despacho ingresado con errores");
    echo json_encode($mensaje,JSON_FORCE_OBJECT);
    exit();


}

      





?>
