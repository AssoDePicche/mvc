<?php

declare(strict_types=1);

namespace Database;

use PDO;
use PDOException;

final class Database extends PDO
{
    private static ?self $connection = null;

    public static function getConnection(): self
    {
        if (null === self::$connection) {
            try {
                $dsn = sprintf(
                    '%s:host=%s:%s;dbname=%s;charset=utf8',
                    $_ENV['DB_CONNECTION'],
                    $_ENV['DB_HOST'],
                    $_ENV['DB_PORT'],
                    $_ENV['DB_DATABASE']
                );

                self::$connection = new self(
                    $dsn,
                    $_ENV['DB_USERNAME'],
                    $_ENV['DB_PASSWORD']
                );
            } catch (PDOException $exception) {
                echo $exception->getMessage();
            }
        }

        return self::$connection;
    }
}
