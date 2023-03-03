<?php

declare(strict_types=1);

namespace App;

use Router\Router;

readonly final class App
{
    public Router $router;

    public function __construct()
    {
        $this->router = new Router;
    }

    public function run(): void
    {
        try {
            $this->router->run();
        } catch (\Exception $exception) {
            \Controller\ErrorController::index($exception->getCode(), $exception->getMessage());
        }
    }
}
