<?php

declare(strict_types=1);

namespace Model;

use Database\Database;

readonly abstract class Model
{
    public function __construct(public Database $database)
    {
    }
}
