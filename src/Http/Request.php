<?php

namespace App\Http;

use App\Enum\ResponseCode;
use App\Contract\ValidatorContract;

class Request
{
    private mixed $body;

    public function __construct()
    {
        $this->body = json_decode(file_get_contents('php://input'), true) ?? null;
    }

    public function validateJson(ValidatorContract $validator): void
    {
        $validator->validate($this->body);

        if (!$validator->isValid()) {
            (new Response(ResponseCode::BAD_REQUEST, "Request not valid", $validator->getErrors()))->send();
        }
    }

    public function get($key)
    {
        return $this->body[$key];
    }
}
