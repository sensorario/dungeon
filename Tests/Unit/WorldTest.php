<?php

namespace Tests\Unit;

use Sensorario\Yagolands\World;

class WorldTest extends \PHPUnit_Framework_TestCase
{
    public function testWorld()
    {
        $tile = $this->getMockBuilder('Sensorario\Yagolands\Tile')
            ->disableOriginalConstructor()
            ->setMethods(['getCoordinates'])
            ->getMock();
        $tile->expects($this->once())
            ->method('getCoordinates')
            ->will($this->returnValue([0, 0]));

        $world = new World('yagolands');
        $this->assertEquals('yagolands', $world->getName());
        $this->assertEquals(7, $world->countTiles());
        $this->assertEquals($tile->getCoordinates(), $world->getTileAtIndex(0));
    }

    public function testMap()
    {
        $world = new World('yagolands');
        $this->assertEquals('Sensorario\Yagolands\Map', get_class($world->getMap()));
    }
}
