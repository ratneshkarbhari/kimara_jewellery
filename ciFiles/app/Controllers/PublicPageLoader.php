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
use App\Models\CategoryPositionModel;
use App\Models\CouponModel;
use App\Models\StoreModel;


class PublicPageLoader extends BaseController
{

	private function vendor_public_page_loader($viewName,$data){

		$cartModel = new CartModel();

		$cache = \Config\Services::cache();

		if (isset($_GET["store_code"])) {

			if(!$cache->get('categories')){
				$categoryModel = new CategoryModel();
				$categoriesFetched = $categoryModel->findAll();	
				$cache->save('categories',$categoriesFetched,24*60*60);
				$allCategories = $cache->get('categories');
			}else {
				$allCategories = $cache->get('categories');
			}

			$storeModel = new StoreModel();

			$storeData = $storeModel->where("code",$_GET["store_code"])->first();

			$storeProductIds = $storeData["product_ids"];

			$productModel = new ProductModel();

			$storeCats = array();
			$storeCatIds = array();

			foreach (json_decode($storeProductIds,TRUE) as $strprdId) {
				
				$prdata = $productModel->find($strprdId);

				foreach($allCategories as $singleCat){
					if(($prdata["category"]==$singleCat["id"])&&!(in_array($singleCat["id"],$storeCatIds))){
						$storeCatIds[] = $singleCat["id"];
						$storeCats[] = $singleCat;
					}
				}				

			}

			$data["categories"] = $storeCats;

		}else {
			if(!$cache->get('categories')){
				$categoryModel = new CategoryModel();
				$categoriesFetched = $categoryModel->findAll();	
				$cache->save('categories',$categoriesFetched,24*60*60);
				$data['categories'] = $cache->get('categories');
			}else {
				$data['categories'] = $cache->get('categories');
			}
		}


		$cart_items = $cartModel->fetch_all_cart_items_store($storeData["code"]);
		$data['cart_item_count'] = count($cart_items);

		if(!isset($_COOKIE['location'])){
			setcookie('location','india',time()+(24*3600));
		}

		echo view('templates/vendor_store_header',$data);
		echo view('vendorPublicPages/'.$viewName,$data);
		echo view('templates/vendor_store_footer',$data);

	}

	public function load_twelve_more_products(){
        $offset = $this->request->getPost('offset');
        $productModel = new ProductModel();
        $fetchedProducts = $productModel->findAll(8,$offset);
        $finalReturn = '';
        if(count($fetchedProducts)>0){
            foreach ($fetchedProducts as $rmpc) {
                $finalReturn.='<div class="col-lg-3 col-md-6-sm-12 text-center custom-half-grid" style="margin-bottom: 5%; padding: 5px;">
                        
				<a href="'.site_url("product/".$rmpc['slug']).'">
					<div class="card">
					
						<img src="'.site_url('assets/images/preloader.gif').'" data-src="'.site_url("assets/images/featured_image_product/".$rmpc['featured_image']).'" class="card-img-top lazy">
					
						<div class="card-body">
						
						<h4 class="product-title-'.$rmpc["id"].'">'.substr($rmpc["title"],0,9).'...</h4>                                                                                <span class="larger-price-card"> ₹ '.$rmpc["sale_price"].'</span> | <del><span class="smaller-price-card"> ₹ '.$rmpc["price"].'</span></del>
						
							<br>

							<p>SKU : '.$rmpc["sku"].'</p>

							<br>

							<p id="select-text-'.$rmpc["id"].'"></p>
							
							<br>
	
							<button class="btn btn-primary">BUY NOW</button>
	
						</div>
	
					</div>
				</a>
	
			</div>';
            }
        }

		return $finalReturn;
		
	}
	public function load_twelve_more_products_vendor(){
        $offset = $this->request->getPost('offset');
		$store_product_ids = json_decode($this->request->getPost("product_ids"),TRUE);
		$productModel = new ProductModel();
        $fetchedProducts = $productModel->findAll(8,$offset);
		$finalReturn = '';
		
        if(count($fetchedProducts)>0){
            foreach ($fetchedProducts as $rmpc) {
				if(is_array($store_product_ids)){ 
					if(in_array($rmpc["id"],$store_product_ids)){
						$bg_color = "purple";
						$text_color = "white";
						$selected = "selected";
					}else {
						$bg_color = "white";
						$text_color = "black";
						$selected = "";
					}
				} 
                $finalReturn.='<div class="col-lg-3 col-md-6-sm-12" style="margin-bottom: 5%; padding: 5px;" >
                        

					<div class="card add-to-store '.$selected.'" style="background-color: '.$bg_color.'; color: '.$text_color.'" pid="'.$rmpc["id"].'" cid="'.$rmpc["category"].'">
						<img src="'.site_url('assets/images/preloader.gif').'" data-src="'.site_url("assets/images/featured_image_product/".$rmpc['featured_image']).'" class="card-img-top lazy">
					
						<div class="card-body">
						
						<h4 id="product-title-'.$rmpc["id"].'" style="color: '.$text_color.' !important;" >'.$rmpc["title"].'</h4>
						
						<br>
						<p>SKU : '.$rmpc["sku"].'</p>
						<br>

						<p id="selected-text-'.$rmpc["id"].'">'.$selected.'</p>

						<span class="larger-price-card"> ₹ '.$rmpc["sale_price"].'</span> | <del><span class="smaller-price-card"> ₹ '.$rmpc["price"].'</span></del>
												
							<br>

						</div>
	
					</div>
				
	
			</div>';
            }
        }

		return $finalReturn;
		
    }


	public function filter_endpoint(){
	


		$max_price = $this->request->getPost("max_price");
		$selected_categories = $this->request->getPost("selected_categories");

		$cache = \Config\Services::cache();


		if(!$cache->get('products')){
			$productModel = new ProductModel();
			$productsFetched = $productModel->findAll();	
			$cache->save('products',$productsFetched,24*60*60);
			$allProducts = $cache->get('products');
		}else {
			$allProducts = $cache->get('products');
		}



		$results_max_price_n_cat = array();


		if (!is_array($selected_categories)) {

			if(!$cache->get('categories')){
				$productModel = new ProductModel();
				$categoriesFetched = $productModel->findAll();	
				$cache->save('categories',$categoriesFetched,24*60*60);
				$allcategories = $cache->get('categories');
			}else {
				$allcategories = $cache->get('categories');
			}			
			
			$selected_categories = $allcategories;
			$catIdsArray = array();

			foreach ($selected_categories as $selCat) {
				$catIdsArray[] = $selCat['id'];
			}

			$selected_categories = $catIdsArray;



		}

		
		$selected_collections = $this->request->getPost("selected_collections");

		if(!(is_array($selected_collections))){
			$selected_collections = array("best-sellers","top-rated");
		}


		foreach ($allProducts as $rmp ) {
			if ((in_array($rmp['category'],$selected_categories))&&(in_array($rmp['collection'],$selected_collections))&&$rmp['sale_price']<=$max_price) {
				$results_max_price_n_cat[] = $rmp;
			}
		}

		$finalReturnJson = '';

		foreach ($results_max_price_n_cat as $rmpc) {
			$finalReturnJson.='<div class="col-lg-3 col-md-6-sm-12 text-center custom-half-grid" style="margin-bottom: 5%; padding: 5px;">
                        
			<a href="'.site_url("product/".$rmpc['slug']).'">
				<div class="card">
				
					<img src="'.site_url("assets/images/featured_image_product/".$rmpc['featured_image']).'" class="card-img-top lazy">
				
					<div class="card-body">
					
					<h6 class="product-title">Gems &amp; Ga...</h6>                                                                                <span class="larger-price-card"> ₹ '.$rmpc["sale_price"].'</span> | <del><span class="smaller-price-card"> ₹ '.$rmpc["price"].'</span></del>
						
						<br><br>

						<button class="btn btn-primary">BUY NOW</button>

					</div>

				</div>
			</a>

		</div>';
		}
		
		if ($finalReturnJson!='') {
			return $finalReturnJson;
		}else {
			return 'No Products match your filters';
		}

	}
	public function filter_endpoint_x(){
	


		$max_price = $this->request->getPost("max_price");
		$selected_categories = $this->request->getPost("selected_categories");

		$cache = \Config\Services::cache();


		if(!$cache->get('products')){
			$productModel = new ProductModel();
			$productsFetched = $productModel->findAll();	
			$cache->save('products',$productsFetched,24*60*60);
			$allProducts = $cache->get('products');
		}else {
			$allProducts = $cache->get('products');
		}



		$results_max_price_n_cat = array();


		if (!is_array($selected_categories)) {

			if(!$cache->get('categories')){
				$productModel = new ProductModel();
				$categoriesFetched = $productModel->findAll();	
				$cache->save('categories',$categoriesFetched,24*60*60);
				$allcategories = $cache->get('categories');
			}else {
				$allcategories = $cache->get('categories');
			}			
			
			$selected_categories = $allcategories;
			$catIdsArray = array();

			foreach ($selected_categories as $selCat) {
				$catIdsArray[] = $selCat['id'];
			}

			$selected_categories = $catIdsArray;



		}

		



		foreach ($allProducts as $rmp ) {
			if ((in_array($rmp['category'],$selected_categories))&&$rmp['sale_price']<=$max_price) {
				$results_max_price_n_cat[] = $rmp;
			}
		}

		$finalReturnJson = '';

		$store_product_ids = json_decode($this->request->getPost("store_product_ids"),TRUE);

		foreach ($results_max_price_n_cat as $rmpc) {
			if(is_array($store_product_ids)){ 
				if(in_array($rmpc["id"],$store_product_ids)){
					$bg_color = "purple";
					$text_color = "white";
					$selected = "selected";
				}else {
					$bg_color = "white";
					$text_color = "black";
					$selected = "";
				}
			} 
			$finalReturnJson.='<div class="col-lg-3 col-md-6-sm-12" style="margin-bottom: 5%; padding: 5px;" >
					

				<div class="card add-to-store '.$selected.'" style="background-color: '.$bg_color.'; color: '.$text_color.'" pid="'.$rmpc["id"].'" cid="'.$rmpc["category"].'">
					<img src="'.site_url('assets/images/preloader.gif').'" data-src="'.site_url("assets/images/featured_image_product/".$rmpc['featured_image']).'" class="card-img-top lazy">
				
					<div class="card-body">
					


					<h4 id="product-title-'.$rmpc["id"].'" class="product-title" style="color: '.$text_color.' !important;" >'.$rmpc["title"].'</h4>
					
					<br>
					<p>SKU : '.$rmpc["sku"].'</p>
					<br>

					<p id="selected-text-'.$rmpc["id"].'">'.$selected.'</p>

					<span class="larger-price-card"> ₹ '.$rmpc["sale_price"].'</span> | <del><span class="smaller-price-card"> ₹ '.$rmpc["price"].'</span></del>
										

					</div>

				</div>
			

		</div>';
		}
		
		if ($finalReturnJson!='') {
			return $finalReturnJson;
		}else {
			return 'No Products match your filters';
		}

	}


	public function search_vendor_store(){
		$query = $this->request->getPost('universal-search');
		$productModel = new ProductModel();
		$products = $productModel->like('title',$query)->findAll();

		
		$storeModel = new StoreModel();
		
		$storeData = $storeModel->where("code",$this->request->getPost('store_code'))->first();

		$storeProductsIds = json_decode($storeData["product_ids"],TRUE);

		$res_products = array();

		foreach ($products as $pro) {
			if (in_array($pro["id"],$storeProductsIds)) {
				$res_products[] = $pro;
			}
		}

		$data['products'] = $res_products;

		$cache = \Config\Services::cache();
		if(!$cache->get('categories')){
			$categoryModel = new CategoryModel();
			$categoriesFetched = $categoryModel->findAll();	
			$cache->save('categories',$categoriesFetched,24*60*60);
			$data['categories'] = $cache->get('categories');
		}else {
			$data['categories'] = $cache->get('categories');
		}

		$data['store_data'] = $storeData;

		$data['title'] = 'Search Results';
		$this->public_page_loader('search_results_vendor',$data);
	}


	public function filter_endpoint_vendor(){
	
		$max_price = $this->request->getPost("max_price");
		$selected_categories = $this->request->getPost("selected_categories");

		$cache = \Config\Services::cache();

		$results_max_price_n_cat = array();


		if (!is_array($selected_categories)) {

			if(!$cache->get('categories')){
				$categoryModel = new CategoryModel();
				$categoriesFetched = $categoryModel->findAll();	
				$cache->save('categories',$categoriesFetched,24*60*60);
				$allcategories = $cache->get('categories');
			}else {
				$allcategories = $cache->get('categories');
			}			
			
			$selected_categories = $allcategories;$catIdsArray = array();

			foreach ($selected_categories as $selCat) {
				$catIdsArray[] = $selCat['id'];
			}

			$selected_categories = $catIdsArray;



		}

		// if(!$cache->get('products')){
		// 	$productModel = new ProductModel();
		// 	$productsFetched = $productModel->findAll();	
		// 	$cache->save('products',$productsFetched,24*60*60);
		// 	$allproducts = $cache->get('products');
		// }else {
		// 	$allproducts = $cache->get('products');
		// }		
		
		$prod_ids = json_decode($this->request->getPost("prod_ids"),TRUE);

		$productModel = new ProductModel();

		$allProducts = array();

		foreach ($prod_ids as $pid) {
			$allProducts[] = $productModel->find($pid);
		}
		

		$selected_collections = $this->request->getPost("selected_collections");

		if(!(is_array($selected_collections))){
			$selected_collections = array("best-sellers","top-rated");
		}

		foreach ($allProducts as $rmp ) {
			if (in_array($rmp['category'],$selected_categories)&&(in_array($rmp['collection'],$selected_collections))&&$rmp['sale_price']<=$max_price) {
				$results_max_price_n_cat[] = $rmp;
			}
		}

		$finalReturnJson = '';

		foreach ($results_max_price_n_cat as $rmpc) {
			$finalReturnJson.='<div class="col-lg-3 col-md-6-sm-12 text-center custom-half-grid" style="margin-bottom: 5%; padding: 5px;">
                        
			<a href="'.site_url("product/".$rmpc['slug']).'">
				<div class="card">
				
					<img src="'.site_url("assets/images/featured_image_product/".$rmpc['featured_image']).'" class="card-img-top lazy">
				
					<div class="card-body">
					
					<h6 class="product-title">Gems &amp; Ga...</h6>                                                                                <span class="larger-price-card"> ₹ '.$rmpc["sale_price"].'</span> | <del><span class="smaller-price-card"> ₹ '.$rmpc["price"].'</span></del>
						
						<br><br>

						<button class="btn btn-primary">BUY NOW</button>

					</div>

				</div>
			</a>

		</div>';
		}
		
		if ($finalReturnJson!='') {
			return $finalReturnJson;
		}else {
			return 'No Products match your filters';
		}

	}


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

		if(!$cache->get('catsByPos')){
			$catPosModel = new CategoryPositionModel();
			$catsByPos = $catPosModel->first();;	
			$cache->save('catsByPos',$catsByPos,24*60*60);
			$data['catsByPos'] = $cache->get('catsByPos');
		}else {
			$data['catsByPos'] = $cache->get('catsByPos');
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

	public function vendor_registration(){
	
		$session = session();

		$role = $session->get('role');

		if($role=='vendor'){
			return redirect()->to(site_url('vendor-dashboard')); 
		}
			

		$data['title'] = 'Vendor Registration';
		$data['error'] = '';


		$this->public_page_loader('vendor_registration',$data);

			
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

		$couponModel = new CouponModel();

		if(!$cache->get('products')){
			$productModel = new ProductModel();
			$productsFetched = $productModel->findAll();	
			$cache->save('products',$productsFetched,24*60*60);
			$data['products'] = $products= $cache->get('products');
		}else {
			$data['products'] = $products = $cache->get('products');
		}

		if(isset($_GET["store_code"])){
			$data['cart_items'] = $cart_items =  $cartModel->fetch_all_cart_items_store($_GET["store_code"]);
		}else {
			$data['cart_items'] = $cart_items =  $cartModel->fetch_all_cart_items();
		}


	

		$shippingRateModel = new ShippingRateModel();

		$shipping_rates = $shippingRateModel->first();

		$data['shipping_rates'] = $shipping_rates;

		$session = session();

		$role = session('role'); 

		if($role=='customer'&&!empty($cart_items)){
			if(!empty($cart_items)){
				$api = new Api('rzp_live_u5KGjme6VZlvYo', 'dR3h6yH6SmxQWQkJgDlc7M23');
				// $api = new Api('rzp_test_tt5wGNQQXooze8', 'e1qIxvJbkhRb77P9hg2ZW4Zw');
	
				$totalPayable = 0.00;
	
				foreach ($cart_items as $cart_item) {
					foreach ($products as $product) {
						if ($cart_item['product_id']==$product['id']) {
							$amount = $cart_item['quantity']*$product['sale_price'];
							$totalPayable=$totalPayable+$amount;
						}
					}
				}
				
								if (isset($_COOKIE['coupon'])) {
					$couponDetails = $couponModel->where('code',$_COOKIE['coupon'])->first();
					$totalPayable = $totalPayable - ($totalPayable*($couponDetails['percentage_discount']/100));
				}


		
				if($totalPayable<$shipping_rates['free_shipping_threshold']){
					$shipping = $shipping_rates[$_COOKIE['location']];
				}else {
					$shipping = 0.00;
				}

				$payableWithShipping = $totalPayable+$shipping;


				$order  = $api->order->create(array('receipt' => rand(10000,9999), 'amount' => (($payableWithShipping)*100), 'currency' => 'INR')); // Creates order
			}

			$data['orderData'] = $order;

		}else {
			$data['orderData'] = array();
		}

		if (isset($_COOKIE['coupon'])) {
			$couponDetails = $couponModel->where('code',$_COOKIE['coupon'])->first();
			$data['percentage_discount'] = $couponDetails['percentage_discount'];
		}

		$storeModel = new StoreModel();


		if(isset($_GET["store_code"])){
			$data["store_data"] = $storeModel->where("code",$_GET["store_code"])->first();


			$this->vendor_public_page_loader('cart',$data);


		}else {

			$this->public_page_loader('cart',$data);

		}

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

	public function home($code ='NA'){

		if($code!='NA'){
			return redirect()->to(site_url('store/'.$code));
		}

		$data['title'] = 'Buy Sterling Silver Jewellery Online';

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

	public function vendor_login(){

		$session = session();

		$role = $session->get('role');

		if($role=='vendor'){
			return redirect()->to(site_url('vendor-dashboard')); 
		}
		
		$data['title'] = 'Vendor Login';
		$data['error'] = '';

		$this->public_page_loader('vendor_login',$data);

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

		if(!$cache->get('eight_products')){
			$productModel = new ProductModel();
			$eight_productsFetched = $productModel->findAll(8,0);	
			$cache->save('eight_products',$eight_productsFetched,24*60*60);
			$data['products'] = $cache->get('eight_products');
		}else {
			$data['products'] = $cache->get('eight_products');
		}

		$this->public_page_loader('shop',$data);

	}



	public function universal_product_search(){
		$query = $this->request->getPost('universal-search');
		$productModel = new ProductModel();
		$products = $productModel->like('title',$query)->orlike('sku',$query)->findAll();
		$data['products'] = $products;
		$cache = \Config\Services::cache();
		if(!$cache->get('categories')){
			$categoryModel = new CategoryModel();
			$categoriesFetched = $categoryModel->findAll();	
			$cache->save('categories',$categoriesFetched,24*60*60);
			$data['categories'] = $cache->get('categories');
		}else {
			$data['categories'] = $cache->get('categories');
		}
		$data['title'] = 'Search Results';
		$this->public_page_loader('search_results',$data);
	}

	public function category_page($slug){

		$categoryModel = new CategoryModel();


		$data["focus_category"] = $focusCategory = $categoryModel->where("slug",$slug)->first();
		
		$data['title'] = 'Products under '.$focusCategory["title"];

		if(isset($_GET['store_code'])){

			$storeModel = new StoreModel();

			$data["store_data"] = $storeData = $storeModel->where("code",$_GET["store_code"])->first();

			$productModel = new ProductModel();

			$productsInStore = json_decode($storeData["product_ids"],TRUE);

			$productsInStoreForCat = array();

			foreach ($productsInStore as $productId) {
				$prdata = $productModel->find($productId);
				if($prdata["category"]==$focusCategory["id"]){
					$productsInStoreForCat[] = $prdata;
				}
			}

			$data["products_in_category"] = $productsInStoreForCat;

			$this->vendor_public_page_loader("category_page",$data);

		}else {

			$categoryModel = new CategoryModel();
		
			$data['title'] = $focusCategory['title'];
	
			$productModel = new ProductModel();
	
			$products_in_cat = array();


			$cache = \Config\Services::cache();


			$data['title'] = 'Products in '.$focusCategory['title'];

			if(!$cache->get('products')){
				$productModel = new ProductModel();
				$productsFetched = $productModel->findAll();	
				$cache->save('products',$productsFetched,24*60*60);
				$allProducts = $cache->get('products');
			}else {
				$allProducts = $cache->get('products');
			}

			foreach ($allProducts as $pro) {
				if ($pro['category']==$focusCategory['id']) {
					$products_in_cat[] = $pro;
				}
			}

			$data['products'] = $products_in_cat;


			$this->public_page_loader('shop',$data);

		}


	}

	public function product_page($slug){


		if(isset($_GET["store_code"])){

			$storeModel = new StoreModel();

			$data["store_data"] = $storeData = $storeModel->where("code",$_GET["store_code"])->first();


			$productModel = new ProductModel();

			$data['product'] = $productModel->where('slug',$slug)->first();
	
	
			$data['title'] = $data['product']['title'];
	
			$categoryModel = new CategoryModel();
	
			$data['categories'] = $categoryModel->findAll();
	
			$data['related_products'] = $productModel->where('category',$data['product']['category'])->findAll();

			$authModel = new AuthModel();

			$data["vendorData"] = $authModel->where("id",$storeData["vendor"])->first();

			$this->vendor_public_page_loader("product_page",$data);
			

		}else {

			$productModel = new ProductModel();

			$data['product'] = $productModel->where('slug',$slug)->first();
	
	
			$data['title'] = $data['product']['title'];
	
			$categoryModel = new CategoryModel();
	
			$data['categories'] = $categoryModel->findAll();
	
			$data['related_products'] = $productModel->where('category',$data['product']['category'])->findAll();
	
	
			$this->public_page_loader('product_page',$data);	
			
		}


	}


	//--------------------------------------------------------------------

}