<?php namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{

    protected $table = "wishlist";

    protected $primaryKey = 'id';

    protected $allowedFields = ['customer_id','product_id','material','size'];


}