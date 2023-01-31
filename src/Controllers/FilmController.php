<?php

namespace Sheepdev\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Sheepdev\Repository\FilmRepository;

class FilmController extends AbstractController
{
    private FilmRepository $repository;

    public function __construct(FilmRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Response $response)
    {
        $films = $this->repository->getAll();
        return $this->render($response, 'films', [
            'films' => $films
        ]);
    }
}