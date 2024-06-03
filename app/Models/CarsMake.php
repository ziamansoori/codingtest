<?php

namespace App\Models;

use CodeIgniter\Model;

class CarsMake extends Model
{
    protected $table            = 'cars_make';
    protected $allowedFields    = ['title', 'status'];
}
