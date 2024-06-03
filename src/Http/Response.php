<?php

namespace App\Http;

use App\Enum\ResponseCode;

class Response
{
    public function __construct(
        private ResponseCode $statusCode,
        private ?string $message = null,
        private mixed $data = null
    ) {
    }

    public function send()
    {
        header('Content-Type: application/json');
        http_response_code($this->statusCode->value);
        exit($this->toJson());
    }

    public function toJson()
    {
        return json_encode([
            'status_code' => $this->statusCode,
            'message' => $this->message,
            'data' => $this->data
        ]);
    }
}
