<?php

// load env varialbes
use Dotenv\Dotenv;



$name      = 'Ye Site';
$UrlPrefix = '/php-exe';


function env(string $var_name,  $default_val = null)
{
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    if (isset($_ENV[$var_name])) {
        return $_ENV[$var_name];
    }

    return $default_val;
}

function dd($item)
{
    echo "<pre>";
    var_dump($item);
    echo "</pre>";
    die();
}
