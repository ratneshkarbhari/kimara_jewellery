<?php namespace App\Models;

use CodeIgniter\Model;

class HomePageSlideModel extends Model
{


    protected $table = "slides";

    protected $primaryKey = 'id';

    protected $allowedFields = ['link','desktop_image','touch_image'];


}