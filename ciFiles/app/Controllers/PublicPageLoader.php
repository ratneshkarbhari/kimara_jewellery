<?php namespace App\Controllers;

require_once './vendor/autoload.php'; // change path as needed


use Razorpay\Api\Api;
use App\Models\HomePageSlideModel;
use App\Models\WishlistModel;
use App\Models\ProductModel;
use App\Models\AuthModel;
use App\Models\CategoryModel;
use App\Models\CartModel;
use App\Models\CollectionModel;
use App\Models\OrderModel;
use App\Models\ShippingRateModel;




class PublicPageLoader extends BaseController
{

	private function public_page_loader($viewName,$data){

		$cartModel = new CartModel();

		$cache = \Config\Services::cache();

		if(!$cache->get('categories')){
			$categoryModel = new CategoryModel();
			$categoriesFetched = $categoryModel->findAll();	
			$cache->save('categories',$categoriesFetched,24*60*60);
			$data['categories'] = $cache->get('categories');
		}else {
			$data['categories'] = $cache->get('categories');
		}

		$cart_items = $cartModel->fetch_all_cart_items();
		$data['cart_item_count'] = count($cart_items);

		if(!isset($_COOKIE['location'])){
			setcookie('location','india',time()+(24*3600));
		}

		echo view('templates/header',$data);
		echo view('sitePages/'.$viewName,$data);
		echo view('templates/footer',$data);

	}

	public function contact(){
		$data['title'] = 'Contact';
		$data['success'] = '';
		$this->public_page_loader('contact',$data);
	}
	public function forgot_password(){
		$data['title'] = 'Forgot Password';
		$this->public_page_loader('forgot_password',$data);
	}
	public function about(){
		$data['title'] = 'About';
		$this->public_page_loader('about',$data);
	}
	public function faqs(){
		$data['title'] = 'FAQs';

		$this->public_page_loader('faqs',$data);
	}
	public function pp(){
		$data['title'] = 'Privacy Policy';

		$this->public_page_loader('pp',$data);
	}
	public function tnc(){
		$data['title'] = 'Terms and Conditions';

		$this->public_page_loader('tnc',$data);
	}

	public function customer_registration(){


		$session = session();

		$role = $session->get('role');

		if($role=='customer'){
			return redirect()->to(site_url('my-account')); 
		}
			

		$data['title'] = 'Customer Registration';
		$data['error'] = '';


		$this->public_page_loader('customer_registration',$data);

	}

	public function my_account(){

		$session = session();

		$role = $session->get('role');

		if($role!='customer'){
			return redirect()->to(site_url('customer-login')); 
		}


		$authModel = new AuthModel();

		$orderModel = new OrderModel();

		$wishlistModel = new WishlistModel();


		$loggedInEmail = $session->get('email');

		$userData = $authModel->where('email',$loggedInEmail)->first();

		$data['userdata'] = $userData;


		$customerOrders = $orderModel->where('customer_email',$session->email)->findAll();

		$data['orders'] = $customerOrders;

		$data['title'] = 'My Account';
		$data['error'] = $data['success'] = '';

		$cache = \Config\Services::cache();

		$data['wishlist_items'] = $wishlistModel->where('cid',$session->id)->findAll();

		if(!$cache->get('products')){
			$productModel = new ProductModel();
			$productsFetched = $productModel->findAll();	
			$cache->save('products',$productsFetched,24*60*60);
			$data['products'] = $cache->get('products');
		}else {
			$data['products'] = $cache->get('products');
		}

		$this->public_page_loader('my_account',$data);

	}

	public function nl_sub_thank_you(){
		$data['title'] = 'Thanks for subscribing to email Newsletter';
		echo view('sitePages/thank_you_nl',$data);
	}

	public function order_details($order_id){

		$orderModel = new OrderModel();
		$productModel = new ProductModel();

		$orderData = $orderModel->where('public_order_id',$order_id)->first();

		if ($orderData) {
		
			$data['title'] = 'Order Details';

			$data['orderData'] = $orderData;
			$productsOrdered = array();

			$products_qty_obj = json_decode($orderData['products_qty_json'],TRUE);
			
			foreach($products_qty_obj as $ordered_item){
				$productsOrdered[] = $productModel->find($ordered_item['product_id']); 
			}

			$data['ordered_products'] = $productsOrdered;
		
		} else {
			
			$data['title'] = 'Invalid Order ID';
			
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

	public function flush_cache(){

		$cache = \Config\Services::cache();

		$cache->clean();

		return redirect()->to(site_url('admin-dashboard'));

	}

	public function cart(){

		$cache = \Config\Services::cache();

	
		$data['title'] = 'Cart';

		$cartModel = new CartModel();


		if(!$cache->get('products')){
			$productModel = new ProductModel();
			$productsFetched = $productModel->findAll();	
			$cache->save('products',$productsFetched,24*60*60);
			$data['products'] = $products= $cache->get('products');
		}else {
			$data['products'] = $products = $cache->get('products');
		}

		$data['cart_items'] = $cart_items =  $cartModel->fetch_all_cart_items();

		$shippingRateModel = new ShippingRateModel();

		$shipping_rates = $shippingRateModel->first();

		$data['shipping_rates'] = $shipping_rates;

		$session = session();

		$role = session('role'); 

		if($role=='customer'&&!empty($cart_items)){
			if(!empty($cart_items)){
				$api = new Api('rzp_live_u5KGjme6VZlvYo', 'dR3h6yH6SmxQWQkJgDlc7M23');
				// $api = new Api('rzp_test_f9AFe5VqZFjZN0', 'tfe4A9CY6Ax7aCYO5uRMyjRM');
	
				$totalPayable = 0.00;
	
				foreach ($cart_items as $cart_item) {
					foreach ($products as $product) {
						if ($cart_item['product_id']==$product['id']) {
							$amount = $cart_item['quantity']*$product['sale_price'];
							$totalPayable=$totalPayable+$amount;
						}
					}
				}

		
				if($totalPayable<$shipping_rates['free_shipping_threshold']){
					$shipping = $shipping_rates[$_COOKIE['location']];
				}else {
					$shipping = 0.00;
				}


				$order  = $api->order->create(array('receipt' => rand(10000,9999), 'amount' => (($totalPayable+$shipping)*100), 'currency' => 'INR')); // Creates order
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
			

		$data['title'] = 'Customer Login';
		$data['error'] = '';


		$this->public_page_loader('customer_login',$data);
		
	}

	public function home(){

		$data['title'] = 'Tagline';

		$collectionModel = new CollectionModel();

        $homePageSlideModel = new HomePageSlideModel();
		$slides = $homePageSlideModel->findAll();
		

        $data['slides'] = $slides;

		$data['collections'] = array(
			'best_sellers' => $collectionModel->find(4),
			'top_rated' => $collectionModel->find(5)
		);


		$cache = \Config\Services::cache();

		if(!$cache->get('products')){
			$productModel = new ProductModel();
			$productsFetched = $productModel->findAll();	
			$cache->save('products',$productsFetched,24*60*60);
			$data['products'] = $cache->get('products');
		}else {
			$data['products'] = $cache->get('products');
		}

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

		$cache = \Config\Services::cache();


		$data['title'] = 'Shop';

		if(!$cache->get('products')){
			$productModel = new ProductModel();
			$productsFetched = $productModel->findAll();	
			$cache->save('products',$productsFetched,24*60*60);
			$data['products'] = $cache->get('products');
		}else {
			$data['products'] = $cache->get('products');
		}

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