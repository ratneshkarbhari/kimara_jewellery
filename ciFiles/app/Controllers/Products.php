<?php namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;


class Products extends BaseController
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

    

        $productModel = new ProductModel();

        $title = $this->request->getPost('title');
        
        $slugEntered = $this->request->getPost('slug');
        
        if ($slugEntered=='') {
            $slug = url_title($title,'-',TRUE);
        } else {
            $slug = url_title($slugEntered,'-',TRUE);
        }
        
        $productExists = $productModel->where('slug',$slug)->first();

        if ($productExists) {
            
            $data['title'] = 'Add Product';

            $categoryModel = new CategoryModel();
    
            $data['categories'] = $categoryModel->findAll();
    
            $data['error'] = 'This slug already exists'; $data['success'] = '';
            
            $this->admin_page_loader('add_product',$data);
            
        } else {

            $description = $this->request->getPost('description');
            $category = $this->request->getPost('category');

            // Featured Image Upload

            $featuredImage = $this->request->getFile('featured_image');

			
			$featuredImageRandomName = $featuredImage->getRandomName();

			$featuredImage->move('assets/images/featured_image_product', $featuredImageRandomName);

            // GalleryImages Upload
            $galleryImages = $this->request->getFilemULTIPLE('gallery_images');

            $galleryImageNames = '';

			foreach ($galleryImages as $galleryImage) {

				$galleryImageRandomName = $galleryImage->getRandomName();

				$galleryImage->move('assets/images/gallery_images_product', $galleryImageRandomName);

				if($galleryImageNames==''){
					$galleryImageNames.=$galleryImageRandomName;
				}else{
					$galleryImageNames.=','.$galleryImageRandomName;
				}

			}

            // GalleryImages Upload
            $galleryVideos = $this->request->getFilemULTIPLE('gallery_images');

            $galleryVideoNames = '';

			foreach ($galleryVideos as $galleryVideo) {

				$galleryVideoRandomName = $galleryVideo->getRandomName();

				// $galleryVideo->move('assets/images/gallery_videos_product', $galleryVideoRandomName);

				if($galleryVideoNames==''){
					$galleryVideoNames.=$galleryVideoRandomName;
				}else{
					$galleryVideoNames.=','.$galleryVideoRandomName;
				}

			}

    
            $categoryData = array(
                'title' => $title,
                'slug' => $slug,
                'description' => $description,
                'category' => $category,
                'featured_image' => $featuredImageRandomName,
                'gallery_images' => $galleryImageNames,
                'gallery_videos' => $galleryVideoNames,
                'sizes' => $this->request->getPost('sizes'),
                'materials' => $this->request->getPost('materials'),
                'featured' => $this->request->getPost('featured'),
                'price' =>  $this->request->getPost('price'),
                'sale_price' =>  $this->request->getPost('sale_price'),
                'stock_count' => $this->request->getPost('stock_count'),
                'visibility' => $this->request->getPost('visibility')
            );
            
            $response = $productModel->insert($categoryData);

            if ($response) {
                
                $data['title'] = 'Add Product';

                $categoryModel = new CategoryModel();
        
                $data['categories'] = $categoryModel->findAll();
        
                $data['error'] = ''; $data['success'] = 'Product added successfully';
                
                $this->admin_page_loader('add_product',$data);


            } else {
                
                $data['title'] = 'Add Product';

                $categoryModel = new CategoryModel();
        
                $data['categories'] = $categoryModel->findAll();
        
                $data['error'] = 'Product not added'; $data['success'] = '';
                
                $this->admin_page_loader('add_product',$data);


            }
            

        }
        

    }


    
    public function delete(){
        $this->send_to_login();

        $productId = $this->request->getPost('id');

        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();

        $productData = $productModel->find($productId);

        $productDeleted = $productModel->delete($productId);

        $data['title'] = 'Manage Products';

        $data['categories'] = $categoryModel->findAll();
        $data['products'] = $productModel->findAll();


        if ($productDeleted) {
            
    
            $data['error'] = ''; $data['success'] = 'Product Deleted Successfully';

            $this->admin_page_loader('products',$data);
            
        }else {

            $data['error'] = 'Product couldnt be deleted'; $data['success'] = '';

            $this->admin_page_loader('products',$data);
            
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