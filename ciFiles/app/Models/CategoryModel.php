<?php namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{

    protected $table = "categories";

    protected $primaryKey = 'id';

    protected $allowedFields = ['title','slug','parent','featured_image_rect','featured_image_square','description','visibility'];


}