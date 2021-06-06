<?php 

include("includes/BD/catalogoBD.php");
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

$oCatalogoBD->InsertaDespacho($sNombre,$sApellidos,$sDireccion,$sDepartamento,$sCiudad,$sComuna,$sRegion,$sTelefono,$sEmail);

      





?>
