<?php namespace App\Controllers;

use App\Models\HomePageSlideModel;


class Slides extends BaseController
{

    public function delete(){
        $slideId = $this->request->getPost('id');
        $hpSliderModel = new HomePageSlideModel();
        $deleted = $hpSliderModel->delete($slideId);
        if ($deleted) {
            
            $data['title'] = 'HomePage Slides';
            $homePageSlideModel = new HomePageSlideModel();
            $slides = $homePageSlideModel->findAll();
    
            $data['slides'] = $slides;
            $data['error'] = ""; $data['success'] = 'Slide deleted successfully';
    
            $this->admin_page_loader('homepage_slides',$data);

        } else {


            $data['title'] = 'HomePage Slides';
            $homePageSlideModel = new HomePageSlideModel();
            $slides = $homePageSlideModel->findAll();
    
            $data['slides'] = $slides;
            $data['error'] = "Slide not deleted"; $data['success'] = '';
    
            $this->admin_page_loader('homepage_slides',$data);
            
        }
    }

    public function add(){
        
        $link = $this->request->getPost('link');
        
        $desktopImage = $this->request->getFile('desktop_image');
        $touchImage = $this->request->getFile('touch_image');

        if($desktopImage->isValid()){
            if (! $desktopImage->hasMoved()) {
                $desktopImageRandomName = $desktopImage->getRandomName();

                $desktopImage->move('assets/images/banners', $desktopImageRandomName);

            }
        }

        if($touchImage->isValid()){
            if (! $touchImage->hasMoved()) {
                $touchImageRandomName = $touchImage->getRandomName();

                $touchImage->move('assets/images/banners', $touchImageRandomName);

            }
        }

        $sliderObj = array(
            'link' => $link,
            'desktop_image' => $desktopImageRandomName,
            'touch_image' => $touchImageRandomName
        );

        $hpSliderModel = new HomePageSlideModel();

        $created = $hpSliderModel->insert($sliderObj);

        if($created){

            $data['title'] = 'HomePage Slides';
            $homePageSlideModel = new HomePageSlideModel();
            $slides = $homePageSlideModel->findAll();
    
            $data['slides'] = $slides;
            $data['error'] = ""; $data['success'] = 'Slide created successfully';
    
            $this->admin_page_loader('homepage_slides',$data);
            
        }else{

            $data['title'] = 'HomePage Slides';
            $homePageSlideModel = new HomePageSlideModel();
            $slides = $homePageSlideModel->findAll();
    
            $data['slides'] = $slides;
            $data['error'] = "Slide not created"; $data['success'] = '';
    
            $this->admin_page_loader('homepage_slides',$data);

        }

    }

    private function admin_page_loader($viewName,$data){

        echo view('templates/admin_header',$data);
        echo view('adminPages/'.$viewName,$data);
        echo view('templates/admin_footer',$data);

    }

}