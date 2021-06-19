<?php 
include("../phpMailer/PHPMailer.php");
include("../phpMailer/Exception.php");
include("../phpMailer/OAuth.php");
include("../phpMailer/POP3.php");
include("../phpMailer/SMTP.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//require 'phpMailer/Exception.php';
//require 'phpMailer/PHPMailer.php';
//require 'phpMailer/SMTP.php';

class envioMail
{
   function EnviarCorreo($idDespacho)
   {
    $oCatalogo= new catalogoBD();
    $sNombre="";
    $sApellido="";
    $sDireccion="";
    $sDepartamento="";
    $sComuna="";
    $sCiudad="";
    $sRegion="";
    $sTelefono="";
    $sDestinarioEmail="";
    $sDestinario="";
    $sAsunto="";
    
    
    if($idDespacho !="")
{
    $Listafilas=$oCatalogo->obtieneDatosDespacho($idDespacho);
    foreach($Listafilas as $filas => $value)
{
   $sNombre = $value['NOMBRE'];
   $sApellido = $value['APELLIDOS'];
   $sDireccion = $value['DIRECCION'];
   $sDepartamento = $value['DEPARTAMENTO'];
   $sComuna = $value['COMUNA'];
   $sCiudad = $value['CIUDAD'];
   $sRegion = $value['REGION'];
   $sTelefono = $value['TELEFONO'];
   $sDestinarioEmail = $value['EMAIL'];   


}
$sDestinarioEmail ="alesaldivia@gmail.com";
$sAsunto = " Su pedido con código " . $idDespacho . " recepcionado";
$sCuerpo = "Estimado: $sNombre \n";
$sCuerpo .=" Hemos recibido su pedido \n ";
$sCuerpo .=" Nos podremos en contacto con usted \n ";
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'odroguett@gmail.com';                     //SMTP username
    $mail->Password   = '1981Febrero';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('odroguett@gmail.com', 'Topuva');
    $mail->addAddress($sDestinarioEmail, 'Estimada(o)');     //Add a recipient
    $mail->addAddress('alesaldivia@gmail.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $sAsunto;
    $mail->Body    = $sCuerpo;
   // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'El mensaje se envio correctamente';
} catch (Exception $e) {
    echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
}





}


   }
}

?>
