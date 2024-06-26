<?php

namespace App\Controller;

use App\Model\Car;
use App\Http\Request;
use App\Http\Response;
use App\Enum\ResponseCode;
use App\Repository\CarRepository;
use App\Http\Validator\CreateCarValidator;
use App\Http\Validator\GetCarValidator;
use App\Http\Validator\UpdateCarValidator;

class CarController
{
    public function __construct(private CarRepository $carRepository)
    {
    }

    public function index(Request $request): Response
    {
        return new Response(
            ResponseCode::OK,
            data: $this->carRepository->findAll()
        );
    }

    public function get(Request $request): Response
    {
        $request->validateUrlParts(new GetCarValidator());

        $carId = $request->getUrlPart(0);
        $car = $this->carRepository->findById($carId);

        if ($car === null) {
            return new Response(ResponseCode::NOT_FOUND, "Car {$carId} not found");
        }

        return new Response(
            ResponseCode::OK,
            data: $car->toArray()
        );
    }

    public function create(Request $request): Response
    {
        $request->validateJson(new CreateCarValidator());

        $car = new Car();
        $car->setName($request->get("name"));
        $this->carRepository->save($car);

        return new Response(ResponseCode::CREATED, "Car created", $car->toArray());
    }

    public function update(Request $request): Response
    {
        $request->validateJson(new UpdateCarValidator());

        $carId = $request->getUrlPart(0);
        $car = $this->carRepository->findById($carId);

        if ($car === null) {
            return new Response(ResponseCode::NOT_FOUND, "Car {$carId} not found");
        }

        $car->setName($request->get("name"));
        $this->carRepository->save($car);

        return new Response(ResponseCode::ACCEPTED, "Car updated", $car->toArray());
    }
}
