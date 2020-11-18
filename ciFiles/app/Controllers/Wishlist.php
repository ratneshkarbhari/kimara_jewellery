<?php namespace App\Controllers;

use App\Models\WishlistModel;


class Wishlist extends BaseController
{

    public function add(){
        
        $customer_id = $this->request->getPost('customer_id');
        $product_id = $this->request->getPost('product_id');
        $material = $this->request->getPost('material');
        $size = $this->request->getPost('size');

        $wishListModel = new WishlistModel();

        $exists = $wishListModel->where('cid',$customer_id)->where('pid',$product_id)->where('material',$material)->where('size',$size)->first();

        if($exists){
            exit('already-in-wishlist');
        }else{


            $arrayToInsert = array(
                'cid' => $customer_id,
                'pid' => $product_id,
                'material' => $material,
                'size' => $size
            );


            $res = $wishListModel->insert($arrayToInsert);

            if($res){
                exit('add-to-wishlist-success');
            }




        }


    }

    public function delete(){
        
        $session = session();
        if($session->role!='customer'){
            return redirect()->to(site_url('customer-login')); 
        }
        $wlid = $this->request->getPost('wlid');
        $wishListModel = new WishlistModel();
        $deleted = $wishListModel->delete($wlid);
        return redirect()->to(site_url('my-account')); 
    
    }

}