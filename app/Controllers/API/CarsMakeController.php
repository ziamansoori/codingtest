<?php

namespace App\Controllers\API;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use App\Models\CarsMake;

class CarsMakeController extends Controller
{
    use ResponseTrait;
    protected $carsResponse;
    public function __construct()
    {
        $this->carsResponse = $this->setResponseFormat('json');
    }
    
    public function index()
    {
        $carsModel = new CarsMake();
        try{
            $cars = $carsModel->where('status', 1)->orderBy('title', 'ASC')->findAll();
            return $this->carsResponse->respond($cars, 200);
        }
        catch(\Exception $e)
        {
            return $this->carsResponse->respond($e->getMessage(), 400);
        }
    }

}
