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

if (!function_exists('view')) {
    /**
     * @param string $template
     * @param array $data
     */
    function view($template, array $data): string
    {
        global $twig;

        $template = $twig->load($template . '.twig');
        return $template->render($data);
    }
}
