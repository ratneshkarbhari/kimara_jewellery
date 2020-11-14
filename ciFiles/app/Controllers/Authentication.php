<?php namespace App\Controllers;

require_once ROOTPATH.'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once ROOTPATH.'vendor/phpmailer/phpmailer/src/Exception.php';
require_once ROOTPATH.'vendor/phpmailer/phpmailer/src/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


use App\Models\AuthModel;
use App\Models\CategoryModel;
use App\Models\CartModel;
use App\Models\OrderModel;
use App\Models\OtpModel;


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

            $body =  '<p>Here is your Email verification code: '.$emailVerifRandomCode.'. Provide it on our website to complete email verification.</p>';

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
            'role' => 'customer'
        );

        $authModel = new AuthModel();

        $accountCreated = $authModel->insert($customerData);

        if($accountCreated){
            $session = session();
            $session->set($customerData);
            return 'account-created';
        }

    }

    public function verify_email_exe(){
        $enteredCode = $this->request->getPost('enteredCode');
        $otpModel = new OtpModel();
        $codeExists = $otpModel->otp_exists($enteredCode);
        if ($codeExists) {
            setcookie('email_verified',$codeExists['email']);
            $otpModel->delete($codeExists['id']);
            return 'otp-correct';
        }else {
            return 'code-incorrect';
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
        return redirect()->to(site_url('/')); 
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

}