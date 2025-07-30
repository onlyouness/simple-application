<?php

namespace Hp\Phpexe\Commands;

class MainCommands
{
    private function get_arg_value(array $args, string $target_arg): bool|string
    {
        $to_skip = [0];

        foreach ($args as $i => $arg) {
            if (in_array($i, $to_skip)) continue;

            // Check for exact match 
            if ($arg === $target_arg) {

                return true;
                break;
            }

            // Check for arg:value format
            if (
                substr($arg, 0, strlen($target_arg)) === $target_arg &&
                isset(explode(':', $arg)[1])
            ) {
                return explode(':', $arg)[1];
            }
        }

        return false;
    }

    public  function handler(array $args)
    {
        switch ($args[1]) {
            case $this->get_arg_value($args, 'server'):
                
                $port =  $this->get_arg_value($args, '--port') ?  $this->get_arg_value($args, '--port') : env('ENV_PORT', '3333');

                exec('php -S localhost:' . $port . ' -t .');
        }
    }
}
