<?php namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\StoreModel;

class VendorPageLoader extends BaseController
{

    

    private function vendor_page_loader($viewName,$data){

        echo view('templates/vendor_header',$data);
        echo view('vendorPages/'.$viewName,$data);
        echo view('templates/vendor_footer',$data);

    }


    public function manage_store(){

        $session = session();

		$role = $session->get('role');

		if($role!='vendor'){
			return redirect()->to(site_url('vendor-login')); 
        }
    
        $data['success'] = $data['error'] = '';

        $storeModel = new StoreModel();
        
        $existingStore = $storeModel->where("vendor",$_SESSION['id'])->first();

        

        if ($existingStore) {

            $data['existing_store'] = $existingStore; 
            $data['title'] = 'Manage Store';
            
            $this->vendor_page_loader('manage_store',$data);
            
        } else {

            $data['title'] = 'Create Store';

            $this->vendor_page_loader('create_store',$data);
            
        }

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