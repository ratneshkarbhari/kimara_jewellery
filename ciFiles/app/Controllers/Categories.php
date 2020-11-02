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

    public function delete(){
        $this->send_to_login();

        $categoryId = $this->request->getPost('id');

        $categoryModel = new CategoryModel();

        $categoryData = $categoryModel->find($categoryId);

        $featuredImageFolderPath = './assets/images/category_featured_images/';

        $featuredImgRectPath = $featuredImageFolderPath.$categoryData['featured_image_rect'];
        $featuredImgSquarePath = $featuredImageFolderPath.$categoryData['featured_image_square'];

        if(is_file($featuredImgRectPath)){
            unlink($featuredImgRectPath);
        }

        if (is_file($featuredImgSquarePath)) {
            unlink($featuredImgSquarePath);
        }

        $categoryDeleted = $categoryModel->delete($categoryId);

        $data['title'] = 'Manage Categories';

        $data['categories'] = $data['pcats'] = $categoryModel->findAll();


        if ($categoryDeleted) {
            
    
            $data['error'] = ''; $data['success'] = 'Category Deleted Successfully';

            $this->admin_page_loader('categories',$data);
            
        }else {

            $data['error'] = 'Category couldnt be deleted'; $data['success'] = '';

            $this->admin_page_loader('categories',$data);
            
        }

    }

    public function update(){
     
        $this->send_to_login();

        $featuredImageFolderPath = './assets/images/category_featured_images/';

    
        $categoryId = $this->request->getPost('id');

        $categoryModel = new CategoryModel();

        $categoryData = $categoryModel->find($categoryId);

        $title = $this->request->getPost('title');
        
        $slugEntered = $this->request->getPost('slug');
        
        if ($slugEntered=='') {
            $slug = url_title($title,'-',TRUE);
        } else {
            $slug = url_title($slugEntered,'-',TRUE);
        }
        
        $categoryExists = $categoryModel->where('slug',$slug)->first();

        if ($categoryExists&&$categoryExists['id']!=$categoryId) {
            
            $data['title'] = 'Edit Category';

            $categoryModel = new CategoryModel();
    
            $data['category'] = $categoryModel->where('slug',$slug)->first();
    
            $data['pcats'] = $categoryModel->findAll();
    
            $data['error'] = 'The slug already exists'; $data['success'] = '';
            
            $this->admin_page_loader('edit_category',$data);
            
        } else {

            $description = $this->request->getPost('description');
            $parent = $this->request->getPost('parent');

            // Featured Image Square



            $featuredImgSquarePath = $featuredImageFolderPath.$categoryData['featured_image_square'];

            // Featured Image Rectangular

    
            $featuredImageRect = $this->request->getFile('featured_image_rect');

            if ($featuredImageRect->isValid()) {

                $prevFeaturedImgRectPath = $featuredImageFolderPath.$categoryData['featured_image_rect'];

                if (is_file($prevFeaturedImgRectPath)) {
                    unlink($prevFeaturedImgRectPath);
                }

                $featuredImageRectRandomName = $featuredImageRect->getRandomName();
    
                $featuredImageRect->move('assets/images/category_featured_images', $featuredImageRectRandomName);
                
            }else {
                $featuredImageRectRandomName = $categoryData['featured_image_rect'];
            }


            // Featured Image Square


            $featuredImageSquare = $this->request->getFile('featured_image_square');


            if ($featuredImageSquare->isValid()) {

                $prevFeaturedImgSquarePath = $featuredImageFolderPath.$categoryData['featured_image_rect'];

                if (is_file($prevFeaturedImgSquarePath)) {
                    unlink($prevFeaturedImgSquarePath);
                }

                $featuredImageSquareRandomName = $featuredImageSquare->getRandomName();
    
                $featuredImageSquare->move('assets/images/category_featured_images', $featuredImageSquareRandomName);
                
            }else {
                $featuredImageSquareRandomName = $categoryData['featured_image_square'];
            }
    

            
    
    
    
            $categoryData = array(
                'title' => $title,
                'slug' => $slug,
                'description' => $description,
                'parent' => $parent,
                'featured_image_rect' => $featuredImageRectRandomName,
                'featured_image_square' => $featuredImageSquareRandomName,
                'visibility' => $this->request->getPost('visibility')
            );
            
            $response = $categoryModel->update($categoryId,$categoryData);

            if ($response) {
                
                $data['title'] = 'Edit Category';

                $categoryModel = new CategoryModel();
        
                $data['category'] = $categoryModel->where('slug',$slug)->first();
        
                $data['pcats'] = $categoryModel->findAll();
        
                $data['error'] = ''; $data['success'] = 'Category updated';
                
                $this->admin_page_loader('edit_category',$data);


            } else {
                
                $data['title'] = 'Edit Category';

                $categoryModel = new CategoryModel();
        
                $data['category'] = $categoryModel->where('slug',$slug)->first();
        
                $data['pcats'] = $categoryModel->findAll();
        
                $data['error'] = 'Category not updated'; $data['success'] = '';
                
                $this->admin_page_loader('edit_category',$data);


            }
            

        }
        
    }

}