<?php namespace App\Controllers;

class AdminPageLoader extends BaseController
{

    private function send_to_login(){

        $session = session();

		$role = $session->get('role');

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }

    }

	public function dashboard()
	{

        $this->send_to_login();
        
        $data['title'] = 'Admin Dashboard';
        
        echo view('templates/admin_header',$data);
        echo view('adminPages/dashboard',$data);
        echo view('templates/admin_footer',$data);

    }
}