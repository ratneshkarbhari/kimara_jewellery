<?php namespace App\Models;

use CodeIgniter\Model;

class CouponModel extends Model
{

    protected $table = "coupons";

    protected $primaryKey = 'id';

    protected $allowedFields = ['title','code','percentage_discount','merchant','status','description'];

}