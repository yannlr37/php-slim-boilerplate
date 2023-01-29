<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 2023-01-29
 * Time: 19:25
 */

use Psr\Container\ContainerInterface;
use Sheepdev\Controllers\Controller;
use Sheepdev\GreetingService;

return [
    'GreetingService' => function(ContainerInterface $c) {
        return new GreetingService();
    },
    'Controller' => function (ContainerInterface $c) {
        return new Controller($c->get('GreetingService'));
    }
];