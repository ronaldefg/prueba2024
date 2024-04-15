<?php

namespace App\Infrastructure\Http;

class Response
{
    private string $body;
    private int $statusCode;

    public function __construct(string $body = '', int $statusCode = 200)
    {
        $this->body = $body;
        $this->statusCode = $statusCode;
    }

    public function send(): void
    {
        http_response_code($this->statusCode);
        echo $this->body;
    }
}
