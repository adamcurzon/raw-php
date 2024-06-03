<?php

namespace App\Enum;

enum ResponseCode: int
{
    case OK = 200;
    case CREATED = 201;

    case BAD_REQUEST = 400;
    case NOT_FOUND = 404;
    case METHOD_NOT_ALLOWED = 405;

    case SERVER_ERROR = 500;
}
