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


// SitePages
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
// Customer Profile my account page section
$routes->post('update-customer-profile','Authentication::update_customer_profile');

// cart routes
$routes->post('add-to-cart-exe','Cart::add');
$routes->post('update-cart','Cart::update');
$routes->post('delete-cart-item','Cart::delete');



// Order EndPoint
$routes->post('create-cod-order','Orders::create_cod_order');
$routes->post('create-order','Orders::create');
$routes->post('update-order','Orders::update');

// Auth Endpoints
$routes->post('customer-login-api','Authentication::customer_login_api');
$routes->post('user-logi-exe','Authentication::login');
$routes->post('customer-login-exe','Authentication::customer_login');
$routes->get('logout','Authentication::logout');
$routes->post('get-email-verif-code','Authentication::get_email_verif_code');
$routes->post('verify-email-exe','Authentication::verify_email_exe');
$routes->post('create-customer-account-exe','Authentication::create_customer_account');

// Wishlist
$routes->post('add-to-wishlist-exe','Wishlist:add');

// Newsletter
$routes->post('add-email-subscriber','NewsLetter::nl_subscription_send_email');
$routes->get('nl-sub-thank-you','PublicPageLoader::nl_sub_thank_you');

// Admin Dashboard
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

// Slides
$routes->post('add-slide-exe','Slides::add');
$routes->post('delete-slide-exe','Slides::delete');


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
