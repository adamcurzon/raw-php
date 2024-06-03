<?php

namespace App\Contract;

use App\Http\Request;

interface MiddlewareContract
{
    public function handle(Request $request): void;
}
