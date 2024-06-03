<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\CarsMake;

class CarsMakeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'Ford',
            'Audi',
            'BMW',
            'Abath',
            'Aston Martin',
            'Bentley',
            'Chrysler',
            'Ferrari',
            'Mazda',
            'Subaru',
            'Toyota',
            'Cadillac',
            'Dodge',
            'Honda',
            'Maybach',
            'Mitsubishi',
            'Volkswegan',
            'Acura',
            'Chevrolet',
            'Hyundai',
            'Kia'
        ];
       // print_r($data);
        $carsMake = new CarsMake();

        foreach($data as $title)
        {
            $carsMake->insert(['title' => $title], true);
        }
    }
}
