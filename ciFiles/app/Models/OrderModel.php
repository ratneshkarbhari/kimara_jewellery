<?php namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{

    protected $table = "orders";

    protected $primaryKey = 'id';

    protected $allowedFields = ['public_order_id','products_qty_json','amount_paid','status','status_details','customer_note','customer_id','customer_name','mode'];

    public function fetch_all_cart_items(){
        return $this->where('ip_address',$_SERVER['REMOTE_ADDR'])->findAll();
    }   

}