<?php

namespace App\Controller;

use App\Model\Car;
use App\Http\Request;
use App\Http\Response;
use App\Enum\ResponseCode;
use App\Repository\CarRepository;
use App\Http\Validator\CreateCarValidator;

class CarController
{
    public function __construct(private CarRepository $carRepository)
    {
    }

    public function index(Request $request): Response
    {
        return new Response(ResponseCode::OK, data: $this->carRepository->findAll());
    }

    public function create(Request $request): Response
    {
        $request->validateJson(new CreateCarValidator());

        $car = new Car();
        $car->setName($request->get("name"));
        $this->carRepository->save($car);

        return new Response(ResponseCode::CREATED, "Car created", $car->toArray());
    }
}
