<?php

use DI\Bridge\Slim\Bridge;

require_once __DIR__ . '/../bootstrap.php';

$builder = new DI\ContainerBuilder();
$builder->useAutowiring(true);
//$builder->addDefinitions(__DIR__ . '/../config/definitions.php');

$container = $builder->build();

// Set container to create App with on AppFactory
$app = Bridge::create($container);

$routes = require __DIR__ . '/../config/routes.php';
$routes($app);

$app->run();
