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

    
        $product_id = $this->request->getPost("product_id");
        $category_id = $this->request->getPost("category_id");
        $store_id = $this->request->getPost("store_id");

        $storeModel = new StoreModel();

        $storeData = $storeModel->find($store_id);

        $storeProducts = json_decode($storeData["product_ids"],TRUE);

        $storeCategories = json_decode($storeData["category_ids"],TRUE);

        if(is_array($storeProducts)){
            if(!in_array($product_id,$storeProducts)){
                $storeProducts[] = $product_id;
                $storeData["product_ids"] = json_encode($storeProducts);
                if(is_array($storeCategories)){
                    if(!in_array($category_id,$storeCategories)){
                        $storeCategories[] = $category_id;
                        $storeData["category_ids"] = json_encode($storeCategories);
                    }
                }else {
                    $storeCategories = array();
                    if(!in_array($category_id,$storeCategories)){
                        $storeCategories[] = $category_id;
                        $storeData["category_ids"] = json_encode($storeCategories);
                    }
                }
            }            
        }else {
            $storeProducts = array();
            if(!in_array($product_id,$storeProducts)){
                $storeProducts[] = $product_id;
                $storeData["product_ids"] = json_encode($storeProducts);
                if(is_array($storeCategories)){
                    if(!in_array($category_id,$storeCategories)){
                        $storeCategories[] = $category_id;
                        $storeData["category_ids"] = json_encode($storeCategories);
                    }
                }else {
                    $storeCategories = array();
                    if(!in_array($category_id,$storeCategories)){
                        $storeCategories[] = $category_id;
                        $storeData["category_ids"] = json_encode ($storeCategories);
                    }
                }
            }      
        }

        $storeModel->update($store_id,$storeData);

        exit("Done");

    }
    public function remove_products_exe(){

    
        $product_id = $this->request->getPost("product_id");
        $store_id = $this->request->getPost("store_id");

        $storeModel = new StoreModel();

        $storeData = $storeModel->find($store_id);

        $storeProducts = json_decode($storeData["product_ids"],TRUE);


        $key = array_search($product_id,$storeProducts);

        unset($storeProducts[$key]);
       
        array_values($storeProducts);

        $stprojson = json_encode($storeProducts);

        $storeData["product_ids"] = $stprojson;

        $storeModel->update($store_id,$storeData);

        exit("done");

    }

    public function search_products(){
        
    }

    public function add_products_exe(){
        $session = session();

		$role = $session->get('role');

		if($role!='vendor'){
			return redirect()->to(site_url('vendor-login')); 
        }

        $storeModel = new StoreModel();
    
        $store_id = $this->request->getPost("store_id");
        $storeData = $storeModel->find($store_id);

        $productsInStoreArray = json_decode($storeData["product_ids"],TRUE);

        $productsToBeAddedArray = $this->request->getPost("selected_products");

        foreach ($productsToBeAddedArray as $pr2Add) {
            if (!in_array($pr2Add,$productsInStoreArray)) {
                $productsInStoreArray[] = $pr2Add;
            }
        }

        $storeData["product_ids"] = json_encode($productsInStoreArray);

        $updated = $storeModel->update($storeData["id"],$storeData);
    
        return redirect()->to(site_url('update-store-products')); 

    }

}