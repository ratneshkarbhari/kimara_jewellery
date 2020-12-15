<?php namespace App\Controllers;


class VendorPageLoader extends BaseController
{

    private function send_to_login(){

        $session = session();

		$role = $session->get('role');

		if($role!='vendor'){
			return redirect()->to(site_url('vendor-login')); 
        }

    }

    

    private function vendor_page_loader($viewName,$data){

        echo view('templates/vendor_header',$data);
        echo view('vendorPages/'.$viewName,$data);
        echo view('templates/vendor_footer',$data);

    }


    
	public function dashboard()
	{

        $this->send_to_login();
        
        $data['title'] = 'Vendor Dashboard';
        
        $this->vendor_page_loader('dashboard',$data);

    }

    
}