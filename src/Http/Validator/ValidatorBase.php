<?php

namespace App\Http\Validator;

use App\Enum\ValidatorRulesEnum;
use App\Contract\ValidatorContract;

class ValidatorBase implements ValidatorContract
{
    private bool $valid;

    private array $errors = [];

    protected function config(): array
    {
        return [];
    }

    public function validate(mixed $body): void
    {
        $this->valid = true;

        foreach ($this->config() as $key => $rules) {
            if (in_array(ValidatorRulesEnum::REQUIRED, $rules)) {
                $this->{ValidatorRulesEnum::REQUIRED->value}($body, $key);
            }

            if (!$this->valid) {
                continue;
            }

            if (in_array(ValidatorRulesEnum::EMAIL, $rules)) {
                $this->{ValidatorRulesEnum::EMAIL->value}($body, $key);
            }
        }
    }

    public function required($body, $key): void
    {
        if (empty($body[$key])) {
            $this->errors[$key][] = ValidatorRulesEnum::REQUIRED->value;
            $this->valid = false;
        }
    }

    public function email($body, $key): void
    {
        if (!preg_match('/^[a-zA-Z]+$/', $body[$key])) {
            $this->errors[$key][] = ValidatorRulesEnum::EMAIL->value;
            $this->valid = false;
        }
    }

    public function isValid(): bool
    {
        return $this->valid;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
