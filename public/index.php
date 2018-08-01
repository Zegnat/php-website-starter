<?php

declare(strict_types = 1);

require '../vendor/autoload.php';

$injector = (function ($i) {
    $i->define(
        Middlewares\Fastroute::class,
        [':router' => FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
            require '../config/routes.php';
        })]
    );
    require '../config/injector.php';
    return $i;
})(new Auryn\Injector());

$middlewares = require '../config/middlewares.php';
$middlewares[] = function (Psr\Http\Message\ServerRequestInterface $request) use ($injector) {
    $handler = $request->getAttribute('request-handler');
    if (is_string($handler) && class_exists($handler)) {
        $handler = $injector->make($handler);
    }
    if ($handler instanceof Psr\Http\Server\RequestHandlerInterface) {
        return $handler->handle($request);
    }
    throw new RuntimeException(sprintf('Invalid request handler: %s', gettype($handler)));
};

$request = $injector->make(Nyholm\Psr7Server\ServerRequestCreator::class);

(new Zend\HttpHandlerRunner\Emitter\SapiEmitter)
    ->emit(
        (new Middleland\Dispatcher(
            $middlewares,
            new class($injector) implements Psr\Container\ContainerInterface {
                private $injector;
                public function __construct($injector)
                {
                    $this->injector = $injector;
                }
                public function get($id)
                {
                    return $this->injector->make($id);
                }
                public function has($id)
                {
                    return true;
                }
            }
        ))->dispatch($request->fromArrays(
            $_SERVER,
            function_exists('getallheaders') ? getallheaders() : $request->getHeadersFromServer($_SERVER),
            $_COOKIE,
            $_GET,
            $_POST,
            $_FILES
        ))
    );
