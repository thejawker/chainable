<?php

namespace TheJawker\Chainable;

class Chain
{
    private $instance = null;
    private $escape = false;

    /**
     * Initializes the Chain.
     */
    public function __construct()
    {
        $pars = func_get_args();
        $this->instance = is_object($obj = array_shift($pars)) ? $obj : new $obj($pars);
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

    /**
     * Gets the actual original instance back.
     * Especially nice if you want to check
     * for class_basename() or something
     * in that direction or something
     *
     * @return mixed|null
     */
    public function instance()
    {
        return $this->instance;
    }

    /**
     * Turns the chainable off until turned on
     * again by using the unescape method.
     *
     * @return $this
     */
    public function escape()
    {
        $this->escape = true;
        return $this;
    }

    /**
     * Turns the chainable on until turned off
     * again by using the escape method.
     *
     * @return $this
     */
    public function unescape()
    {
        $this->escape = false;
        return $this;
    }

    /**
     * Gets the property magically.
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->instance->$name;
    }
}