<?php

namespace App\Domain;

interface ResponseInterface
{
    public function getContent(): string;

    public function getStatusCode(): int;
}
