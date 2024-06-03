<?php

namespace App\Controllers\API;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use App\Models\Cars;

class CarsController extends Controller
{
    use ResponseTrait;
    protected $carsResponse;
    protected $cache;
    private $cacheKey;
    public function __construct()
    {
        $this->carsResponse = $this->setResponseFormat('json');
        $this->cache = cache();
        $this->cacheKey = "cars-cache";
    }
    
    public function index()
    {
        $pageNo = $this->request->getVar('page') !== null ? $this->request->getVar('page')-1 : 0;
        $items = $this->cache->get($this->cacheKey."-".$pageNo);

        if($items == null)
        {
            $limit = 10;
            $offset = $pageNo*$limit;
            $carsModel = new Cars();
            try{
                $cars = $carsModel->select('cars.id, cars.model, cars.year, cars.vin, cars.shipping_status, cm.title as make, cars.created_at, cars.updated_at')
                                ->join('cars_make as cm', 'cm.id = cars.make_id')
                                ->where('cars.status', 1)->orderBy('cars.created_at', 'DESC');
                $total_records = $cars->countAllResults(false);
                $pages = ceil($total_records/$limit);
                $records = $cars->limit($limit, $offset)->findAll();
                $response = ["pages" => $pages, "data" => $records];
                $this->cache->save($this->cacheKey."-".$pageNo, $response);
                return $this->carsResponse->respond($response, 200);
            }
            catch(\Exception $e)
            {
                return $this->carsResponse->respond($e->getMessage(), 400);
            }
        }
        else
        {
            return $this->carsResponse->respond($items, 200);
        }
    }

    public function store()
    {
        $request = $this->request->getJSON(true);
        $rules = [
            "model" => "required|max_length[100]|min_length[3]",
            "year" => "required",
            "make_id" => "required",
            "vin" => "required|max_length[17]|min_length[17]"
        ];
        if(! $this->validate($rules))
        {
            return $this->carsResponse->respond(["error" => $this->validator->getErrors()], 400);
        }

        try{
            $carsModel = new Cars();
            $response = $carsModel->insert(
                [
                    "make_id" => $request['make_id'],
                    "model" => $request['model'],
                    "year" => $request['year'],
                    "vin" => $request['vin'],
                    "detail" => isset($request['detail']) ? $request['detail'] : '',
                    "shipping_status" => 1
                ]
            );

            $car = $carsModel->find($response);
            $this->cache->clean();
            return $this->carsResponse->respond(["data" => $car], 200);
        }
        catch(\Exception $e)
        {
            return $this->carsResponse->respond($e->getMessage(), 400);
        }

    }

    public function updateShippingStatus($id)
    {
        $request = $this->request->getJSON(true);
        $rules = [
            "shipping_status" => "required|in_list[1,2,3]"
        ];
        if(! $this->validate($rules) )
        {
            return $this->carsResponse->respond(["error" => $this->validator->getErrors()], 400);
        }
        try{
            $carsModel = new Cars();
            $response = $carsModel->update($id, ["shipping_status" => $request['shipping_status']]);
            $this->cache->clean();
            return $this->carsResponse->respond(["data" => $response], 200);
        }
        catch(\Exception $e)
        {
            return $this->carsResponse->respond(["error" => $e->getMessage()], 400);
        }

    }
}
