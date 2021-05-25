<?php

namespace App\Tests;

use App\Entity\Tire\TireWidth;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Test extends WebTestCase
{
    public function testTireWidth()
    {
        $tireWidth = new TireWidth();
        $tireWidth->setWidth(190);
        $this->assertEquals(190, $tireWidth->getWidth());
    }

    public function testIncomplete()
    {
        $this->markTestIncomplete('TODO');
    }
}
