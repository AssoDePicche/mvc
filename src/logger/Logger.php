<?php

declare(strict_types=1);

namespace Logger;

readonly final class Logger
{
    public const DEBUG = 'DEBUG';

    public const ERROR = 'ERROR';

    public const FATAL = 'FATAL';

    public const INFO = 'INFO';

    public const TRACE = 'TRACE';

    public const WARN = 'WARN';

    public mixed $stream;

    public function __construct()
    {
        $this->stream = fopen('logs/app.log', 'a+');
    }

    public function __destruct()
    {
        fclose($this->stream);
    }

    public function log(string $message, string $level): void
    {
        if (!in_array($level, ['DEBUG', 'ERROR', 'FATAL', 'INFO', 'TRACE', 'WARN'])) {
            throw new \InvalidArgumentException('Invalid log level');
        }

        $timestamp = (new \DateTime())->format('Y-m-d g:i:s A');

        $log = sprintf('%s %s %s%s', $level, $timestamp, $message, PHP_EOL);

        fwrite($this->stream, $log);
    }
}
