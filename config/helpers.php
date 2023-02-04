<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use \Fig\Http\Message\StatusCodeInterface;
use Sheepdev\Auth\AuthManager;
use Slim\Routing\RouteContext;

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../resources/views');
global $twig;
$twig = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/../cache/twig',
    'debug' => true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

if (!function_exists('view')) {

    function view(string $template, array $data): string
    {
        global $twig;
        $twig->addGlobal('auth', new AuthManager(
            new \Sheepdev\Repository\UserRepository(
                new \Sheepdev\Normalizer\UserNormalizer(),
                new \Sheepdev\Logger\AppLogger()
            )
        ));

        $template = $twig->load($template . '.twig');
        return $template->render($data);
    }
}

if (!function_exists('env')) {

    function env(string $key, string $defaultValue = ''): string
    {
        return $_ENV[$key] ?? $defaultValue;
    }
}

if (!function_exists('config')) {

    function config(string $key = '')
    {
        $configuration = require __DIR__ . '/settings.php';
        if ($key === '') {
            return $configuration;
        }
        return $configuration[$key] ?? '';
    }
}

if (!function_exists('getRootDir')) {

    function getRootDir()
    {
        return __DIR__ . '/../';
    }
}

if (!function_exists('redirect')) {

    function redirect(
        Response $response,
        Request $request,
        string $routeName
    ) {
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor($routeName);
        header('Location: ' . $url);
    }
}
