<?php namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\CategoryModel;
use App\Models\OrderModel;


class Authentication extends BaseController
{

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

        $categoryModel = new CategoryModel();

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

                    $data['categories'] = $categoryModel->findAll();

                    $this->load_customer_login_error('The Password entered is incorrect');                    

                }
                
            } else {

                $this->load_customer_login_error('A customer with ths email is not found');
                

            }
            

        }else {


            $data['categories'] = $categoryModel->findAll();

            $this->load_customer_login_error('Entered email invalid');

        }

    }

    private function public_page_loader($viewName,$data){

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

        echo view('templates/header',$data);
        echo view('sitePages/admin_login',$data);
        echo view('templates/footer',$data);
    }
    private function load_customer_login_error($errorMessage){
        $data['title'] = 'Customer Login';
        $data['error'] = $errorMessage;

        echo view('templates/header',$data);
        echo view('sitePages/custoer_login',$data);
        echo view('templates/footer',$data);
    }

}