<?php

namespace Tests\Unit;

use Sensorario\Yagolands\World;

class WorldTest extends \PHPUnit_Framework_TestCase
{
    public function testWorld()
    {
        $tile = $this->getMockBuilder('Sensorario\Yagolands\Tile')
            ->disableOriginalConstructor()
            ->setMethods(['getCoordinates', 'isBuildable'])
            ->getMock();
        $tile->expects($this->once())
            ->method('getCoordinates')
            ->will($this->returnValue([0, 0]));
        $tile->expects($this->once())
            ->method('isBuildable')
            ->will($this->returnValue(false));

        $world = new World('yagolands');
        $this->assertEquals('yagolands', $world->getName());
        $this->assertEquals(7, $world->countTiles());
        $this->assertEquals([$tile->getCoordinates(), $tile->isBuildable()], $world->getTileAtIndex(0));
    }

    public function testMap()
    {
        $world = new World('yagolands');
        $this->assertEquals('Sensorario\Yagolands\Map', get_class($world->getMap()));
    }

    public function testAddPlayersToWorld()
    {
        $demo = $this->getMockBuilder('Sensorario\Yagolands\Player')
            ->disableOriginalConstructor()
            ->getMock();

        $john = $this->getMockBuilder('Sensorario\Yagolands\Player')
            ->disableOriginalConstructor()
            ->getMock();

        $world = new World('yagolands');
        $world->addPlayer($demo);
        $world->addPlayer($john);
        $this->assertEquals(2, $world->countPlayers());
    }
}
