<?php namespace App\Controllers;


use App\Models\CouponModel;


class Coupons extends BaseController
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

    public function add(){

        $this->send_to_login();

        $title = $this->request->getPost('title');
        $code = $this->request->getPost('code');

        $percentage_discount = $this->request->getPost('percentage_discount');
        $status = $this->request->getPost('status');
        $merchant = $this->request->getPost('merchant');
        $description = $this->request->getPost('description');

        $couponModel = new CouponModel();

        $dataToInsert = array(
            'title' => $title,
            'code' => $code,
            'status' => $status,
            'percentage_discount' => $percentage_discount,
            'merchant' => $merchant,
            'description' => $description
        );

        $couponExists = $couponModel->where('code',$code)->first();

        if ($couponExists) {
            
            $data['title']  = 'Add Coupon';
            $data['success'] = ''; $data['error'] = 'Coupon code already exists';
            $this->admin_page_loader('add_coupon_page',$data);

        } else {

            $created = $couponModel->insert($dataToInsert);

            if ($created) {
                $data['title']  = 'Add Coupon';
                $data['success'] = 'Coupon created successfully'; $data['error'] = '';
                $this->admin_page_loader('add_coupon_page',$data);
            } else {
                $data['title']  = 'Add Coupon';
                $data['success'] = ''; $data['error'] = 'Coupon couldnt be created';
                $this->admin_page_loader('add_coupon_page',$data);
            }
            
            
        }

    }

    public function set_coupon_cookie(){
        $code = $this->request->getPost('code');
        $couponModel = new CouponModel();
        $couponData = $couponModel->where('code',$code)->first();
        if ($couponData) {
            setcookie('coupon',$couponData['code'],time()+90000000000);
        }
        exit(TRUE);
    }

    public function unset_coupon_cookie(){
        setcookie('coupon','',time()-90000000000);
        exit(TRUE);
    }

    public function delete(){
    
        $this->send_to_login();
        
        $id = $this->request->getPost('id');

        $couponModel = new CouponModel();

        $deleted = $couponModel->delete($id);

        return redirect()->to(site_url('coupons-mgt'));         
        
    }

    public function update(){
        
        $this->send_to_login();
        
        $couponId = $this->request->getPost('id');

        $couponModel = new CouponModel();

        $prevCouponData = $couponModel->find($couponId);

        $code = $this->request->getPost('code');

        $codeExists = $couponModel->where('code',$code)->first();

        if ($codeExists && $codeExists['id']!=$prevCouponData['id']) {
            $data['title']  = 'Add Coupon';
            $data['success'] = ''; $data['error'] = 'Coupon code already exists';
            $this->admin_page_loader('add_coupon_page',$data);
        } else {
            $title = $this->request->getPost('title');    
            $percentage_discount = $this->request->getPost('percentage_discount');
            $status = $this->request->getPost('status');
            $merchant = $this->request->getPost('merchant');
            $description = $this->request->getPost('description');    
            $dataToInsert = array(
                'title' => $title,
                'code' => $code,
                'status' => $status,
                'percentage_discount' => $percentage_discount,
                'merchant' => $merchant,
                'description' => $description
            );
            $updated = $couponModel->update($prevCouponData['id'],$dataToInsert);
            if ($updated) {
                $data['focus_coupon'] = $focus_coupon = $couponModel->find($prevCouponData['id']);
                $data['title'] = 'Editing '.$focus_coupon['title'];
                $data['success'] = 'Coupon Updated successfully'; $data['error'] = '';
                $this->admin_page_loader('edit_coupon',$data);        
            } else {
                $data['focus_coupon'] = $focus_coupon = $couponModel->find($prevCouponData['id']);
                $data['title'] = 'Editing '.$focus_coupon['title'];
                $data['success'] = ''; $data['error'] = 'Coupon couldnt be updated';
                $this->admin_page_loader('edit_coupon',$data);
            }
                   
        }
        
    }



}