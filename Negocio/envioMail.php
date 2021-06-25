<?php 
require_once("../phpMailer/PHPMailer.php");
require_once("../phpMailer/Exception.php");
require_once("../phpMailer/OAuth.php");
require_once("../phpMailer/POP3.php");
require_once("../phpMailer/SMTP.php");
require_once("../log/log.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;



class envioMail
{
   function EnviarCorreo($sAsunto,$sCuerpo,$sDestinarioEmail,$sAdjunto)
   {

    try{
        $mail = new PHPMailer(true);
        $oLog = new Log();


        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'emporiodys@gmail.com';                     //SMTP username
            $mail->Password   = 'Dys.2012';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom('emporiodys@gmail.com', 'Topuva');
            $mail->addAddress($sDestinarioEmail, 'Estimada(o)');     //Add a recipient
            $mail->addAddress('emporiodys@gmail.com');               //Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
        
            //Attachments
            if($sAdjunto !="")
            {
                $mail->addStringAttachment($sAdjunto,'ComprobantePago.pdf',$encoding = 'base64', $type = 'application/pdf');         //Add attachments
        
            }
            
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $sAsunto;
            $mail->Body    = $sCuerpo;
           // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo 'El mensaje se envio correctamente';
        } catch (Error $e) {
            echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
            $oLog->EscribeLog("ERROR",$e->getMessage(),$e->getCode(),$e->getLine());
        }

    }
    catch(Exception $e)
    {

        $oLog->EscribeLog("ERROR",$e->getMessage(),$e->getCode(),$e->getLine());
    }






}


   }


?>
