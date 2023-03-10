<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 2023-01-29
 * Time: 19:11
 */

namespace Sheepdev\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sheepdev\Services\GreetingService;

class GreetController extends AbstractController
{
    /** @var GreetingService */
    private $greetingService;

    public function __construct(GreetingService $greetingService)
    {
        $this->greetingService = $greetingService;
    }

    public function greet(Response $response, string $name)
    {
        $message = $this->greetingService->greet($name);
        return $this->render($response, 'index', [
            'message' => $message,
            'prout' => env('PROJECT_NAME', 'COUCOU')
        ]);
    }
}