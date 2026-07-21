<?php

declare(strict_types=1);

// Configure PSR-17 factories:
return [
    Psr\Http\Message\ResponseFactoryInterface::class => DI\get(
        Zend\Diactoros\ResponseFactory::class
    ),
    Psr\Http\Message\ServerRequestFactoryInterface::class => DI\get(
        Zend\Diactoros\ServerRequestFactory::class
    ),
    Psr\Http\Message\StreamFactoryInterface::class => DI\get(
        Zend\Diactoros\StreamFactory::class
    ),
    Psr\Http\Message\UploadedFileFactoryInterface::class => DI\get(
        Zend\Diactoros\UploadedFileFactory::class
    ),
    Psr\Http\Message\UriFactoryInterface::class => DI\get(
        Zend\Diactoros\UriFactory::class
    ),
];
