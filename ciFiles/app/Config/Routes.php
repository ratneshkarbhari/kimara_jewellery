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
$routes->post('user-login-exe','Authentication::login');

// Admin Dashboard
$routes->get('admin-dashboard','AdminPageLoader::dashboard');
$routes->get('manage-categories','AdminPageLoader::categories');
$routes->get('add-category','AdminPageLoader::add_category');
$routes->get('edit-category/(:any)','AdminPageLoader::edit_category/$1');
$routes->get('manage-products','AdminPageLoader::products');
$routes->get('add-products','AdminPageLoader::add_product');

// Category Routs
$routes->post('add-category-exe','Categories::add');
$routes->post('delete-category-exe','Categories::delete');
$routes->post('update-category-exe','Categories::update');


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
