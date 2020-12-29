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



class VPublicPageLoader extends BaseController
{

	private function public_page_loader($viewName,$data){



		if(!isset($_COOKIE['location'])){
			setcookie('location','india',time()+(24*3600));
		}


		echo view('templates/vendor_store_header',$data);
		echo view('vendorPublicPages/'.$viewName,$data);
		echo view('templates/vendor_store_footer',$data);

	}

	
	public function store(){

		$code = $_GET['store_code'];

		setcookie("store_code",$code,time()+(365*24*60*60));

		$storeModel = new StoreModel();
		
		$storeData = $storeModel->where("code",$code)->first();

		$storeProducts = array();
		$storeCategories = array();

		$cache = \Config\Services::cache();

		if(!$cache->get('categories')){
			$categoryModel = new CategoryModel();
			$categoriesFetched = $categoryModel->findAll();	
			$cache->save('categories',$categoriesFetched,24*60*60);
			$allCategories = $cache->get('categories');
		}else {
			$allCategories = $cache->get('categories');
		}
		
		if(!$cache->get('products')){
			$productModel = new ProductModel();
			$productsFetched = $productModel->findAll();	
			$cache->save('products',$productsFetched,24*60*60);
			$allProducts = $cache->get('products');
		}else {
			$allProducts = $cache->get('products');
		}		
		
		foreach ($allProducts as $prod) {
			if(in_array($prod["id"],json_decode($storeData["product_ids"],TRUE))){
				$storeProducts[] = $prod;
			}
		}

	$stCatIds = array();

		foreach ($allCategories as $cat) {
			foreach ($storeProducts as $stpro) {
				if ($cat["id"]==$stpro["category"]) {
					if(!in_array($cat["id"],$stCatIds)){
						$stCatIds[] = $cat["id"];
						$storeCategories[] = $cat;
					}
				}
			}
		}

		$data["products"] = $storeProducts;
		$data["categories"] = $storeCategories;
		$data["store_data"] = $storeData;
		$data["title"] = $storeData["name"];
	
		$cartModel = new CartModel();
		$cart_items = $cartModel->fetch_all_cart_items_store($code);
		$data['cart_item_count'] = count($cart_items);
		

		$this->public_page_loader("shop",$data);

	}


	//--------------------------------------------------------------------

}