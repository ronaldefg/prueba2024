<?php
namespace Api\Controllers;

use App\Domain\Service\HelloWorldService;
use App\Infrastructure\Http\Response;

class HelloWorldController
{
    private HelloWorldService $helloWorldService;

    public function __construct(HelloWorldService $helloWorldService)
    {
        $this->helloWorldService = $helloWorldService;
    }

    public function index(): Response
    {
        $message = $this->helloWorldService->getMessage();
        return new Response($message, 200);
    }
}
