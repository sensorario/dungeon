<?php

namespace Tests\Unit;

use PHPUnit_Framework_TestCase;
use Sensorario\Yagolands\Tile;
use Sensorario\Yagolands\Map;

class MapTest extends PHPUnit_Framework_TestCase
{
    public function testTileIsCoordinateWithPosition()
    {
        $center = new Tile(2, 3);
        $map = new Map($center, 1);
        $this->assertEquals([0 => [[2, 3], 0]], $map->getTiles());
        $this->assertEquals([[[2, 3], 0]], $map->getTiles());
    }

    public function testRounds()
    {
        $center = new Tile(0, 0);
        $map = new Map($center, 2);
        $this->assertEquals(
            [
                [[0, 0], 0], // centro
                [[1, 0], 1], // primo girone
                [[0, -1], 1],
                [[-1, -1], 1],
                [[-1, 0], 1],
                [[-1, 1], 1],
                [[0, 1], 1]
            ],
            $map->getTiles()
        );
    }

    public function testThreeRounds()
    {
        $map = new Map(new Tile(0, 0), 3);
        $this->assertEquals(
            [
                [[0, 0], 0], // centro
                [[1, 0], 1], // primo girone
                [[0, -1], 1],
                [[-1, -1], 1],
                [[-1, 0], 1],
                [[-1, 1], 1],
                [[0, 1], 1],
                [[1, 1], 2], // secondo girone
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
            $map->getTiles()
        );
    }

    public function testChangeDistanceOfTile()
    {
        $center = new Tile(0, 0);
        $map = new Map($center, 2);
        $map->setTileDistance(3, 2);
        $this->assertEquals(
            [
                [[0, 0], 0], // centro
                [[1, 0], 1], // primo girone
                [[0, -1], 1],
                [[-1, -1], 2],
                [[-1, 0], 1],
                [[-1, 1], 1],
                [[0, 1], 1]
            ],
            $map->getTiles()
        );
    }

    /**
     * @dataProvider tiles
     */
    public function testTileExists($x, $y, $exists)
    {
        $center = new Tile(0, 0);
        $map = new Map($center, 2);
        $this->assertTrue($exists === $map->tileExists(new Tile($x, $y)));
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
                [[0, 0], 0], // centro
                [[1, 0], 1], // primo girone
                [[0, -1], 1],
                [[-1, -1], 1],
                [[-1, 0], 1],
                [[-1, 1], 1],
                [[0, 1], 1],
                [[2, 1], 1], // terzo girone
            ],
            $map->getTiles()
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
}
