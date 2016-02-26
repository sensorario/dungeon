<?php

namespace Sensorario\Dungeon\Test\Sensorario\Dungeon;

use PHPUnit_Framework_TestCase;
use Sensorario\Dungeon\Tile;
use Sensorario\Dungeon\World;

class WorldTest extends PHPUnit_Framework_TestCase
{
    public function testWorld()
    {
        $tile = $this->getMockBuilder('Sensorario\Dungeon\Tile')
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
        $this->assertEquals('Sensorario\Dungeon\Map', get_class($world->getMap()));
    }

    public function testFindFirstFreeTile()
    {
        $world = new World('yagolands');
        $freeIndex = $world->getEdgeTile();
        $this->assertEquals(7, $freeIndex);
        $this->assertEquals([[1, 1], 2], $world->getTileAtIndex($freeIndex));
    }

    public function testBuildAroundFreeTile()
    {
        $world = new World('yagolands');

        $this->assertFalse($world->getMap()->hasTile(Tile::withCoords(0, 3)));
        $this->assertFalse($world->getMap()->hasTile(Tile::withCoords(1, 3)));
        $this->assertFalse($world->getMap()->hasTile(Tile::withCoords(2, 3)));
        $this->assertFalse($world->getMap()->hasTile(Tile::withCoords(2, 2)));
        $this->assertFalse($world->getMap()->hasTile(Tile::withCoords(3, 2)));
        $this->assertFalse($world->getMap()->hasTile(Tile::withCoords(2, 1)));
        $this->assertFalse($world->getMap()->hasTile(Tile::withCoords(3, 1)));
        $this->assertFalse($world->getMap()->hasTile(Tile::withCoords(3, 0)));

        $world->growAroundTile($world->getEdgeTile());

        $this->assertTrue($world->getMap()->hasTile(Tile::withCoords(0, 3)));
        $this->assertTrue($world->getMap()->hasTile(Tile::withCoords(1, 3)));
        $this->assertTrue($world->getMap()->hasTile(Tile::withCoords(2, 3)));
        $this->assertTrue($world->getMap()->hasTile(Tile::withCoords(2, 2)));
        $this->assertTrue($world->getMap()->hasTile(Tile::withCoords(3, 2)));
        $this->assertTrue($world->getMap()->hasTile(Tile::withCoords(2, 1)));
        $this->assertTrue($world->getMap()->hasTile(Tile::will(3, 1)));
        $this->assertTrue($world->getMap()->hasTile(Tile::will(3, 0)));

        $this->assertEquals(0, $world->getMap()->getTileDistanceByCoordinate(new Tile(1, 1)));

        $this->assertEquals(1, $world->getMap()->getTileDistanceByCoordinate(new Tile(2, 1)));
        $this->assertEquals(1, $world->getMap()->getTileDistanceByCoordinate(new Tile(2, 0)));
        $this->assertEquals(1, $world->getMap()->getTileDistanceByCoordinate(new Tile(1, 0)));
        $this->assertEquals(1, $world->getMap()->getTileDistanceByCoordinate(new Tile(0, 1)));
        $this->assertEquals(1, $world->getMap()->getTileDistanceByCoordinate(new Tile(1, 2)));
        $this->assertEquals(1, $world->getMap()->getTileDistanceByCoordinate(new Tile(2, 2)));

        $this->assertEquals(2, $world->getMap()->getTileDistanceByCoordinate(new Tile(3, 1)));
        $this->assertEquals(2, $world->getMap()->getTileDistanceByCoordinate(new Tile(3, 0)));
        $this->assertEquals(2, $world->getMap()->getTileDistanceByCoordinate(new Tile(2, -1)));
        $this->assertEquals(2, $world->getMap()->getTileDistanceByCoordinate(new Tile(1, -1)));
        $this->assertEquals(1, $world->getMap()->getTileDistanceByCoordinate(new Tile(0, -1)));
        $this->assertEquals(0, $world->getMap()->getTileDistanceByCoordinate(new Tile(0, 0)));
        $this->assertEquals(1, $world->getMap()->getTileDistanceByCoordinate(new Tile(-1, 1)));
        $this->assertEquals(2, $world->getMap()->getTileDistanceByCoordinate(new Tile(0, 2)));
        $this->assertEquals(2, $world->getMap()->getTileDistanceByCoordinate(new Tile(0, 3)));
        $this->assertEquals(2, $world->getMap()->getTileDistanceByCoordinate(new Tile(1, 3)));
        $this->assertEquals(2, $world->getMap()->getTileDistanceByCoordinate(new Tile(2, 3)));
        $this->assertEquals(2, $world->getMap()->getTileDistanceByCoordinate(new Tile(3, 2)));
    }

    public function testFindFreeIndexWillBeRandom()
    {
        $world = new World('yagolands');
        $this->assertTrue(false === $world->freeIndexSearchIsRandom());
        $world->growAroundTile($world->getEdgeTile());
        $this->assertTrue(true === $world->freeIndexSearchIsRandom());
    }

    public function testWorldGrowRandomly()
    {
        $yagolands = new World('yagolands');
        $yagolands->growAroundTile($yagolands->getEdgeTile());

        $threegates = new World('threegates');
        $threegates->growAroundTile($threegates->getEdgeTile());

        $this->assertTrue($yagolands->getMap() == $threegates->getMap());

        $yagolands->growAroundTile($yagolands->getEdgeTile());
        $yagolands->growAroundTile($yagolands->getEdgeTile());
        $yagolands->growAroundTile($yagolands->getEdgeTile());
        $yagolands->growAroundTile($yagolands->getEdgeTile());
        $yagolands->growAroundTile($yagolands->getEdgeTile());

        $threegates->growAroundTile($threegates->getEdgeTile());
        $threegates->growAroundTile($threegates->getEdgeTile());
        $threegates->growAroundTile($threegates->getEdgeTile());
        $threegates->growAroundTile($threegates->getEdgeTile());
        $threegates->growAroundTile($threegates->getEdgeTile());

        $this->assertFalse($yagolands->getMap() == $threegates->getMap());
    }
}
