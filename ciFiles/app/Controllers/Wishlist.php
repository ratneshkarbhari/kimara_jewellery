<?php namespace App\Controllers;

use App\Models\WishlistModel;


class Wishlist extends BaseController
{

    public function add(){
        
        $customer_id = $this->request->getPost('customer_id');
        $product_id = $this->request->getPost('product_id');
        $material = $this->request->getPost('material');
        $size = $this->request->getPost('size');

        $exists = $this->check_if_exists($customer_id,$product_id,$material,$size);

        if($exists){
            exit('already-in-wishlist');
        }else{

            $wishListModel = new WishlistModel();

            $arrayToInsert = array(
                'customer_id' => $customer_id,
                'product_id' => $product_id,
                'material' => $material,
                'size' => $size
            );

            $wishListModel->insert($arrayToInsert);

        }


    }

    private function check_if_exists($customer_id,$product_id,$material,$size){
        $wishListModel = new WishlistModel();

        return $wishListModel->where('customer_id',$customer_id)->where('product_id',$product_id)->where('material',$material)->where('size',$size)->first();

    }

}