<?php namespace App\Models;

use CodeIgniter\Model;

class StoreModel extends Model
{

    protected $table = "stores";

    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'code','logo','product_ids','category_ids','vendor'];

}