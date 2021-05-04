<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Test extends WebTestCase
{
    public function testCreate()
    {
        $this->assertEquals(42, 42);
    }
}
