<?php

namespace App\Infrastructure\Http;

class Request
{
    private array $queryParams;
    private array $bodyParams;

    public function __construct(array $queryParams, array $bodyParams)
    {
        $this->queryParams = $queryParams;
        $this->bodyParams = $bodyParams;
    }

    public static function createFromGlobals(): self
    {
        return new self($_GET, $_POST);
    }

    public function getQueryParam(string $name, $default = null)
    {
        return $this->queryParams[$name] ?? $default;
    }

    public function getBodyParam(string $name, $default = null)
    {
        return $this->bodyParams[$name] ?? $default;
    }

    public function getPath(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
