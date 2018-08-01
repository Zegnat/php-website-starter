<?php

// Configure PSR-17 factories:
$i->alias(
    Psr\Http\Message\ResponseFactoryInterface::class,
    Http\Factory\Diactoros\ResponseFactory::class
);
$i->alias(
    Psr\Http\Message\ServerRequestFactoryInterface::class,
    Http\Factory\Diactoros\ServerRequestFactory::class
);
$i->alias(
    Psr\Http\Message\StreamFactoryInterface::class,
    Http\Factory\Diactoros\StreamFactory::class
);
$i->alias(
    Psr\Http\Message\UploadedFileFactoryInterface::class,
    Http\Factory\Diactoros\UploadedFileFactory::class
);
$i->alias(
    Psr\Http\Message\UriFactoryInterface::class,
    Http\Factory\Diactoros\UriFactory::class
);
