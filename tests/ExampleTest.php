<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->assertEquals(1,1);
    }

    public function testMethodExampleArg() {
        $res = $this->action('GET', 'FrontController@examplePhpunit', ['a'=>1,'b'=>2]);

        $this->assertEquals($res->status(), '200');

        $this->assertEquals(3, $res->content());
    }
}
