<?php namespace App\Models;

use CodeIgniter\Model;

class HomePageSlideModel extends Model
{


    protected $table = "homepage_slides";

    protected $primaryKey = 'id';

    protected $allowedFields = ['link','image_desktop','image_touch'];


}