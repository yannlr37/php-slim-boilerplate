<?php

use Slim\App;
use Sheepdev\Middleware\AuthMiddleware;
use Sheepdev\Controllers\AuthController;
use Sheepdev\Controllers\UserController;
use Sheepdev\Controllers\PageController;
use Sheepdev\Controllers\ArticleController;

return function(App $app) {
    $app->get('/login', [AuthController::class, 'index'])->setName('login');
    //$app->post('/login/check', [AuthController::class, 'login']);

    $app->get('/test', [UserController::class, 'index'])->add(AuthMiddleware::class);
    $app->get('/page/{slug}', [PageController::class, 'show']);
    $app->get('/article/{slug}', [ArticleController::class, 'show']);

    /*
    $app->group('/admin', function(RouteCollectorProxy $group) {
        $group->get('/', [])->setName('admin.');
    });
    */
};