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
2. Using [Diactoros][] to only have to work with
   [PSR-7 Requests and Responses][PSR-7].
3. Using [Middleland][] to run through all configured
   [PSR-15 Middlewares][PSR-15].
4. Using [FastRoute][] to parse requested URIs and find the matching
   [PSR-15 RequestHandlers][PSR-15].
5. Using [PHP_CodeSniffer][] to check all code against the
   [PSR-2 Coding Style Guide][PSR-2].

[Auryn]: https://github.com/rdlowrey/auryn
[Diactoros]: https://zendframework.github.io/zend-diactoros/
[FastRoute]: https://github.com/nikic/FastRoute
[Middleland]: https://github.com/oscarotero/middleland
[PHP_CodeSniffer]: https://github.com/squizlabs/PHP_CodeSniffer
[PSR-2]: http://www.php-fig.org/psr/psr-2/
[PSR-7]: http://www.php-fig.org/psr/psr-7/
[PSR-15]: https://www.php-fig.org/psr/psr-15/

## License

The BSD Zero Clause License (0BSD). Please see the LICENSE file for
more information.
