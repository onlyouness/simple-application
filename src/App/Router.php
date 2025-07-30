<?php
declare (strict_types = 1);
namespace Hp\Phpexe\App;
use Closure;
class Router
{
    private array $routes = [];
    public function add(string $path, Closure $handler): void
    {
        $this->routes[$path] = $handler;
    }
    
    public function dispatcher(string $path): void
    {
        foreach ($this->routes as $route => $handler) {
            $pattern = preg_replace('#\{\w+\}#',"([^\/]+)",$route);
            // dd([$route,$this->routes,$pattern]);
            if(preg_match("#^$pattern$#",$path,$matches)){
                array_shift($matches);
                call_user_func_array($handler,$matches);
                // dd($matches);
            }
        }
        // echo "404 not found!!";
        
    }
}
