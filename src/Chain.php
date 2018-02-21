<?php

namespace TheJawker\Chainable;

class Chain
{
    /**
     * The original instance.
     *
     * @var mixed|null
     */
    private $instance = null;

    /**
     * Whether the chainability functionality is disabled.
     *
     * @var bool
     */
    private $escape = false;

    /**
     * Initializes the Chain.
     */
    public function __construct()
    {
        $arguments = func_get_args();
        $this->instance = is_object($instance = array_shift($arguments)) ? $instance : new $instance($arguments);
    }

    /**
     * Calls the method *magically* and returns $this;
     *
     * @param $name
     * @param $arguments
     * @return $this
     */
    public function __call($name, $arguments)
    {
        $result = call_user_func_array([$this->instance, $name], $arguments);
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