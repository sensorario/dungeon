<?php

namespace Tests\Unit;

use Sensorario\Yagolands\World;

class WorldTest extends \PHPUnit_Framework_TestCase
{
    public function testWorld()
    {
        $world = new World('yagolands');
        $this->assertEquals('yagolands', $world->getName());
    }
}
