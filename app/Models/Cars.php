<?php

namespace App\Models;

use CodeIgniter\Model;

class Cars extends Model
{
    protected $table = "cars";
    protected $allowedFields = ['make_id', 'model', 'year', 'vin', 'detail', 'image', 'shipping_status', 'status'];
}