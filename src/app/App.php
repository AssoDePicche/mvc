<?php

declare(strict_types=1);

namespace App;

final readonly class App
{
    public \Http\Router $router;

    public function __construct()
    {
        $this->router = new \Http\Router($_ENV['APP_URL']);
    }

    public function run(): void
    {
        $response = $this->router->run();

        $response->send();
    }
}
