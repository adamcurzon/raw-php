<?php

namespace App\Http\Validator;

use App\Enum\ValidatorRulesEnum;
use App\Contract\ValidatorContract;

class GetCarValidator extends ValidatorBase implements ValidatorContract
{
    protected function config(): array
    {
        return [
            0 => [
                ValidatorRulesEnum::REQUIRED,
                ValidatorRulesEnum::INTEGER
            ]
        ];
    }
}
