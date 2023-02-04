<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 2023-02-04
 * Time: 11:01
 */

namespace Sheepdev\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Sheepdev\Repository\UserRepository;

class AuthController extends AbstractController
{
    /** @var UserRepository */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Response $response)
    {
        return $this->render($response, 'login');
    }
}