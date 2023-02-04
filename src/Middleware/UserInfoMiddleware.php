<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 2023-02-04
 * Time: 12:51
 */

namespace Sheepdev\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use Sheepdev\Auth\AuthManager;

class UserInfoMiddleware
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
        global $twig;

        $infos = [
            'authenticated' => false,
            'firstname' => '',
            'lastname' => ''
        ];

        $response = $handler->handle($request);
        $user = $this->authManager->getCurrentLoggedInUser();
        if (!empty($user)) {
            $infos = [
                'authenticated' => true,
                'firstname' => $user['firstname'],
                'lastname' => strtoupper($user['lastname'])
            ];
        }
        return $response;
    }
}