<?php

namespace App\Http;

use App\Enum\ResponseCode;
use App\Contract\ValidatorContract;

class Request
{
    private mixed $body;

    private array $urlParts;

    private array|null $headers;

    public function __construct()
    {
        $this->body = json_decode(file_get_contents('php://input'), true) ?? null;
        $this->headers = getallheaders() ?? null;
    }

    public function validateJson(ValidatorContract $validator): void
    {
        $validator->validate($this->body);

        if (!$validator->isValid()) {
            (new Response(ResponseCode::BAD_REQUEST, "Request not valid", ["errors" => $validator->getErrors()]))->send();
        }
    }

    public function validateUrlParts(ValidatorContract $validator): void
    {
        $validator->validate($this->urlParts);

        if (!$validator->isValid()) {
            (new Response(ResponseCode::BAD_REQUEST, "Request not valid", ["errors" => $validator->getErrors()]))->send();
        }
    }

    public function get($key)
    {
        return $this->body[$key];
    }

    public function parseUrl(): void
    {
        $this->urlParts = array_unique(explode('/', $_SERVER['REQUEST_URI']));

        $_SERVER["REQUEST_URI"] = "/" . $this->urlParts[1];

        $this->urlParts = array_slice($this->urlParts, 2);

        for ($i = 0; $i < sizeOf($this->urlParts); $i++) {
            $_SERVER["REQUEST_URI"] .= "/{}";
        }
    }

    public function getUrlPart(int $pos)
    {
        return $this->urlParts[$pos] ?? null;
    }

    public function getHeader(string $key): string
    {
        return $this->headers[$key];
    }
}
