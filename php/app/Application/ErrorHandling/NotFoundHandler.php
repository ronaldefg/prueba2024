<?php

namespace App\Application\ErrorHandling;

use Exception;
use Throwable;
use App\Infrastructure\Http\Response;

class NotFoundHandler implements ErrorHandlingInterface
{
    /**
     * Determina si este manejador es capaz de manejar el tipo de error proporcionado.
     *
     * @param Throwable $e El error que se produjo.
     * @return bool True si este manejador puede manejar el error, false de lo contrario.
     */
    public function supports(Throwable $e): bool
    {
        return true;
    }

    /**
     * Maneja el error proporcionado y devuelve una respuesta adecuada.
     *
     * @param Throwable $e El error que se produjo.
     * @return Response La respuesta generada para manejar el error.
     */
    public function handle(Throwable $e): Response
    {
        // Crea una respuesta con el mensaje de error y el código de estado 404
        return new Response('404 Not Found Handler', 404);
    }
}
