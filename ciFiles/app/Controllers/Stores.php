<?php namespace App\Controllers;

use App\Models\StoreModel;
use App\Models\ProductModel;

class Stores extends BaseController
{

    public function create_exe(){
    
        $session = session();

		$role = $session->get('role');

		if($role!='vendor'){
			return redirect()->to(site_url('vendor-login')); 
        }
    
        $logo = $this->request->getFile('logo');

        if ($logo->isValid()) {

            $logoRandomName = $logo->getRandomName();

            $logo->move('assets/store_logos', $logoRandomName);
            
        }else {

            $logoRandomName = "noimage.jpg";
            
        }

        $newData = array(
            'name' => $this->request->getPost("name"),
            'code' => $this->request->getPost("code"),
            'logo' => $logoRandomName,
            'vendor' => $this->request->getPost("vendor_id")
        );

        $storeModel = new StoreModel();

        $exists = $storeModel->where("vendor",$this->request->getPost("vendor_id"))->first();

        if ($exists) {
            $created = $storeModel->update($exists['id'],$newData);
        } else {
            $created = $storeModel->insert($newData);
        }

        return redirect()->to(site_url('manage-store-vendor'));
        
    }

}