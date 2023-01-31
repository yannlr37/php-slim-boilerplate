<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 2023-01-29
 * Time: 19:25
 */

use Psr\Container\ContainerInterface;
use Sheepdev\Controllers\FilmController;
use Sheepdev\Controllers\GreetController;
use Sheepdev\Logger\AppLogger;
use Sheepdev\Normalizer\FilmNormalizer;
use Sheepdev\Repository\FilmRepository;
use Sheepdev\Services\GreetingService;

return [
    'AppLogger' => function(ContainerInterface $c) {
        return new AppLogger();
    },
    'GreetingService' => function(ContainerInterface $c) {
        return new GreetingService();
    },
    'GreetController' => function (ContainerInterface $c) {
        return new GreetController($c->get('GreetingService'));
    },
    'FilmNormalizer' => function(ContainerInterface $c) {
        return new FilmNormalizer();
    },
    'FilmRepository' => function(ContainerInterface $c) {
        return new FilmRepository(
            $c->get('FilmNormalizer'),
            $c->get('AppLogger')
        );
    },
    'FilmController' => function (ContainerInterface $c) {
        return new FilmController($c->get('FilmRepository'));
    }
];