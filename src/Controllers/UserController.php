<?php

namespace Sheepdev\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Sheepdev\Repository\UserRepository;

class UserController extends AbstractController
{
    /** @var UserRepository */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Response $response)
    {
        $users = $this->repository->getAll();
        return $this->render($response, 'test', [
            'users' => $users
        ]);
    }
}