<?php

namespace TheJawker\Chainable;

class Chain
{
    private $instance = null;
    private $escape = false;

    public function __construct()
    {
        $pars = func_get_args();
        $this->instance = is_object($obj=array_shift($pars))?$obj:new $obj($pars);
    }

    /**
     * Calls the method *magically* and returns $this;
     *
     * @param $name
     * @param $pars
     * @return $this
     */
    public function __call($name, $pars)
    {
        $result = call_user_func_array([$this->instance, $name], $pars);
        return $this->escape ? $result : $this;
    }

    public function escape()
    {
        $this->escape = true;
        return $this;
    }

    public function unescape()
    {
        $this->escape = false;
        return $this;
    }

    public function __get($name)
    {
        return $this->instance->$name;
    }
}