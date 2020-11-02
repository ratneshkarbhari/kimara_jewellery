<?php namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;

class AdminPageLoader extends BaseController
{

    private function send_to_login(){

        $session = session();

		$role = $session->get('role');

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }

    }

    private function admin_page_loader($viewName,$data){

        echo view('templates/admin_header',$data);
        echo view('adminPages/'.$viewName,$data);
        echo view('templates/admin_footer',$data);

    }

	public function dashboard()
	{

        $this->send_to_login();
        
        $data['title'] = 'Admin Dashboard';
        
        $this->admin_page_loader('dashboard',$data);

    }

    public function categories()
	{

        $this->send_to_login();
        
        $data['title'] = 'Manage Categories';

        $categoryModel = new CategoryModel();

        $data['categories'] = $data['pcats'] = $categoryModel->findAll();

        $data['error'] = $data['success'] = '';
        
        $this->admin_page_loader('categories',$data);

    }

    public function add_category()
	{

        $this->send_to_login();
        
        $data['title'] = 'Add Category';

        $categoryModel = new CategoryModel();

        $data['categories'] = $categoryModel->findAll();

        $data['error'] = $data['success'] = '';
        
        $this->admin_page_loader('add_category',$data);

    }
    public function edit_category($slug)
	{

        $this->send_to_login();

        $data['title'] = 'Edit Category';

        $categoryModel = new CategoryModel();

        $data['category'] = $categoryModel->where('slug',$slug)->first();

        $data['pcats'] = $categoryModel->findAll();

        $data['error'] = $data['success'] = '';
        
        $this->admin_page_loader('edit_category',$data);

    }

    public function products(){
 
        $this->send_to_login();
        
        $data['title'] = 'Manage Products';

        $categoryModel = new CategoryModel();
        $productModel = new ProductModel();

        $data['categories'] = $categoryModel->findAll();
        $data['products'] = $productModel->findAll();

        $data['error'] = $data['success'] = '';
        
        $this->admin_page_loader('products',$data);
        
    }

    public function add_product(){
        $this->send_to_login();
        
        $data['title'] = 'Add Product';

        $categoryModel = new CategoryModel();

        $data['categories'] = $categoryModel->findAll();

        $data['error'] = $data['success'] = '';
        
        $this->admin_page_loader('add_category',$data);
    }

}