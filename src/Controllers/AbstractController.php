<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 2023-01-29
 * Time: 19:59
 */

namespace Sheepdev\Controllers;

use Psr\Http\Message\ResponseInterface as Response;

abstract class AbstractController
{
    public function __construct()
    {
    }

    protected function render(Response $response, $template, array $data = [])
    {
        $html = view($template, $data);
        $response->withStatus(200);
        $response->getBody()->write($html);

        return $response;
    }
}