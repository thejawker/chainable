<?php

use TheJawker\Chainable\Chain;

if (! function_exists('ch')) {
    /**
     * Creates a Chainable from a simple function call.
     *
     * @param null $class
     * @return Chain
     */
    function ch($class = null)
    {
        return new Chain($class);
    }
}