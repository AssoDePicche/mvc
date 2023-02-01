<?php

declare(strict_types=1);

namespace Logger;

use Util\Singleton;

final class Logger extends Singleton
{
    private mixed $stream;

    protected function __construct()
    {
        $this->stream = fopen(LOG_FOLDER . '/application.log', 'a+');
    }

    public function write(string $content, string $level): void
    {
        $timestamp = date('Y-m-d H:i:s');

        $log = sprintf("[%s]: %s %s\n", $level, $timestamp, $content);

        fwrite($this->stream, $log);
    }

    public static function log(string $message, string $level): void
    {
        $logger = self::getInstance();

        $logger->write($message, $level);
    }

    public function __destruct()
    {
        fclose($this->stream);
    }
}
