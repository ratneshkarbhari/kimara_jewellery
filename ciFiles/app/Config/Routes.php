<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('PublicPageLoader');
$routes->setDefaultMethod('home');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('not-found', 'PublicPageLoader::not_found');
$routes->get('/', 'PublicPageLoader::home');

// Cache flush
$routes->get('flush-cache','PublicPageLoader::flush_cache');

// Vendor Store Pages
$routes->get("store/(:any)","VPublicPageLoader::store/$1");

// SitePages
$routes->post("vendor-store-product-search",'PublicPageLoader::search_vendor_store');
$routes->post("filter-endpoint-vendor",'PublicPageLoader::filter_endpoint_vendor');
$routes->post("filter-endpoint",'PublicPageLoader::filter_endpoint');
$routes->post("filter-endpoint-x",'PublicPageLoader::filter_endpoint_x');
$routes->get('admin-login','PublicPageLoader::admin_login');
$routes->get('shop','PublicPageLoader::shop');
$routes->get('about','PublicPageLoader::about');
$routes->get('contact','PublicPageLoader::contact');
$routes->get('product/(:any)','PublicPageLoader::product_page/$1');
$routes->get('category/(:any)','PublicPageLoader::category_page/$1');
$routes->get('customer-login','PublicPageLoader::customer_login');
$routes->get('forgot-password','PublicPageLoader::forgot_password');
$routes->get('my-account','PublicPageLoader::my_account');
$routes->get('cart','PublicPageLoader::cart');
$routes->get('cod-order','PublicPageLoader::cod_order');
$routes->get('privacy-policy','PublicPageLoader::pp');
$routes->get('terms-and-conditions','PublicPageLoader::tnc');
$routes->get('faqs','PublicPageLoader::faqs');
$routes->get('thank-you','PublicPageLoader::thank_you');
$routes->get('order-details/(:any)','PublicPageLoader::order_details/$1');
$routes->post('universal-product-search','PublicPageLoader::universal_product_search');
$routes->get('customer-registration','PublicPageLoader::customer_registration');
$routes->get('vendor-registration','PublicPageLoader::vendor_registration');
$routes->get('vendor-login','PublicPageLoader::vendor_login');

// Customer Profile my account page section
$routes->post('update-customer-profile','Authentication::update_customer_profile');

// Vendor update
$routes->post("update-vendor-data",'Authentication::update_vendor_profile_by_admin');

// cart routes
$routes->post('add-to-cart-exe','Cart::add');
$routes->post('update-cart','Cart::update');
$routes->post('delete-cart-item','Cart::delete');

// Category Positions
$routes->post('update-category-positions','CategoryPositions::update');

// Order EndPoint
$routes->post('create-cod-order','Orders::create_cod_order');
$routes->post('create-order','Orders::create');
$routes->post('create-order-vendor','Orders::create_vendor');
$routes->post('update-order','Orders::update');
$routes->post("delete-order-exe","Orders::delete");

$routes->get("vendor-sales","VendorPageLoader::vendor_sales");

$routes->post("create-vendor-account-exe",'Authentication::create_vendor_account');

// Vendor Dashboard Endpoints
$routes->get('vendor-dashboard','VendorPageLoader::dashboard');
$routes->get('manage-account-vendor','VendorPageLoader::manage_account');
$routes->get("manage-store-vendor",'VendorPageLoader::manage_store');
$routes->get("update-store-products","VendorPageLoader::update_store_products");

// Vendor feature routes
$routes->post("vendor-store-product-search",'Stores::search_products');
$routes->post('update-vendor-profile','Authentication::update_vendor_profile');
$routes->post("update-vendor-password","Authentication::update_vendor_pwd");
$routes->post("create-store-exe","Stores::create_exe");
$routes->post("update-store-exe","Stores::update_exe");
$routes->post("add-products-to-store-exe","Stores::update_products_exe");
$routes->post("remove-products-from-store-exe","Stores::remove_products_exe");
$routes->get("alloted-coupons","VendorPageLoader::alloted_coupons");
$routes->post("product-search-to-add-to-store","VendorPageLoader::search_products_add_to_store");

// Auth Endpoints
$routes->post('approve-vendor-exe','Authentication::approve_vendor_exe');
$routes->post('submit-vendor-for-approval','Authentication::submit_vendor_for_approval');
$routes->post('vendor-login-exe','Authentication::vendor_login_exe');
$routes->post('create-endor-account-exe','Authentication::create_vendor_account');
$routes->post('customer-login-api','Authentication::customer_login_api');
$routes->post('user-login-exe','Authentication::login');
$routes->post('customer-login-exe','Authentication::customer_login');
$routes->get('logout','Authentication::logout');
$routes->post('get-email-verif-code','Authentication::get_email_verif_code');
$routes->post('get-email-verif-code-vendor','Authentication::get_email_verif_code_vendor');
$routes->post('verify-email-exe','Authentication::verify_email_exe');
$routes->post('create-customer-account-exe','Authentication::create_customer_account');
$routes->post('get-email-verif-code-pw-reset','Authentication::get_email_verif_code_pw_reset');
$routes->post('reset-customer-password','Authentication::reset_customer_password');

// Wishlist
$routes->post('add-to-wishlist-exe','Wishlist::add');
$routes->post('delete-from-wishlist','Wishlist::delete');

// Newsletter
$routes->post('add-email-subscriber','NewsLetter::nl_subscription_send_email');
$routes->get('nl-sub-thank-you','PublicPageLoader::nl_sub_thank_you');

// Coupons
$routes->post('create-coupon-exe','Coupons::add');
$routes->post('update-coupon','Coupons::update');
$routes->post('delete-coupon','Coupons::delete');
$routes->post('set-coupon-cookie','Coupons::set_coupon_cookie');
$routes->post('unset-coupon-cookie','Coupons::unset_coupon_cookie');
$routes->post('load-twelve-more-products','PublicPageLoader::load_twelve_more_products');
$routes->post('load-twelve-more-products-vendor','PublicPageLoader::load_twelve_more_products_vendor');

// Admin Dashboard
$routes->post("filter-sales-by-date","AdminPageLoader::orders_between_dates");
$routes->get("orders-from-store/(:any)","AdminPageLoader::orders_from_store/$1");
$routes->get("orders-from-code/(:any)","AdminPageLoader::orders_from_code/$1");
$routes->get('sales-reports','AdminPageLoader::sales_reports');
$routes->get('vendor-requests','AdminPageLoader::vendor_requests');
$routes->get("edit-vendor-details/(:any)",'AdminPageLoader::edit_vendor/$1');
$routes->get('vendors-mgt','AdminPageLoader::vendor_mgt');
$routes->get('edit-coupon/(:any)','AdminPageLoader::edit_coupon/$1');
$routes->get('add-coupon','AdminPageLoader::add_coupon');
$routes->get('coupons-mgt','AdminPageLoader::coupons_mgt');
$routes->get('update-shipping-rates','AdminPageLoader::update_shipping_rates');
$routes->get('admin-dashboard','AdminPageLoader::dashboard');
$routes->get('manage-categories','AdminPageLoader::categories');
$routes->get('add-category','AdminPageLoader::add_category');
$routes->get('edit-category/(:any)','AdminPageLoader::edit_category/$1');
$routes->get('manage-products','AdminPageLoader::products');
$routes->get('add-product','AdminPageLoader::add_product');
$routes->get('edit-product/(:any)','AdminPageLoader::edit_product/$1');
$routes->get('manage-orders','AdminPageLoader::all_orders');
$routes->get('manage-collections','AdminPageLoader::all_collections');
$routes->get('add-collection','AdminPageLoader::add_collection');
$routes->get('manage-homepage-slides','AdminPageLoader::homepage_slides');
$routes->get('category-position-mgt','AdminPageLoader::category_position_mgt');

// Slides
$routes->post('add-slide-exe','Slides::add');
$routes->post('delete-slide-exe','Slides::delete');

// Shipping rates
$routes->post('update-shipping-rates','ShippingRates::update');
$routes->post('set-location-cookie','ShippingRates::set_location_cookie');

// Collection Routes
$routes->post('add-collection-exe','Collections::add');
$routes->post('delete-collection-exe','Collections::delete');


// Category Routes
$routes->post('add-category-exe','Categories::add');
$routes->post('delete-category-exe','Categories::delete');
$routes->post('update-category-exe','Categories::update');


// Products
$routes->post('add-product-exe','Products::add');
$routes->post('delete-product-exe','Products::delete');
$routes->post('update-product-exe','Products::update');



/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
