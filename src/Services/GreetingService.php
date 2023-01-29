<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 2023-01-29
 * Time: 19:13
 */

namespace Sheepdev\Services;

class GreetingService
{
    public function greet(string $name): string
    {
        return "Welcome {$name} :)";
    }
}
