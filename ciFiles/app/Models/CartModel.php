<?php namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{

    protected $table = "cart";

    protected $primaryKey = 'id';

    protected $allowedFields = ['product_id','material','size','quantity','ip_address'];

    public function clear_cart_for_ip(){
        return $this->where('ip_address',$_SERVER['REMOTE_ADDR'])->delete();
    }

    public function fetch_all_cart_items(){
        return $this->where('ip_address',$_SERVER['REMOTE_ADDR'])->findAll();
    }

}