<?php

namespace App\Enum;

enum ValidatorRulesEnum: string
{
    case REQUIRED = "required";
    case EMAIL = "email";
    case INTEGER = "integer";
}
