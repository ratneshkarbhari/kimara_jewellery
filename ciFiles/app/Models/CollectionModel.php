<?php namespace App\Models;

use CodeIgniter\Model;

class CollectionModel extends Model
{

    protected $table = "collections";

    protected $primaryKey = 'id';

    protected $allowedFields = ['title','slug','products','featured_image','description'];

}