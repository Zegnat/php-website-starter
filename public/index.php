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

$middlewares = require '../config/middlewares.php';
$middlewares[] = function (Psr\Http\Message\ServerRequestInterface $request) use ($injector) {
    $handler = $request->getAttribute('request-handler');
    if (is_string($handler) && class_exists($handler)) {
        $handler = $injector->make($handler);
    }
    if ($handler instanceof Interop\Http\Server\RequestHandlerInterface) {
        return $handler->handle($request);
    }
    throw new RuntimeException(sprintf('Invalid request handler: %s', gettype($handler)));
};

(new Zend\Diactoros\Response\SapiEmitter)
    ->emit(
        (new mindplay\middleman\Dispatcher(
            $middlewares,
            function ($middleware) use ($injector) {
                if (is_string($middleware)) {
                    return $injector->make($middleware);
                }
                return $middleware;
            }
        ))->dispatch(Zend\Diactoros\ServerRequestFactory::fromGlobals())
    );
