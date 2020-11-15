<?php namespace App\Controllers;

require_once ROOTPATH.'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once ROOTPATH.'vendor/phpmailer/phpmailer/src/Exception.php';
require_once ROOTPATH.'vendor/phpmailer/phpmailer/src/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class NewsLetter extends BaseController
{

    public function nl_subscription_send_email(){

        $nlEmail = $this->request->getPost('nlSubEmail');

        if(!filter_var($nlEmail, FILTER_VALIDATE_EMAIL)){
            exit('invalid-email');
        }else {

            $mail = new PHPMailer(true);

            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'mail.kimaara.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'emailverification@kimaara.com';                     // SMTP username
            $mail->Password   = 'ratnesh@47';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('emailverification@kimaara.com', 'Email Newsletter Dept.');
            $mail->addAddress('kimaarasilver@gmail.com');               // Name is optional
            $mail->addReplyTo('noreply@kimaara.com', 'Email Newsletter Signup');
            
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $nlEmail.' Email Newsletter New Signup';
            $mail->Body    = 'I want to subscribe to your Newsletter <br><br>'.$nlEmail;

            $res = $mail->send();
            
            if($res){
                exit('nl-add-success');
            }

        }        

    }

}