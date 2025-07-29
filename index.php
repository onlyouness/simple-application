<?php
require 'vendor/autoload.php';

use Hp\Phpexe\Controllers\indexController;
use Hp\Phpexe\Controllers\articleController;
use Hp\Phpexe\App\Router;

require 'tools.php';
require 'config.php';
$name      = 'Ye Site';
$UrlPrefix = '/php-exe';

$requestUri = str_replace($UrlPrefix, '', $_SERVER['REQUEST_URI']);
$requestMethod = $_SERVER['REQUEST_METHOD'];
$parsedUrl  = parse_url($requestUri);
$url        = $parsedUrl['path'];


$router = new Router();
// $router->add('/',function(){
//     $index = new indexController();
//     $index->indexAction();
// });
$router->add('/articles/{id}',function($id){
    // dd($id);
    $blog = new articleController();
    $blog->showAction($id);
});
$router->dispatcher($url);

