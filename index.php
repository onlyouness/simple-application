<?php
require 'tools.php';
$name      = 'Ye Site';
$UrlPrefix = '/php-exe';

$requestUri = str_replace($UrlPrefix, '', $_SERVER['REQUEST_URI']);
$parsedUrl  = parse_url($requestUri);
$url        = $parsedUrl['path'];

dd($_SERVER);
// Define your routes
$routes = [
    '/'        => 'controllers/indexController.php',
    '/about'   => 'controllers/aboutController.php',
    '/contact' => 'controllers/contactController.php',
];

if (array_key_exists($url, $routes)) {
    require $routes[$url];
} else {
    http_response_code(404);
    require 'views/404.php';
}
