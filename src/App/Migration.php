<?php

namespace Hp\Phpexe\App;

class Migration
{
    public array $columns = [];
    public function add(string $name, string $type) : self
    {
        $this->columns[$name] = $type;
        return $this;
    }
}
