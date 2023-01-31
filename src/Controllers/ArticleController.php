<?php

namespace Sheepdev\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Sheepdev\Repository\ArticleRepository;

class ArticleController extends AbstractController
{
    private ArticleRepository $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function show(Response $response, string $slug)
    {
        $films = $this->repository->getAll();
        return $this->render($response, 'test', [
            'films' => $films
        ]);
    }
}