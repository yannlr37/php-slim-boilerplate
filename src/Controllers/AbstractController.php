<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 2023-01-29
 * Time: 19:59
 */

namespace Sheepdev\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use \Fig\Http\Message\StatusCodeInterface;
use Slim\Routing\RouteContext;

abstract class AbstractController
{
    protected function render(Response $response, $template, array $data = [])
    {
        $html = view($template, $data);
        $response->withStatus(200);
        $response->getBody()->write($html);

        return $response;
    }

    public function redirect(
        Response $response,
        Request $request,
        string $routeName,
        int $status = StatusCodeInterface::STATUS_FOUND): Response
    {
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor($routeName);

        return $response->withHeader('Location', $url)
            ->withStatus($status);
    }
}