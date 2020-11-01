<?php namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{

    protected $table = "products";

    protected $primaryKey = 'id';

    protected $allowedFields = ['title','slug','category','featured_image','gallery_images','gallery_videos','youtube_video_links','attributes_json','stock_count','featured','attr_names','visibility'];


}