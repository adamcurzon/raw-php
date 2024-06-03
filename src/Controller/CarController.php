<?php

namespace App\Controller;

use App\Response\Response;
use App\Enum\ResponseCode;

class CarController
{
    public function index(): Response
    {
        return new Response(ResponseCode::OK, data: ["Fiesta", "BMW"]);
    }
}
