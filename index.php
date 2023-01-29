<?php

use DI\Bridge\Slim\Bridge;
use Sheepdev\Controllers\Controller;
use Slim\Factory\AppFactory;

require_once 'vendor/autoload.php';
require_once 'helpers.php';

$builder = new DI\ContainerBuilder();
$builder->addDefinitions('definitions.php');

$container = $builder->build();

// Set container to create App with on AppFactory
$app = Bridge::create($container);

$app->get('/{name}', [Controller::class, 'greet']);

$app->run();
