<?php

namespace TheJawker\Chainable\Test;

use TheJawker\Chainable\Chain;
use TheJawker\Chainable\ChainableTrait;

class ChainableTest extends TestCase
{
    /** @test */
    public function methods_can_be_chained()
    {
        $class = new Chain(new class {
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
        });

        $class->up()->downByTwo();
        $this->assertEquals(-1, $class->count);
        $this->assertEquals(-1, $class->escape()->getValue());
        $this->assertEquals(-3, $class->unescape()->downByTwo()->count);
    }
}