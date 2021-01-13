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

		$categoryModel = new CategoryModel();
		$productModel = new ProductModel();

		$storeCategories = $categoryModel->find(json_decode($storeData['category_ids'],TRUE));
		$storeProducts = $productModel->find(json_decode($storeData['product_ids'],TRUE));

		$data["categories"] = $storeCategories;
		$data["products"] = $storeProducts;
		$data["title"] = $storeData["name"];
		$data["store_data"] = $storeData;
		$cartmodel = new CartModel();
		$cart_items = $cartmodel->fetch_all_cart_items_store($code);
		$data["cart_item_count"] = count($cart_items);
		$data["prodIdArray"] = json_decode($storeData['category_ids'],TRUE);
		$this->public_page_loader('shop',$data);

	}


	//--------------------------------------------------------------------

}