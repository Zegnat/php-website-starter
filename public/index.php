<?php

declare(strict_types = 1);

require '../vendor/autoload.php';

$injector = new Auryn\Injector();
$injector->define(
    Middlewares\Fastroute::class,
    [':router' => FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
        require '../config/routes.php';
    })]
);

(new Zend\Diactoros\Response\SapiEmitter)
    ->emit((new mindplay\middleman\Dispatcher(
        require '../config/middlewares.php',
        function ($middleware) use ($injector) {
            if (is_string($middleware)) {
                return $injector->make($middleware);
            }
            return $middleware;
        }
    ))->dispatch(Zend\Diactoros\ServerRequestFactory::fromGlobals())
);
