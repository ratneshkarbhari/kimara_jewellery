<?php namespace App\Controllers;

use App\Models\CollectionModel;
use App\Models\ProductModel;


class Collections extends BaseController
{

    private function send_to_login(){

        $session = session();

		$role = $session->get('role');

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }

    }

    private function admin_page_loader($viewName,$data){

        echo view('templates/admin_header',$data);
        echo view('adminPages/'.$viewName,$data);
        echo view('templates/admin_footer',$data);

    }

    public function delete(){

        $this->send_to_login();

        $collectionId = $this->request->getPost('id');

        $collectionModel = new CollectionModel();

        $deleted = $collectionModel->delete($collectionId);

        if($deleted){

            $data['title'] = 'Collections';
            $collectionModel = new CollectionModel();
            $collections = $collectionModel->findAll();
    
            $data['collections'] = array_reverse($collections);
            $data['error'] = ''; $data['success'] = 'Collection Deleted successfully';
    
            $this->admin_page_loader('collections',$data);      

        }else {

            $data['title'] = 'Collections';
            $collectionModel = new CollectionModel();
            $collections = $collectionModel->findAll();
    
            $data['collections'] = array_reverse($collections);
            $data['error'] = 'Not Deleted'; $data['success'] = '';
    
            $this->admin_page_loader('collections',$data);      
            
        }

    }



    public function add(){

        $this->send_to_login();

        $collection_products = $this->request->getPost('collection_products');

        $collection_products_string = '';

        foreach ($collection_products as $collection_product) {
            $collection_products_string.=$collection_product.',';
        }

        if($this->request->getPost('slug')==''){
            $slug = $this->request->getPost('title');
        }else {
            $slug = $this->request->getPost('slug');
        }

        $featuredImage = $this->request->getFile('featured_image');
   
        if($featuredImage->isValid()){

            $featuredImageRandomName = $featuredImage->getRandomName();

            $featuredImage->move('assets/images/collection_featured', $featuredImageRandomName);
    
        }else{
            $featuredImageRandomName = "noimage.jpg";
        }

        $objToInsert = array(
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'description' => $this->request->getPost('description'),
            'featured_image' => $featuredImageRandomName,
            'products' => $collection_products_string
        );

        $collectionModel = new CollectionModel();

        $created = $collectionModel->insert($objToInsert);

        if($created){
            $data['title'] = 'Collections';
            $productModel = new ProductModel();
            $products = $productModel->findAll();
            $data['products'] = $products;
            $data['error'] = ''; $data['success'] = 'Collection Created Successfully';
            $this->admin_page_loader('add_collection',$data);        
        }else {
            $data['title'] = 'Collections';
            $productModel = new ProductModel();
            $products = $productModel->findAll();
            $data['products'] = $products;
            $data['error'] = 'Couldnt create collection'; $data['success'] = '';
            $this->admin_page_loader('add_collection',$data);        
        }

    }


}