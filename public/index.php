<?php

declare(strict_types = 1);

require '../vendor/autoload.php';

$injector = new Auryn\Injector();
$injector->share(Psr\Container\ContainerInterface::class);
$injector->alias(
    Psr\Container\ContainerInterface::class,
    Northwoods\Container\InjectorContainer::class
);
$injector->define(
    Middlewares\Fastroute::class,
    [':router' => FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
        require '../config/routes.php';
    })]
);
$injector->define(
    Northwoods\Container\InjectorContainer::class,
    [ ':injector' => $injector ]
);

(new Zend\Diactoros\Response\SapiEmitter)
    ->emit((new mindplay\middleman\Dispatcher(
        require '../config/middlewares.php',
        $injector->make(mindplay\middleman\ContainerResolver::class)
    ))->dispatch(Zend\Diactoros\ServerRequestFactory::fromGlobals())
);
