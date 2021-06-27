<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/TopuvaWeb/rutas.php');
require_once(BD . "catalogoBD.php");
require_once(LOG . "log.php");
require_once(COMPARTIDA . "parametros.php");
require_once(NEGOCIO . "EnvioMail.php");

//En esta seccion colocaremos las clases Singleton//
//Parametros::getInstance()->cargaParametros();
ob_start();
$mail=filter_var($_POST['mail'],FILTER_SANITIZE_EMAIL);
$nombre= filter_var($_POST['nombre'],FILTER_SANITIZE_STRING);
$mensaje= filter_var($_POST['mensaje'],FILTER_SANITIZE_STRING);
try //Si es Excepcion, se utiliza este Try
{
  try
  {
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
      exit();
  
  }
  catch(Error $e)
    {
      ob_end_clean();
      $oLog->EscribeLog("ERROR",$e->getMessage(),$e->getCode(),$e->getLine());
      echo "Error al ingresar mensaje, disculpe las molestias.";
      exit();
    }
  
}
catch(Exception $e)
{
  $oLog->EscribeLog("ERROR",$e->getMessage(),$e->getCode(),$e->getLine());
  echo "Error al ingresar mensaje, disculpe las molestias.";
  exit();

}

?>
