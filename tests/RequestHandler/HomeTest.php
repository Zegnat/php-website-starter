<?php

declare(strict_types=1);

namespace app\RequestHandler;

use PHPUnit\Framework\Attributes\Depends;

class HomeTest extends \PHPUnit\Framework\TestCase
{
    public function testCanConstruct(): Home
    {
        $home = new Home(new \Laminas\Diactoros\ResponseFactory());
        $this->assertInstanceOf(Home::class, $home);

        return $home;
    }

    #[Depends('testCanConstruct')]
    public function testReturnsOK(Home $home): void
    {
        $response = $home->handle(new \Laminas\Diactoros\ServerRequest());
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
    }
}
