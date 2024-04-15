<?php

namespace App\Infrastructure\Middleware;

use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;

class ErrorHandlerMiddleware
{
    private array $errorHandlers = [];

    public function __construct(array $errorHandlers)
    {
        $this->errorHandlers = $errorHandlers;
    }

    public function __invoke(Request $request, callable $next): Response
    {
        try {
            // Ejecutar el siguiente middleware (o el enrutador)
            $response = $next($request);
        } catch (\Throwable $e) {
            // Manejar el error y generar una respuesta de error
            $response = $this->handleError($e);
        }

        return $response;
    }

    private function handleError(\Throwable $e): Response
    {
        foreach ($this->errorHandlers as $errorHandler) {
            if ($errorHandler->supports($e)) {
                return $errorHandler->handle($e);
            }
        }

        return new Response('500 Internal Server Error', 500);
    }
}
