<?php namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ShippingRateModel;
use App\Models\ProductModel;
use App\Models\CollectionModel;
use App\Models\OrderModel;
use App\Models\HomePageSlideModel;
use App\Models\CategoryPositionModel;
use App\Models\CouponModel;
use App\Models\VendorApprovalModel;
use App\Models\AuthModel;
use Config\Services; 


class AdminPageLoader extends BaseController
{

    private function send_to_login(){

        

    }

    private function admin_page_loader($viewName,$data){

        echo view('templates/admin_header',$data);
        echo view('adminPages/'.$viewName,$data);
        echo view('templates/admin_footer',$data);

    }


    public function vendor_mgt(){
        $session = session();

        
        $role = $session->get('role');
        

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }

        $authModel = new AuthModel();
        $data['approved_vendors'] = $authModel->where('role','vendor')->where('approved','yes')->findAll();

        $data['title'] = 'Vendor Mgt';
        $this->admin_page_loader('vendor_mgt',$data);
    }

    public function vendor_requests(){
        $session = session();

        
        $role = $session->get('role');
        

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }
        $vendorModel = new VendorApprovalModel();


        $data['vendor_requests'] = $vendorModel->findAll(); 
        $data['title'] = 'Vendor Mgt';
        $this->admin_page_loader('vendor_req',$data);
    }

    public function edit_vendor($id){
        
        $session = session();

        
        $role = $session->get('role');
        

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }

        $authModel = new AuthModel();

        $data['title'] = 'Edit Vendor';
        $data["vendor_data"] = $vendorData = $authModel->find($id);
        $data['success'] = $data['error'] = '';

        $this->admin_page_loader("edit_vendor",$data);
        
    }
    

    public function add_coupon(){
        $session = session();

        
        $role = $session->get('role');
        

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }
        $data['title']  = 'Add Coupon';
        $data['success'] = $data['error'] = '';
        $this->admin_page_loader('add_coupon_page',$data);               
    }

    public function edit_coupon($code){
        $couponModel = new CouponModel();
        $focus_coupon = $couponModel->where('code',$code)->first();
        $data['focus_coupon'] = $focus_coupon;
        $data['title'] = 'Editing '.$focus_coupon['title'];
        $data['success'] = $data['error'] = '';
        $this->admin_page_loader('edit_coupon',$data);        
    }

    public function coupons_mgt(){
        $session = session();

        
        $role = $session->get('role');
        

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }
        $data['title']  = 'Coupons Management';
        $data['success'] = $data['error'] = '';
        $couponModel = new CouponModel();
        $data['coupons'] = $couponModel->findAll();
        $this->admin_page_loader('coupons_mgt',$data);       
    }



    public function update_shipping_rates(){

        $session = session();

        
        $role = $session->get('role');
        

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }

        $data['title'] = 'Update Shipping Rates';
        $shippingRateModel = new ShippingRateModel();
        $data['shipping_rates'] = $shippingRateModel->first();
        $this->admin_page_loader('update_shipping_rates',$data);        

    }

    public function category_position_mgt(){

        $categoryModel = new CategoryModel();

        $data['categories'] = $categoryModel->findAll();

        $data['title'] = 'Category Position Model';

        $categoryPositionModel = new CategoryPositionModel();

        $data['category_positions'] = $categoryPositionModel->first();

        $this->admin_page_loader('update_category_positions',$data);

    }

    public function add_collection(){

        $session = session();

        
        $role = $session->get('role');
        

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }        

        $data['title'] = 'Collections';
        $productModel = new ProductModel();
        $products = $productModel->findAll();
        $data['products'] = $products;
        $data['error'] = $data['success'] = '';

        $this->admin_page_loader('add_collection',$data);        
        

    }

    public function all_collections(){

        $session = session();

        
        $role = $session->get('role');
        

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }        
    
        $data['title'] = 'Collections';
        $collectionModel = new CollectionModel();
        $collections = $collectionModel->findAll();

        $data['collections'] = array_reverse($collections);
        $data['error'] = $data['success'] = '';

        $this->admin_page_loader('collections',$data);        

    }

    public function homepage_slides(){
        $session = session();

        
        $role = $session->get('role');
        

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }        
    
        $data['title'] = 'HomePage Slides';
        $homePageSlideModel = new HomePageSlideModel();
        $slides = $homePageSlideModel->findAll();

        $data['slides'] = $slides;
        $data['error'] = $data['success'] = '';

        $this->admin_page_loader('homepage_slides',$data);
    }

    public function all_orders(){

        $session = session();

        
        $role = $session->get('role');
        

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }

        $data['title'] = 'Orders';
        $orderModel = new OrderModel();
        $orders = $orderModel->findAll();

        $data['orders'] = array_reverse($orders);

        $this->admin_page_loader('orders',$data);
        
    }

	public function dashboard()
	{

        $session = session();

        
        $role = $session->get('role');
        

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }
        
        $data['title'] = 'Admin Dashboard';
        
        $this->admin_page_loader('dashboard',$data);

    }

    public function categories()
	{

        $session = session();

        
        $role = $session->get('role');
        

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }
        
        $data['title'] = 'Manage Categories';

        $categoryModel = new CategoryModel();

        $data['categories'] = $data['pcats'] = $categoryModel->findAll();

        $data['error'] = $data['success'] = '';
        
        $this->admin_page_loader('categories',$data);

    }

    public function add_category()
	{

        $session = session();

        
        $role = $session->get('role');
        

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }
        
        $data['title'] = 'Add Category';

        $categoryModel = new CategoryModel();

        $data['categories'] = $categoryModel->findAll();

        $data['error'] = $data['success'] = '';
        
        $this->admin_page_loader('add_category',$data);

    }

    public function edit_category($slug)
	{

        $session = session();
        
        $role = $session->get('role');
        

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }

        $data['title'] = 'Edit Category';

        $categoryModel = new CategoryModel();

        $data['category'] = $categoryModel->where('slug',$slug)->first();

        $data['pcats'] = $categoryModel->findAll();

        $data['error'] = $data['success'] = '';
        
        $this->admin_page_loader('edit_category',$data);

    }

    public function products(){
 
        $session = session();

        
        $role = $session->get('role');
        

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }
        
        $data['title'] = 'Manage Products';

        $categoryModel = new CategoryModel();
        $productModel = new ProductModel();

        $data['categories'] = $categoryModel->findAll();
        $data['products'] = $productModel->findAll();

        $data['error'] = $data['success'] = '';
        
        $this->admin_page_loader('products',$data);
        
    }

    public function add_product(){
        $session = session();

        
        $role = $session->get('role');
        

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }
        
        $data['title'] = 'Add Product';

        $categoryModel = new CategoryModel();

        $data['categories'] = $categoryModel->findAll();

        $data['error'] = $data['success'] = '';
        
        $this->admin_page_loader('add_product',$data);
    }

    public function edit_product($slug){

        $session = session();

        
        $role = $session->get('role');
        

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }

        $data['title'] = 'Edit Product';

        $categoryModel = new CategoryModel();

        $data['categories'] = $categoryModel->findAll();

        $productModel = new ProductModel();

        $data['product'] = $productModel->where('slug',$slug)->first();

        $data['error'] = $data['success'] = '';
        
        $this->admin_page_loader('edit_product',$data);

    }

}