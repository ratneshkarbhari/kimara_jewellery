<?php namespace App\Models;

use CodeIgniter\Model;

class VendorApprovalModel extends Model
{

    protected $table = "vendor_approval_requests";

    protected $primaryKey = 'id';

    protected $allowedFields = ['vendor_data', 'adhaar_image','pan_image'];

}