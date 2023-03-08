<?php

declare(strict_types=1);

namespace Http;

final readonly class Request
{
    public string $method;

    public array $headers;

    public array $params;

    public array $vars;

    public string $uri;

    public function __construct()
    {
        $this->headers = getallheaders();

        $this->params = $_GET ?? [];

        $this->vars = $_POST ?? [];

        $this->method = $_SERVER['REQUEST_METHOD'] ?? '';

        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
    }
}
