<?php

use Slim\App;
use Sheepdev\Controllers\FilmController;
use Sheepdev\Controllers\GreetController;

return function(App $app) {
    $app->get('/home/{name}', [GreetController::class, 'greet']);
    $app->get('/films', [FilmController::class, 'index']);
};