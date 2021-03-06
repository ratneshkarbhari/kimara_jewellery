<?php namespace App\Controllers;

require_once ROOTPATH.'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once ROOTPATH.'vendor/phpmailer/phpmailer/src/Exception.php';
require_once ROOTPATH.'vendor/phpmailer/phpmailer/src/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


use App\Models\AuthModel;
use App\Models\CategoryModel;
use App\Models\CategoryPositionModel;
use App\Models\VendorApprovalModel;
use App\Models\CartModel;
use App\Models\OrderModel;
use App\Models\OtpModel;
use App\Models\StoreModel;


class Authentication extends BaseController
{


    public function get_email_verif_code(){
        
        $enteredEmail = $this->request->getPost('emailEntered');

        $authModel = new AuthModel();

        $customerExists = $authModel->where('role','customer')->where('email',$enteredEmail)->first();

        if ($customerExists) {
            return 'customer-already-exists';
        }else {

            $otpModel = new OtpModel();

            $otpExists = $otpModel->otp_for_email($enteredEmail);

            if($otpExists){

                $emailVerifRandomCode = $otpExists['code'];

            }else {

                $emailVerifRandomCode = rand(100000,999999);

                $otpArray = array(
                    'code' => $emailVerifRandomCode,
                    'email' => $enteredEmail
                );

                $otpModel->insert($otpArray);

            }

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            
            $from = "emailverification@kimaara.com";

            // Create email headers
            $headers .= 'From: '.$from."\r\n".
                'Reply-To: '.$from."\r\n" .
                'X-Mailer: PHP/' . phpversion();

            // $body =  '<p>Here is your Email verification code: '.$emailVerifRandomCode.'. Provide it on our website to complete email verification.</p>';

            $body    = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head> <meta name="viewport" content="width=device-width, initial-scale=1.0"/> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <title>Verify your email address</title> <style type="text/css" rel="stylesheet" media="all"> /* Base ------------------------------ */ *:not(br):not(tr):not(html){font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; -webkit-box-sizing: border-box; box-sizing: border-box;}body{width: 100% !important; height: 100%; margin: 0; line-height: 1.4; background-color: #F5F7F9; color: #0a0a0a; -webkit-text-size-adjust: none;}a{color: #414EF9;}/* Layout ------------------------------ */ .email-wrapper{width: 100%; margin: 0; padding: 0; background-color: #F5F7F9;}.email-content{width: 100%; margin: 0; padding: 0;}/* Masthead ----------------------- */ .email-masthead{padding: 25px 0; text-align: center;}.email-masthead_logo{max-width: 400px; border: 0;}.email-masthead_name{font-size: 16px; font-weight: bold; color: #839197; text-decoration: none; text-shadow: 0 1px 0 white;}/* Body ------------------------------ */ .email-body{width: 100%; margin: 0; padding: 0; border-top: 1px solid #E7EAEC; border-bottom: 1px solid #E7EAEC; background-color: #FFFFFF;}.email-body_inner{width: 570px; margin: 0 auto; padding: 0;}.email-footer{width: 570px; margin: 0 auto; padding: 0; text-align: center;}.email-footer p{color: #839197;}.body-action{width: 100%; margin: 30px auto; padding: 0; text-align: center;}.body-sub{margin-top: 25px; padding-top: 25px; border-top: 1px solid #E7EAEC;}.content-cell{padding: 35px;}.align-right{text-align: right;}/* Type ------------------------------ */ h1{margin-top: 0; color: #292E31; font-size: 19px; font-weight: bold; text-align: left;}h2{margin-top: 0; color: #292E31; font-size: 16px; font-weight: bold; text-align: left;}h3{margin-top: 0; color: #292E31; font-size: 14px; font-weight: bold; text-align: left;}p{margin-top: 0; color: #839197; font-size: 16px; line-height: 1.5em; text-align: left;}p.sub{font-size: 12px;}p.center{text-align: center;}/* Buttons ------------------------------ */ .button{display: inline-block; width: 200px; background-color: #414EF9; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 45px; text-align: center; text-decoration: none; -webkit-text-size-adjust: none; mso-hide: all;}.button--green{background-color: #28DB67;}.button--red{background-color: #FF3665;}.button--blue{background-color: #414EF9;}/*Media Queries ------------------------------ */ @media only screen and (max-width: 600px){.email-body_inner, .email-footer{width: 100% !important;}}@media only screen and (max-width: 500px){.button{width: 100% !important;}}</style></head><body> <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0"> <tr> <td align="center"> <table class="email-content" width="100%" cellpadding="0" cellspacing="0"> <tr> <td class="email-masthead"> <a class="email-masthead_name">"Kimaara Jewellery"</a> </td></tr><tr> <td class="email-body" width="100%"> <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0"> <tr> <td class="content-cell"> <h1>Verify your email address</h1> <p>This is regarding your order on Kimaara Jewellery.</p><table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0"> <tr> <td align="center"> <div> <p>Here is your Email verification code: '.$emailVerifRandomCode.'. Provide it on our website to complete email verification.</p></div></td></tr></table> <p>Thanks,<br>The Kimaara Jewellery Team</p><table class="body-sub"> <tr> <td> <p class="sub"></p></td></tr></table> </td></tr></table> </td></tr><tr> <td> <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0"> <tr> <td class="content-cell"> <p class="sub center"> Kimaara Jewellery. <br>Mumbai, India </p></td></tr></table> </td></tr></table> </td></tr></table></body></html>';

            $mail = new PHPMailer(true);

            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'mail.kimaara.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'emailverification@kimaara.com';                     // SMTP username
            $mail->Password   = 'ratnesh@47';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('emailverification@kimaara.com', 'Email Verification Dept.');
            $mail->addAddress($enteredEmail);               // Name is optional
            $mail->addReplyTo('noreply@kimaara.com', 'Email Verification');
            
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Email Verification for Registration';
            $mail->Body    = $body;

            $res = $mail->send();
                
            
            if($res){
                exit('email-send-success');
            }else{
                exit('email-send-fail');
            }
                            
        }



    }
    public function get_email_verif_code_vendor(){
        
        $enteredEmail = $this->request->getPost('emailEntered');

        $authModel = new AuthModel();

        $customerExists = $authModel->where('role','vendor')->where('email',$enteredEmail)->first();

        if ($customerExists) {
            return 'vendor-already-exists';
        }else {

            $otpModel = new OtpModel();

            $otpExists = $otpModel->otp_for_email($enteredEmail);

            if($otpExists){

                $emailVerifRandomCode = $otpExists['code'];

            }else {

                $emailVerifRandomCode = rand(100000,999999);

                $otpArray = array(
                    'code' => $emailVerifRandomCode,
                    'email' => $enteredEmail
                );

                $otpModel->insert($otpArray);

            }

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            
            $from = "emailverification@kimaara.com";

            // Create email headers
            $headers .= 'From: '.$from."\r\n".
                'Reply-To: '.$from."\r\n" .
                'X-Mailer: PHP/' . phpversion();

            // $body =  '<p>Here is your Email verification code: '.$emailVerifRandomCode.'. Provide it on our website to complete email verification.</p>';

            $body    = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head> <meta name="viewport" content="width=device-width, initial-scale=1.0"/> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <title>Verify your email address</title> <style type="text/css" rel="stylesheet" media="all"> /* Base ------------------------------ */ *:not(br):not(tr):not(html){font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; -webkit-box-sizing: border-box; box-sizing: border-box;}body{width: 100% !important; height: 100%; margin: 0; line-height: 1.4; background-color: #F5F7F9; color: #0a0a0a; -webkit-text-size-adjust: none;}a{color: #414EF9;}/* Layout ------------------------------ */ .email-wrapper{width: 100%; margin: 0; padding: 0; background-color: #F5F7F9;}.email-content{width: 100%; margin: 0; padding: 0;}/* Masthead ----------------------- */ .email-masthead{padding: 25px 0; text-align: center;}.email-masthead_logo{max-width: 400px; border: 0;}.email-masthead_name{font-size: 16px; font-weight: bold; color: #839197; text-decoration: none; text-shadow: 0 1px 0 white;}/* Body ------------------------------ */ .email-body{width: 100%; margin: 0; padding: 0; border-top: 1px solid #E7EAEC; border-bottom: 1px solid #E7EAEC; background-color: #FFFFFF;}.email-body_inner{width: 570px; margin: 0 auto; padding: 0;}.email-footer{width: 570px; margin: 0 auto; padding: 0; text-align: center;}.email-footer p{color: #839197;}.body-action{width: 100%; margin: 30px auto; padding: 0; text-align: center;}.body-sub{margin-top: 25px; padding-top: 25px; border-top: 1px solid #E7EAEC;}.content-cell{padding: 35px;}.align-right{text-align: right;}/* Type ------------------------------ */ h1{margin-top: 0; color: #292E31; font-size: 19px; font-weight: bold; text-align: left;}h2{margin-top: 0; color: #292E31; font-size: 16px; font-weight: bold; text-align: left;}h3{margin-top: 0; color: #292E31; font-size: 14px; font-weight: bold; text-align: left;}p{margin-top: 0; color: #839197; font-size: 16px; line-height: 1.5em; text-align: left;}p.sub{font-size: 12px;}p.center{text-align: center;}/* Buttons ------------------------------ */ .button{display: inline-block; width: 200px; background-color: #414EF9; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 45px; text-align: center; text-decoration: none; -webkit-text-size-adjust: none; mso-hide: all;}.button--green{background-color: #28DB67;}.button--red{background-color: #FF3665;}.button--blue{background-color: #414EF9;}/*Media Queries ------------------------------ */ @media only screen and (max-width: 600px){.email-body_inner, .email-footer{width: 100% !important;}}@media only screen and (max-width: 500px){.button{width: 100% !important;}}</style></head><body> <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0"> <tr> <td align="center"> <table class="email-content" width="100%" cellpadding="0" cellspacing="0"> <tr> <td class="email-masthead"> <a class="email-masthead_name">"Kimaara Jewellery"</a> </td></tr><tr> <td class="email-body" width="100%"> <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0"> <tr> <td class="content-cell"> <h1>Verify your email address</h1> <p>This is regarding your Account Registration on Kimaara Jewellery.</p><table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0"> <tr> <td align="center"> <div> <p>Here is your Email verification code: '.$emailVerifRandomCode.'. Provide it on our website to complete email verification.</p></div></td></tr></table> <p>Thanks,<br>The Kimaara Jewellery Team</p><table class="body-sub"> <tr> <td> <p class="sub"></p></td></tr></table> </td></tr></table> </td></tr><tr> <td> <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0"> <tr> <td class="content-cell"> <p class="sub center"> Kimaara Jewellery. <br>Mumbai, India </p></td></tr></table> </td></tr></table> </td></tr></table></body></html>';

            $mail = new PHPMailer(true);

            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'mail.kimaara.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'emailverification@kimaara.com';                     // SMTP username
            $mail->Password   = 'ratnesh@47';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('emailverification@kimaara.com', 'Email Verification Dept.');
            $mail->addAddress($enteredEmail);               // Name is optional
            $mail->addReplyTo('noreply@kimaara.com', 'Email Verification');
            
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Email Verification for Registration';
            $mail->Body    = $body;

            $res = $mail->send();
                
            
            if($res){
                exit('email-send-success');
            }else{
                exit('email-send-fail');
            }
                            
        }



    }

    public function get_email_verif_code_pw_reset(){
        
        $enteredEmail = $this->request->getPost('emailEntered');

        $authModel = new AuthModel();

        $customerExists = $authModel->where('role','customer')->where('email',$enteredEmail)->first();

        if ($customerExists) {
            $otpModel = new OtpModel();

            $otpExists = $otpModel->otp_for_email($enteredEmail);

            if($otpExists){

                $emailVerifRandomCode = $otpExists['code'];

            }else {

                $emailVerifRandomCode = rand(100000,999999);

                $otpArray = array(
                    'code' => $emailVerifRandomCode,
                    'email' => $enteredEmail
                );

                $otpModel->insert($otpArray);

            }

            // $body =  '<p>Here is your Email verification code: '.$emailVerifRandomCode.'. Provide it on our website to complete email verification.</p>';

            $body    = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head> <meta name="viewport" content="width=device-width, initial-scale=1.0"/> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <title>Verify your email address</title> <style type="text/css" rel="stylesheet" media="all"> /* Base ------------------------------ */ *:not(br):not(tr):not(html){font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; -webkit-box-sizing: border-box; box-sizing: border-box;}body{width: 100% !important; height: 100%; margin: 0; line-height: 1.4; background-color: #F5F7F9; color: #0a0a0a; -webkit-text-size-adjust: none;}a{color: #414EF9;}/* Layout ------------------------------ */ .email-wrapper{width: 100%; margin: 0; padding: 0; background-color: #F5F7F9;}.email-content{width: 100%; margin: 0; padding: 0;}/* Masthead ----------------------- */ .email-masthead{padding: 25px 0; text-align: center;}.email-masthead_logo{max-width: 400px; border: 0;}.email-masthead_name{font-size: 16px; font-weight: bold; color: #839197; text-decoration: none; text-shadow: 0 1px 0 white;}/* Body ------------------------------ */ .email-body{width: 100%; margin: 0; padding: 0; border-top: 1px solid #E7EAEC; border-bottom: 1px solid #E7EAEC; background-color: #FFFFFF;}.email-body_inner{width: 570px; margin: 0 auto; padding: 0;}.email-footer{width: 570px; margin: 0 auto; padding: 0; text-align: center;}.email-footer p{color: #839197;}.body-action{width: 100%; margin: 30px auto; padding: 0; text-align: center;}.body-sub{margin-top: 25px; padding-top: 25px; border-top: 1px solid #E7EAEC;}.content-cell{padding: 35px;}.align-right{text-align: right;}/* Type ------------------------------ */ h1{margin-top: 0; color: #292E31; font-size: 19px; font-weight: bold; text-align: left;}h2{margin-top: 0; color: #292E31; font-size: 16px; font-weight: bold; text-align: left;}h3{margin-top: 0; color: #292E31; font-size: 14px; font-weight: bold; text-align: left;}p{margin-top: 0; color: #839197; font-size: 16px; line-height: 1.5em; text-align: left;}p.sub{font-size: 12px;}p.center{text-align: center;}/* Buttons ------------------------------ */ .button{display: inline-block; width: 200px; background-color: #414EF9; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 45px; text-align: center; text-decoration: none; -webkit-text-size-adjust: none; mso-hide: all;}.button--green{background-color: #28DB67;}.button--red{background-color: #FF3665;}.button--blue{background-color: #414EF9;}/*Media Queries ------------------------------ */ @media only screen and (max-width: 600px){.email-body_inner, .email-footer{width: 100% !important;}}@media only screen and (max-width: 500px){.button{width: 100% !important;}}</style></head><body> <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0"> <tr> <td align="center"> <table class="email-content" width="100%" cellpadding="0" cellspacing="0"> <tr> <td class="email-masthead"> <a class="email-masthead_name">"Kimaara Jewellery"</a> </td></tr><tr> <td class="email-body" width="100%"> <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0"> <tr> <td class="content-cell"> <h1>Verify your email address</h1> <p>This is regarding your order on Kimaara Jewellery.</p><table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0"> <tr> <td align="center"> <div> <p>Here is your Email verification code: '.$emailVerifRandomCode.'. Provide it on our website to complete email verification.</p></div></td></tr></table> <p>Thanks,<br>The Kimaara Jewellery Team</p><table class="body-sub"> <tr> <td> <p class="sub"></p></td></tr></table> </td></tr></table> </td></tr><tr> <td> <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0"> <tr> <td class="content-cell"> <p class="sub center"> Kimaara Jewellery. <br>Mumbai, India </p></td></tr></table> </td></tr></table> </td></tr></table></body></html>';

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
            $mail->setFrom('emailverification@kimaara.com', 'Email Verification Dept.');
            $mail->addAddress($enteredEmail);               // Name is optional
            $mail->addReplyTo('noreply@kimaara.com', 'Email Verification');
            
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Email Verification for Registration';
            $mail->Body    = $body;

            $res = $mail->send();
                
            
            if($res){
                exit('email-send-success');
            }else{
                exit('email-send-fail');
            }

        }else {
            return 'customer-doesnt-exist';

                            
        }



    }

    public function create_customer_account(){
        $first_name = $this->request->getPost('fname');
        $last_name = $this->request->getPost('lname');
        $email = $_COOKIE['email_verified'];
        $passwordSet = $this->request->getPost('password');

        $customerData = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => password_hash($passwordSet,PASSWORD_DEFAULT),
            'mobile_number' => '',
            'role' => 'customer',
            'adhaar' => '',
            'pan' => '',
            'approved' => 'no'
        );

        $authModel = new AuthModel();

        $accountCreated = $authModel->insert($customerData);

        if($accountCreated){

            $customerDataNew = $authModel->where('email',$email)->where('role','customer')->first();

            $customerDataNew['password'] = '';

            $session = session();
            $session->set($customerDataNew);
            return 'account-created';
        }

    }

    public function vendor_login_exe(){
        $session = session();


        $enteredEmail = $this->request->getPost('vendor-email');

        $enteredPassword = $this->request->getPost('vendor-password');

    
        if(filter_var($enteredEmail, FILTER_VALIDATE_EMAIL)){

            $authModel = new AuthModel();

            $userData = $authModel->where('email',$enteredEmail)->where('role','vendor')->first();



            
            if (isset($userData)&&$userData['status']=='active') {
                
                $passwordCorrect = password_verify($enteredPassword,$userData['password']);

                if ($passwordCorrect) {
                    
                    $storeModel = new StoreModel();

                    $storeData = $storeModel->where("vendor",$userData["id"])->first();

                    if(!$storeData){
                        $storeData['code'] = 'NA';
                    }

                    $newdata = [
                        'id' => $userData['id'],
                        'first_name'  => $userData['first_name'],
                        'last_name'  => $userData['last_name'],
                        'email'     => $userData['email'],
                        'role' => $userData['role'],
                        'mobile_number' => $userData['mobile_number'],
                        'approved' => $userData['approved'],
                        'store_code' => $storeData['code']
                    ];
                
                    $session->set($newdata);                
                    
                    return redirect()->to(site_url('vendor-dashboard')); 

                } else {


                    $this->load_vendor_login_error('The Password entered is incorrect');                    

                }
                
            } else {

                $this->load_vendor_login_error('A vendor with ths email is not found or your account is disabled');
                

            }
            

        }else {


            $this->load_customer_login_error('Entered email invalid');

        }
    }

    public function create_vendor_account(){
        $first_name = $this->request->getPost('fname');
        $last_name = $this->request->getPost('lname');
        $email = $_COOKIE['email_verified'];
        $passwordSet = $this->request->getPost('password');

        $customerData = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => password_hash($passwordSet,PASSWORD_DEFAULT),
            'mobile_number' => '',
            'role' => 'vendor',
            'adhaar' => '',
            'pan' => '',
            'approved' => 'not-submitted',
            'status' => 'active'
        );

        $authModel = new AuthModel();

        $vendor_exists = $authModel->where('role','vendor')->where('email',$email)->first();

        if ($vendor_exists) {

            return 'account-exists-for-email';
            
        } else {
            
            $accountCreated = $authModel->insert($customerData);

            if($accountCreated){

                $vendorDataNew = $authModel->where('email',$email)->where('role','vendor')->first();

                $vendorDataNew['password'] = '';

                $session = session();
                $session->set($vendorDataNew);
                return 'account-created';
            }
            
        }
    }

    public function approve_vendor_exe(){

        $session = session();

        $role = $session->role;

        if($role!='admin'){
            return redirect()->to(site_url('admin-login')); 
        }

        $vendor_request_id = $this->request->getPost('vendor_request_id');

        $vendorApprovalModel = new VendorApprovalModel();

        $vendor_request = $vendorApprovalModel->find($vendor_request_id);

        $vendor_data = json_decode($vendor_request['vendor_data'],TRUE);

        $authModel = new AuthModel();

        $authModel->where('id',$vendor_data['id'])->set(['approved' => 'yes','adhaar'=>$vendor_request['adhaar_image'],'pan'=>$vendor_request['pan_image']])->update();

        $vendorApprovalModel->delete($vendor_request_id);

        return redirect()->to(site_url('vendors-mgt'));         

    }

    public function update_vendor_profile_by_admin(){

        $session = session();

        $role = $session->get('role');

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }

        $first_name = $this->request->getPost("first_name");
        $last_name = $this->request->getPost("last_name");
        $email = $this->request->getPost("email");
        $mobile_number = $this->request->getPost("mobile_number");

        $arrayData = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'mobile_number' => $mobile_number,
            'status' => $this->request->getPost("status")
        );

        $authModel = new AuthModel();

        $updated = $authModel->update($this->request->getPost("vendor_id"),$arrayData);
        
        return redirect()->to(site_url('edit-vendor-details/'.$this->request->getPost("vendor_id"))); 

    }

    private function vendor_page_loader($viewName,$data){

        echo view('templates/vendor_header',$data);
        echo view('vendorPages/'.$viewName,$data);
        echo view('templates/vendor_footer',$data);

    }

    public function update_vendor_pwd(){

        $session = session();

        $role = $session->role;

        if($role!='vendor'){
            return redirect()->to(site_url('vendor-login')); 
        }

        $authModel = new AuthModel();

        $vendor_id = $this->request->getPost("vendor_id");

        $vendorData = $authModel->find($vendor_id);

        if (password_verify($this->request->getPost("current_pwd"),$vendorData["password"])) {
            
            if($this->request->getPost("new_pwd")==$this->request->getPost("repeat_new_pwd")){

                $vendorData["password"] = password_hash($this->request->getPost("new_pwd"),PASSWORD_DEFAULT);

                $updated = $authModel->update($vendorData["id"],$vendorData);

                if ($updated) {

                    $data['title'] = 'Manage Account';
                    $data['error'] = ""; $data['success'] = 'Password updated successfully';
                    
                    $this->vendor_page_loader('manage_account',$data);
                    
                }

            }else {
                $data['title'] = 'Manage Account';
                $data['success'] = ""; $data['error'] = 'New Password repeated doesnt match';
                
                $this->vendor_page_loader('manage_account',$data);
            }

        }else {
            $data['title'] = 'Manage Account';
            $data['success'] = ""; $data['error'] = 'Current Password is incorrect';
            
            $this->vendor_page_loader('manage_account',$data);
        }

    }

    public function update_vendor_profile(){

        $session = session();

        $role = $session->role;

        if($role!='vendor'){
            return redirect()->to(site_url('vendor-login')); 
        }

        $authModel = new AuthModel();

        $vendor_id = $this->request->getPost("vendor_id");
        $first_name = $this->request->getPost("first_name");
        $last_name = $this->request->getPost("last_name");
        $email = $this->request->getPost("email");
        $mobile_number = $this->request->getPost("mobile_number");

        if($vendor_id!=''&&$first_name!=''&&$last_name!=''&&$email!=''){
            $vendor_data = $authModel->find($vendor_id);
        
            $vendor_data['first_name'] = $first_name;
            $vendor_data['last_name'] = $last_name;
            $vendor_data['email'] = $email;
            $vendor_data['mobile_number'] = $mobile_number;    
        
            $updated = $authModel->update($vendor_data['id'],$vendor_data);

            $session->set($vendor_data);

            if ($updated) {
                return redirect()->to(site_url('manage-account-vendor'));
            }
            
        }else {
            return redirect()->to(site_url('manage-account-vendor'));
        }
        
        
    }

    public function reject_vendor_exe(){

        $session = session();

        $role = $session->role;

        if($role!='admin'){
            return redirect()->to(site_url('admin-login')); 
        }

        $vendor_request_id = $this->request->getPost('vendor_request_id');

        $vendorApprovalModel = new VendorApprovalModel();

        $vendor_request = $vendorApprovalModel->find($vendor_request_id);

        $vendor_data = json_decode($vendor_request['vendor_data'],TRUE);

        $authModel = new AuthModel();

        $authModel->where('id',$vendor_data['id'])->set(['approved' => 'rejected'])->update();

        $vendorApprovalModel->delete($vendor_request_id);

        return redirect()->to(site_url('vendors-mgt'));         

    }

    public function submit_vendor_for_approval(){

        $session = session();

        $role = $session->role;

        if($role!='vendor'){
            return redirect()->to(site_url('vendor-login')); 
        }

        $adhaarImage = $this->request->getFile('adhaar_image');


        if (! $adhaarImage->hasMoved()) {

            $adhaarImageRandomName = $adhaarImage->getRandomName();

            $adhaarImage->move('assets/vendor_docs', $adhaarImageRandomName);

        }

        $panImage = $this->request->getFile('pan_image');

        if (! $panImage->hasMoved()) {

            $panImageRandomName = $panImage->getRandomName();

            $panImage->move('assets/vendor_docs', $panImageRandomName);

        }

        $authModel = new AuthModel();


        $user_id = $this->request->getPost('vendor_user_id');
        $vendorData = $authModel->find($user_id);
        $vendorData['mobile_number'] = $this->request->getPost('contact_number');
        $vendorDataJson = json_encode($vendorData);

        $dataToInsert = array(
            'vendor_data' => $vendorDataJson,
            'adhaar_image' => $adhaarImageRandomName,
            'pan_image' => $panImageRandomName
        );

        $vendorApprovalModel = new VendorApprovalModel();

        $created = $vendorApprovalModel->insert($dataToInsert);

        if ($created) {

            $updated = $authModel->where('id', $vendorData['id'])->set(['approved' => 'no'])->update();
            
            $session = session();

            $session->set('approved', 'no');

            if ($updated) {
                return redirect()->to(site_url('vendor-dashboard')); 
            }

        }

    }

    public function verify_email_exe(){
        $enteredCode = $this->request->getPost('enteredCode');
        $otpModel = new OtpModel();
        $codeExists = $otpModel->otp_exists($enteredCode);
        if ($codeExists) {
            setcookie('email_verified',$codeExists['email']);
            return $codeExists['email'];
        }else {
            return 'code-incorrect';
        }
    }

    public function reset_customer_password(){
        $userEmail = $this->request->getPost('userEmail');
        $password = $this->request->getPost('password');
        $authModel = new AuthModel();
        $userData = $authModel->where('role','customer')->where('email',$userEmail)->first();
        $userData['password'] = password_hash($password,PASSWORD_DEFAULT);
        $passwordReset = $authModel->update($userData['id'],$userData);
        if($passwordReset){
            return 'password-reset-success';
        }else{
            return 'password-reset-fail';
        }
    }

	public function login()
	{

        $session = session();

        $enteredEmail = $this->request->getPost('admin-email');

        $enteredPassword = $this->request->getPost('admin-password');
    
        if(filter_var($enteredEmail, FILTER_VALIDATE_EMAIL)){

            $authModel = new AuthModel();

            $userData = $authModel->where('email',$enteredEmail)->where('role','admin')->first();
            
            if ($userData) {
                
                $passwordCorrect = password_verify($enteredPassword,$userData['password']);

                if ($passwordCorrect) {
                    
                    $newdata = [
                        'first_name'  => $userData['first_name'],
                        'last_name'  => $userData['last_name'],
                        'email'     => $userData['email'],
                        'role' => 'admin'
                    ];
                
                    $session->set($newdata);                
                    
                    return redirect()->to(site_url('admin-dashboard')); 

                } else {



                    $this->load_admin_login_error('The Password entered is incorrect');                    

                }
                
            } else {

                $this->load_admin_login_error('An admin with ths email is not found');
                

            }
            

        }else {

            $this->load_admin_login_error('Entered email invalid');

        }

    }

    public function customer_login()
	{

        $session = session();


        $enteredEmail = $this->request->getPost('customer-email');

        $enteredPassword = $this->request->getPost('customer-password');

    
        if(filter_var($enteredEmail, FILTER_VALIDATE_EMAIL)){

            $authModel = new AuthModel();

            $userData = $authModel->where('email',$enteredEmail)->where('role','customer')->first();


            
            if ($userData) {
                
                $passwordCorrect = password_verify($enteredPassword,$userData['password']);

                if ($passwordCorrect) {
                    
                    $newdata = [
                        'id' => $userData['id'],
                        'first_name'  => $userData['first_name'],
                        'last_name'  => $userData['last_name'],
                        'email'     => $userData['email'],
                        'role' => $userData['role']
                    ];
                
                    $session->set($newdata);                
                    
                    return redirect()->to(site_url('my-account')); 

                } else {


                    $this->load_customer_login_error('The Password entered is incorrect');                    

                }
                
            } else {

                $this->load_customer_login_error('A customer with ths email is not found');
                

            }
            

        }else {


            $this->load_customer_login_error('Entered email invalid');

        }

    }

    private function public_page_loader($viewName,$data){

        $cartModel = new CartModel();

		$cart_items = $cartModel->fetch_all_cart_items();

		$data['cart_item_count'] = count($cart_items);

		echo view('templates/header',$data);
		echo view('sitePages/'.$viewName,$data);
		echo view('templates/footer',$data);

	}


    public function logout(){
        $session = session();   
        $session->destroy();
        return redirect()->to(site_url('')); 
    }

    public function update_customer_profile(){

        $session = session();
        $role = $session->get('role');
        
        if($role!='customer'){
            return redirect()->to(site_url('customer-login')); 
        }

        $first_name = $this->request->getPost('first_name');
        $last_name = $this->request->getPost('last_name');
        $email = $this->request->getPost('email');
        $contact_number = $this->request->getPost('mobile_number');

        $authModel = new AuthModel();

        $customerData = $authModel->find($this->request->getPost('cust_id'));

        $customerData['first_name'] = $first_name;
        $customerData['last_name'] = $last_name;
        $customerData['email'] = $email;
        $customerData['mobile_number'] = $contact_number;


        $categoryModel = new CategoryModel();

        $data['categories'] = $categoryModel->findAll();

        $orderModel = new OrderModel();

		$data['orders'] =  $orderModel->where('customer_email',$session->get('email'))->findAll();


        $authModel->update($this->request->getPost('cust_id'),$customerData);

        $session = session();

        $session->set($customerData);

        $data['title'] = 'My Account';
        
        $data['userdata'] = $customerData;

        $this->public_page_loader('my_account',$data);

        
    }

    public function customer_login_api()
	{

        $session = session();

        $enteredEmail = $this->request->getPost('customer-email');

        $enteredPassword = $this->request->getPost('customer-password');
    
        if(filter_var($enteredEmail, FILTER_VALIDATE_EMAIL)){

            $authModel = new AuthModel();

            $userData = $authModel->where('email',$enteredEmail)->where('role','customer')->first();
            
            if ($userData) {
                
                $passwordCorrect = password_verify($enteredPassword,$userData['password']);

                if ($passwordCorrect) {
                    
                    $newdata = [
                        'first_name'  => $userData['first_name'],
                        'last_name'  => $userData['last_name'],
                        'email'     => $userData['email'],
                        'role' => $userData['role']
                    ];
                
                    $session->set($newdata);                
                    
                    return ('login-success');

                } else {

                    return ('password-incorrect');

                }
                
            } else {

                return ('email-incorrect');
                

            }
            

        }else {

            return ('email-invalid');
            
        }

    }

    private function load_admin_login_error($errorMessage){
        $data['title'] = 'Admin Login';
        $data['error'] = $errorMessage;
        $categoryModel = new CategoryModel();
        $cartModel = new CartModel();

        $cache = \Config\Services::cache();

        

        if(!$cache->get('catsByPos')){
			$catPosModel = new CategoryPositionModel();
			$catsByPos = $catPosModel->first();;	
			$cache->save('catsByPos',$catsByPos,24*60*60);
			$data['catsByPos'] = $cache->get('catsByPos');
		}else {
			$data['catsByPos'] = $cache->get('catsByPos');
		}


        $cart_items = $cartModel->fetch_all_cart_items();		$data['cart_item_count'] = count($cart_items);

        $data['categories'] =  $categories = $categoryModel->findAll();


        echo view('templates/header',$data);
        echo view('sitePages/admin_login',$data);
        echo view('templates/footer',$data);
    }
    private function load_customer_login_error($errorMessage){
        $data['title'] = 'Customer Login';
        $data['error'] = $errorMessage;
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll();

        $cartModel = new CartModel();

        $cart_items = $cartModel->fetch_all_cart_items();		$data['cart_item_count'] = count($cart_items);


        echo view('templates/header',$data);
        echo view('sitePages/customer_login',$data);
        echo view('templates/footer',$data);
    }
    private function load_vendor_login_error($errorMessage){
        $data['title'] = 'Vendor Login';
        $data['error'] = $errorMessage;
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll();

        $cartModel = new CartModel();

        $cart_items = $cartModel->fetch_all_cart_items();		
        $data['cart_item_count'] = count($cart_items);

        $cache = \Config\Services::cache();

        if(!$cache->get('catsByPos')){
			$catPosModel = new CategoryPositionModel();
			$catsByPos = $catPosModel->first();;	
			$cache->save('catsByPos',$catsByPos,24*60*60);
			$data['catsByPos'] = $cache->get('catsByPos');
		}else {
			$data['catsByPos'] = $cache->get('catsByPos');
		}

        echo view('templates/header',$data);
        echo view('sitePages/vendor_login',$data);
        echo view('templates/footer',$data);
    }

}