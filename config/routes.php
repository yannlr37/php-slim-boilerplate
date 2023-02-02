<?php

use Slim\App;
use Sheepdev\Controllers\UserController;
use Sheepdev\Controllers\PageController;
use Sheepdev\Controllers\ArticleController;

return function(App $app) {
    $app->get('/test', [UserController::class, 'index']);
    $app->get('/page/{slug}', [PageController::class, 'show']);
    $app->get('/article/{slug}', [ArticleController::class, 'show']);

    /*
    $app->group('/admin', function(RouteCollectorProxy $group) {
        $group->get('/', [])->setName('admin.');
    });
    */
};