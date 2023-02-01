<?php

require_once dirname(__DIR__) . '/bootstrap.php';

use DI\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Application;

$app = new Application();
$app->setName('CGDT WordPress Plugins Console Tools');

$containerBuilder = new ContainerBuilder();
$loader = new File($containerBuilder, new FileLocator(__DIR__ . '/../'));
$loader->load(__DIR__ . '/../config/services.php');
$containerBuilder->compile();

foreach ($containerBuilder->findTaggedServiceIds('console.command') as $serviceId => $tags) {
    $app->add($containerBuilder->get($serviceId));
}

$app->run();