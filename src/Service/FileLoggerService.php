<?php

namespace App\Service;

use App\Contract\LoggerServiceContract;
use App\Enum\LogLevelEnum;

class FileLoggerService implements LoggerServiceContract
{
    public function __construct(private string $logDirectory)
    {
    }

    public function log(LogLevelEnum $level, mixed $data): void
    {
        $handle = fopen($this->logFilePath($level), 'a');
        fwrite($handle, $this->prefix($level) . json_encode($data) . PHP_EOL);
        fclose($handle);
    }

    public function prefix(LogLevelEnum $level): string
    {
        return "[" . date('Y-m-d H:i:s') . "][" . $level->value . "] ";
    }

    public function logFilePath(LogLevelEnum $level): string
    {
        return $this->logDirectory . "/" . strtolower($level->value) . ".log";
    }

    public function info(mixed $data): void
    {
        $this->log(LogLevelEnum::INFO, $data);
    }

    public function error(mixed $data): void
    {
        $this->log(LogLevelEnum::ERROR, $data);
    }
}
