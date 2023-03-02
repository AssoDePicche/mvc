<?php

declare(strict_types=1);

namespace Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    public final static function make(string $view): void
    {
        $cache = dirname(__DIR__, 2) . '\\storage\\cache\\';

        $template = dirname(__DIR__, 2) . '\\src\\view\\';

        $loader = new FilesystemLoader($template);

        $twig = new Environment($loader, [
            'cache' => $cache
        ]);

        echo $twig->display($view);
    }
}
