<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 2023-02-04
 * Time: 09:52
 */

namespace Sheepdev\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Sheepdev\Auth\AuthManager;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class AuthMiddleware
{
    /** @var AuthManager */
    private $authManager;

    public function __construct(
        AuthManager $authManager
    ) {
        $this->authManager = $authManager;
    }

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        if (!$this->authManager->isUserAuthenticated()) {
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $url = $routeParser->urlFor('login');
            header('Location: ' . $url);
        }

        $user = $this->authManager->getCurrentLoginInUser();
        if (is_null($user)) {
            header('Location: ' . $url);
        }

        // store user in session ?

        return $handler->handle($request);
    }
}