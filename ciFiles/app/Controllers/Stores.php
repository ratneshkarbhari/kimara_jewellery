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

        $exists = $storeModel->where("code",$this->request->getPost("code"))->first();

        if (!$exists) {
            $created = $storeModel->insert($newData);
        }

        return redirect()->to(site_url('manage-store-vendor'));
        
    }

    public function update_exe(){
    
        $session = session();

		$role = $session->get('role');

		if($role!='vendor'){
			return redirect()->to(site_url('vendor-login')); 
        }

        $storeModel = new StoreModel();
    
        $store_id = $this->request->getPost("store_id");
        
        $prevStoreData = $storeModel->find($store_id);

        $logo = $this->request->getFile('logo');

        if ($logo->isValid()) {

            $featuredImageFolderPath = './assets/store_logos';

            $currentLogoPath = $featuredImageFolderPath.$prevStoreData["logo"];

            if (is_file($currentLogoPath)) {
                unlink($currentLogoPath);
            }

            $logoRandomName = $logo->getRandomName();

            $logo->move('assets/store_logos', $logoRandomName);
            
        }else {

            $logoRandomName = $prevStoreData["logo"];
            
        }

        $newData = array(
            'name' => $this->request->getPost("name"),
            'code' => $this->request->getPost("code"),
            'logo' => $logoRandomName,
            'vendor' => $this->request->getPost("vendor_id")
        );

        $exists = $storeModel->where("code",$this->request->getPost("code"))->first();

        if (!$exists&&$exists["id"]!=$prevStoreData["id"]) {


            return redirect()->to(site_url('manage-store-vendor'));
        }else{
            $updated = $storeModel->update($prevStoreData['id'],$newData);            
        }


        
    }

    public function update_products_exe(){
        $session = session();

		$role = $session->get('role');

		if($role!='vendor'){
			return redirect()->to(site_url('vendor-login')); 
        }

        $storeModel = new StoreModel();
    
        $store_id = $this->request->getPost("store_id");
        $storeData = $storeModel->find($store_id);

        $productsSelected = $this->request->getPost("selected_products");

        $productsSelectedJson = json_encode($productsSelected);

        $storeData["product_ids"] = $productsSelectedJson;


        $updated = $storeModel->update($store_id,$storeData);


        return redirect()->to(site_url('update-store-products'));       



    }

}