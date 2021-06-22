<?php 
require_once("../Negocio/EnvioMail.php");
ob_start();
$mail= $_POST['mail'];
$nombre= $_POST['nombre'];
$mensaje= $_POST['mensaje'];
try{
    $oMail = new envioMail();
    
$sAsunto = " Contacto de  " . $nombre ;
$sCuerpo = "Correo ingresado en contacto:" .  $mail . " \n";
$sCuerpo .=$mensaje;
$sDestinarioEmail = "odroguett@gmail.com";
if($oMail->EnviarCorreo($sAsunto,$sCuerpo,$sDestinarioEmail,""))
{

}

ob_end_clean();
echo "A la brevedad nos pondremos en contacto con usted.";  

}
catch(Exception $e)
  {
    ob_end_clean();
   echo "Error al ingresar mensaje, disculpe las molestias.";
  }

?>
