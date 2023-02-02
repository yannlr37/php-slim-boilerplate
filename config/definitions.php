<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 2023-01-29
 * Time: 19:25
 */

use Psr\Container\ContainerInterface;
use Sheepdev\Actions\Users\AddUser\AddUserAction;
use Sheepdev\Auth\PasswordCryptService;
use Sheepdev\Command\AddUserCommand;
use Sheepdev\Controllers\UserController;
use Sheepdev\Logger\AppLogger;
use Sheepdev\Normalizer\UserNormalizer;
use Sheepdev\Repository\UserRepository;

;

return [
    'AppLogger' => function(ContainerInterface $c) {
        return new AppLogger();
    },
    'PasswordCryptService' => function(ContainerInterface $c) {
        return new PasswordCryptService();
    },
    'UserNormalizer' => function(ContainerInterface $c) {
        return new UserNormalizer();
    },
    'UserRepository' => function(ContainerInterface $c) {
        return new UserRepository(
            $c->get('UserNormalizer'),
            $c->get('AppLogger')
        );
    },
    'UserController' => function (ContainerInterface $c) {
        return new UserController($c->get('UserRepository'));
    },
    'AddUserAction' => function(ContainerInterface $c) {
        return new AddUserAction(
            $c->get('UserRepository'),
            $c->get('PasswordCryptService')
        );
    },
    'AddUserCommand' => function(ContainerInterface $c) {
        return new AddUserCommand($c->get('UserRepository'));
    },
];