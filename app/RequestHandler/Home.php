<?php

declare(strict_types = 1);

namespace app\RequestHandler;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Home implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new \Zend\Diactoros\Response\EmptyResponse;
    }
}
