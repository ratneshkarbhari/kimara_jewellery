<?php namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class PublicPageLoader extends BaseController
{

	private function public_page_loader($viewName,$data){

		echo view('templates/header',$data);
		echo view('sitePages/'.$viewName,$data);
		echo view('templates/footer',$data);

	}

	public function home(){

		$data['title'] = 'Tagline';

		$categoryModel = new CategoryModel();
		$productModel = new ProductModel();

		$categoriesFetched = $categoryModel->findAll();
		$productsFetched = $productModel->findAll();


		$data['categories'] = $categoriesFetched;
		$data['products'] = $productsFetched;

		$this->public_page_loader('home',$data);

	}

	public function admin_login(){

		$session = session();

		$role = $session->get('role');

		if($role=='admin'){
			return redirect()->to(site_url('admin-dashboard')); 
		}
		
		$data['title'] = 'Admin Login';
		$data['error'] = '';

		$categoryModel = new CategoryModel();

		$categoriesFetched = $categoryModel->findAll();


		$data['categories'] = $categoriesFetched;

		$this->public_page_loader('admin_login',$data);

	}

	public function not_found()
	{
		
		$data['title'] = 'Page Not Found';
		$data['error'] = '';

		echo view('templates/header',$data);
		echo view('sitePages/not_found',$data);
		echo view('templates/footer',$data);

	}


	public function shop(){

		$data['title'] = 'Shop';

		$productModel = new ProductModel();
		$categoryModel = new CategoryModel();


		$data['categories'] = $categoryModel->findAll();

		$data['products'] = $productModel->findAll();

		$this->public_page_loader('shop',$data);
	}

	public function category_page($slug){

		$categoryModel = new CategoryModel();

		$data['categories'] = $categoryModel->findAll();

		$data['focus_category'] = $focusCategory = $categoryModel->where('slug',$slug)->first();
		
		$data['title'] = $focusCategory['title'];

		$productModel = new ProductModel();

		$data['products_in_category'] = $productModel->where('category',$focusCategory['id'])->findAll();


		$this->public_page_loader('category_page',$data);

	}

	public function product_page($slug){

		$productModel = new ProductModel();

		$data['product'] = $productModel->where('slug',$slug)->first();


		$data['title'] = $data['product']['title'];

		$categoryModel = new CategoryModel();

		$data['categories'] = $categoryModel->findAll();


		$this->public_page_loader('product_page',$data);

	}


	//--------------------------------------------------------------------

}
