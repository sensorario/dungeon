<?php

namespace Sensorario\Dungeon\Test\Sensorario\Dungeon;

use PHPUnit_Framework_TestCase;
use Sensorario\Dungeon\Tile;
use Sensorario\Dungeon\Map;

class MapTest extends PHPUnit_Framework_TestCase
{
    public function testTileIsCoordinateWithPosition()
    {
        $center = Tile::withCoords(2, 3);
        $map = new Map($center, 1);
        $this->assertEquals([0 => [[2, 3], 0]], $map->getAllTiles());
        $this->assertEquals([[[2, 3], 0]], $map->getAllTiles());
    }

    public function testRounds()
    {
        $center = Tile::withCoords(0, 0);
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
        $center = Tile::withCoords(-1, -1);
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
        $map = new Map(Tile::withCoords(0, 0), 3);
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
        $center = Tile::withCoords(0, 0);
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
        $center = Tile::withCoords(0, 0);
        $map = new Map($center, 2);
        $this->assertTrue($exists === $map->hasTile(Tile::withCoords($x, $y)));
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
        $center = Tile::withCoords(0, 0);
        $map = new Map($center, 2);
        $map->addTile(Tile::withCoords(2, 1), 1);
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
        $center = Tile::withCoords(0, 0);
        $map = new Map($center, 2);
        $map->setTileDistance(3, 2);
        $this->assertEquals(2, $map->getDistanceAtIndex(3));
        $this->assertEquals(0, $map->getDistanceAtIndex(0));
        $this->assertEquals(1, $map->getDistanceAtIndex(2));
    }

    public function testGetTileAtIndex()
    {
        $center = Tile::withCoords(0, 0);
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
        $center = Tile::withCoords(0, 0);
        $map = new Map($center, 2);
        $this->assertEquals([[0, 0], 0], $map->getTileAtIndex(133));
    }

    public function testGetDistanceAtCoordinate()
    {
        $center = Tile::withCoords(0, 0);
        $map = new Map($center, 2);
        $this->assertEquals(0, $map->getTileDistanceByCoordinate(Tile::withCoords(0, 0)));
        $this->assertEquals(1, $map->getTileDistanceByCoordinate(Tile::withCoords(1, 0)));
        $this->assertEquals(1, $map->getTileDistanceByCoordinate(Tile::withCoords(-1, 0)));
    }

    public function testGetTileIndexFromCoordinate()
    {
        $center = Tile::withCoords(0, 0);
        $map = new Map($center, 2);
        $this->assertEquals(0, $map->getTileIndex(Tile::withCoords(0, 0)));
        $this->assertEquals(1, $map->getTileIndex(Tile::withCoords(1, 0)));
        $this->assertEquals(4, $map->getTileIndex(Tile::withCoords(-1, 0)));
    }

    public function testAddTileAsZeroDistanceByDefault()
    {
        $center = Tile::withCoords(0, 0);
        $map = new Map($center, 2);
        $map->addTile(Tile::withCoords(2, 1));
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
        $center = Tile::withCoords(0, 0);
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
        $this->assertTrue($map->isTileOnTheEdge(Tile::withCoords(-1, -1)));
        $this->assertTrue(false === $map->isTileOnTheEdge(Tile::withCoords(0, -1)));
    }

    public function testPositionOfCoupleOfCoordinateInsideAMap()
    {
        $center = Tile::withCoords(0, 0);
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
            $map->getPositionOfTile(Tile::withCoords(-1, 0))
        );

        $this->assertSame(
            0,
            $map->getPositionOfTile(Tile::withCoords(0, 0))
        );
    }
}
