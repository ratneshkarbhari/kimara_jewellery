<?php namespace App\Controllers;

require_once './vendor/autoload.php'; // change path as needed


use Razorpay\Api\Api;
use App\Models\HomePageSlideModel;
use App\Models\ProductModel;
use App\Models\AuthModel;
use App\Models\CategoryModel;
use App\Models\CartModel;
use App\Models\CollectionModel;
use App\Models\OrderModel;




class PublicPageLoader extends BaseController
{

	private function public_page_loader($viewName,$data){

		$cartModel = new CartModel();

		$cart_items = $cartModel->fetch_all_cart_items();

		$data['cart_item_count'] = count($cart_items);

		echo view('templates/header',$data);
		echo view('sitePages/'.$viewName,$data);
		echo view('templates/footer',$data);

	}

	public function contact(){
		$data['title'] = 'Contact';
		$data['success'] = '';
		$categoryModel = new CategoryModel();
		$data['categories'] = $categoryModel->findAll();
		$this->public_page_loader('contact',$data);
	}
	public function about(){
		$data['title'] = 'About';
		$categoryModel = new CategoryModel();
		$data['categories'] = $categoryModel->findAll();
		$this->public_page_loader('about',$data);
	}
	public function faqs(){
		$data['title'] = 'FAQs';
		$categoryModel = new CategoryModel();
		$data['categories'] = $categoryModel->findAll();
		$this->public_page_loader('faqs',$data);
	}
	public function pp(){
		$data['title'] = 'Privacy Policy';
		$categoryModel = new CategoryModel();
		$data['categories'] = $categoryModel->findAll();
		$this->public_page_loader('pp',$data);
	}
	public function tnc(){
		$data['title'] = 'Terms and Conditions';
		$categoryModel = new CategoryModel();
		$data['categories'] = $categoryModel->findAll();
		$this->public_page_loader('tnc',$data);
	}

	public function customer_registration(){


		$session = session();

		$role = $session->get('role');

		if($role=='customer'){
			return redirect()->to(site_url('my-account')); 
		}
			
		$categoryModel = new CategoryModel();

		$categoriesFetched = $categoryModel->findAll();

		$data['title'] = 'Customer Registration';
		$data['error'] = '';

		$data['categories'] = $categoriesFetched;

		$this->public_page_loader('customer_registration',$data);

	}

	public function my_account(){

		$session = session();

		$role = $session->get('role');

		if($role!='customer'){
			return redirect()->to(site_url('customer-login')); 
		}

		$categoryModel = new CategoryModel();

		$authModel = new AuthModel();

		$loggedInEmail = $session->get('email');

		$userData = $authModel->where('email',$loggedInEmail)->first();

		$data['userdata'] = $userData;

		$categoriesFetched = $categoryModel->findAll();

		$data['title'] = 'My Account';
		$data['error'] = $data['success'] = '';

		$data['categories'] = $categoriesFetched;

		$this->public_page_loader('my_account',$data);

	}

	public function order_details($order_id){

		$orderModel = new OrderModel();
		$categoryModel = new CategoryModel();
		$productModel = new ProductModel();

		$orderData = $orderModel->where('public_order_id',$order_id)->first();

		if ($orderData) {
		
			$data['title'] = 'Order Details';

			$data['orderData'] = $orderData;
			$data['categories'] = $categoryModel->findAll();
			$productsOrdered = array();

			$products_qty_obj = json_decode($orderData['products_qty_json'],TRUE);
			
			foreach($products_qty_obj as $ordered_item){
				$productsOrdered[] = $productModel->find($ordered_item['product_id']); 
			}

			$data['ordered_products'] = $productsOrdered;
		
		} else {
			
			$data['title'] = 'Invalid Order ID';
			$data['categories'] = $categoryModel->findAll();
			
		}

		$this->public_page_loader('public_order_details',$data);
		
	}

	public function thank_you(){

		if(!isset($_COOKIE['latest_order_id'])){
		
			return redirect()->to(site_url('/'));

		}else {

			$session = session();
			
			$data['order_id'] = $_COOKIE['latest_order_id'];
			$fname = $session->get('first_name');
			$data['title'] = 'Thank You '.$fname;

			echo view('sitePages/thank_you');

		}

	}

	public function cart(){


		$categoryModel = new CategoryModel();

		$data['categories'] = $categoryModel->findAll();
	
		$data['title'] = 'Cart';

		$cartModel = new CartModel();

		$productModel = new ProductModel();

		$data['products'] = $products = $productModel->findAll();

		$data['cart_items'] = $cart_items =  $cartModel->fetch_all_cart_items();


		$session = session();

		$role = session('role'); 

		if($role=='customer'&&!empty($cart_items)){
			if(!empty($cart_items)){
				$api = new Api('rzp_test_looXFeOiWI0vw6', 'zYQvID9bM68Qt5uikukVZdvz');
	
				$totalPayable = 0.00;
	
				foreach ($cart_items as $cart_item) {
					foreach ($products as $product) {
						if ($cart_item['product_id']==$product['id']) {
							$amount = $cart_item['quantity']*$product['sale_price'];
							$totalPayable=$totalPayable+$amount;
						}
					}
				}
	
				$order  = $api->order->create(array('receipt' => rand(10000,9999), 'amount' => ($totalPayable*100), 'currency' => 'INR')); // Creates order
			}
			$data['orderData'] = $order;
		}else {
			$data['orderData'] = array();
		}

		$this->public_page_loader('cart',$data);

	}

	public function customer_login(){

		$session = session();

		$role = $session->get('role');

		if($role=='customer'){
			return redirect()->to(site_url('my-account')); 
		}
			
		$categoryModel = new CategoryModel();

		$categoriesFetched = $categoryModel->findAll();

		$data['title'] = 'Customer Login';
		$data['error'] = '';

		$data['categories'] = $categoriesFetched;

		$this->public_page_loader('customer_login',$data);
		
	}

	public function home(){

		$data['title'] = 'Tagline';

		$collectionModel = new CollectionModel();
		$categoryModel = new CategoryModel();
		$productModel = new ProductModel();

        $homePageSlideModel = new HomePageSlideModel();
		$slides = $homePageSlideModel->findAll();
		

        $data['slides'] = $slides;

		$data['collections'] = array(
			'best_sellers' => $collectionModel->find(4),
			'top_rated' => $collectionModel->find(5)
		);

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



	public function universal_product_search(){
		$query = $this->request->getPost('universal-search');
		$productModel = new ProductModel();
		$products = $productModel->like('title',$query)->findAll();
		$data['products'] = $products;
		$categoryModel = new CategoryModel();
		$data['categories'] = $categoryModel->findAll();
		$data['title'] = 'Search Results';
		$this->public_page_loader('search_results',$data);
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

		$data['related_products'] = $productModel->where('category',$data['product']['category'])->findAll();

		$this->public_page_loader('product_page',$data);

	}


	//--------------------------------------------------------------------

}