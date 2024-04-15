<?php

use App\Infrastructure\Router;

return function (Router $router) {
    $router->get('/', 'Api\Controllers\HelloWorldController@index');
};
