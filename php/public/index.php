<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Application\ErrorHandling\NotFoundHandler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Middleware\ErrorHandlerMiddleware;
use App\Infrastructure\Router;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$request = Request::createFromGlobals();

$router = new Router();

$routes = require_once __DIR__ . '/../api/Routes/index.php';
$routes($router);

$errorHandler = new ErrorHandlerMiddleware([new NotFoundHandler()]);

$response = $errorHandler($request, function ($request) use ($router) {
    return $router->dispatch($request->getPath(), $request->getMethod());
});

$response->send();
