<?php namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{

    protected $table = "users";

    protected $primaryKey = 'id';

    protected $allowedFields = ['first_name', 'last_name','email','mobile_number','addresses_json','email_verified','mobile_verified','role','password'];


}