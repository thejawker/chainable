<?php

namespace TheJawker\Chainable\Test;

use TheJawker\Chainable\Chain;
use TheJawker\Chainable\ChainableTrait;

class ChainableTest extends TestCase
{
    /** @test */
    public function methods_can_be_chained()
    {
        $class = new Chain(TestClass::class);

        try {
            $class->up()->downByTwo()->throwException();
        } catch (\RuntimeException $exception) {
            $this->avoidTestMarkedAsRisky();
            return;
        }

        $this->fail('Didnt throw exception');
    }
    
    /** @test */
    public function properties_are_still_accessible()
    {
        $class = new Chain(TestClass::class);

        $class->up()->downByTwo();

        $this->assertEquals(-1, $class->count);
    }

    /** @test */
    public function properties_are_still_accessible_after_escaping()
    {
        $class = new Chain(TestClass::class);

        $class->up()->downByTwo();

        $this->assertEquals(-1, $class->count);
        $this->assertEquals(-3, $class->unescape()->downByTwo()->count);
    }

    /** @test */
    public function class_can_be_instantiated_before()
    {
        $testClass = new TestClass();

        $class = new Chain($testClass);

        $this->assertEquals('TestClass', class_basename($class->instance()));
    }

    /** @test */
    public function default_behaviour_can_be_escaped_for_getting_properties_from_the_class()
    {
        $class = new Chain(TestClass::class);

        $class->up()->downByTwo();

        $this->assertEquals(-1, $class->escape()->getValue());
    }

    /** @test */
    public function the_instance_can_be_returned()
    {
        $class = new Chain(TestClass::class);

        $this->assertEquals('TestClass', class_basename($class->instance()));
    }
}