<?php

declare(strict_types=1);

namespace Util;

abstract class Singleton
{
    private static array $instances = [];

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    public static function getInstance(): static
    {
        $class = static::class;

        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new static();
        }

        return self::$instances[$class];
    }
}
