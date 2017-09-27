<?php

namespace TheJawker\Chainable\Test;

class TestClass
{
    public $count = 0;

    public function up()
    {
        $this->count = $this->count + 1;
    }

    public function downByTwo()
    {
        $this->count = $this->count - 2;
    }

    public function getValue()
    {
        return $this->count;
    }

    public function throwException()
    {
        throw new \RuntimeException;
    }
}