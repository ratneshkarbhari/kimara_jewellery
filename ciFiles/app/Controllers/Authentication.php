<?php namespace App\Controllers;

use App\Models\AuthModel;


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

    public function logout(){
        $session = session();   
        $session->destroy();
        return redirect()->to(site_url('/')); 
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