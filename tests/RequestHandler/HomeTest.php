<?php

declare(strict_types=1);

namespace app\RequestHandler;

class HomeTest extends \PHPUnit\Framework\TestCase
{
    public function testCanConstruct(): Home
    {
        $home = new Home(new \Zend\Diactoros\ResponseFactory());
        $this->assertInstanceOf(Home::class, $home);

        return $home;
    }

    /**
     * @depends testCanConstruct
     */
    public function testReturnsOK(Home $home)
    {
        $response = $home->handle(new \Zend\Diactoros\ServerRequest());
        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $response);
        $this->assertSame(200, $response->getStatusCode());
    }
}
