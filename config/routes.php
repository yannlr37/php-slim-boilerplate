<?php

use Sheepdev\Controllers\HomeController;
use Sheepdev\Middleware\UserInfoMiddleware;
use Slim\App;
use Sheepdev\Middleware\AuthMiddleware;
use Sheepdev\Controllers\AuthController;
use Sheepdev\Controllers\UserController;
use Sheepdev\Controllers\PageController;
use Sheepdev\Controllers\ArticleController;

return function(App $app) {
    $app->get('/login', [AuthController::class, 'index'])->setName('login.signin');
    $app->post('/authenticate', [AuthController::class, 'login'])->setName('login.authenticate');
    $app->get('/logout', [AuthController::class, 'logout'])->setName('login.signout');


    $app->get('/home', [HomeController::class, 'index'])->setName('home');

    $app->get('/test', [UserController::class, 'index'])
        ->setName('test')
        ->add(AuthMiddleware::class);

    $app->get('/page/{slug}', [PageController::class, 'show']);
    $app->get('/article/{slug}', [ArticleController::class, 'show']);

    /*
    $app->group('/admin', function(RouteCollectorProxy $group) {
        $group->get('/', [])->setName('admin.');
    });
    */
};