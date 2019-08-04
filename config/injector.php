<?php

declare(strict_types=1);

// Configure PSR-17 factories:
$i->alias(
    Psr\Http\Message\ResponseFactoryInterface::class,
    Zend\Diactoros\ResponseFactory::class
);
$i->alias(
    Psr\Http\Message\ServerRequestFactoryInterface::class,
    Zend\Diactoros\ServerRequestFactory::class
);
$i->alias(
    Psr\Http\Message\StreamFactoryInterface::class,
    Zend\Diactoros\StreamFactory::class
);
$i->alias(
    Psr\Http\Message\UploadedFileFactoryInterface::class,
    Zend\Diactoros\UploadedFileFactory::class
);
$i->alias(
    Psr\Http\Message\UriFactoryInterface::class,
    Zend\Diactoros\UriFactory::class
);
