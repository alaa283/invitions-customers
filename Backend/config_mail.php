<?php

//Include required PHPMailer files
    require './PHPMailer/vendor/phpmailer/src/PHPMailer.php';
    require './PHPMailer/vendor/phpmailer/src/SMTP.php';
    require './PHPMailer/vendor/phpmailer/src/Exception.php';
//Define name spaces
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

class Mail
{
    function __construct()
    {
        // $this->config_mail($email, $subject, $body, $confirm_email);
    }

    public function config_mail($email, $subject, $body)
    {

        $mail = new PHPMailer($email);

        //Set mailer to use smtp
            $mail->isSMTP();

        //Define smtp host
            $mail->Host = "smtp.gmail.com";
 
        //Enable smtp authentication
            $mail->SMTPAuth = true;
 
        //Set smtp encryption type (ssl/tls)
            $mail->SMTPSecure = "tls";
 
        //Port to connect smtp
            $mail->Port = "587";
 
        //Set gmail username
            $mail->Username = "alaasender@gmail.com";
            // $mail->Username = "alaa.gamal.saad3@gmail.com";
 
        //Set gmail password
            $mail->Password = "guabbodealylwlrf";
            // $mail->Password = "mwfqovrqosbfwndp";

        //Set sender email
            $mail->setFrom('alaasender@gmail.com');

        //Enable HTML
            $mail->isHTML(true);

        //Email subject
            $mail->Subject = $subject ;

        //Attachment
            // $mail->addAttachment('img/attachment.png');
     
        //Email body
            $mail->Body = $body;
     
        //Add recipient
            $mail->addAddress($email);

            // return $mail->send();

            if(!$mail->send()) 
            {
                return true;
            } 
            else
            {
               return false;
            }
     

    }
}