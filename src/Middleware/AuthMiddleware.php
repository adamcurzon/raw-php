<?php

namespace App\Middleware;

use App\Http\Request;
use App\Http\Response;
use App\Enum\ResponseCode;
use App\Contract\MiddlewareContract;

class AuthMiddleware implements MiddlewareContract
{
    public function handle(Request $request): void
    {
        if ($request->getHeader("Authorization") !== "123") {
            (new Response(ResponseCode::FORBIDDEN, "Not authorized"))->send();
        }
    }
}
