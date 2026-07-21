<?php

declare(strict_types=1);

require '../vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    require '../config/routes.php';
});

$container = (function () use ($dispatcher) {
    $builder = new DI\ContainerBuilder();
    $builder->useAutowiring(true);
    $builder->addDefinitions(require '../config/injector.php');
    $builder->addDefinitions([
        Middlewares\FastRoute::class => DI\autowire()->constructorParameter('router', $dispatcher),
    ]);

    return $builder->build();
})();

$middlewares = require '../config/middlewares.php';
$middlewares[] = static function (Psr\Http\Message\ServerRequestInterface $request) use ($container) {
    $handler = $request->getAttribute('request-handler');
    if (\is_string($handler) && \class_exists($handler)) {
        $handler = $container->get($handler);
    }
    if ($handler instanceof Psr\Http\Server\RequestHandlerInterface) {
        return $handler->handle($request);
    }
    throw new RuntimeException(\sprintf('Invalid request handler: %s', \gettype($handler)));
};

(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter())
    ->emit(
        (new Middleland\Dispatcher(
            $middlewares,
            $container
        ))->dispatch(Laminas\Diactoros\ServerRequestFactory::fromGlobals())
    );
