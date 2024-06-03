<?php

namespace App\Contract;

interface ValidatorContract
{
    public function isValid(): bool;

    public function validate(mixed $body): void;

    public function getErrors(): array;
}
