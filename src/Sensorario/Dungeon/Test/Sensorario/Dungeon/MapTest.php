<?php

namespace Sensorario\Dungeon\Test\Sensorario\Dungeon;

use PHPUnit_Framework_TestCase;
use Sensorario\Dungeon\Tile;
use Sensorario\Dungeon\Map;

class MapTest extends PHPUnit_Framework_TestCase
{
    public function testTileIsCoordinateWithPosition()
    {
        $center = new Tile(2, 3);
        $map = new Map($center, 1);
        $this->assertEquals([0 => [[2, 3], 0]], $map->getAllTiles());
        $this->assertEquals([[[2, 3], 0]], $map->getAllTiles());
    }

    public function testRounds()
    {
        $center = new Tile(0, 0);
        $map = new Map($center, 2);
        $this->assertEquals(
            [
                [[0, 0], 0],
                [[1, 0], 1],
                [[0, -1], 1],
                [[-1, -1], 1],
                [[-1, 0], 1],
                [[-1, 1], 1],
                [[0, 1], 1]
            ],
            $map->getAllTiles()
        );
    }

    public function testWithDifferentCenter()
    {
        $center = new Tile(-1, -1);
        $map = new Map($center, 2);

        $tiles = $map->getAllTiles();

        $this->assertEquals(
            [[-1, -1], 0],
            $tiles[0]
        );

        $this->assertEquals(
            [[0, -1], 1],
            $tiles[1]
        );
    }

    public function testThreeRounds()
    {
        $map = new Map(new Tile(0, 0), 3);
        $this->assertEquals(
            [
                [[0, 0], 0],
                [[1, 0], 1],
                [[0, -1], 1],
                [[-1, -1], 1],
                [[-1, 0], 1],
                [[-1, 1], 1],
                [[0, 1], 1],
                [[1, 1], 2],
                [[2, 0], 2],
                [[1, -1], 2],
                [[1, -2], 2],
                [[0, -2], 2],
                [[-1, -2], 2],
                [[-2, -1], 2],
                [[-2, 0], 2],
                [[-2, 1], 2],
                [[-1, 2], 2],
                [[0, 2], 2],
                [[1, 2], 2],
            ],
            $map->getAllTiles()
        );
    }

    public function testChangeDistanceOfTile()
    {
        $center = new Tile(0, 0);
        $map = new Map($center, 2);
        $map->setTileDistance(3, 2);
        $this->assertEquals(
            [
                [[0, 0], 0],
                [[1, 0], 1],
                [[0, -1], 1],
                [[-1, -1], 2],
                [[-1, 0], 1],
                [[-1, 1], 1],
                [[0, 1], 1]
            ],
            $map->getAllTiles()
        );
    }

    /**
     * @dataProvider tiles
     */
    public function testTileExists($x, $y, $exists)
    {
        $center = new Tile(0, 0);
        $map = new Map($center, 2);
        $this->assertTrue($exists === $map->hasTile(new Tile($x, $y)));
    }

    public function tiles()
    {
        return [
            [0, 0, true],
            [4, 4, false],
        ];
    }

    public function testAddTile()
    {
        $center = new Tile(0, 0);
        $map = new Map($center, 2);
        $map->addTile(new Tile(2, 1), 1);
        $this->assertEquals(
            [
                [[0, 0], 0],
                [[1, 0], 1],
                [[0, -1], 1],
                [[-1, -1], 1],
                [[-1, 0], 1],
                [[-1, 1], 1],
                [[0, 1], 1],
                [[2, 1], 1],
            ],
            $map->getAllTiles()
        );
    }

    public function testGetDistanceAtIndex()
    {
        $center = new Tile(0, 0);
        $map = new Map($center, 2);
        $map->setTileDistance(3, 2);
        $this->assertEquals(2, $map->getDistanceAtIndex(3));
        $this->assertEquals(0, $map->getDistanceAtIndex(0));
        $this->assertEquals(1, $map->getDistanceAtIndex(2));
    }

    public function testGetTileAtIndex()
    {
        $center = new Tile(0, 0);
        $map = new Map($center, 2);
        $this->assertEquals([[0, 0], 0], $map->getTileAtIndex(0));
        $this->assertEquals([[1, 0], 1], $map->getTileAtIndex(1));
        $this->assertEquals([[-1, 0], 1], $map->getTileAtIndex(4));
    }

    /**
     * @expectedException Sensorario\Dungeon\InvalidPositionException
     */
    public function testInvalidPositionThrowAnException()
    {
        $center = new Tile(0, 0);
        $map = new Map($center, 2);
        $this->assertEquals([[0, 0], 0], $map->getTileAtIndex(133));
    }

    public function testGetDistanceAtCoordinate()
    {
        $center = new Tile(0, 0);
        $map = new Map($center, 2);
        $this->assertEquals(0, $map->getTileDistanceByCoordinate(new Tile(0, 0)));
        $this->assertEquals(1, $map->getTileDistanceByCoordinate(new Tile(1, 0)));
        $this->assertEquals(1, $map->getTileDistanceByCoordinate(new Tile(-1, 0)));
    }

    public function testGetTileIndexFromCoordinate()
    {
        $center = new Tile(0, 0);
        $map = new Map($center, 2);
        $this->assertEquals(0, $map->getTileIndex(new Tile(0, 0)));
        $this->assertEquals(1, $map->getTileIndex(new Tile(1, 0)));
        $this->assertEquals(4, $map->getTileIndex(new Tile(-1, 0)));
    }

    public function testAddTileAsZeroDistanceByDefault()
    {
        $center = new Tile(0, 0);
        $map = new Map($center, 2);
        $map->addTile(new Tile(2, 1));
        $this->assertEquals(
            [
                [[0, 0], 0], // center
                [[1, 0], 1], // first circle
                [[0, -1], 1],
                [[-1, -1], 1],
                [[-1, 0], 1],
                [[-1, 1], 1],
                [[0, 1], 1],
                [[2, 1], 0], // second circle
            ],
            $map->getAllTiles()
        );
    }

    public function testTileIsOnTheEdge()
    {
        $center = new Tile(0, 0);
        $map = new Map($center, 2);
        $map->setTileDistance(3, 2);
        $map->setTileDistance(5, 2);
        $this->assertEquals(
            [
                [[0, 0], 0],
                [[1, 0], 1],
                [[0, -1], 1],
                [[-1, -1], 2],
                [[-1, 0], 1],
                [[-1, 1], 2],
                [[0, 1], 1]
            ],
            $map->getAllTiles()
        );
        $this->assertTrue($map->isTileOnTheEdge(new Tile(-1, -1)));
        $this->assertTrue(false === $map->isTileOnTheEdge(new Tile(0, -1)));
    }

    public function testPositionOfCoupleOfCoordinateInsideAMap()
    {
        $center = new Tile(0, 0);
        $map = new Map($center, 2);
        $this->assertEquals(
            [
                [[0, 0], 0],
                [[1, 0], 1],
                [[0, -1], 1],
                [[-1, -1], 1],
                [[-1, 0], 1],
                [[-1, 1], 1],
                [[0, 1], 1]
            ],
            $map->getAllTiles()
        );

        $this->assertSame(
            4,
            $map->getPositionOfTile(new Tile(-1, 0))
        );

        $this->assertSame(
            0,
            $map->getPositionOfTile(new Tile(0, 0))
        );
    }
}
