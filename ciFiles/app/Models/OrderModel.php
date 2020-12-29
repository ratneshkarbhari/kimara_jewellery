<?php namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{

    protected $table = "orders";

    protected $primaryKey = 'id';

    protected $allowedFields = ['public_order_id','products_qty_json','amount_paid','status','status_details','customer_email','contact_number','customer_name','mode','shipping_address','billing_address','date','store'];

    public function fetch_all_cart_items(){
        return $this->where('ip_address',$_SERVER['REMOTE_ADDR'])->findAll();
    }   


}