# PHP Website Starter

The PHP Website Starter is my minimum viable setup for starting a PHP project.

What my minimum setup is changes all the time, and this repository will change
with it. The idea is that, whenever I start a new website project, I can get a
checkout of the current state of this repository without having to think about
where I will start.

This is heavily inspired by [the Fermi Framework][Fermi] and even uses similar
dependencies. But I have a slightly different way of wanting to handle my
configurations and base dependencies.

[Fermi]: https://github.com/journeygroup/fermi

## Usage

Via Composer

``` bash
$ composer create-project zegnat/website-starter
```

## Current Practices

1. Using [Auryn][] to get actual dependency injections. Never pass around
   a container.
2. Using [PSR-7 HTTP message objects][PSR-7] with [PSR-17 factories][PSR-17]
   for all request and response handling.
3. Using [nyholm/psr7-server][] to create the initial [PSR-7][] request.
4. Using [Middleland][] to run through all configured
   [PSR-15 Middlewares][PSR-15].
5. Using [FastRoute][] to parse requested URIs and find the matching
   [PSR-15 RequestHandlers][PSR-15].
6. Using [PHP CS Fixer][] to check all code against a somewhat opinionated set
   of style rules based on the [Symfony Coding Standards][].
7. Using a [Zend Emitter][] to output a final response to the web server.

## PSR-7 & PSR-17 Providers

By default this project loads [Diactoros][] for its [PSR-7][] objects and
matching [PSR-17][] factories.

The providers can easily be swapped for a different set of implementations.
Simply remove the dependency from composer and add a new one. Example:

```bash
$ composer remove zendframework/zend-diactoros
$ composer require nyholm/psr7
```

Then change [the injector configuration](config/injector.php) to tell
[Auryn][] which factories it should use. In the case of [nyholm/psr7][] all of
them can be defined as `Nyholm\Psr7\Factory\Psr17Factory::class`.

[Auryn]: https://github.com/rdlowrey/auryn
[Diactoros]: https://zendframework.github.io/zend-diactoros/
[FastRoute]: https://github.com/nikic/FastRoute
[Middleland]: https://github.com/oscarotero/middleland
[nyholm/psr7]: https://github.com/Nyholm/psr7
[nyholm/psr7-server]: https://github.com/Nyholm/psr7-server
[PHP CS Fixer]: https://github.com/FriendsOfPHP/PHP-CS-Fixer
[PSR-7]: http://www.php-fig.org/psr/psr-7/
[PSR-15]: https://www.php-fig.org/psr/psr-15/
[PSR-17]: https://www.php-fig.org/psr/psr-17/
[Symfony Coding Standards]: https://symfony.com/doc/current/contributing/code/standards.html
[Zend Emitter]: https://docs.zendframework.com/zend-httphandlerrunner/emitters/

## License

The BSD Zero Clause License (0BSD). Please see the LICENSE file for
more information.
