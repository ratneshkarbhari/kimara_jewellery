<?php namespace App\Controllers;

class PublicPageLoader extends BaseController
{


	public function admin_login()
	{

		$session = session();

		$role = $session->get('role');

		if($role=='admin'){
			return redirect()->to(site_url('admin-dashboard')); 
		}
		
		$data['title'] = 'Admin Login';
		$data['error'] = '';

		echo view('templates/header',$data);
		echo view('sitePages/admin_login',$data);
		echo view('templates/footer',$data);

	}

	public function not_found()
	{
		
		$data['title'] = 'Page Not Found';
		$data['error'] = '';

		echo view('templates/header',$data);
		echo view('sitePages/not_found',$data);
		echo view('templates/footer',$data);

	}
	//--------------------------------------------------------------------

}
