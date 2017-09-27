<?php

namespace TheJawker\Chainable\Test;

use Mockery;
use Mockery\MockInterface;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /** @var MockInterface spy */
    public $spy;
    public function setUp()
    {
        parent::setUp();
        $this->spy = Mockery::spy();
    }
    public function tearDown()
    {
        Mockery::close();
    }

    public function avoidTestMarkedAsRisky()
    {
        $this->assertTrue(true);
    }
}