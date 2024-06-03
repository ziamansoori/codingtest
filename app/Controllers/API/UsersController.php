<?php

namespace App\Controllers\API;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use App\Models\User;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UsersController extends Controller
{
    use ResponseTrait;
    protected $userResponse;
    protected $db;
    public function __construct()
    {
        $this->userResponse = $this->setResponseFormat('json');
        $this->db = \Config\Database::connect();
    }
    
    public function login()
    {
        $request = $this->request->getJSON(true);
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];
        if(! $this->validate($rules) )
        {
            return $this->userResponse->respond(['error' => $this->validtor->getErrors()], 400);
        }

        $userModel = new User();
        $user = $userModel->where('email' , $request['email'])
                        ->first();
        if(is_null($user))
        {
            return $this->userResponse->respond(['error' => 'Invalid Email or Password'], 400);
        }

        $password_verify = password_verify($request['password'], $user['password']);

        if(!$password_verify)
        {
            return $this->userResponse->respond(['error' => 'Invalid Email or Password'], 400);
        }
        $key = getenv('JWT_SECRET');
        $expiry = getenv('JWT_EXPIRY');
        $iat = time(); // current timestamp value
        $exp = $iat + $expiry;
  
        $payload = array(
            "iss" => "CodingTest",
            "aud" => "CodingTestUser",
            "sub" => $user['id'],
            "iat" => $iat,
            "exp" => $exp
        );
          
        $token = JWT::encode($payload, $key, 'HS256');
        $response = [
            'success' => true,
            'token' => $token
        ];

        return $this->userResponse->respond($response, 200);
    }

}
