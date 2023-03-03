<?php

declare(strict_types=1);

namespace Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    protected final static function make(string $view, array $data = []): void
    {
        $loader = new FilesystemLoader(VIEW_DIRECTORY);

        $twig = new Environment($loader, [
            'cache' => CACHE_STORAGE
        ]);

        echo $twig->display($view, $data);
    }
}
