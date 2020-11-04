<?php namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProductModel;



class Cart extends BaseController
{

    public function add(){


        $pid = $this->request->getPost('product_id');
        $material = $this->request->getPost('material');
        $size = $this->request->getPost('size');
        $quantity = $this->request->getPost('quantity');
        
        $cartModel = new CartModel();
        
        $existsAlready = $cartModel->where('product_id',$pid)->where('material',$material)->where('size',$size)->where('ip_address',$_SERVER['REMOTE_ADDR'])->first();
        
        if ($existsAlready) {
            $existsAlready['quantity'] = $existsAlready['quantity']+$quantity;
            $res = $cartModel->update($existsAlready['id'],$existsAlready); 
            if ($res) {
                exit('success');
            } else {
                exit('failure');
            }
        } else {
            $data = array(
                'product_id' => $pid,
                'material' => $material,
                'size' => $size,
                'quantity' => $quantity,
                'ip_address' => $_SERVER['REMOTE_ADDR']
            );
            $res = $cartModel->insert($data);
            if ($res) {
                exit('success');
            } else {
                exit('failure');
            }
            
        }
        
        
        
        
        
        
    }

    public function update(){
       $id = $this->request->getPost('cart-item-id');
       $qty = $this->request->getPost('product-qty');
        $cartModel = new CartModel();

        $itemExists = $cartModel->find($id);
            
        $itemExists['quantity'] = $qty;
        
        $res = $cartModel->update($itemExists['id'], $itemExists);

        return redirect()->to(site_url('cart')); 

    }       

    public function delete(){
        $cartItemID = $this->request->getPost('cart-item-id');
        $cartModel = new CartModel();
        $cartModel->delete($cartItemID);
        return redirect()->to(site_url('cart'));
    }

}