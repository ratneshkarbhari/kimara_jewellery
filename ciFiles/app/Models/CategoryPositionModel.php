<?php namespace App\Models;

use CodeIgniter\Model;

class CategoryPositionModel extends Model
{

    protected $table = "category_positions";

    protected $primaryKey = 'id';

    protected $allowedFields = ['ig_feed','homepage','sidenav'];


}