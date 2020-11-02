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

		$cache = \Config\Services::cache();

		
		if (!$cache->get('cached_categories')) {
			$categoriesFetched = $categoryModel->findAll();
			$productsFetched = $productModel->findAll();
			$cache->save('cached_categories',$categoriesFetched);
			$cache->save('cached_products',$productsFetched);
		}

		$data['categories'] = $cache->get('cached_categories');
		$data['products'] = $cache->get('cached_products');

		$this->public_page_loader('home',$data);

	}

	public function admin_login()
	{

		$session = session();

		$role = $session->get('role');

		if($role=='admin'){
			return redirect()->to(site_url('admin-dashboard')); 
		}
		
		$data['title'] = 'Admin Login';
		$data['error'] = '';

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
	//--------------------------------------------------------------------

}
