<?php namespace App\Controllers;

require_once ROOTPATH.'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once ROOTPATH.'vendor/phpmailer/phpmailer/src/Exception.php';
require_once ROOTPATH.'vendor/phpmailer/phpmailer/src/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


use App\Models\OrderModel;
use App\Models\CartModel;
use App\Models\StoreModel;
use App\Models\AuthModel;

class Orders extends BaseController
{

    public function create(){

        $cartModel = new CartModel();

        $cartItems = $cartModel->fetch_all_cart_items();

        $payee_customer_email = $this->request->getPost('payee_customer_email');
        $payee_customer_name = $this->request->getPost('payee_customer_name');
        $amount = $this->request->getPost('amount');

        $contactNumber = $this->request->getPost('contact_number');
        $shippingAddress = $this->request->getPost('shipping_address');
        $billingAddress = $this->request->getPost('billing_address');

        $items_qty_json = '';

        $itemsJsonObject = array();

        foreach($cartItems as $cartItem){
            $itemsJsonObject[] = array(
                'product_id' => $cartItem['product_id'],
                'quantity' => $cartItem['quantity'],
                'material' => $cartItem['material'],
                'size' => $cartItem['size']
            );
        }

        $items_qty_json = json_encode($itemsJsonObject);

        $publicOrderId = uniqid();


        $orderObject = array(
            'public_order_id' => $publicOrderId,
            'products_qty_json' => $items_qty_json,
            'amount_paid' => $amount,
            'status' => 'placed',
            'status_details' => 'Order is placed by payment made via RazorPay',
            'customer_email' => $payee_customer_email,
            'customer_name' => $payee_customer_name,
            'mode' => 'prepaid',
            'contact_number' => $contactNumber,
            'shipping_address' => $shippingAddress,
            'billing_address' => $billingAddress,
            'date' => date("d-m-Y"),
            'store' => $this->request->getPost("store"),
            'code' => $this->request->getPost("coupon")
        );

        $orderModel = new OrderModel();

        $res = $orderModel->insert($orderObject);

 
        if ($res) {
            setcookie('latest_order_id',$publicOrderId,time()+600);
            $cartModel->where('ip_address', $_SERVER['REMOTE_ADDR'])->delete();
            $this->order_create_notification($orderObject);
            exit('success');
        }else {
            exit('failure');
        }

    }

    public function create_vendor(){

        $cartModel = new CartModel();

        $cartItems = $cartModel->fetch_all_cart_items_store($this->request->getPost('store'));

        $payee_customer_email = $this->request->getPost('payee_customer_email');
        $payee_customer_name = $this->request->getPost('payee_customer_name');
        $amount = $this->request->getPost('amount');

        $contactNumber = $this->request->getPost('contact_number');
        $shippingAddress = $this->request->getPost('shipping_address');
        $billingAddress = $this->request->getPost('billing_address');

        $items_qty_json = '';

        $itemsJsonObject = array();

        foreach($cartItems as $cartItem){
            $itemsJsonObject[] = array(
                'product_id' => $cartItem['product_id'],
                'quantity' => $cartItem['quantity'],
                'material' => $cartItem['material'],
                'size' => $cartItem['size']
            );
        }

        $items_qty_json = json_encode($itemsJsonObject);

        $publicOrderId = uniqid();

        $storeCode = $this->request->getPost("store");

        

        $orderObject = array(
            'public_order_id' => $publicOrderId,
            'products_qty_json' => $items_qty_json,
            'amount_paid' => $amount,
            'status' => 'placed',
            'status_details' => 'Order is placed by payment made via RazorPay',
            'customer_email' => $payee_customer_email,
            'customer_name' => $payee_customer_name,
            'mode' => 'prepaid',
            'contact_number' => $contactNumber,
            'shipping_address' => $shippingAddress,
            'billing_address' => $billingAddress,
            'date' => date("d-m-Y"),
            'store' => $storeCode,
            'code' => $this->request->getPost("coupon")
        );

        $orderModel = new OrderModel();

        $res = $orderModel->insert($orderObject);

 
        if ($res) {
            setcookie('latest_order_id',$publicOrderId,time()+600);
            $cartModel->where('ip_address', $_SERVER['REMOTE_ADDR'])->delete();
            $this->order_create_notification($orderObject);
            $storeModel = new StoreModel();
            $authModel = new AuthModel();
            $storeData = $storeModel->where("code",$storeCode)->first();
            $vendorData = $authModel->where("id",$storeData['vendor'])->first();
            $this->order_create_notification_vendor($orderObject,$vendorData["email"]);
            exit('success');
        }else {
            exit('failure');
        }

    }

    public function delete(){

        $orderModel = new OrderModel();

        $orderData = $orderModel->find($this->request->getPost("id"));

        $orderDeleted = $orderModel->delete($orderData["id"]);

        if ($orderDeleted) {
            
            $data['title'] = 'Orders';
            $orderModel = new OrderModel();
            $orders = $orderModel->findAll();
    
            $data['orders'] = array_reverse($orders);
    
            $this->admin_page_loader('orders',$data);

        } else {

            $data['title'] = 'Orders';
            $orderModel = new OrderModel();
            $orders = $orderModel->findAll();
    
            $data['orders'] = array_reverse($orders);
    
            $this->admin_page_loader('orders',$data);
            
        }
        

    }

    public function create_cod_order(){

        $cartModel = new CartModel();

        $cartItems = $cartModel->fetch_all_cart_items();

        $payee_customer_email = $this->request->getPost('payee_customer_email');
        $payee_customer_name = $this->request->getPost('payee_customer_name');
        $amount = $this->request->getPost('amount');

        $contactNumber = $this->request->getPost('contact_number');
        $shippingAddress = $this->request->getPost('shipping_address');
        $billingAddress = $this->request->getPost('billing_address');

        $items_qty_json = '';

        $itemsJsonObject = array();

        foreach($cartItems as $cartItem){
            $itemsJsonObject[] = array(
                'product_id' => $cartItem['product_id'],
                'quantity' => $cartItem['quantity'],
                'material' => $cartItem['material'],
                'size' => $cartItem['size']
            );
        }

        $items_qty_json = json_encode($itemsJsonObject);

        $publicOrderId = uniqid();


        $orderObject = array(
            'public_order_id' => $publicOrderId,
            'products_qty_json' => $items_qty_json,
            'amount_paid' => $amount,
            'status' => 'placed',
            'status_details' => 'Order is placed by COD',
            'customer_email' => $payee_customer_email,
            'customer_name' => $payee_customer_name,
            'mode' => 'cod',
            'contact_number' => $contactNumber,
            'shipping_address' => $shippingAddress,
            'billing_address' => $billingAddress,
            'date' => date("m-d-Y"),
            'store' => $this->request->getPost("store")
        );

        $orderModel = new OrderModel();

        $res = $orderModel->insert($orderObject);

 
        if ($res) {
            setcookie('latest_order_id',$publicOrderId,time()+600);
            $cartModel->where('ip_address', $_SERVER['REMOTE_ADDR'])->delete();
            exit('success');
        }else {
            exit('failure');
        }

    }

    public function update(){
        $session = session();

        $role = $session->get('role');
        
        if($role!='admin'){
            return redirect()->to(site_url('admin-login')); 
        }

        $orderModel = new OrderModel();

        $orderData = $orderModel->where('public_order_id',$this->request->getPost('order_id'))->first();

        if ($orderData) {
            
            $orderData['status'] = $this->request->getPost('orderStatus');

            $orderData['status_details'] = $this->request->getPost('orderStatusDetails');

            $updated = $orderModel->update($orderData['id'],$orderData);

            if($updated){

                $emailSent = $this->send_order_status_change_email($orderData['customer_email'],'Order status change',$orderData);

                $data['title'] = 'Orders';
                $orders = $orderModel->findAll();
        
                $data['orders'] = array_reverse($orders);
        
                $this->admin_page_loader('orders',$data);

            }

        }
        
    }

    private function send_order_status_change_email($recipient, $message, $orderData){

        
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        $from = "orderprocessing@kimaara.com";

        // Create email headers
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();


        $body    = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head> <meta name="viewport" content="width=device-width, initial-scale=1.0"/> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <title>Verify your email address</title> <style type="text/css" rel="stylesheet" media="all"> /* Base ------------------------------ */ *:not(br):not(tr):not(html){font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; -webkit-box-sizing: border-box; box-sizing: border-box;}body{width: 100% !important; height: 100%; margin: 0; line-height: 1.4; background-color: #F5F7F9; color: #0a0a0a; -webkit-text-size-adjust: none;}a{color: #414EF9;}/* Layout ------------------------------ */ .email-wrapper{width: 100%; margin: 0; padding: 0; background-color: #F5F7F9;}.email-content{width: 100%; margin: 0; padding: 0;}/* Masthead ----------------------- */ .email-masthead{padding: 25px 0; text-align: center;}.email-masthead_logo{max-width: 400px; border: 0;}.email-masthead_name{font-size: 16px; font-weight: bold; color: #839197; text-decoration: none; text-shadow: 0 1px 0 white;}/* Body ------------------------------ */ .email-body{width: 100%; margin: 0; padding: 0; border-top: 1px solid #E7EAEC; border-bottom: 1px solid #E7EAEC; background-color: #FFFFFF;}.email-body_inner{width: 570px; margin: 0 auto; padding: 0;}.email-footer{width: 570px; margin: 0 auto; padding: 0; text-align: center;}.email-footer p{color: #839197;}.body-action{width: 100%; margin: 30px auto; padding: 0; text-align: center;}.body-sub{margin-top: 25px; padding-top: 25px; border-top: 1px solid #E7EAEC;}.content-cell{padding: 35px;}.align-right{text-align: right;}/* Type ------------------------------ */ h1{margin-top: 0; color: #292E31; font-size: 19px; font-weight: bold; text-align: left;}h2{margin-top: 0; color: #292E31; font-size: 16px; font-weight: bold; text-align: left;}h3{margin-top: 0; color: #292E31; font-size: 14px; font-weight: bold; text-align: left;}p{margin-top: 0; color: #839197; font-size: 16px; line-height: 1.5em; text-align: left;}p.sub{font-size: 12px;}p.center{text-align: center;}/* Buttons ------------------------------ */ .button{display: inline-block; width: 200px; background-color: #414EF9; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 45px; text-align: center; text-decoration: none; -webkit-text-size-adjust: none; mso-hide: all;}.button--green{background-color: #28DB67;}.button--red{background-color: #FF3665;}.button--blue{background-color: #414EF9;}/*Media Queries ------------------------------ */ @media only screen and (max-width: 600px){.email-body_inner, .email-footer{width: 100% !important;}}@media only screen and (max-width: 500px){.button{width: 100% !important;}}</style></head><body> <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0"> <tr> <td align="center"> <table class="email-content" width="100%" cellpadding="0" cellspacing="0"> <tr> <td class="email-masthead"> <a class="email-masthead_name">"Kimaara Jewellery"</a> </td></tr><tr> <td class="email-body" width="100%"> <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0"> <tr> <td class="content-cell"> <h1>Verify your email address</h1> <p>This is regarding your order on Kimaara Jewellery.</p><table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0"> <tr> <td align="center"> <div> <p>Your Order with the ID: '.$orderData['public_order_id'].' has its order status changed to '.$orderData['status'].'</p></div></td></tr></table> <p>Thanks,<br>The Kimaara Jewellery Team</p><table class="body-sub"> <tr> <td> <p class="sub"></p></td></tr></table> </td></tr></table> </td></tr><tr> <td> <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0"> <tr> <td class="content-cell"> <p class="sub center"> Kimaara Jewellery. <br>Mumbai, India </p></td></tr></table> </td></tr></table> </td></tr></table></body></html>';
        
        $res = mail($recipient,"Order Status Change",$body,$headers);

        if($res){
            exit(TRUE);           
        }

    }

    private function order_create_notification_vendor($orderData,$vendoremail){

        
        $from = "orderprocessing@kimaara.com";


        $body    = '<h1>New Order Details:</h1> <br><br>
        <h4>'.$orderData['customer_name'].'</h4>
        <h5>'.$orderData['customer_email'].'</h5>
        <p>Amount: Rs. '.$orderData['amount_paid'].'</p>
        <p>Order Link: <a href="'.site_url('order-details/'.$orderData['public_order_id']).'">See Full Details</a></p>
        ';

        $mail = new PHPMailer(true);

        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'mail.kimaara.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'orderprocessing@kimaara.com';                     // SMTP username
        $mail->Password   = 'ratnesh@47';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('orderprocessing@kimaara.com', 'Order Processing Dept.');
        $mail->addAddress($vendoremail);               // Name is optional
        $mail->addReplyTo('noreply@kimaara.com', 'Order Processing');
        
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'New Order on Kimaara Jewellery';
        $mail->Body    = $body;

        $res = $mail->send();
                


        if($res){
            exit(TRUE);           
        }

    }
    private function order_create_notification($orderData){

        
        $from = "orderprocessing@kimaara.com";


        $body    = '<h1>New Order Details:</h1> <br><br>
        <h4>'.$orderData['customer_name'].'</h4>
        <h5>'.$orderData['customer_email'].'</h5>
        <p>Amount: Rs. '.$orderData['amount_paid'].'</p>
        <p>Order Link: <a href="'.site_url('order-details/'.$orderData['public_order_id']).'">See Full Details</a></p>
        ';

        $mail = new PHPMailer(true);

        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'mail.kimaara.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'orderprocessing@kimaara.com';                     // SMTP username
        $mail->Password   = 'ratnesh@47';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('orderprocessing@kimaara.com', 'Order Processing Dept.');
        $mail->addAddress('kimaarasilver@gmail.com');               // Name is optional
        $mail->addReplyTo('noreply@kimaara.com', 'Order Processing');
        
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'New Order on Kimaara Jewellery';
        $mail->Body    = $body;

        $res = $mail->send();
                


        if($res){
            exit(TRUE);           
        }

    }

    private function admin_page_loader($viewName,$data){

        echo view('templates/admin_header',$data);
        echo view('adminPages/'.$viewName,$data);
        echo view('templates/admin_footer',$data);

    }

}