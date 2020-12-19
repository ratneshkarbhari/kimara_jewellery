<?php namespace App\Controllers;


class VendorPageLoader extends BaseController
{

    

    private function vendor_page_loader($viewName,$data){

        echo view('templates/vendor_header',$data);
        echo view('vendorPages/'.$viewName,$data);
        echo view('templates/vendor_footer',$data);

    }


    
	public function dashboard()
	{

        $session = session();

		$role = $session->get('role');

		if($role!='vendor'){
			return redirect()->to(site_url('vendor-login')); 
        }
    
        $data['title'] = 'Vendor Dashboard';
        
        $this->vendor_page_loader('dashboard',$data);

    }

    public function manage_account()
	{

        $session = session();

		$role = $session->get('role');

		if($role!='vendor'){
			return redirect()->to(site_url('vendor-login')); 
        }
    
        $data['title'] = 'Manage Account';
        $data['success'] = $data['error'] = '';
        
        $this->vendor_page_loader('manage_account',$data);

    }

    
}