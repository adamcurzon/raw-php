<?php

namespace App\Http\Validator;

use App\Enum\ValidatorRulesEnum;
use App\Contract\ValidatorContract;

class CreateCarValidator extends ValidatorBase implements ValidatorContract
{
    protected function config(): array
    {
        return [
            'name' => [
                ValidatorRulesEnum::REQUIRED
            ]
        ];
    }
}
