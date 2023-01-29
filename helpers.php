<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 2023-01-29
 * Time: 19:31
 */

$loader = new \Twig\Loader\FilesystemLoader('resources/views');
$twig = new \Twig\Environment($loader, [
    'cache' => 'cache/twig',
    'debug' => true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if (!function_exists('view')) {

    function view(string $template, array $data): string
    {
        global $twig;

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

