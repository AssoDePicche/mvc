<?php

declare(strict_types=1);

namespace Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    private static array $vars = [];

    public static function set(array $vars): void
    {
        self::$vars = array_merge($vars);
    }

    public static function make(string $view, array $data = []): void
    {
        $view .= VIEW_EXTENSION;

        $loader = new FilesystemLoader(VIEW_FOLDER);

        $twig = new Environment($loader, []);

        $twig->display($view, array_merge(self::$vars, $data));
    }
}
