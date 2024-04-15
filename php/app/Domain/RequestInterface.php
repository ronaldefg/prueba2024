<?php

namespace App\Domain;

interface RequestInterface
{
    public function getPath(): string;

    public function getMethod(): string;
}