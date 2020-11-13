<?php namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{

    protected $table = "products";

    protected $primaryKey = 'id';

    protected $allowedFields = ['title','slug','category','featured_image','gallery_images','gallery_videos','stock_count','featured','visibility','description','price','sale_price','sizes','materials','daily_deal','sku','collection'];


}