<?php namespace App\Models;

use CodeIgniter\Model;

class OtpModel extends Model
{


    protected $table = "otps";

    protected $primaryKey = 'id';

    protected $allowedFields = ['code','email'];

    public function otp_exists($code){
        return $this->where('code',$code)->first();
    }

    public function delete_code(){
        
    }

    public function otp_for_email($email){
        return $this->where('email',$email)->first();
    }   


}