<?php

namespace App;

use App\Exception\InstanceNotFoundException;

class Container
{
    protected $instances = [];

    public function set($name, $resolver)
    {
        $this->instances[$name] = $resolver;
    }

    public function get($name)
    {
        if (isset($this->instances[$name])) {
            return $this->instances[$name]();
        }

        throw new InstanceNotFoundException("No entry found for $name.");
    }
}
