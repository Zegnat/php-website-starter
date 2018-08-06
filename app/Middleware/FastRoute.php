<?php

declare(strict_types = 1);

namespace app\Middleware;

use FastRoute\Dispatcher;
use Middlewares\FastRoute as OldFastRoute;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ResponseFactoryInterface;

final class FastRoute extends OldFastRoute implements MiddlewareInterface
{
    public function __construct(Dispatcher $router, ResponseFactoryInterface $factory)
    {
        parent::__construct($router);
        $this->responseFactory($factory);
    }
}
