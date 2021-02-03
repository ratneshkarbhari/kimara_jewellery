<?php namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\StoreModel;
use App\Models\OrderModel;
use App\Models\CategoryModel;
use App\Models\CouponModel;

class VendorPageLoader extends BaseController
{

    

    private function vendor_page_loader($viewName,$data){

        echo view('templates/vendor_header',$data);
        echo view('vendorPages/'.$viewName,$data);
        echo view('templates/vendor_footer',$data);

    }

    public function vendor_sales(){

        $session = session();

		$role = $session->get('role');

		if($role!='vendor'){
			return redirect()->to(site_url('vendor-login')); 
        }

        $data["title"] = "Sales";

        $orderModel = new OrderModel();

        $data["orders"] = $orderModel->where("store",$_SESSION["store_code"])->findAll();

        $this->vendor_page_loader("orders",$data);

    }

    public function alloted_coupons(){

        $session = session();

		$role = $session->get('role');

		if($role!='vendor'){
			return redirect()->to(site_url('vendor-login')); 
        }

        $data["title"] = "Alloted Coupons";

        $couponModel = new CouponModel();

        $data["coupons"] = $couponModel->where("merchant",$_SESSION['id'])->findAll();

        $data["success"] = $data["error"] = "";

        $this->vendor_page_loader("coupons",$data);

    }


    public function update_store_products(){

        $session = session();

        

		$role = $session->get('role');

		if($role!='vendor'){
			return redirect()->to(site_url('vendor-login')); 
        }

        $data['title'] = "Manage Store Products";
        $productModel = new ProductModel();
        $storeModel = new StoreModel();
        $data['store'] = $storeModel->where("vendor",$_SESSION["id"])->first();
        $data['store_product_ids'] = json_decode($data["store"]['product_ids'],TRUE);

        $cache = \Config\Services::cache();

        if(!$cache->get('eight_products')){
            $productModel = new ProductModel();
            $categoriesFetched = $productModel->findAll(8,0);	
            $cache->save('eight_products',$categoriesFetched,24*60*60);
            $eightProducts = $cache->get('eight_products');
        }else {
            $eightProducts = $cache->get('eight_products');
        }

        if(!$cache->get('categories')){
            $categoryModel = new CategoryModel();
            $categoriesFetched = $categoryModel->findAll(8,0);	
            $cache->save('categories',$categoriesFetched,24*60*60);
            $categories = $cache->get('categories');
        }else {
            $categories = $cache->get('categories');
        }

        $data['categories'] = $categories;

        $data['products'] = $eightProducts;
        
        $this->vendor_page_loader("manage_store_products",$data);

    }


    public function search_products_add_to_store(){

        $session = session();

		$role = $session->get('role');

		if($role!='vendor'){
			return redirect()->to(site_url('vendor-login')); 
        }

        $searchQuery = $this->request->getPost("search-query");        

        $productModel = new ProductModel();
        
		$products = $productModel->like('title',$searchQuery)->orlike('sku',$searchQuery)->findAll();
        $data['products'] = $products;
        $storeModel = new StoreModel();
        $data['store'] = $storeModel->where("vendor",$_SESSION["id"])->first();
        $data['store_product_ids'] = json_decode($data["store"]['product_ids'],TRUE);
        
        $data['title'] = 'Search Results for adding Products to Store';
		$this->vendor_page_loader('product_search_results',$data);
        
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