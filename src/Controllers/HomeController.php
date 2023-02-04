<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 2023-02-04
 * Time: 12:46
 */

namespace Sheepdev\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController extends AbstractController
{
    public function index(Response $response)
    {
        return $this->render($response, 'home');
    }


}