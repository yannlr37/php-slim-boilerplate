<?php

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../resources/views');
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
