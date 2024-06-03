<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = [
            'first_name' => 'Test',
            'last_name' => 'Test',
            'email' => 'testing@test.com',
            'password' => password_hash('Test1234', PASSWORD_DEFAULT)
        ];

        $userModel = new User();
        $response = $userModel->insert($user);
        echo $response;
    }
}
