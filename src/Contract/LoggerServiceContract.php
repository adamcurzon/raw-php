<?php

namespace App\Contract;

use App\Enum\LogLevelEnum;

interface LoggerServiceContract
{
    public function log(LogLevelEnum $level, mixed $data): void;

    public function info(mixed $data): void;

    public function error(mixed $data): void;
}
