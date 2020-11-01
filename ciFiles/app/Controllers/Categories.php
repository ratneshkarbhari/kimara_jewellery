<?php namespace App\Controllers;

use App\Models\CategoryModel;


class Categories extends BaseController
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


	public function add()
	{

        $this->send_to_login();

    

        $categoryModel = new CategoryModel();

        $title = $this->request->getPost('title');
        
        $slugEntered = $this->request->getPost('slug');
        
        if ($slugEntered=='') {
            $slug = url_title($title,'-',TRUE);
        } else {
            $slug = url_title($slugEntered,'-',TRUE);
        }
        
        $categoryExists = $categoryModel->where('slug',$slug)->first();

        if ($categoryExists) {
            
            $data['title'] = 'Add Category';
            $data['error'] = 'This Slug already exists'; 
            $data['success'] = '';
            $data['categories'] = $categoryModel->findAll();


            $this->admin_page_loader('add_category',$data);
            
        } else {

            $description = $this->request->getPost('description');
            $parent = $this->request->getPost('parent');

            // Featured Image Square
    
            $featuredImageRect = $this->request->getFile('featured_image_rect');
    
            $featuredImageRectRandomName = $featuredImageRect->getRandomName();
    
            $featuredImageRect->move('assets/images/category_featured_images', $featuredImageRectRandomName);
            
            // Featured Image Square

            $featuredImageSquare = $this->request->getFile('featured_image_square');
    
            $featuredImageSquareRandomName = $featuredImageSquare->getRandomName();
    
            $featuredImageSquare->move('assets/images/category_featured_images', $featuredImageSquareRandomName);
    
            $categoryData = array(
                'title' => $title,
                'slug' => $slug,
                'description' => $description,
                'parent' => $parent,
                'featured_image_rect' => $featuredImageRectRandomName,
                'featured_image_square' => $featuredImageSquareRandomName,
                'visibility' => $this->request->getPost('visibility')
            );
            
            $response = $categoryModel->insert($categoryData);

            if ($response) {
                
                $data['title'] = 'Add Category';
                $data['error'] = ''; 
                $data['success'] = 'Category created';
                $data['categories'] = $categoryModel->findAll();

                $this->admin_page_loader('add_category',$data);


            } else {
                
                $data['title'] = 'Add Category';
                $data['error'] = 'We are facing some errors'; 
                $data['success'] = '';
                $data['categories'] = $categoryModel->findAll();

                $this->admin_page_loader('add_category',$data);


            }
            

        }
        

    }
}