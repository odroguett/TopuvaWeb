<?php 
require_once("../Negocio/EnvioMail.php");
ob_start();
$mail=filter_var($_POST['mail'],FILTER_SANITIZE_EMAIL);
$nombre= filter_var($_POST['nombre'],FILTER_SANITIZE_STRING);
$mensaje= filter_var($_POST['mensaje'],FILTER_SANITIZE_STRING);
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
