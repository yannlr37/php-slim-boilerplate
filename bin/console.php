<?php

require_once __DIR__ . '/../bootstrap.php';

use DI\ContainerBuilder;
use Sheepdev\Command\DeleteUserCommand;
use Symfony\Component\Console\Application;
use Sheepdev\Command\AddUserCommand;

$containerBuilder = new ContainerBuilder();
$containerBuilder->useAutowiring(true);
$container = $containerBuilder->build();

$app = new Application();
$app->setName('CGDT WordPress Plugins Console Tools');

$app->add($container->get(AddUserCommand::class));
$app->add($container->get(DeleteUserCommand::class));

$app->run();