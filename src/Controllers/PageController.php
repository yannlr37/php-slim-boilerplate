<?php

namespace Sheepdev\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Sheepdev\Repository\PageRepository;

class PageController extends AbstractController
{
    /** @var PageRepository */
    private $repository;

    public function __construct(PageRepository $repository)
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