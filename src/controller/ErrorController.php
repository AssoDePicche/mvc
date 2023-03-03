<?php

declare(strict_types=1);

namespace Controller;

final class ErrorController extends Controller
{
    public static function index(int $error, string $message): void
    {
        parent::make('error.html.twig', [
            'error' => $error,
            'message' => $message
        ]);
    }
}
