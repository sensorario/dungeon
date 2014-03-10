<?php

namespace Tests\Unit;

use PHPUnit_Framework_TestCase;
use Sensorario\Yagolands\Tile;
use Sensorario\Yagolands\World;

class WorldTest extends PHPUnit_Framework_TestCase
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
        $this->assertEquals(19, $world->countTiles());
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

    public function testFindFirstFreeTile()
    {
        $world = new World('yagolands');
        $freeIndex = $world->findFreeIndex();
        $this->assertEquals(7, $freeIndex);
        $this->assertEquals([[1, 1], 2], $world->getTileAtIndex($freeIndex));
    }

    public function testBuildAroundFreeTile()
    {
        $world = new World('yagolands');

        $this->assertFalse($world->getMap()->tileExists(new Tile(0, 3)));
        $this->assertFalse($world->getMap()->tileExists(new Tile(1, 3)));
        $this->assertFalse($world->getMap()->tileExists(new Tile(2, 3)));
        $this->assertFalse($world->getMap()->tileExists(new Tile(2, 2)));
        $this->assertFalse($world->getMap()->tileExists(new Tile(3, 2)));
        $this->assertFalse($world->getMap()->tileExists(new Tile(2, 1)));
        $this->assertFalse($world->getMap()->tileExists(new Tile(3, 1)));
        $this->assertFalse($world->getMap()->tileExists(new Tile(3, 0)));

        $world->buildAroundTileAtIndex($world->findFreeIndex());

        $this->assertTrue($world->getMap()->tileExists(new Tile(0, 3)));
        $this->assertTrue($world->getMap()->tileExists(new Tile(1, 3)));
        $this->assertTrue($world->getMap()->tileExists(new Tile(2, 3)));
        $this->assertTrue($world->getMap()->tileExists(new Tile(2, 2)));
        $this->assertTrue($world->getMap()->tileExists(new Tile(3, 2)));
        $this->assertTrue($world->getMap()->tileExists(new Tile(2, 1)));
        $this->assertTrue($world->getMap()->tileExists(new Tile(3, 1)));
        $this->assertTrue($world->getMap()->tileExists(new Tile(3, 0)));
    }
}
