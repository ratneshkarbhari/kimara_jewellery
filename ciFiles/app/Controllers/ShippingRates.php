<?php namespace App\Controllers;

use App\Models\ShippingRateModel;


class ShippingRates extends BaseController
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

    public function update(){

        $this->send_to_login();

        $shippingRateModel = new ShippingRateModel();

        $array = array(
            'india' => $this->request->getPost('india_shipping'),
            'row' => $this->request->getPost('row_shipping'),
            'free_shipping_threshold' => $this->request->getPost('free_shipping_threshold')
        );

        $res = $shippingRateModel->update(1,$array);

       
        $data['title'] = 'Update Shipping Rates';
        $data['shipping_rates'] = $shippingRateModel->first();
        $this->admin_page_loader('update_shipping_rates',$data);  
       

    }

    public function set_location_cookie(){
        $location = $this->request->getPost('location');
        setcookie('location',$location,time()+(24*60*60));
        return TRUE;
    }

}